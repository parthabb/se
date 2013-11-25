<?php
  class IndexView {

    private $controller;
    private $page_title;

    public function __construct($controller) {
      $this->controller = $controller;
    }

    public function GetTemplate() {
      return $this->controller->GetTemplate();
    }

    public function GetParams() {
      return array(
          'user' => 'Partha',
          'pagetitle' => $this->controller->GetPageTitle(),
      );
    }

  }

  class WelcomeView {

    private $controller;
    private $page_title;

    public function __construct($controller) {
      $this->controller = $controller;
    }

    public function GetTemplate() {
      return $this->controller->GetTemplate();
    }

    public function GetParams() {
      return array(
          'user' => 'Partha',
          'pagetitle' => $this->controller->GetPageTitle(),
      );
    }
  }
?>