<?php
  // ======================== Page configurations ==============================
  $data = array(
      // The different pages in the application.
      'index' => array(
          'controller' => 'BaseController',
          'model' => 'BaseModel',
          'pagetitle' => 'Index',
          'template' => 'index',
          'view' => 'BaseView',),
      'view_leaves' => array(
          'controller' => 'LeavesController',
          'model' => 'LeavesModel',
          'pagetitle' => 'View Leaves',
          'template' => 'view_leaves',
          'view' => 'LeavesView'),
      'apply' => array(
          'controller' => 'LeavesController',
          'model' => 'LeavesModel',
          'pagetitle' => 'Apply For Leaves',
          'template' => 'apply',
          'view' => 'ApplyView'),
      'approve' => array(
          'controller' => 'LeavesController',
          'model' => 'LeavesModel',
          'pagetitle' => 'Approve Leaves',
          'template' => 'approve',
          'view' => 'ApproveView'),
      // Handle default behavior.*/
  );


  // ========================= Database configuration ==========================
  $machine = 'localhost';  // machine name
  $user_name = 'root';  // username
  $pass = 'root';  // password
  $db = 'las';  // database name


  // =========================== status options ================================
  $decisions = array('Approved', 'Rejected', 'Pending');

?>