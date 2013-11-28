<?php
  function UnsetAllMessages() {
    if (isset($_SESSION['ErrMsg'])) {
      unset($_SESSION['ErrMsg']);
    }
    if (isset($_SESSION['SuccessMsg'])) {
      unset($_SESSION['SuccessMsg']);
    }
    if (isset($_SESSION['InfoMsg'])) {
      unset($_SESSION['InfoMsg']);
    }
  }

  function IsLoggedIn() {
    return isset($_SESSION['empid']);
  }


  function Logout() {
    session_unset();
  }


  function Login($con) {
    if (!isset($_POST['EmpId']) or !isset($_POST['PassWd'])) {
      $_SESSION['ErrMsg'] = 'Employee id or password not set';
      return false;
    }

    $empid = $_POST['EmpId'];
    $pass = $_POST['PassWd'];

    // usermodel
    $m = new UserModel($con);
    $result = $m->GetUserByEmpIdAndPass($empid, $pass);

    if ($result) {
      $row = mysqli_fetch_array ( $result );
      $_SESSION['empid'] = $empid;
      $_SESSION['username'] = $row ['userName'];
      return true;
    }

    $_SESSION['ErrMsg'] = 'Employee id and password do not match';
    return false;
  }

?>