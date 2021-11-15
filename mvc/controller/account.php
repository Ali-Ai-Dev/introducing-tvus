<?php

class AccountController {

  public function fetchAccounts($pageIndex = 1){
    $accessTypeSelector = $_POST['accessTypeSelector'];
    $searchPhrase = $_POST['searchPhrase'];

    $itemCount = 15;
    $itemIndex = ($pageIndex - 1) * $itemCount;

    $totalItems = AccountModel::searchWebUserByEmailAndAccess($accessTypeSelector, $searchPhrase, -1, -1);
    $accounts = AccountModel::searchWebUserByEmailAndAccess($accessTypeSelector, $searchPhrase, $itemIndex, $itemCount);

    $data['accounts'] = $accounts;
    $data['pageIndex'] = $pageIndex;
    $data['pageCount'] = ceil(count($totalItems) / $itemCount);
    $data['itemCount'] = $itemCount;
    View::renderPartial("/account/fetch_accounts.php", $data);
  }



  public function resetPassword(){
    $userId = $_POST['userId'];
    $userEmail = $_POST['userEmail'];

    $hashedPassword = encryptCharacters($userEmail);
    AccountModel::resetPassword($userId, $hashedPassword);
  }



  public function changeAccess(){
    $userId = $_POST['userId'];
    $accessType = $_POST['accessType'];

    AccountModel::changeAccessModel($userId, $accessType);
  }



  public function logout(){
    session_destroy();
    header("Location: " . fullBaseUrl());

    session_start();
    session_regenerate_id();

    initializeSettings();
  }



  public function login() {
    $email = post('userEmail');

    // show login form if email not provided
    if ($email == null) {
      View::render("default", "/account/login.php");
      return;
    }

    // check login information to be valid
    $password = post('userPassword');

    $record = AccountModel::fetch_by_email($email);
    if ($record == null) {
      echo('emailNotRegisterd');
    } else {
      $hashedPassword = encryptCharacters($password);
      if ($hashedPassword == $record['userPassword']) {

        session_set('user_id', $record['user_id']);
        session_set('email', $record['userEmail']);
        session_set('access', $record['userAccess']);

        //message('success', _login_welcome, true);
        if($record['mustChangePassword'] == 1){
          echo('mustChangePassword');
        }
      } else {
        echo('invalidPassword');
      }
    }
  }



  public function register(){
    grantAdmin();
    $email = post('userEmail');

    // show registration form if email not provided
    if ($email == null) {
      $data['activePage'] = 'registerUser';
      View::render("defaultDashboard", "/account/register.php", $data);
      return;
    }

    // check registration info and register if is valid information
    $email = post('userEmail');
    $password1 = post('userPassword1');
    $time = getCurrentDateTime();

    $record = AccountModel::fetch_by_email($email);
    if ($record != null){
      echo('alreadyRegistered');
      return;
    }

    $hashedPassword = encryptCharacters($password1);
    AccountModel::insert($email, $hashedPassword, $time);
  }



  public function changePassword(){
    $userPassword1 = post('userPassword1');

    // show registration form if email not provided
    if ($userPassword1 == null) {
      grantUser();
      View::render("default", "/account/change_password.php", array());
      return;
    }

    // check changePassword info and change if is valid information
    $userId = session_get('user_id');

    $hashedPassword = encryptCharacters($userPassword1);
    AccountModel::changePasswordById($userId, $hashedPassword);

    header("Location: " . fullBaseUrl());
  }
}