<?php

class UniController {

  public function fetchUnis($pageIndex = 1){
    $uniStateSelector = $_POST['uniStateSelector'];
    $uniCitySelector = $_POST['uniCitySelector'];
    $searchPhrase = $_POST['searchPhrase'];

    $itemCount = 15;
    $itemIndex = ($pageIndex - 1) * $itemCount;

    $totalItems = UniModel::searchUnisByStateAndCityAndWebUserId($uniStateSelector, $uniCitySelector, getUserId(), $searchPhrase, -1, -1);
    $unis = UniModel::searchUnisByStateAndCityAndWebUserId($uniStateSelector, $uniCitySelector, getUserId(), $searchPhrase, $itemIndex, $itemCount);

    $data['unis'] = $unis;
    $data['pageIndex'] = $pageIndex;
    $data['pageCount'] = ceil(count($totalItems) / $itemCount);
    $data['itemCount'] = $itemCount;
    View::renderPartial("/uni/fetchUni.php", $data);
  }

  public function deleteUni(){
    $uniId = $_POST['uniId'];

    UniModel::deleteUni($uniId);

    // delete uniLogo image
    $file_path = "image/uniLogo/" .$uniId. ".png";
    if(file_exists ($file_path)){
      unlink($file_path);
    }else{
      $file_path = "image/uniLogo/" .$uniId. ".jpg";
      unlink($file_path);
    }

    // delete uniPhotos directory
    $dir_path = "image/uniPhotos/" .$uniId;
    deleteDirectory($dir_path);
  }





  public function fetchReviews($pageIndex = 1){
    $dateSelector = $_POST['dateSelector'];
    $reportSelector = $_POST['reportSelector'];
    $searchPhrase = $_POST['searchPhrase'];
    $uniId = $_POST['uniId'];

    $itemCount = 15;
    $itemIndex = ($pageIndex - 1) * $itemCount;

    $totalItems = UniModel::searchReviewsByDateAndReportAndUniId($dateSelector, $reportSelector, $searchPhrase, $uniId, -1, -1);
    $reviews = UniModel::searchReviewsByDateAndReportAndUniId($dateSelector, $reportSelector, $searchPhrase, $uniId, $itemIndex, $itemCount);

    $data['reviews'] = $reviews;
    $data['pageIndex'] = $pageIndex;
    $data['pageCount'] = ceil(count($totalItems) / $itemCount);
    $data['itemCount'] = $itemCount;
    View::renderPartial("/uni/fetchReviews.php", $data);
  }

  public function deleteReview(){
    $uniReviewId = $_POST['uniReviewId'];

    UniModel::deleteReview($uniReviewId);
  }

}