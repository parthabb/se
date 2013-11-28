<?php
  class BaseController {
    protected $model;

    public function __construct($model) {
      $this->model = $model;
    }
  }


  class LeavesController extends BaseController {

    public function GetLeaves() {
      $result = $this->model->GetLeavesForEmpId($_SESSION['empid']);
      $leaves = array();

      if ($result) {
        while ($row = mysqli_fetch_array($result)) {
          $leaves = array_merge(
              $leaves,
              array(array(
                  'start_date' => $row['startDate'],
                  'end_date' => $row['endDate'],
                  'status' => $row['status'],
                  'reason' => $row['reason'])));
        }
      }
      return $leaves;
    }

    public function GetLeavesCount() {
      $result = $this->model->GetLeavesCountByEmdId($_SESSION['empid']);
      $leaves_count = null;

      if ($result) {
        while ($row = mysqli_fetch_array($result)) {
          $leaves_count = array(
              'total' => $row['total'],
              'remaining' => $row['remaining']);
        }
      }
      return $leaves_count;
    }

    public function ApplyLeaves() {
      $start_date = $_POST['StartDate'];
      $end_date = $_POST['EndDate'];
      $type = $_POST['Type'];
      $reason = $_POST['Reason'];
      if ($this->model->SubmitLeaves($_SESSION['empid'], $start_date, $end_date,
          $type, $reason)) {
        $_SESSION['SuccessMsg'] = 'Successfully applied for leave.';
        return;
      }
      $_SESSION['ErrMsg'] = 'Leave appication failed.';
    }

    public function GetPendingApprovals() {
      $pending_approvals = array();
      $result = $this->model->GetPendingLeavesOfSubordinates($_SESSION['empid']);

      if ($result) {
        while ($row = mysqli_fetch_array($result)) {
          $pending_approvals = array_merge($pending_approvals, array(array(
              'id' => $row['ID'],
              'empid' => $row['empId'],
              'fName' => $row['fName'],
              'lName' => $row['lName'],
              'start_date' => $row['startDate'],
              'end_date' => $row['endDate'],
              'status' => $row['status'],
              'reason' => $row['reason'],
              'type' => $row['type'],
          )));
        }
      }
      return $pending_approvals;
    }

    public function SubmitApproval() {
      $decision_map = array();

      foreach ($_POST['identifier'] as $key => $value) {
        $decision_map = $decision_map + array(
            $value => $_POST['decision-' . $value]);
      }

      if ($this->model->ApproveLeaves($decision_map)) {
        $_SESSION['SuccessMsg'] = 'Successfully appoved/rejected for leave.';
        return;
      }
      $_SESSION['ErrMsg'] = 'Leave approval/rejection failed.';
    }
  }
/*
  class AdminController extends BaseController {
     public function GetAllUsers() {
       $result = $this->model->GetAllUsers();
     }
  }
*/
?>