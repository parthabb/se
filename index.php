<?php
  // File imports.
  require_once './model/Model.php';  // relative path to models file.
  require_once './controller/Controller.php';  // relative path to controller file.
  require_once './view/View.php';  // relative path to views file.
  // Import the Twig template library.
  require_once './Twig/lib/Twig/Autoloader.php'; // relative path to twig library

  Twig_Autoloader::register();

  $loader = new Twig_Loader_Filesystem('./html');
  $twig = new Twig_Environment($loader, array(
      'cache' => './tmp/cache', 'auto_reload' => true,
  ));

  $data = array(
    // The different pages in the application.
    'index' => array('model' => 'IndexModel', 'view' => 'IndexView',
                     'controller' => 'IndexController'),
    'view_leaves' => array('model' => 'WelcomeModel', 'view' => 'WelcomeView',
                           'controller' => 'WelcomeController'),
  );

  $page;
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  }

  if(empty($page)) {
    $page = 'index';
  }

  foreach ($data as $key => $controller) {
    if ($page == $key) {
      $model = $controller['model'];
      $view = $controller['view'];
      $controller = $controller['controller'];
      break;
    }
  }

  if (isset($model)) {
    $m = new $model;
    $c = new $controller($m);
    $v = new $view($c);

    $template = $twig->loadTemplate($v->GetTemplate() . '.phtml');
    $template->display($v->GetParams());
  }
?>
