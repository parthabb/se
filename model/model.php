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

    public function GetUserByEmpId($empId) {
      $query = 'SELECT * FROM login where empId = ' . $empId;
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
      $query = ('Insert into leaves (empId, startDate, endDate, status) ' .
          'values (' . $empid . ', "' . $start_date .'", "' . $end_date . '",' .
          ' "Pending")');
      return mysqli_query($this->con, $query);
    }

    public function GetPendingLeavesOfSubordinates($empid) {
      // Change query to accomodate juniors.
      $query = 'select ID, employee.empId, fName, lName, startDate, endDate, ' .
               'status from ' .
               'employee join leaves where employee.empId=' . $empid . ' and ' .
               'employee.empId=leaves.empId';
      return mysqli_query($this->con, $query);
    }

    public function ApproveLeaves($decision_map) {
      $query = 'update leaves set status = case ID';
      foreach ($decision_map as $key => $value) {
        $query .= ' when ' . $key . ' then "' . $value .'"';
      }
      $query .= ' end where ID in (' . implode(',', array_keys($decision_map)) .
      ')';

      return mysqli_query($this->con, $query);
    }

  }
?>