<?php

class AndroidController {

  public function fetchFeedbacks($pageIndex = 1) {
    $mobileInfo = $_POST['mobileInfo'];
    $searchPhrase = $_POST['searchPhrase'];

    $itemCount = 15;
    $itemIndex = ($pageIndex - 1) * $itemCount;

    $totalItems = AndroidModel::searchFeedbacksByTextAndMobileInfo($mobileInfo, $searchPhrase, -1, -1);
    $feedbacks = AndroidModel::searchFeedbacksByTextAndMobileInfo($mobileInfo, $searchPhrase, $itemIndex, $itemCount);

    $data['feedbacks'] = $feedbacks;
    $data['pageIndex'] = $pageIndex;
    $data['pageCount'] = ceil(count($totalItems) / $itemCount);
    $data['itemCount'] = $itemCount;
    View::renderPartial("/android/fetch_feedbacks.php", $data);
  }


  public function deleteFeedback(){
    $feedbackId = $_POST['feedbackId'];

    for($i=1; $i<4; $i++){
      $file_path = "image/feedback/" .$feedbackId. "_" . $i . ".png";
      if(file_exists ($file_path)){
        unlink($file_path);
      }else{
        $file_path = "image/feedback/" .$feedbackId. "_" . $i . ".jpg";
        if(file_exists ($file_path)){
          unlink($file_path);
        }
      }
    }

    AndroidModel::deleteFeedback($feedbackId);
  }
}