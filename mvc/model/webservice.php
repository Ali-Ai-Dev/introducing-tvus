<?php
class WebserviceModel {

  public static function passwordChangeRequestModel($userId, $tokenHash) {
    $db = Db::getInstance();
    $db->insert("INSERT INTO user_password_change_requests (user_id, token, time, isPasswordChanged)
                VALUES (:userId, :token, :currentTime, :isPasswordChanged)" , array(
      'token' => $tokenHash,
      'userId' => $userId,
      'currentTime' => date("Y-m-d H:i:s"),
      'isPasswordChanged' => 0,
    ));
  }



  public static function changePasswordForTheUserModel($tokenHash, $userPassword) {
    $db = Db::getInstance();
    $db->modify("UPDATE user_password_change_requests SET isPasswordChanged=:isPasswordChange WHERE token=:token" , array(
      'token' => $tokenHash,
      'isPasswordChange' => 1,
    ));

    $db->modify("UPDATE user INNER JOIN user_password_change_requests ON user.user_id = user_password_change_requests.user_id
                SET userPassword=:userPassword WHERE token=:token" , array(
      'userPassword' => $userPassword,
      'token' => $tokenHash,
    ));
  }



  public static function clearSearchHistoryModel($userId) {
    $db = Db::getInstance();
    $db->modify("UPDATE user SET userRecentSearches=:userRecentSearches WHERE user_id=:userId" , array(
      'userRecentSearches' => '',
      'userId' => $userId,
    ));
  }



  public static function applyProfileChangeModel($userId, $userName, $userEmail) {
    $db = Db::getInstance();
    $db->modify("UPDATE user SET userName=:userName, userEmail=:userEmail WHERE user_id=:userId" , array(
      'userName' => $userName,
      'userEmail' => $userEmail,
      'userId' => $userId,
    ));
  }



  public static function updateUserSignInWithGoogleToOneModel($userId) {
    $db = Db::getInstance();
    $db->modify("UPDATE user SET userSignInWithGoogle=:userSignInWithGoogle WHERE user_id=:userId" , array(
      'userSignInWithGoogle' => 1,
      'userId' => $userId,
    ));
  }



  public static function fetchTokenDataModel($tokenHash) {
    $db = Db::getInstance();
    $tokenData = $db->query("SELECT * FROM user_password_change_requests WHERE token=:token" , array(
      'token' => $tokenHash,
    ));

    return $tokenData;
  }



  public static function fetchUserInfoByIdModel($userId) {
    $db = Db::getInstance();
    $userInfo = $db->query("SELECT * FROM user WHERE user_id=:userId" , array(
      'userId' => $userId,
    ));

    return $userInfo;
  }



  public static function userRegisterModel($userName, $userEmail, $userPassword, $userSignInWithGoogle) {
    $db = Db::getInstance();
    $userId = $db->insert("INSERT INTO user (userName, userEmail, userPassword, userSignInWithGoogle, userRecentSearches)
                VALUES (:userName, :userEmail, :userPassword, :userSignInWithGoogle, :userRecentSearches)" , array(
      'userName' => $userName,
      'userEmail' => $userEmail,
      'userPassword' => $userPassword,
      'userRecentSearches' => '',
      'userSignInWithGoogle' => $userSignInWithGoogle,
    ));

    return $userId;
  }



  public static function fetchUserInfoByEmailModel($userEmail) {
    $db = Db::getInstance();
    $fetchUserInfoByEmail = $db->query("SELECT * FROM user WHERE userEmail=:userEmail" , array(
      'userEmail' => $userEmail,
    ));

    return $fetchUserInfoByEmail;
  }



  public static function checkUserSignInModel($userEmail, $userPassword) {
    $db = Db::getInstance();
    $checkUserSignIn = $db->query("SELECT * FROM user WHERE userEmail=:userEmail AND userPassword=:userPassword" , array(
      'userEmail' => $userEmail,
      'userPassword' => $userPassword,
    ));

    return $checkUserSignIn;
  }



  public static function setRecentSearchesByUserIdModel($userId, $recentSearches) {
    $db = Db::getInstance();
    $db->modify("UPDATE user SET userRecentSearches=:userRecentSearches WHERE user_id=:userId" , array(
      'userId' => $userId,
      'userRecentSearches' => $recentSearches,
    ));
  }



  public static function submitNewReviewModel($uniId, $userId, $reviewRate, $reviewText) {
    $db = Db::getInstance();
    $db->insert("INSERT INTO uni_review (uni_id, user_id, reviewDate, reviewRate, reviewText, reviewUpVote, reviewDownVote, reviewReport, reviewEdited)
                VALUES (:uniId, :userId, :reviewDate, :reviewRate, :reviewText, :reviewUpVote, :reviewDownVote, :reviewReport, :reviewEdited)" , array(
      'uniId' => $uniId,
      'userId' => $userId,
      'reviewDate' => getCurrentDateTime(),
      'reviewRate' => $reviewRate,
      'reviewText' => $reviewText,
      'reviewUpVote' => 0,
      'reviewDownVote' => 0,
      'reviewReport' => '',
      'reviewEdited' => 0,
    ));
  }



  public static function reportReviewModel($uniReviewId, $reviewReport) {
    $db = Db::getInstance();
    $db->modify("UPDATE uni_review SET reviewReport=:reviewReport WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
      'reviewReport' => $reviewReport,
    ));
  }



  public static function deleteReviewModel($uniReviewId) {
    $db = Db::getInstance();
    $db->modify("DELETE FROM uni_review WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
    ));

    $db->modify("DELETE FROM user_review_vote WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
    ));
  }



  public static function submitEditReviewModel($uniReviewId, $reviewRate, $reviewText) {
    $db = Db::getInstance();
    $db->modify("UPDATE uni_review SET reviewRate=:reviewRate, reviewText=:reviewText, reviewEdited=:reviewEdited WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
      'reviewRate' => $reviewRate,
      'reviewText' => $reviewText,
      'reviewEdited' => 1,
    ));
  }



  public static function incrementUpVoteModel($uniReviewId) {
    $db = Db::getInstance();
    $db->modify("UPDATE uni_review SET reviewUpVote=reviewUpVote+1 WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
    ));
  }



  public static function decrementUpVoteModel($uniReviewId) {
    $db = Db::getInstance();
    $db->modify("UPDATE uni_review SET reviewUpVote=reviewUpVote-1 WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
    ));
  }




  public static function incrementDownVoteModel($uniReviewId) {
    $db = Db::getInstance();
    $db->modify("UPDATE uni_review SET reviewDownVote=reviewDownVote+1 WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
    ));
  }




  public static function decrementDownVoteModel($uniReviewId) {
    $db = Db::getInstance();
    $db->modify("UPDATE uni_review SET reviewDownVote=reviewDownVote-1 WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
    ));
  }



  public static function fetchCurrentVoteModel($userId, $uniReviewId) {
    $db = Db::getInstance();
    $fetchCurrentVote = $db->query("SELECT * FROM user_review_vote WHERE user_id=:userId AND uniReview_id=:uniReviewId" , array(
      'userId' => $userId,
      'uniReviewId' => $uniReviewId,
    ));

    return $fetchCurrentVote;
  }



  public static function fetchCurrentUserReviewModel($uniId, $userId) {
    $db = Db::getInstance();
    $fetchCurrentUserReview = $db->query("SELECT uniReview_id,uni_review.user_id, userName, reviewDate, reviewRate, reviewText, reviewUpVote, reviewDownVote, reviewEdited
                                        FROM uni_review INNER JOIN user ON uni_review.user_id = user.user_id
                                        WHERE uni_id=:uniId AND uni_review.user_id=:userId" , array(
      'uniId' => $uniId,
      'userId' => $userId,
    ));

    return $fetchCurrentUserReview;
  }



  public static function fetchAvgAndNumberOfReviewsModel($uniId) {
    $db = Db::getInstance();
    $fetchAvgAndNumberOfReviews = $db->query("SELECT COUNT(*) AS numberOfReviews, AVG(reviewRate) AS average
                                            FROM uni_review WHERE uni_id=:uniId" , array(
      'uniId' => $uniId,
    ));

    return $fetchAvgAndNumberOfReviews;
  }




  public static function fetchUniReviewsByUniIdModel($uniId, $orderBy, $limitFrom) {
    $db = Db::getInstance();

    if($orderBy == 'New'){
      $uniReviewsByUniId = $db->query("SELECT uniReview_id,uni_review.user_id, userName, reviewDate, reviewRate, reviewText, reviewUpVote, reviewDownVote, reviewEdited
                                    FROM uni_review INNER JOIN user ON uni_review.user_id = user.user_id
                                    WHERE uni_id=:uniId ORDER BY reviewDate DESC LIMIT $limitFrom,10" , array(
        'uniId' => $uniId,
      ));

      return $uniReviewsByUniId;
    }

    // Happen when (orderBy == 'Top')
    // Algorithm for fetchTop list of VoteUp & VoteDown
    // From here (https://stackoverflow.com/questions/33444600/mysql-logical-order-by/33444805#33444805)
    $uniReviewsByUniId = $db->query("SELECT uniReview_id,uni_review.user_id, userName, reviewDate, reviewRate, reviewText, reviewUpVote, reviewDownVote, reviewEdited,
                                    ((reviewUpVote + 1.9208) / (reviewUpVote + ABS(reviewDownVote)) -
                                    1.96 * SQRT((reviewUpVote * ABS(reviewDownVote)) / (reviewUpVote + ABS(reviewDownVote)) + 0.9604) /
                                    (reviewUpVote + ABS(reviewDownVote))) / (1 + 3.8416 / (reviewUpVote + ABS(reviewDownVote)))
                                     AS ci_lower_bound
                                FROM uni_review INNER JOIN user ON uni_review.user_id = user.user_id
                                WHERE uni_id=:uniId
                                ORDER BY ci_lower_bound DESC LIMIT $limitFrom,10" , array(
      'uniId' => $uniId,
    ));

    return $uniReviewsByUniId;
  }



  public static function fetchAllReviewsUserVotedInThisUniModel($uniId, $userId) {
    $db = Db::getInstance();
    $allReviewsVotedByThisUserInThisUni = $db->query("SELECT * FROM uni_review
                                            INNER JOIN user_review_vote ON uni_review.uniReview_id = user_review_vote.uniReview_id
                                            WHERE uni_id=:uniId AND user_review_vote.user_id=:userId" , array(
      'uniId' => $uniId,
      'userId' => $userId,
    ));

    return $allReviewsVotedByThisUserInThisUni;
  }



  public static function insertCurrentVoteModel($userId, $uniReviewId, $isUpVote) {
    $db = Db::getInstance();
    $db->insert("INSERT INTO user_review_vote (user_id, uniReview_id, vote)
                VALUES (:userId, :uniReviewId, :isUpVote)" , array(
      'userId' => $userId,
      'uniReviewId' => $uniReviewId,
      'isUpVote' => $isUpVote,
    ));
  }



  public static function deleteCurrentVoteModel($userReviewVote_id) {
    $db = Db::getInstance();
    $db->modify("DELETE FROM user_review_vote WHERE userReviewVote_id=:userReviewVote_id" , array(
      'userReviewVote_id' => $userReviewVote_id,
    ));
  }



  public static function updateCurrentVoteModel($userReviewVote_id, $isUpVote) {
    $db = Db::getInstance();
    $db->modify("UPDATE user_review_vote SET vote=:isUpVote WHERE userReviewVote_id=:userReviewVote_id" , array(
      'userReviewVote_id' => $userReviewVote_id,
      'isUpVote' => $isUpVote,
    ));
  }



  public static function insertFeedbackTextAndGetId($feedbackText, $mobileInfoBrandModelDeviceSdk) {
    $db = Db::getInstance();
    $feedbackId = $db->insert("INSERT INTO feedback (feedbackText, mobileInfoBrandModelDeviceSdk)
                VALUES (:feedbackText, :mobileInfoBrandModelDeviceSdk)" , array(
      'feedbackText' => $feedbackText,
      'mobileInfoBrandModelDeviceSdk' => $mobileInfoBrandModelDeviceSdk,
    ));

    return $feedbackId;
  }



  public static function sendFeedbackImages($id, $fileName) {
    // we add pipeLine for all of the images and specially the first one
    // because if the size of the first image is too high
    // it will be copied after than the others
    $fileName = "|" . $fileName;

    $db = Db::getInstance();
    $db->modify("UPDATE feedback SET feedbackImages=CONCAT(IFNULL(feedbackImages,''), :fileName) WHERE feedback_id=:feedback_id" , array(
      'feedback_id' => $id,
      'fileName' => $fileName,
    ));
  }



  public static function deleteFeedbackCancelByUser($feedbackId) {
    $db = Db::getInstance();
    $db->modify("DELETE FROM feedback WHERE feedback_id=:feedbackId" , array(
      'feedbackId' => $feedbackId,
    ));
  }





  public static function fetchMostViewedUnisModel($uniState) {
    if($uniState == ''){
      $findState = '1=1';
      $limitNumber = '5';
    }else{
      $findState = 'uniStateFa=:uniState OR uniStateEn=:uniState';
      $limitNumber = '1';
    }

    $db = Db::getInstance();
    $mostViewedUnis = $db->query("(Select uni_id,uniFullNameFa,uniFullNameEn,uniStateFa,uniStateEn,uniLogo,uniGender,viewCounts From unis
                          INNER JOIN uni_state ON unis.uniState_id=uni_state.uniState_id
                          WHERE uniGender='boys' AND ($findState)
                          ORDER BY viewCounts DESC LIMIT $limitNumber)

                          UNION

                          (Select uni_id,uniFullNameFa,uniFullNameEn,uniStateFa,uniStateEn,uniLogo,uniGender,viewCounts From unis
                          INNER JOIN uni_state ON unis.uniState_id=uni_state.uniState_id
                          WHERE uniGender='girls' AND ($findState)
                          ORDER BY viewCounts DESC LIMIT $limitNumber)" , array(
      'uniState' => $uniState,
    ));
    return $mostViewedUnis;
  }



  public static function fetchImageSliderMainModel() {
    $db = Db::getInstance();
    $imageSliderMain = $db->first("Select * From image_slider_main");

    return $imageSliderMain;
  }



  public static function fetchUniDetailsByIdModel($uni_id) {
    $db = Db::getInstance();
    $db->modify("UPDATE unis SET viewCounts=viewCounts+1 WHERE uni_id=:uni_id" , array(
      'uni_id' => $uni_id,
    ));


    $fetchUniDetailsById = $db->query("SELECT * FROM unis
                                     INNER JOIN uni_state ON unis.uniState_id=uni_state.uniState_id
                                     INNER JOIN uni_city ON unis.uniCity_id=uni_city.uniCity_id
                                     INNER JOIN uni_type ON unis.uniType_id=uni_type.uniType_id
                                     INNER JOIN uni_affiliations ON unis.uniAffiliations_id=uni_affiliations.uniAffiliations_id
                                     WHERE uni_id=:uni_id" , array(
      'uni_id' => $uni_id,
    ));

    return $fetchUniDetailsById;
  }



  public static function fetchUniMoreInfoByIdModel($uni_id) {
    $db = Db::getInstance();
    $fetchUniMoreInfoById = $db->query("SELECT * FROM uni_more_info
                                     INNER JOIN unis ON uni_more_info.uniMoreInfo_id=unis.uni_id
                                     WHERE uni_more_info.uni_id=:uni_id" , array(
      'uni_id' => $uni_id,
    ));
    return $fetchUniMoreInfoById;
  }



  public static function fetchAllUnisNameAndUnisStateModel() {
    $db = Db::getInstance();
    $fetchAllUnisNameAndUnisState = array();

    $fetchAllUnisNameAndUnisState['unisName'] = $db->query("Select uniFullNameFa,uniFullNameEn From unis");
    $fetchAllUnisNameAndUnisState['unisState'] = $db->query("Select uniStateFa,uniStateEn From uni_state ORDER BY uniStateFa");
    return $fetchAllUnisNameAndUnisState;
  }



  public static function fetchSearchUnisByNameAndStateModel($searchPhrase, $uniState) {
    if($uniState == ''){
      $findState = '1=1';
    }else{
      $findState = 'uniStateFa=:uniState OR uniStateEn=:uniState';
    }

    $db = Db::getInstance();
    $fetchUniMoreInfoById = $db->query("SELECT uni_id,uniStateFa,uniStateEn,uniFullNameFa,uniFullNameEn,uniLogo,uniGender FROM unis
                                      INNER JOIN uni_state ON unis.uniState_id=uni_state.uniState_id
                                      WHERE ($findState) AND
                                            (uniFullNameFa LIKE :searchPhrase OR uniFullNameEn LIKE :searchPhrase)" , array(
      'searchPhrase' => "%$searchPhrase%",
      'uniState' => $uniState,
    ));
    return $fetchUniMoreInfoById;
  }
}