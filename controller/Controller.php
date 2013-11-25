<?php
  class IndexController {
    private $model;

    public function __construct($model) {
      $this->model = $model;
    }

    public function GetTemplate() {
      return $this->model->GetTemplate();
    }

    public function GetPageTitle() {
      return $this->model->GetPageTitle();
    }
  }

  class WelcomeController {
    private $model;

    public function __construct($model) {
      $this->model = $model;
    }

    public function GetTemplate() {
      return $this->model->GetTemplate();
    }

    public function GetPageTitle() {
      return $this->model->GetPageTitle();
    }
  }
?>