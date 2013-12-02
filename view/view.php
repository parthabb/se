<?php
  class BaseView {
    // Base view class that is extended by all other classes.
    protected $controller;
    private $params = array();

    public function __construct($controller, $page_title) {
      $this->controller = $controller;
      $this->page_title = $page_title;
      $this->params = array('pagetitle' => $page_title);
    }

    public function GetParams() {
      if (isset($_SESSION['ErrMsg'])) {
        $this->params = array_merge($this->params,
                                    array('err' => $_SESSION['ErrMsg']));
      }
      if (isset($_SESSION['InfoMsg'])) {
        $this->params = array_merge($this->params,
                                    array('info' => $_SESSION['InfoMsg']));
      }
      if (isset($_SESSION['SuccessMsg'])) {
        $this->params = array_merge($this->params,
                                    array('success' => $_SESSION['SuccessMsg']));
      }
      if (isset($_SESSION['username'])) {
        $this->params = array_merge($this->params,
                                    array('user' => $_SESSION['username'],
                                          /*'super_user' => $_SESSION['superId']*/
      ));}

      return $this->params;
    }

    public function GetTemplate() {
      return $this->template;
    }
  }

  class LeavesView extends BaseView {

    public function GetParams() {
      if (isset($_POST['applyLeave']) and $_POST['applyLeave'] === 'applyLeave') {
        // Php validation for end date later than start date.
        if (strtotime($_POST['StartDate']) > strtotime($_POST['EndDate'])) {
          $_SERVER['REQUEST_URI'] = '/las/index.php?page=apply';
          $_SESSION['ErrMsg'] = 'Start date later than end date. Please correct.';
          return parent :: GetParams();
        }
        $this->controller->ApplyLeaves();
      }

      $params = array('leaves' => $this->controller->GetLeaves(),
                      'show_apply_leaves' => true,
                      'show_approve_leaves' => $_SESSION['superId']);
      return array_merge(parent :: GetParams(), $params);
    }

  }


  class ApplyView extends BaseView {

    public function GetParams() {
      $params = array('leaves_count' => $this->controller->GetLeavesCount(),
                      'leave_types' => $GLOBALS['leave_type'],
                      'show_view_link' => true,
                      'show_approve_leaves' => $_SESSION['superId']);
      return array_merge($params, parent :: GetParams());
    }
  }


  class ApproveView extends BaseView {

    public function GetParams() {
      if (isset($_POST['submit_approval']) and $_POST['submit_approval'] === 'submit_approval') {
        $this->controller->SubmitApproval();
      }

      $params = array(
          'pending_approvals' => $this->controller->GetPendingApprovals(),
          'decisions' => $GLOBALS['decisions'],
          'show_view_link' => true,
          'show_apply_leaves' => true,);
      return array_merge($params, parent :: GetParams());
    }
  }

?>