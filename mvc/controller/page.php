<?php
class PageController {

  public function home() {
    if (! isset($_SESSION['email'])){
      header("Location: " . baseUrl() . "/account/login");
      return;
    }

    $uniStates = UniModel::fetchStates();
    $uniCities = UniModel::fetchCities();

    $data['uniStates'] = $uniStates;
    $data['uniCities'] = $uniCities;
    $data['activePage'] = 'home';
    View::render("defaultDashboard", "/page/home.php", $data);
  }



  public function accountsManagement() {
    grantAdmin();

    $data['activePage'] = 'accountsManagement';
    View::render("defaultDashboard", "/page/accounts_management.php", $data);
  }



  public function reviews() {
    $uniId = post('uniId');
    $uniFullNameFa = post('uniFullNameFa');
    if($uniId == null){
      header("Location: " . baseUrl() . "/page/home");
    }

    $data['activePage'] = 'uniReviews';
    $data['uniId'] = $uniId;
    $data['uniFullNameFa'] = $uniFullNameFa;
    View::render("defaultDashboard", "/page/uni_reviews.php", $data);
  }



  public function feedback() {
    grantSuperAdmin();

    $data['activePage'] = 'feedback';
    View::render("defaultDashboard", "/page/feedback.php", $data);
  }



  public function mainImageSlider() {
    grantSuperAdmin();

    $imageSliderMainId = post('imageSliderMainId');
    $imageSlider = AndroidModel::fetchMainImageSlider();

    if($imageSliderMainId == null){
      $data['activePage'] = 'mainImageSlider';
      $data['imageSlider'] = $imageSlider;
      View::render("defaultDashboard", "/page/main_image_slider.php", $data);
      return;
    }

    $images = $imageSlider['images'];
    $parts = explode('|',$images);

    // imageSliderData images
    $imageSliderData = '';
    for($i=1; $i<7; $i++){
      if($_FILES['inputImgSlider' . $i]['size'] != 0){
        if(count($parts) >= $i){
          $image = $parts[$i-1];
          $image = substr($image, 1); // remove first slash '/'
          if(file_exists ($image)) {
            unlink($image);
          }
        }

        $file = $_FILES['inputImgSlider' . $i]['tmp_name'];
        $ext = $_FILES['inputImgSlider' . $i]['type'];
        $ext = str_replace('image/', '.', $ext);
        list($width, $height) = getimagesize($file);

        if($ext == '.jpeg'){
          $ext = '.jpg';
        }

        $milliseconds = round(microtime(true) * 1000);
        $path = getcwd() . "/image/imageSliderMain/" . $i ."_". $milliseconds . $ext;
        if($i == 1){
          $imageSliderData = "/image/imageSliderMain/" . $i ."_". $milliseconds . $ext;
        }else{
          $imageSliderData .= "|/image/imageSliderMain/" . $i ."_". $milliseconds . $ext;
        }

        if($height > 300){
          resizeImage($file, $ext, 0, 300, $path);
        }else{
          copy($file, $path);
        }
      }else{
        $fileExists = 0;

        if(count($parts) >= $i){
          $image = $parts[$i-1];
          $image = substr($image, 1); // remove first slash '/'
          if(file_exists ($image)) {
            $fileExists = 1;
          }
        }

        if($fileExists == 1){
          if($i == 1){
            $imageSliderData = "/". $image;
          }else{
            $imageSliderData .= "|/" . $image;
          }
        }

      }
    }

    // update imageSliderData
    AndroidModel::updateImageSlider($imageSliderMainId, $imageSliderData);

    //header("Location: " . baseUrl() . "/page/home");
  }



  public function editUni() {
    $uniId = post('uniId');
    $uni = UniModel::fetchUniFullDataById($uniId);

    $uniStates = UniModel::fetchStates();
    $uniCities = UniModel::fetchCities();
    $uniTypes = UniModel::fetchUniTypes();
    $uniAffiliations = UniModel::fetchUniAffiliations();

    $data['activePage'] = 'editUni';
    $data['uni'] = $uni;
    $data['uniStates'] = $uniStates;
    $data['uniCities'] = $uniCities;
    $data['uniTypes'] = $uniTypes;
    $data['uniAffiliations'] = $uniAffiliations;
    View::render("defaultDashboard", "/page/add_uni.php", $data);
  }

  public function addUni() {
    $addOrEdit = post('addOrEdit');

    // show addUni form if email not empty
    if ($addOrEdit == null) {
      $uniStates = UniModel::fetchStates();
      $uniCities = UniModel::fetchCities();
      $uniTypes = UniModel::fetchUniTypes();
      $uniAffiliations = UniModel::fetchUniAffiliations();

      $data['activePage'] = 'addUni';
      $data['uni'] = null;
      $data['uniStates'] = $uniStates;
      $data['uniCities'] = $uniCities;
      $data['uniTypes'] = $uniTypes;
      $data['uniAffiliations'] = $uniAffiliations;
      View::render("defaultDashboard", "/page/add_uni.php", $data);
      return;
    }

    $uniFullNameFa = post('uniFullNameFa');
    $uniFullNameEn = post('uniFullNameEn');
    $uniShortNameFa = post('uniShortNameFa');
    $uniShortNameEn = post('uniShortNameEn');
    $uniStateSelector = post('uniStateSelector');
    $uniStateFa = post('uniStateFa');
    $uniStateEn = post('uniStateEn');
    $uniCitySelector = post('uniCitySelector');
    $uniCityFa = post('uniCityFa');
    $uniCityEn = post('uniCityEn');
    $uniGender = post('uniGender');
    $uniTypeSelector = post('uniTypeSelector');
    $uniAffiliationSelector = post('uniAffiliationSelector');
    $uniEstablished = post('uniEstablished');
    $uniStudentNumber = post('uniStudentNumber');
    $uniPresidentFa = post('uniPresidentFa');
    $uniPresidentEn = post('uniPresidentEn');
    $uniEducationalAssistantFa = post('uniEducationalAssistantFa');
    $uniEducationalAssistantEn = post('uniEducationalAssistantEn');
    $uniStudentAssistantFa = post('uniStudentAssistantFa');
    $uniStudentAssistantEn = post('uniStudentAssistantEn');
    $uniAssociateDegreeMajorsFa = post('uniAssociateDegreeMajorsFa');
    $uniAssociateDegreeMajorsEn = post('uniAssociateDegreeMajorsEn');
    $uniBachelorDegreeMajorsFa = post('uniBachelorDegreeMajorsFa');
    $uniBachelorDegreeMajorsEn = post('uniBachelorDegreeMajorsEn');
    $uniWebsite = post('uniWebsite');
    $uniAddressFa = post('uniAddressFa');
    $uniAddressEn = post('uniAddressEn');
    $inputLatitude = post('inputLatitude');
    $inputLongitude = post('inputLongitude');
    $uniLittleDescFa = post('uniLittleDescFa');
    $uniLittleDescEn = post('uniLittleDescEn');
    $uniHistoryFa = post('uniHistoryFa');
    $uniHistoryEn = post('uniHistoryEn');
    $uniNamesFromTheBeginningFa = post('uniNamesFromTheBeginningFa');
    $uniNamesFromTheBeginningEn = post('uniNamesFromTheBeginningEn');
    $uniPresidentsFromTheBeginningFa = post('uniPresidentsFromTheBeginningFa');
    $uniPresidentsFromTheBeginningEn = post('uniPresidentsFromTheBeginningEn');
    $uniEducationalGroupsAndMajorsFa = post('uniEducationalGroupsAndMajorsFa');
    $uniEducationalGroupsAndMajorsEn = post('uniEducationalGroupsAndMajorsEn');
    $uniHonoursFa = post('uniHonoursFa');
    $uniHonoursEn = post('uniHonoursEn');
    $uniAdditionalExplanationsFa = post('uniAdditionalExplanationsFa');
    $uniAdditionalExplanationsEn = post('uniAdditionalExplanationsEn');

    // fetchStateId
    if($uniStateFa == ''){
      $uniState = UniModel::fetchUniStateByName($uniStateSelector);
      $uniStateId = $uniState['uniState_id'];
    }else{
      $uniStateId = UniModel::insertUniState($uniStateFa, $uniStateEn);
    }


    // fetchCityId
    if($uniCityFa == ''){
      $uniCity = UniModel::fetchUniCityByName($uniCitySelector);
      $uniCityId = $uniCity['uniCity_id'];
    }else{
      $uniCityId = UniModel::insertUniCity($uniCityFa, $uniCityEn);
    }

    // fetch Type and Affiliation id
    $uniType = UniModel::fetchUniTypeByName($uniTypeSelector);
    $uniTypeId = $uniType['uniType_id'];
    $uniAffiliation = UniModel::fetchUniAffiliationByName($uniAffiliationSelector);
    $uniAffiliationId = $uniAffiliation['uniAffiliations_id'];

    // concatenate lat & lng
    $uniLatLng = $inputLatitude .', '. $inputLongitude;

    if($addOrEdit == 'Add'){
      $webUserId = getUserId();
      // insert uni and fetch id
      $uniId = UniModel::insertUni($webUserId, $uniStateId, $uniCityId, $uniTypeId, $uniAffiliationId, $uniFullNameFa, $uniFullNameEn,
        $uniShortNameFa, $uniShortNameEn, $uniEstablished, $uniPresidentFa, $uniPresidentEn,
        $uniEducationalAssistantFa, $uniEducationalAssistantEn, $uniStudentAssistantFa, $uniStudentAssistantEn, $uniStudentNumber,
        $uniAssociateDegreeMajorsFa, $uniAssociateDegreeMajorsEn, $uniBachelorDegreeMajorsFa, $uniBachelorDegreeMajorsEn,
        $uniWebsite, $uniLittleDescFa, $uniLittleDescEn, $uniGender, $uniAddressFa, $uniAddressEn, $uniLatLng);
    }else{
      // if we are in edit, we have uniId in $addOrEdit
      $uniId = $addOrEdit;

      // update uni
      UniModel::updateUni($uniId, $uniStateId, $uniCityId, $uniTypeId, $uniAffiliationId, $uniFullNameFa, $uniFullNameEn,
        $uniShortNameFa, $uniShortNameEn, $uniEstablished, $uniPresidentFa, $uniPresidentEn,
        $uniEducationalAssistantFa, $uniEducationalAssistantEn, $uniStudentAssistantFa, $uniStudentAssistantEn, $uniStudentNumber,
        $uniAssociateDegreeMajorsFa, $uniAssociateDegreeMajorsEn, $uniBachelorDegreeMajorsFa, $uniBachelorDegreeMajorsEn,
        $uniWebsite, $uniLittleDescFa, $uniLittleDescEn, $uniGender, $uniAddressFa, $uniAddressEn, $uniLatLng);
    }

    // uniLogo image
    if($_FILES['inputImgUniLogo']['size'] != 0){
      if($addOrEdit != 'Add'){
        $uniLogoArray = UniModel::fetchUniLogoById($uniId);
        $uniLogo = $uniLogoArray['uniLogo'];
        $uniLogo = substr($uniLogo, 1); // remove first slash '/'
        if(file_exists ($uniLogo)) {
          unlink($uniLogo);
        }
      }

      $uniLogoFile = $_FILES['inputImgUniLogo']['tmp_name'];
      $extUniLogo = $_FILES['inputImgUniLogo']['type'];
      $extUniLogo = str_replace('image/', '.', $extUniLogo);
      list($uniLogoWidth, $uniLogoHeight) = getimagesize($uniLogoFile);

      if($extUniLogo == '.jpeg'){
        $extUniLogo = '.jpg';
      }

      $milliseconds = round(microtime(true) * 1000);
      $uniLogoPath = getcwd() . "/image/uniLogo/" . $uniId ."_". $milliseconds . $extUniLogo;
      $uniLogo = "/image/uniLogo/" . $uniId ."_". $milliseconds . $extUniLogo;
      if($uniLogoWidth > 200){
        resizeImage($uniLogoFile, $extUniLogo, 200, 200, $uniLogoPath);
      }else{
        copy($uniLogoFile, $uniLogoPath);
      }
    }else{
      $uniLogo = UniModel::fetchUniLogoById($uniId);
      $uniLogo = $uniLogo['uniLogo'];
    }


    // uniPhotos images
    $uniPhotos = '';
    if($addOrEdit == 'Add'){
      mkdir(getcwd() . "/image/uniPhotos/" . $uniId);
    }

    $uniPhotosArray = UniModel::fetchUniPhotosById($uniId);
    $uniPhotos = $uniPhotosArray['uniPhotos'];
    $parts = explode('|',$uniPhotos);

    for($i=1; $i<6; $i++){
      if($_FILES['inputImgUni' . $i]['size'] != 0){
        if($addOrEdit != 'Add'){
          if(count($parts) >= $i){
            $uniPhoto = $parts[$i-1];
            $uniPhoto = substr($uniPhoto, 1); // remove first slash '/'
            if(file_exists ($uniPhoto)) {
              unlink($uniPhoto);
            }
          }
        }

        $file = $_FILES['inputImgUni' . $i]['tmp_name'];
        $ext = $_FILES['inputImgUni' . $i]['type'];
        $ext = str_replace('image/', '.', $ext);
        list($width, $height) = getimagesize($file);

        if($ext == '.jpeg'){
          $ext = '.jpg';
        }

        $milliseconds = round(microtime(true) * 1000);
        $path = getcwd() . "/image/uniPhotos/" . $uniId . "/" . $i ."_". $milliseconds . $ext;
        if($i == 1){
          $uniPhotos = "/image/uniPhotos/" . $uniId . "/" . $i ."_". $milliseconds . $ext;
        }else{
          $uniPhotos .= "|/image/uniPhotos/" . $uniId . "/" . $i ."_". $milliseconds . $ext;
        }

        if($height > 300){
          resizeImage($file, $ext, 0, 300, $path);
        }else{
          copy($file, $path);
        }
      }else{
        if($addOrEdit != 'Add'){
          $fileExists = 0;

          if(count($parts) >= $i){
            $uniPhoto = $parts[$i-1];
            $uniPhoto = substr($uniPhoto, 1); // remove first slash '/'
            if(file_exists ($uniPhoto)) {
              $fileExists = 1;
            }
          }

          if($fileExists == 1){
            if($i == 1){
              $uniPhotos = "/". $uniPhoto;
            }else{
              $uniPhotos .= "|/" . $uniPhoto;
            }
          }
        }

      }
    }

    // insert Uni Logo And Photos
    UniModel::updateUniLogoAndPhotos($uniId, $uniLogo, $uniPhotos);

    if($addOrEdit == 'Add'){
      // insert uniMoreInfo
      UniModel::insertUniMoreInfo($uniId, $uniHistoryFa, $uniHistoryEn, $uniNamesFromTheBeginningFa, $uniNamesFromTheBeginningEn,
        $uniPresidentsFromTheBeginningFa, $uniPresidentsFromTheBeginningEn, $uniEducationalGroupsAndMajorsFa, $uniEducationalGroupsAndMajorsEn,
        $uniHonoursFa, $uniHonoursEn, $uniAdditionalExplanationsFa, $uniAdditionalExplanationsEn);
    }else{
      // update uniMoreInfo
      UniModel::updateUniMoreInfo($uniId, $uniHistoryFa, $uniHistoryEn, $uniNamesFromTheBeginningFa, $uniNamesFromTheBeginningEn,
        $uniPresidentsFromTheBeginningFa, $uniPresidentsFromTheBeginningEn, $uniEducationalGroupsAndMajorsFa, $uniEducationalGroupsAndMajorsEn,
        $uniHonoursFa, $uniHonoursEn, $uniAdditionalExplanationsFa, $uniAdditionalExplanationsEn);
    }

    //header("Location: " . baseUrl() . "/page/home");
  }
}