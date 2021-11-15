<?php
class WebserviceController {

  public function googleSignInOrRegister(){
    $userName= $_POST['userName'];
    $userEmail= $_POST['userEmail'];

    $userData = array();

    $userInfo = WebserviceModel::fetchUserInfoByEmailModel($userEmail);
    if($userInfo != null){
      // if user registered with email before, and first time signIn with Google
      if($userInfo[0]['userSignInWithGoogle'] == 0){
        $userId = $userInfo[0]['user_id'];
        WebserviceModel::updateUserSignInWithGoogleToOneModel($userId);
      }

      $userData['Type'] = "SignIn";
      $userData['userInfo'] = $userInfo;
      echo(json_encode($userData));
      return;
    }

    $userId = WebserviceModel::userRegisterModel($userName, $userEmail, '', 1);
    $userData['Type'] = "Register";
    $userData['user_id'] = $userId;
    echo(json_encode($userData));
  }



  public function resetPassword(){
    $userEmail= $_POST['userEmail'];

    do{
      $token = randomString(15);
      $tokenHash = encryptCharacters($token);
      $tokenData = WebserviceModel::fetchTokenDataModel($tokenHash);
    }while($tokenData != null);

    $userInfo = WebserviceModel::fetchUserInfoByEmailModel($userEmail);
    if($userInfo == null) {
      echo("EmailNotRegistered");
      return;
    }

    $userId = $userInfo[0]['user_id'];
    $userName = $userInfo[0]['userName'];
    WebserviceModel::passwordChangeRequestModel($userId, $tokenHash);

    $subject = "Reset Password";
    $message = "
      <html>
        <head>
          <title>$subject</title>
        </head>
        <body style='direction: rtl'>
          <div>$userName <span>:</span></div>
          <div style='margin-top: 20px; margin-bottom: 5px;'>لطفا جهت تغییر رمز عبور خود بر روی لینک زیر کلیک نمائید:</div>
          <div style='direction: ltr'>
            <a href='http://intro-tvus.mahsoftgroup.ir/webservice/resetPassword?token=$token'>intro-tvus.mahsoftgroup.ir/webservice/resetPassword?token=$token</a>
          </div>
        </body>
      </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <intro-tvus@mahsoftgroup.ir>' . "\r\n";

    mail($userEmail,$subject,$message,$headers);
    echo("EmailSent");
  }



  public function checkTokenAndFetchUserInfo() {
    $token= $_POST['token'];
    $tokenHash = encryptCharacters($token);

    $tokenData = WebserviceModel::fetchTokenDataModel($tokenHash);
    if($tokenData == null){
      // when link is wrong, we use Expired too
      echo("Expired");
      return;
    }else if($tokenData[0]['isPasswordChanged'] == 1){
      echo("PasswordHasChangedBefore");
      return;
    }

    $userId = $tokenData[0]['user_id'];
    $timeChangePasswordRequest = $tokenData[0]['time'];

    $timeAddTwoDays = new DateTime($timeChangePasswordRequest);
    $timeAddTwoDays->modify('+1 day');

    $currentTime = date("Y-m-d H:i:s");
    $currentTime = new DateTime($currentTime);

    if($currentTime > $timeAddTwoDays){
      echo("Expired");
      return;
    }

    $userInfo = WebserviceModel::fetchUserInfoByIdModel($userId);
    echo(json_encode($userInfo));
  }



  public function changePassword(){
    $token= $_POST['token'];
    $userPassword = $_POST['userPassword'];

    $tokenHash = encryptCharacters($token);
    WebserviceModel::changePasswordForTheUserModel($tokenHash, $userPassword);
  }



  public function clearSearchHistory(){
    $userId= $_POST['userId'];
    WebserviceModel::clearSearchHistoryModel($userId);
  }



  public function applyProfileChange(){
    $userId= $_POST['userId'];
    $userName= $_POST['userName'];
    $userEmail= $_POST['userEmail'];

    $userInfo = WebserviceModel::fetchUserInfoByEmailModel($userEmail);
    if($userInfo != null){
      if($userInfo[0]['user_id'] != $userId){
        echo("EmailDuplicate");
        return;
      }
    }

    WebserviceModel::applyProfileChangeModel($userId, $userName, $userEmail);
  }



  public function userRegister() {
    $userName= $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

    $checkUserEmail = WebserviceModel::fetchUserInfoByEmailModel($userEmail);
    if($checkUserEmail != null){
      if($checkUserEmail[0]['userPassword'] == ''){
        echo("GoogleEmailDuplicate");
      }else{
        echo("EmailDuplicate");
      }
      return;
    }

    $userId = WebserviceModel::userRegisterModel($userName, $userEmail, $userPassword, 0);
    echo($userId);
  }



  public function userSignIn() {
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

    $checkUserEmail = WebserviceModel::fetchUserInfoByEmailModel($userEmail);
    if($checkUserEmail == null) {
      echo("EmailNotRegistered");
      return;
    }else if($checkUserEmail[0]['userPassword'] == ''){
      echo("GoogleEmailSignIn");
      return;
    }

    $checkUserSignIn = WebserviceModel::checkUserSignInModel($userEmail, $userPassword);
    if($checkUserSignIn == null) {
      echo("PasswordIsIncorrect");
      return;
    }
    echo(json_encode($checkUserSignIn));
  }



  public function userSignInByIdWhenEnterApp() {
    $userId = $_POST['userId'];

    $userInfo = WebserviceModel::fetchUserInfoByIdModel($userId);
    echo(json_encode($userInfo));
  }



  public function setRecentSearchesByUserId() {
    $userId = $_POST['userId'];
    $recentSearches = $_POST['recentSearches'];

    WebserviceModel::setRecentSearchesByUserIdModel($userId, $recentSearches);
  }



  public function submitNewReview() {
    $uniId = $_POST['uniId'];
    $userId = $_POST['userId'];
    $reviewRate = $_POST['reviewRate'];
    $reviewText = $_POST['reviewText'];

    WebserviceModel::submitNewReviewModel($uniId, $userId, $reviewRate, $reviewText);
  }



  public function reportReview() {
    $uniReviewId = $_POST['uniReviewId'];
    $reviewReport = $_POST['reviewReport'];

    WebserviceModel::reportReviewModel($uniReviewId, $reviewReport);
  }



  public function deleteReview() {
    $uniReviewId = $_POST['uniReviewId'];

    WebserviceModel::deleteReviewModel($uniReviewId);
  }



  public function submitEditReview() {
    $uniReviewId = $_POST['uniReviewId'];
    $reviewRate = $_POST['reviewRate'];
    $reviewText = $_POST['reviewText'];

    WebserviceModel::submitEditReviewModel($uniReviewId, $reviewRate, $reviewText);
    WebserviceModel::submitEditReviewModel($uniReviewId, $reviewRate, $reviewText);
  }



  public function setVote() {
    $userId = $_POST['userId'];
    $uniReviewId = $_POST['uniReviewId'];
    $isUpVote = $_POST['isUpVote'];

    $currentVote = WebserviceModel::fetchCurrentVoteModel($userId, $uniReviewId);
    if($currentVote == null){
      if($isUpVote == 1){
        WebserviceModel::incrementUpVoteModel($uniReviewId);
      }else{
        WebserviceModel::decrementDownVoteModel($uniReviewId);
      }

      WebserviceModel::insertCurrentVoteModel($userId, $uniReviewId, $isUpVote);
      echo("SetNewVote");
      return;
    }

    if($currentVote[0]['vote'] == 1){
      if($isUpVote == 1){
        WebserviceModel::decrementUpVoteModel($uniReviewId);
        WebserviceModel::deleteCurrentVoteModel($currentVote[0]['userReviewVote_id']);
        echo("DeleteUpVote");
        return;
      }else{
        WebserviceModel::decrementUpVoteModel($uniReviewId);
        WebserviceModel::decrementDownVoteModel($uniReviewId);
        WebserviceModel::updateCurrentVoteModel($currentVote[0]['userReviewVote_id'], $isUpVote);
        echo("DeleteUpVoteInsertDownVote");
        return;
      }
    }

    if($isUpVote == 1){
      WebserviceModel::incrementUpVoteModel($uniReviewId);
      WebserviceModel::incrementDownVoteModel($uniReviewId);
      WebserviceModel::updateCurrentVoteModel($currentVote[0]['userReviewVote_id'], $isUpVote);
      echo("DeleteDownVoteInsertUpVote");
      return;
    }else{
      WebserviceModel::incrementDownVoteModel($uniReviewId);
      WebserviceModel::deleteCurrentVoteModel($currentVote[0]['userReviewVote_id']);
      echo("DeleteDownVote");
      return;
    }
  }



  public function fetchAvgAndNumberOfReviewsAndCurrentReview() {
    $userId = $_POST['userId'];
    $uniId = $_POST['uniId'];

    $allData = array();

    $allData['currentUserReview'] = WebserviceModel::fetchCurrentUserReviewModel($uniId, $userId);
    $allData['avgAndNumberOfReviews'] = WebserviceModel::fetchAvgAndNumberOfReviewsModel($uniId);
    echo(json_encode($allData));
  }



  public function fetchUniReviewsByUniId() {
    $uniId = $_POST['uniId'];
    $userId = $_POST['userId'];
    $orderBy = $_POST['orderBy'];
    $limitFrom = $_POST['limitFrom'];

    $allData = array();

    $allData['allReviews'] = WebserviceModel::fetchUniReviewsByUniIdModel($uniId, $orderBy, $limitFrom);
    $allData['allReviewsUserVoted'] = WebserviceModel::fetchAllReviewsUserVotedInThisUniModel($uniId, $userId);
    echo(json_encode($allData));
  }




  public function insertFeedbackTextAndGetId() {
    $feedbackText = $_POST['feedbackText'];
    $mobileInfoBrandModelDeviceSdk = $_POST['mobileInfoBrandModelDeviceSdk'];

    $feedbackId = WebserviceModel::insertFeedbackTextAndGetId($feedbackText, $mobileInfoBrandModelDeviceSdk);


    $subject = "New Feedback_(introducingTVUs)";
    $message = "
      <html>
        <head>
          <title>$subject</title>
        </head>
        <body style='direction: rtl'>
          <span>متن بازخورد:</span>
          <div>$feedbackText</div>
        </body>
      </html>
    ";
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <intro-tvus@mahsoftgroup.ir>' . "\r\n";

    mail('a.bozorgzad1995@gmail.com',$subject,$message,$headers);


    echo $feedbackId;
  }



  public function sendFeedbackImages() {
    $fileName = basename($_FILES['uploaded_file']['name']);
    $explode = explode('_', $fileName);
    $id = $explode[0];

    $fileNameInDb = "/image/feedback/" . $fileName;
    WebserviceModel::sendFeedbackImages($id, $fileNameInDb);

    $file_path = "image/feedback/" . $fileName;
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path) ){
      echo "success";
    } else{
      echo "fail";
    }
  }



  public function deleteFeedbackCancelByUser() {
    $feedbackId = $_POST['feedbackId'];
    $numberOfImagesMustUpload = $_POST['numberOfImagesMustUpload'];
    WebserviceModel::deleteFeedbackCancelByUser($feedbackId);

    for($i=1; $i<=$numberOfImagesMustUpload; $i++){
      $file_path = "image/feedback/" .$feedbackId. "_" .$i. ".jpg";
      if (is_file($file_path))
      {
        unlink($file_path);
      }
    }
  }




  public function fetchMostViewedUnis() {
    if(isset($_POST['uniState'])){
      $uniState = $_POST['uniState'];
    }else{
      $uniState = '';
    }
    $mostViewedUnis = WebserviceModel::fetchMostViewedUnisModel($uniState);

    echo(json_encode($mostViewedUnis));
  }



  public function fetchImageSliderMain() {
    $imageSliderMain = WebserviceModel::fetchImageSliderMainModel();
    echo(json_encode($imageSliderMain));
  }



  public function fetchUniDetailsById() {
    $uni_id = $_POST['uni_id'];
    $fetchUniDetailsById = WebserviceModel::fetchUniDetailsByIdModel($uni_id);
    echo(json_encode($fetchUniDetailsById));
  }



  public function fetchUniMoreInfoById() {
    $uni_id = $_POST['uni_id'];
    $fetchUniMoreInfoById = WebserviceModel::fetchUniMoreInfoByIdModel($uni_id);
    echo(json_encode($fetchUniMoreInfoById));
  }



  public function fetchAllUnisNameAndUnisState() {
    $fetchAllUnisNameAndUnisState = WebserviceModel::fetchAllUnisNameAndUnisStateModel();
    echo(json_encode($fetchAllUnisNameAndUnisState));
  }



  public function fetchSearchUnisByNameAndState() {
    $uniState = $_POST['uniState'];
    $searchPhrase = $_POST['searchPhrase'];
    $fetchSearchUnisByNameAndState = WebserviceModel::fetchSearchUnisByNameAndStateModel($searchPhrase, $uniState);
    echo(json_encode($fetchSearchUnisByNameAndState));
  }
}