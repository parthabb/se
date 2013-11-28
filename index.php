<?php
  session_start();

  // ========================== File imports ==================================
  require_once './library/utility.php';  // relative path to utility functions file.
  require_once './model/model.php';  // relative path to models file.
  require_once './controller/controller.php';  // relative path to controller file.
  require_once './view/view.php';  // relative path to views file.
  require_once './library/constants.php';  // File with all the constants.


  //  ================== Import the Twig template library ======================
  require_once './Twig/lib/Twig/Autoloader.php'; // relative path to twig library

  Twig_Autoloader::register();

  $loader = new Twig_Loader_Filesystem('./html');
  $twig = new Twig_Environment($loader, array(
      'cache' => './tmp/cache', 'auto_reload' => true,
  ));
  //  ================== Import the Twig template library ======================


  // ================= Establish connection to the database ====================
  $con = GetDBHandle($machine, $user_name, $pass, $db);


  // ========== Check if logged-in the set page to direct to ===================
  if (IsLoggedIn()) {
    if (isset($_GET['page']) and $_GET['page'] === 'logout') {
      Logout();
      $_SESSION['LogoutMsg'] = 'Successfully logged out';
      $page = 'index';
    } else if (isset($_GET['page']) and $_GET['page'] !== 'login') {
      $page = $_GET['page'];
    } else {
      // If logged-in and URL is default then redirect to view_leaves page.
      $page = 'view_leaves';
    }
  } else {
    $page = 'index';
    // Login for handling log-in without redirection.
    if (isset($_GET['page']) and $_GET['page'] === 'login') {
      if (Login($con)) {
        // Validates if the login if correct and if correct set log-in as
        // true in session go to page.
        $page = $_POST['next_page'];
      }
    }
  }


  // ====================== Select page to show ================================
  foreach ($data as $key => $value) {
    if ($page === $key) {
      $model = $value['model'];
      $view = $value['view'];
      $controller = $value['controller'];
      $pagetitle = $value['pagetitle'];
      $template_name = $value['template'];
      break;
    }
  }


  // =========================== Show page =====================================
  if (isset($model)) {
    $m = new $model($con);
    $c = new $controller($m);
    $v = new $view($c, $pagetitle);


    $template = $twig->loadTemplate($template_name . '.phtml');
    $param = $v->GetParams();
    // Set the next page in case the user is not logged-in and types in URL,
    // s/he should be redirected to the correct page after loggin-in, except
    // when he comes to the log-in page through the logout link.
    if ($page = 'index' and isset($_GET['page']) and $_GET['page'] !== 'logout') {
      $param = array_merge($param, array('next_page' => $_GET['page']));
    }
    $template->display($param);
  }

  // ========================== close DB connection ============================
  mysqli_close ( $con );
  UnsetAllMessages();
?>
