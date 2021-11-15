<?php
class UniModel {


  public static function fetchUniFullDataById($uniId){
    $db = Db::getInstance();
    $uni = $db->first("SELECT * FROM unis
                      INNER JOIN uni_state ON unis.uniState_id = uni_state.uniState_id
                      INNER JOIN uni_city ON unis.uniCity_id = uni_city.uniCity_id
                      INNER JOIN uni_type ON unis.uniType_id = uni_type.uniType_id
                      INNER JOIN uni_affiliations ON unis.uniAffiliations_id = uni_affiliations.uniAffiliations_id
                      INNER JOIN uni_more_info ON unis.uni_id = uni_more_info.uni_id
                      WHERE unis.uni_id=:uniId", array(
      'uniId' => $uniId,
    ));
    return $uni;
  }


  public static function fetchStates(){
    $db = Db::getInstance();
    $uniStates = $db->query("SELECT uniStateFa FROM uni_state ORDER BY uniStateFa");
    return $uniStates;
  }


  public static function fetchCities(){
    $db = Db::getInstance();
    $uniCities = $db->query("SELECT uniCityFa FROM uni_city ORDER BY uniCityFa");
    return $uniCities;
  }


  public static function fetchUniTypes(){
    $db = Db::getInstance();
    $uniTypes = $db->query("SELECT uniTypeFa FROM uni_type");
    return $uniTypes;
  }


  public static function fetchUniAffiliations(){
    $db = Db::getInstance();
    $uniAffiliations = $db->query("SELECT uniAffiliationsFa FROM uni_affiliations");
    return $uniAffiliations;
  }


  public static function fetchUniStateByName($uniStateSelector){
    $db = Db::getInstance();
    $uniState = $db->first("SELECT * FROM uni_state WHERE uniStateFa=:uniStateSelector OR uniStateEn=:uniStateSelector", array(
      'uniStateSelector' => $uniStateSelector,
    ));
    return $uniState;
  }


  public static function fetchUniStateById($uniStateId){
    $db = Db::getInstance();
    $uniState = $db->first("SELECT uniStateFa, uniStateEn FROM uni_state WHERE uniState_id=:uniStateId", array(
      'uniStateId' => $uniStateId,
    ));
    return $uniState;
  }


  public static function fetchUniCityById($uniCityId){
    $db = Db::getInstance();
    $uniCity = $db->first("SELECT uniCityFa, uniCityEn FROM uni_city WHERE uniCity_id=:uniCityId", array(
      'uniCityId' => $uniCityId,
    ));
    return $uniCity;
  }


  public static function fetchUniTypeById($uniTypeId){
    $db = Db::getInstance();
    $uniType = $db->first("SELECT uniTypeFa, uniTypeEn FROM uni_type WHERE uniType_id=:uniTypeId", array(
      'uniTypeId' => $uniTypeId,
    ));
    return $uniType;
  }


  public static function fetchUniAffiliationsById($uniAffiliationsId){
    $db = Db::getInstance();
    $uniAffiliations = $db->first("SELECT uniAffiliationsFa, uniAffiliationsEn FROM uni_affiliations WHERE uniAffiliations_id=:uniAffiliationsId", array(
      'uniAffiliationsId' => $uniAffiliationsId,
    ));
    return $uniAffiliations;
  }


  public static function fetchUniCityByName($uniCitySelector){
    $db = Db::getInstance();
    $uniCity = $db->first("SELECT * FROM uni_city WHERE uniCityFa=:uniCitySelector OR uniCityEn=:uniCitySelector", array(
      'uniCitySelector' => $uniCitySelector,
    ));
    return $uniCity;
  }


  public static function fetchUniTypeByName($uniTypeSelector){
    $db = Db::getInstance();
    $uniType = $db->first("SELECT * FROM uni_type WHERE uniTypeFa=:uniTypeSelector OR uniTypeEn=:uniTypeSelector", array(
      'uniTypeSelector' => $uniTypeSelector,
    ));
    return $uniType;
  }


  public static function fetchUniAffiliationByName($uniAffiliationSelector){
    $db = Db::getInstance();
    $uniAffiliation = $db->first("SELECT * FROM uni_affiliations
                                WHERE uniAffiliationsFa=:uniAffiliationSelector OR uniAffiliationsEn=:uniAffiliationSelector", array(
      'uniAffiliationSelector' => $uniAffiliationSelector,
    ));
    return $uniAffiliation;
  }


  public static function fetchUniLogoById($uniId){
    $db = Db::getInstance();
    $uniLogo = $db->first("SELECT uniLogo FROM unis WHERE uni_id=:uniId", array(
      'uniId' => $uniId,
    ));
    return $uniLogo;
  }


  public static function fetchUniPhotosById($uniId){
    $db = Db::getInstance();
    $uniPhotos = $db->first("SELECT uniPhotos FROM unis WHERE uni_id=:uniId", array(
      'uniId' => $uniId,
    ));
    return $uniPhotos;
  }



  public static function insertUniState($uniStateFa, $uniStateEn){
    $db = Db::getInstance();
    $uniStateId = $db->insert("INSERT INTO uni_state (uniStateFa, uniStateEn) VALUES (:uniStateFa, :uniStateEn)", array(
      'uniStateFa' => $uniStateFa,
      'uniStateEn' => $uniStateEn,
    ));
    return $uniStateId;
  }



  public static function insertUniCity($uniCityFa, $uniCityEn){
    $db = Db::getInstance();
    $uniCityId = $db->insert("INSERT INTO uni_city (uniCityFa, uniCityEn) VALUES (:uniCityFa, :uniCityEn)", array(
      'uniCityFa' => $uniCityFa,
      'uniCityEn' => $uniCityEn,
    ));
    return $uniCityId;
  }




  public static function deleteUni($uniId){
    $db = Db::getInstance();
    $db->modify("DELETE FROM unis WHERE uni_id=:uniId" , array(
      'uniId' => $uniId,
    ));

    $db->modify("DELETE FROM uni_more_info WHERE uni_id=:uniId" , array(
      'uniId' => $uniId,
    ));

    $db->modify("DELETE FROM uni_review WHERE uni_id=:uniId" , array(
      'uniId' => $uniId,
    ));
  }



  public static function deleteReview($uniReviewId){
    $db = Db::getInstance();
    $db->modify("DELETE FROM uni_review WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
    ));

    $db->modify("DELETE FROM user_review_vote WHERE uniReview_id=:uniReviewId" , array(
      'uniReviewId' => $uniReviewId,
    ));
  }


  public static function searchReviewsByDateAndReportAndUniId($dateSelector, $reportSelector, $searchPhrase, $uniId, $itemIndex, $itemCount){
    if (strcmp($dateSelector, "New") == 0) {
      $dateSort = 'DESC';
    }else{
      $dateSort = 'ASC';
    }
    if (strcmp($reportSelector, "") == 0) {
      $reportType = '1=1';
    }else{
      $reportType = 'reviewReport=:reviewReport';
    }

    if($itemIndex == -1){
      $limit = '';
    }else{
      $limit = 'LIMIT ' .$itemIndex. ',' .$itemCount;
    }

    $db = Db::getInstance();
    $reviews = $db->query("SELECT * FROM uni_review
                        WHERE ($reportType) AND (reviewText LIKE :searchPhrase) AND (uni_id=:uniId)
                        ORDER BY reviewDate $dateSort $limit" , array(
      'reviewReport' => $reportSelector,
      'searchPhrase' => "%$searchPhrase%",
      'uniId' => $uniId,
    ));

    return $reviews;
  }




  public static function searchUnisByStateAndCityAndWebUserId($uniStateSelector, $uniCitySelector, $webUserId, $searchPhrase, $itemIndex, $itemCount){
    if (strcmp($uniStateSelector, "انتخاب استان") == 0) {
      $findState = '1=1';
    }else{
      $findState = 'uniStateFa=:uniStateSelector';
    }
    if (strcmp($uniCitySelector, "انتخاب شهر") == 0) {
      $findCity = '1=1';
    }else{
      $findCity = 'uniCityFa=:uniCitySelector';
    }

    if(isAdmin()){
      $findUserId = '1=1';
    }else{
      $findUserId = 'web_user_id=:webUserId';
    }
    if($itemIndex == -1){
      $limit = '';
    }else{
      $limit = 'LIMIT ' .$itemIndex. ',' .$itemCount;
    }

    $db = Db::getInstance();
    $unis = $db->query("SELECT uni_id, uniStateFa, uniCityFa, uniFullNameFa, uniGender FROM unis
                                      INNER JOIN uni_state ON unis.uniState_id=uni_state.uniState_id
                                      INNER JOIN uni_city ON unis.uniCity_id=uni_city.uniCity_id
                                      WHERE ($findState) AND ($findCity) AND ($findUserId) AND
                                            (uniFullNameFa LIKE :searchPhrase) $limit" , array(
      'uniStateSelector' => $uniStateSelector,
      'uniCitySelector' => $uniCitySelector,
      'webUserId' => $webUserId,
      'searchPhrase' => "%$searchPhrase%",
    ));

    return $unis;
  }



  public static function insertUni($webUserId, $uniStateId, $uniCityId, $uniTypeId, $uniAffiliationId, $uniFullNameFa, $uniFullNameEn,
                                   $uniShortNameFa, $uniShortNameEn, $uniEstablished, $uniPresidentFa, $uniPresidentEn,
                                   $uniEducationalAssistantFa, $uniEducationalAssistantEn, $uniStudentAssistantFa, $uniStudentAssistantEn, $uniStudentNumber,
                                   $uniAssociateDegreeMajorsFa, $uniAssociateDegreeMajorsEn, $uniBachelorDegreeMajorsFa, $uniBachelorDegreeMajorsEn,
                                   $uniWebsite, $uniLittleDescFa, $uniLittleDescEn, $uniGender, $uniAddressFa, $uniAddressEn, $uniLatLng){
    $db = Db::getInstance();
    $uniId = $db->insert("INSERT INTO unis (web_user_id, uniState_id, uniCity_id, uniType_id, uniAffiliations_id, uniFullNameFa, uniFullNameEn,
                                   uniShortNameFa, uniShortNameEn, uniEstablished, uniPresidentFa, uniPresidentEn,
                                   uniEducationalAssistantFa, uniEducationalAssistantEn, uniStudentAssistantFa, uniStudentAssistantEn, uniStudentNumber,
                                   uniAssociateDegreeMajorsFa, uniAssociateDegreeMajorsEn, uniBachelorDegreeMajorsFa, uniBachelorDegreeMajorsEn,
                                   uniWebsite, uniLittleDescFa, uniLittleDescEn, uniGender, uniAddressFa, uniAddressEn, uniLatLng, viewCounts)
                                    VALUES (:webUserId, :uniSateId, :uniCityId, :uniTypeId, :uniAffiliationId, :uniFullNameFa, :uniFullNameEn,
                                   :uniShortNameFa, :uniShortNameEn, :uniEstablished, :uniPresidentFa, :uniPresidentEn,
                                   :uniEducationalAssistantFa, :uniEducationalAssistantEn, :uniStudentAssistantFa, :uniStudentAssistantEn, :uniStudentNumber,
                                   :uniAssociateDegreeMajorsFa, :uniAssociateDegreeMajorsEn, :uniBachelorDegreeMajorsFa, :uniBachelorDegreeMajorsEn,
                                   :uniWebsite, :uniLittleDescFa, :uniLittleDescEn, :uniGender, :uniAddressFa, :uniAddressEn, :uniLatLng, :viewCounts)", array(
      'webUserId' => $webUserId,
      'uniSateId' => $uniStateId,
      'uniCityId' => $uniCityId,
      'uniTypeId' => $uniTypeId,
      'uniAffiliationId' => $uniAffiliationId,
      'uniFullNameFa' => $uniFullNameFa,
      'uniFullNameEn' => $uniFullNameEn,
      'uniShortNameFa' => $uniShortNameFa,
      'uniShortNameEn' => $uniShortNameEn,
      'uniEstablished' => $uniEstablished,
      'uniPresidentFa' => $uniPresidentFa,
      'uniPresidentEn' => $uniPresidentEn,
      'uniEducationalAssistantFa' => $uniEducationalAssistantFa,
      'uniEducationalAssistantEn' => $uniEducationalAssistantEn,
      'uniStudentAssistantFa' => $uniStudentAssistantFa,
      'uniStudentAssistantEn' => $uniStudentAssistantEn,
      'uniStudentNumber' => $uniStudentNumber,
      'uniAssociateDegreeMajorsFa' => $uniAssociateDegreeMajorsFa,
      'uniAssociateDegreeMajorsEn' => $uniAssociateDegreeMajorsEn,
      'uniBachelorDegreeMajorsFa' => $uniBachelorDegreeMajorsFa,
      'uniBachelorDegreeMajorsEn' => $uniBachelorDegreeMajorsEn,
      'uniWebsite' => $uniWebsite,
      'uniLittleDescFa' => $uniLittleDescFa,
      'uniLittleDescEn' => $uniLittleDescEn,
      'uniGender' => $uniGender,
      'uniAddressFa' => $uniAddressFa,
      'uniAddressEn' => $uniAddressEn,
      'uniLatLng' => $uniLatLng,
      'viewCounts' => 0,
    ));
    return $uniId;
  }
  
  
  
  
  public static function updateUniLogoAndPhotos($uniId, $uniLogo, $uniPhotos){
    $db = Db::getInstance();
    $db->modify("UPDATE unis SET uniLogo=:uniLogo, uniPhotos=:uniPhotos WHERE uni_id=:uniId" , array(
      'uniId' => $uniId,
      'uniLogo' => $uniLogo,
      'uniPhotos' => $uniPhotos,
    ));
  }



  public static function updateUni($uniId, $uniStateId, $uniCityId, $uniTypeId, $uniAffiliationId, $uniFullNameFa, $uniFullNameEn,
                                   $uniShortNameFa, $uniShortNameEn, $uniEstablished, $uniPresidentFa, $uniPresidentEn,
                                   $uniEducationalAssistantFa, $uniEducationalAssistantEn, $uniStudentAssistantFa, $uniStudentAssistantEn, $uniStudentNumber,
                                   $uniAssociateDegreeMajorsFa, $uniAssociateDegreeMajorsEn, $uniBachelorDegreeMajorsFa, $uniBachelorDegreeMajorsEn,
                                   $uniWebsite, $uniLittleDescFa, $uniLittleDescEn, $uniGender, $uniAddressFa, $uniAddressEn, $uniLatLng){
    $db = Db::getInstance();
    $db->modify("UPDATE unis SET uniState_id=:uniStateId, uniCity_id=:uniCityId, uniType_id=:uniTypeId,
                                 uniAffiliations_id=:uniAffiliationId, uniFullNameFa=:uniFullNameFa, uniFullNameEn=:uniFullNameEn,
                                 uniShortNameFa=:uniShortNameFa, uniShortNameEn=:uniShortNameEn, uniEstablished=:uniEstablished,
                                 uniPresidentFa=:uniPresidentFa, uniPresidentEn=:uniPresidentEn,
                                 uniEducationalAssistantFa=:uniEducationalAssistantFa, uniEducationalAssistantEn=:uniEducationalAssistantEn,
                                 uniStudentAssistantFa=:uniStudentAssistantFa, uniStudentAssistantEn=:uniStudentAssistantEn,
                                 uniStudentNumber=:uniStudentNumber,uniAssociateDegreeMajorsFa=:uniAssociateDegreeMajorsFa,
                                 uniAssociateDegreeMajorsEn=:uniAssociateDegreeMajorsEn, uniBachelorDegreeMajorsFa=:uniBachelorDegreeMajorsFa,
                                 uniBachelorDegreeMajorsEn=:uniBachelorDegreeMajorsEn, uniWebsite=:uniWebsite,
                                 uniLittleDescFa=:uniLittleDescFa, uniLittleDescEn=:uniLittleDescEn, uniGender=:uniGender,
                                 uniAddressFa=:uniAddressFa, uniAddressEn=:uniAddressEn, uniLatLng=:uniLatLng
                WHERE uni_id=:uniId" , array(
      'uniId' => $uniId,
      'uniStateId' => $uniStateId,
      'uniCityId' => $uniCityId,
      'uniTypeId' => $uniTypeId,
      'uniAffiliationId' => $uniAffiliationId,
      'uniFullNameFa' => $uniFullNameFa,
      'uniFullNameEn' => $uniFullNameEn,
      'uniShortNameFa' => $uniShortNameFa,
      'uniShortNameEn' => $uniShortNameEn,      
      'uniEstablished' => $uniEstablished,
      'uniPresidentFa' => $uniPresidentFa,
      'uniPresidentEn' => $uniPresidentEn,
      'uniEducationalAssistantFa' => $uniEducationalAssistantFa,
      'uniEducationalAssistantEn' => $uniEducationalAssistantEn,
      'uniStudentAssistantFa' => $uniStudentAssistantFa,
      'uniStudentAssistantEn' => $uniStudentAssistantEn,
      'uniStudentNumber' => $uniStudentNumber,
      'uniAssociateDegreeMajorsFa' => $uniAssociateDegreeMajorsFa,
      'uniAssociateDegreeMajorsEn' => $uniAssociateDegreeMajorsEn,
      'uniBachelorDegreeMajorsFa' => $uniBachelorDegreeMajorsFa,
      'uniBachelorDegreeMajorsEn' => $uniBachelorDegreeMajorsEn,
      'uniWebsite' => $uniWebsite,
      'uniLittleDescFa' => $uniLittleDescFa,
      'uniLittleDescEn' => $uniLittleDescEn,
      'uniGender' => $uniGender,
      'uniAddressFa' => $uniAddressFa,
      'uniAddressEn' => $uniAddressEn,
      'uniLatLng' => $uniLatLng,
    ));
  }




  public static function insertUniMoreInfo($uniId, $uniHistoryFa, $uniHistoryEn, $uniNamesFromTheBeginningFa, $uniNamesFromTheBeginningEn,
                                           $uniPresidentsFromTheBeginningFa, $uniPresidentsFromTheBeginningEn, $uniEducationalGroupsAndMajorsFa, $uniEducationalGroupsAndMajorsEn,
                                           $uniHonoursFa, $uniHonoursEn, $uniAdditionalExplanationsFa, $uniAdditionalExplanationsEn){
    $db = Db::getInstance();
    $db->insert("INSERT INTO uni_more_info (uni_id, uniHistoryFa, uniHistoryEn, uniNamesFromTheBeginningFa, uniNamesFromTheBeginningEn,
                                           uniPresidentsFromTheBeginningFa, uniPresidentsFromTheBeginningEn, uniEducationalGroupsAndMajorsFa, uniEducationalGroupsAndMajorsEn,
                                           uniHonoursFa, uniHonoursEn, uniAdditionalExplanationsFa, uniAdditionalExplanationsEn)
                                            VALUES (:uniId, :uniHistoryFa, :uniHistoryEn, :uniNamesFromTheBeginningFa, :uniNamesFromTheBeginningEn,
                                           :uniPresidentsFromTheBeginningFa, :uniPresidentsFromTheBeginningEn, :uniEducationalGroupsAndMajorsFa, :uniEducationalGroupsAndMajorsEn,
                                           :uniHonoursFa, :uniHonoursEn, :uniAdditionalExplanationsFa, :uniAdditionalExplanationsEn)", array(
      'uniId' => $uniId,
      'uniHistoryFa' => $uniHistoryFa,
      'uniHistoryEn' => $uniHistoryEn,
      'uniNamesFromTheBeginningFa' => $uniNamesFromTheBeginningFa,
      'uniNamesFromTheBeginningEn' => $uniNamesFromTheBeginningEn,
      'uniPresidentsFromTheBeginningFa' => $uniPresidentsFromTheBeginningFa,
      'uniPresidentsFromTheBeginningEn' => $uniPresidentsFromTheBeginningEn,
      'uniEducationalGroupsAndMajorsFa' => $uniEducationalGroupsAndMajorsFa,
      'uniEducationalGroupsAndMajorsEn' => $uniEducationalGroupsAndMajorsEn,
      'uniHonoursFa' => $uniHonoursFa,
      'uniHonoursEn' => $uniHonoursEn,
      'uniAdditionalExplanationsFa' => $uniAdditionalExplanationsFa,
      'uniAdditionalExplanationsEn' => $uniAdditionalExplanationsEn,
    ));
  }



  public static function updateUniMoreInfo($uniId, $uniHistoryFa, $uniHistoryEn, $uniNamesFromTheBeginningFa, $uniNamesFromTheBeginningEn,
                                           $uniPresidentsFromTheBeginningFa, $uniPresidentsFromTheBeginningEn, $uniEducationalGroupsAndMajorsFa, $uniEducationalGroupsAndMajorsEn,
                                           $uniHonoursFa, $uniHonoursEn, $uniAdditionalExplanationsFa, $uniAdditionalExplanationsEn){
    $db = Db::getInstance();
    $db->modify("UPDATE uni_more_info SET uniHistoryFa=:uniHistoryFa, uniHistoryEn=:uniHistoryEn, uniNamesFromTheBeginningFa=:uniNamesFromTheBeginningFa,
                                uniNamesFromTheBeginningEn=:uniNamesFromTheBeginningEn, uniPresidentsFromTheBeginningFa=:uniPresidentsFromTheBeginningFa,
                                uniPresidentsFromTheBeginningEn=:uniPresidentsFromTheBeginningEn, uniEducationalGroupsAndMajorsFa=:uniEducationalGroupsAndMajorsFa,
                                uniEducationalGroupsAndMajorsEn=:uniEducationalGroupsAndMajorsEn, uniHonoursFa=:uniHonoursFa,
                                uniHonoursEn=:uniHonoursEn, uniAdditionalExplanationsFa=:uniAdditionalExplanationsFa,
                                uniAdditionalExplanationsEn=:uniAdditionalExplanationsEn
                WHERE uni_id=:uniId" , array(
      'uniId' => $uniId,
      'uniHistoryFa' => $uniHistoryFa,
      'uniHistoryEn' => $uniHistoryEn,
      'uniNamesFromTheBeginningFa' => $uniNamesFromTheBeginningFa,
      'uniNamesFromTheBeginningEn' => $uniNamesFromTheBeginningEn,
      'uniPresidentsFromTheBeginningFa' => $uniPresidentsFromTheBeginningFa,
      'uniPresidentsFromTheBeginningEn' => $uniPresidentsFromTheBeginningEn,
      'uniEducationalGroupsAndMajorsFa' => $uniEducationalGroupsAndMajorsFa,
      'uniEducationalGroupsAndMajorsEn' => $uniEducationalGroupsAndMajorsEn,
      'uniHonoursFa' => $uniHonoursFa,
      'uniHonoursEn' => $uniHonoursEn,
      'uniAdditionalExplanationsFa' => $uniAdditionalExplanationsFa,
      'uniAdditionalExplanationsEn' => $uniAdditionalExplanationsEn,
    ));
  }
}