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

      if (isset($_SESSION['username'])) {
        $this->params = array_merge($this->params,
                                    array('user' => $_SESSION['username']));
      }

      return $this->params;
    }

    public function GetTemplate() {
      return $this->template;
    }
  }

  class LeavesView extends BaseView {

    public function GetParams() {
      if (isset($_POST['applyLeave']) and $_POST['applyLeave'] === 'applyLeave') {
        $this->controller->ApplyLeaves();
      }

      $params = array('leaves' => $this->controller->GetLeaves());
      return array_merge(parent :: GetParams(), $params);
    }

  }


  class ApplyView extends BaseView {

    public function GetParams() {
      $params = array('leaves_count' => $this->controller->GetLeavesCount(),
                      'leave_types' => $GLOBALS['leave_type']);
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
          'decisions' => $GLOBALS['decisions']);
      return array_merge($params, parent :: GetParams());
    }
  }
?>