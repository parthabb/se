<?php
  function GetDBHandle($machine, $username, $password, $db_name) {
    $con = mysqli_connect($machine, $username, $password, $db_name);
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_errno();
      $_SESSION['ErrMsg'] = 'Server Error'; // put up a server error page.
      return;
    }
    return $con;
  }


  class BaseModel {
    protected $con;

    public function __construct($handle) {
      $this->con = $handle;
    }

  }


  class UserModel extends BaseModel {
    public function GetUserByEmpIdAndPass($empId, $pass) {
      $query = 'SELECT * FROM employee where empId = ' . $empId . ' and ' .
               'password = MD5("' . $pass . '")';
      return mysqli_query ($this->con, $query);
    }
  }


  class LeavesModel extends BaseModel {

    public function GetLeavesForEmpId($empid) {
      $query = 'Select * from leaves where empId = ' . $empid;
      return mysqli_query($this->con, $query);
    }

    public function GetLeavesCountByEmdId($empid) {
      $query = 'Select * from lcount where empId = ' . $empid;
      return mysqli_query($this->con, $query);
    }

    public function SubmitLeaves($empid, $start_date, $end_date, $type,
                                 $reason) {
      mysqli_query($this->con, 'start transaction');

      $query = ('Insert into leaves (empId, startDate, endDate, type, reason) ' .
          'values (' . $empid . ', "' . $start_date .'", "' . $end_date . '", ' .
          '"' . $type . '", "' . $reason . '")');
      $result = mysqli_query($this->con, $query);
      $new_result = false;
      if ($result) {
        $new_q = 'update lcount set remaining = remaining - datediff("'
            . $end_date . '", "' . $start_date . '") - 1 where ' .
            'lcount.empId=' . $empid;
        $new_result = mysqli_query($this->con, $new_q);
      }

      if ($result and $new_result) {
        mysqli_query($this->con, 'commit');
      } else {
        mysqli_query($this->con, 'rollback');
      }
      return $result and $new_result;
    }

    public function GetPendingLeavesOfSubordinates($empid) {
      // Change query to accomodate juniors.
      $query = 'select ID, employee.empId, fName, lName, startDate, endDate, ' .
               'status, reason, type from ' .
               'employee join leaves where employee.empId !=' . $empid . ' and ' .
               'employee.empId=leaves.empId and status="Pending"';
      return mysqli_query($this->con, $query);
    }

    public function ApproveLeaves($decision_map) {
      $ids = implode(',', array_keys($decision_map));
      $query = 'select * from leaves where ID in (' . $ids . ')';
      $old_data = mysqli_query($this->con, $query);

      mysqli_query($this->con, 'start transaction');

      $query = 'update leaves set status = case ID';
      foreach ($decision_map as $key => $value) {
        $query .= ' when ' . $key . ' then "' . $value .'"';
      }
      $query .= ' end where ID in (' . $ids . ')';
      $result = mysqli_query($this->con, $query);

      $new_result = false;
      if ($result) {
        $new_dm = array();

        while ($row = mysqli_fetch_array($old_data)) {
          if (!isset($new_dm[$row['ID']])) {
            $new_dm += array($row['empId'] => 0);
          }

          if (isset($decision_map[(string)$row['ID']]) and $decision_map[
              (string)$row['ID']] === 'Rejected') {
              $new_dm[$row['empId']] += round(
                    (strtotime($row['endDate']) - strtotime(
                        $row['startDate'])) / 86400) + 1;
          }
        }

        $new_q = 'update lcount set remaining = case empId';
        foreach ($new_dm as $k => $v) {
            $new_q .= ' when ' . $k  . ' then remaining + ' . $v;
        }
        $new_q .= ' end where empId in (' . implode(',', array_keys(
            $new_dm)) . ')';
        $new_result = mysqli_query($this->con, $new_q);
      }
      if ($result and $new_result) {
        mysqli_query($this->con, 'commit');
      } else {
        mysqli_query($this->con, 'rollback');
      }
      return $result and $new_result;
    }

  }
?>