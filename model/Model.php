<?php
  class IndexModel {
    private $page_title;
    private $template_name;

    public function __construct() {
      $this->page_title = 'Index';
      $this->template_name = 'index';
    }

    public function GetTemplate() {
      return $this->template_name;
    }

    public function GetPageTitle() {
      return $this->page_title;
    }
  }

  class WelcomeModel {
    private $page_title;
    private $template_name;

    public function __construct() {
      $this->page_title = 'Welcome';
      $this->template_name = 'welcome';
    }

    public function GetTemplate() {
      return $this->template_name;
    }

    public function GetPageTitle() {
      return $this->page_title;
    }
  }
?>