<?php
class AccountModel {


  public static function insert($userEmail, $userPassword, $userRegisterTime){
    $db = Db::getInstance();
    $db->insert("INSERT INTO web_user (userEmail, userPassword, userAccess, mustChangePassword, userRegisterTime) VALUES (:userEmail, :userPassword, :userAccess, :mustChangePassword, :userRegisterTime)", array(
      'userEmail' => $userEmail,
      'userPassword' => $userPassword,
      'userAccess' => '|' .'author'. '|',
      'mustChangePassword' => 1,
      'userRegisterTime' => $userRegisterTime,
    ));
  }



  public static function fetch_by_email($userEmail){
    $db = Db::getInstance();
    $record = $db->first("SELECT * FROM web_user WHERE userEmail=:userEmail", array(
      'userEmail' => $userEmail,
    ));
    return $record;
  }



  public static function changePasswordById($userId, $hashedPassword){
    $db = Db::getInstance();
    $db->modify("UPDATE web_user SET userPassword=:userPassword, mustChangePassword=:mustChangePassword WHERE user_id=:userId", array(
      'userId' => $userId,
      'userPassword' => $hashedPassword,
      'mustChangePassword' => 0,
    ));
  }



  public static function promote_user($userId, $access){
    $db = Db::getInstance();
    $db->modify("UPDATE x_user SET access=:access WHERE user_id=:user_id", array(
      'user_id' => $userId,
      'access' => $access,
    ));
  }



  public static function get_user_access($userId){
    $db = Db::getInstance();
    $record = $db->first("SELECT access FROM x_user WHERE user_id=:user_id", array(
      'user_id' => $userId,
    ));
    return $record['access'];
  }




  public static function searchWebUserByEmailAndAccess($accessTypeSelector, $searchPhrase, $itemIndex, $itemCount){
    if (strcmp($accessTypeSelector, "") == 0) {
      $accessType = '1=1';
    }else{
      $accessType = 'userAccess=:accessTypeSelector';
    }
    if($itemIndex == -1){
      $limit = '';
    }else{
      $limit = 'LIMIT ' .$itemIndex. ',' .$itemCount;
    }

    $db = Db::getInstance();
    $accounts = $db->query("SELECT user_id, userEmail, userAccess FROM web_user
                        WHERE ($accessType) AND (userEmail LIKE :searchPhrase) $limit" , array(
      'accessTypeSelector' => "|". $accessTypeSelector ."|",
      'searchPhrase' => "%$searchPhrase%",
    ));

    return $accounts;
  }




  public static function resetPassword($userId, $hashedPassword){
    $db = Db::getInstance();
    $db->modify("UPDATE web_user SET userPassword=:userPassword, mustChangePassword=:mustChangePassword WHERE user_id=:user_id", array(
      'user_id' => $userId,
      'userPassword' => $hashedPassword,
      'mustChangePassword' => 1,
    ));
  }




  public static function changeAccessModel($userId, $accessType){
    $db = Db::getInstance();
    $db->modify("UPDATE web_user SET userAccess=:userAccess WHERE user_id=:user_id", array(
      'user_id' => $userId,
      'userAccess' => "|". $accessType ."|",
    ));
  }
}