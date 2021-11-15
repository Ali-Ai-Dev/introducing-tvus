<?php

class AndroidModel {

  public static function fetchMainImageSlider() {
    $db = Db::getInstance();
    $imageSlider = $db->first("SELECT * FROM image_slider_main");
    return $imageSlider;
  }



  public static function updateImageSlider($imageSliderMainId, $imageSliderData) {
    $db = Db::getInstance();
    $db->modify("UPDATE image_slider_main SET images=:imageSliderData WHERE imageSliderMain_id=:imageSliderMainId", array(
      'imageSliderMainId' => $imageSliderMainId,
      'imageSliderData' => $imageSliderData,
    ));
  }



  public static function searchFeedbacksByTextAndMobileInfo($mobileInfo, $searchPhrase, $itemIndex, $itemCount){
    if($itemIndex == -1){
      $limit = '';
    }else{
      $limit = 'LIMIT ' .$itemIndex. ',' .$itemCount;
    }

    $db = Db::getInstance();
    $feedbacks = $db->query("SELECT * FROM feedback WHERE (mobileInfoBrandModelDeviceSdk LIKE :mobileInfo)
                            AND (feedbackText LIKE :searchPhrase) $limit" , array(
      'mobileInfo' => "%$mobileInfo%",
      'searchPhrase' => "%$searchPhrase%",
    ));

    return $feedbacks;
  }


  public static function deleteFeedback($feedbackId){
    $db = Db::getInstance();
    $db->modify("DELETE FROM feedback WHERE feedback_id=:feedbackId" , array(
      'feedbackId' => $feedbackId,
    ));
  }
}