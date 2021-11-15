<div class="container mb-5">
  <div class="alert alert-danger col-lg-9 col-md-12 col-sm-12" role="alert">
    <strong>تذکر:</strong>
    <span>قبل از ایجاد دانشکده از نبود آن در نرم افزار اطمینان یابید.</span>
  </div>
  <div class="alert alert-warning col-lg-9 col-md-12 col-sm-12" role="alert">
    <strong>هشدار:</strong>
    <span>پر کردن تمام فیلد های این بخش الزامی میباشد.</span>
  </div>

  <form id="uploadForm" class="mt-4" action="<?=baseUrl()?>/page/addUni" method="post" enctype="multipart/form-data">
    <div class="form-group col-lg-6 col-md-10 col-sm-12 pr-0">
      <label for="uniFullName">نام کامل دانشکده</label>
      <div>
        <input name="uniFullNameFa" type="text" class="form-control fillField" placeholder="<?=_add_uni_input_fa?>" value="<?=$uni['uniFullNameFa']?>" required>
        <small class="form-text text-muted">مثال: دانشکده فنی و حرفه ای شهید شمسی پور تهران</small>
        <input name="uniFullNameEn" type="text" class="form-control mt-2 fillField" placeholder="<?=_add_uni_input_en?>" value="<?=$uni['uniFullNameEn']?>" required>
        <small class="form-text text-muted">مثال: Shamsipour Technical & Vocational College,Tehran</small>
      </div>
    </div>

    <div class="form-group mt-5 col-lg-6 col-md-10 col-sm-12 pr-0">
      <label for="uniShortName">نام کوتاه دانشکده</label>
      <div>
        <input name="uniShortNameFa" type="text" class="form-control fillField" placeholder="<?=_add_uni_input_fa?>" value="<?=$uni['uniShortNameFa']?>" required>
        <small class="form-text text-muted">مثال: دانشکده شمسی پور</small>
        <input name="uniShortNameEn" type="text" class="form-control mt-2 fillField" placeholder="<?=_add_uni_input_en?>" value="<?=$uni['uniShortNameEn']?>" required>
        <small class="form-text text-muted">مثال: Shamsipour College</small>
      </div>
    </div>

    <div class="form-group mt-5">
      <label class="d-block mb-0" for="uniState">نام استان</label>
      <select name="uniStateSelector" id="uniStateSelector" class="form-control d-inline">
        <option>انتخاب استان</option>
        <?foreach($uniStates as $uniState){?>
          <option <?if($uniState['uniStateFa']==$uni['uniStateFa']){?>selected<?}?> ><?=$uniState['uniStateFa']?></option>
        <?}?>
      </select>
      <span class="mr-lg-3">
        <input name="uniStateFa" id="uniStateFa" type="text" class="form-control mt-2 d-inline col-lg-3 col-sm-12" placeholder="<?=_add_uni_input_fa?> (تهران)"  required <?if($uni != null){?>disabled<?}?>>
        <input name="uniStateEn" id="uniStateEn" type="text" class="form-control mt-2 d-inline col-lg-3 col-sm-12" placeholder="<?=_add_uni_input_en?> (Tehran)" required <?if($uni != null){?>disabled<?}?>>
      </span>
      <div class="alert alert-info col-lg-6 col-md-10 col-sm-12 pt-1 pb-1 mt-1 small" role="alert">
        <strong>توجه:</strong>
        <span>در صورت نبودن نام استان مورد نظر، آنرا به صورت دستی وارد نمایید.</span>
      </div>
    </div>

    <div class="form-group mt-4">
      <label class="d-block mb-0" for="uniCity">نام شهر</label>
      <select name="uniCitySelector" id="uniCitySelector" class="form-control d-inline">
        <option>انتخاب شهر</option>
        <?foreach($uniCities as $uniCity){?>
          <option <?if($uniCity['uniCityFa']==$uni['uniCityFa']){?>selected<?}?> ><?=$uniCity['uniCityFa']?></option>
        <?}?>
      </select>
      <span class="mr-lg-3">
        <input name="uniCityFa" id="uniCityFa" type="text" class="form-control mt-2 d-inline col-lg-3 col-sm-12" placeholder="<?=_add_uni_input_fa?> (تهران)" required <?if($uni != null){?>disabled<?}?>>
        <input name="uniCityEn" id="uniCityEn" type="text" class="form-control mt-2 d-inline col-lg-3 col-sm-12" placeholder="<?=_add_uni_input_en?> (Tehran)" required <?if($uni != null){?>disabled<?}?>>
      </span>
      <div class="alert alert-info col-lg-6 col-md-10 col-sm-12 pt-1 pb-1 mt-1 small" role="alert">
        <strong>توجه:</strong>
        <span>در صورت نبون نام شهر خود آنرا به صورت دستی وارد نمایید.</span>
      </div>
    </div>

    <div class="form-group mt-5">
      <label class="d-block" for="uniPresident">نوع جنسیت</label>
      <label class="custom-control custom-radio mr-0 genderRadio">
        <input name="uniGender" value="boys" type="radio" class="custom-control-input" required <?if($uni['uniGender']=='boys'){?>checked<?}?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">پسرانه</span>
      </label>
      <label class="custom-control custom-radio genderRadio">
        <input name="uniGender" value="girls" type="radio" class="custom-control-input" required <?if($uni['uniGender']=='girls'){?>checked<?}?>>
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">دخترانه</span>
      </label>
    </div>

    <div class="form-group mt-3 col-lg-6 col-md-10 col-sm-12 pr-0">
      <label for="uniType">نوع دانشکده</label>
      <select name="uniTypeSelector" id="uniTypeSelector" class="form-control">
        <?foreach($uniTypes as $uniType){?>
          <option <?if($uniType['uniTypeFa']==$uni['uniTypeFa']){?>selected<?}?> ><?=$uniType['uniTypeFa']?></option>
        <?}?>
      </select>
    </div>

    <div class="form-group mt-3 col-lg-6 col-md-10 col-sm-12 pr-0">
      <label for="uniAffiliation">نوع وابستگی</label>
      <select name="uniAffiliationSelector" id="uniAffiliationSelector" class="form-control">
        <?foreach($uniAffiliations as $uniAffiliation){?>
          <option <?if($uniAffiliation['uniAffiliationsFa']==$uni['uniAffiliationsFa']){?>selected<?}?> ><?=$uniAffiliation['uniAffiliationsFa']?></option>
        <?}?>
      </select>
    </div>

    <div class="form-group mt-5 col-lg-6 col-md-10 col-sm-12 pr-0">
      <label for="uniEstablished">سال تاسیس دانشکده</label>
      <div>
        <input name="uniEstablished" type="Number" class="form-control fillField" min="0" value="<?=$uni['uniEstablished']?>" required>
        <small class="form-text text-muted">مثال: 1343</small>
      </div>
    </div>

    <div class="form-group mt-3 col-lg-6 col-md-10 col-sm-12 pr-0">
      <label for="uniStudentNumber">تعداد دانشجویان فعلی</label>
      <div>
        <input name="uniStudentNumber" type="Number" class="form-control fillField" min="0" value="<?=$uni['uniStudentNumber']?>" required>
        <small class="form-text text-muted">مثال: 4500</small>
      </div>
    </div>

    <div class="form-group mt-5">
      <label class="d-block mb-0" for="uniPresident">رئیس دانشکده</label>
      <span>
        <input name="uniPresidentFa" type="text" class="form-control mt-2 d-inline col-lg-4 col-md-10 col-sm-12 fillField" placeholder="<?=_add_uni_input_fa?>" value="<?=$uni['uniPresidentFa']?>" required>
        <input name="uniPresidentEn" type="text" class="form-control mt-2 d-inline col-lg-4 col-md-10 col-sm-12 fillField" placeholder="<?=_add_uni_input_en?>" value="<?=$uni['uniPresidentEn']?>" required>
      </span>
      <small class="form-text text-muted">مثال: علی بزرگ زاد ارباب، Ali Bozorgzad Arbab</small>
    </div>

    <div class="form-group mt-3">
      <label class="d-block mb-0" for="uniEducationalAssistant">معاون آموزشی</label>
      <span>
        <input name="uniEducationalAssistantFa" type="text" class="form-control mt-2 d-inline col-lg-4 col-md-10 col-sm-12 fillField" placeholder="<?=_add_uni_input_fa?>" value="<?=$uni['uniEducationalAssistantFa']?>" required>
        <input name="uniEducationalAssistantEn" type="text" class="form-control mt-2 d-inline col-lg-4 col-md-10 col-sm-12 fillField" placeholder="<?=_add_uni_input_en?>" value="<?=$uni['uniEducationalAssistantEn']?>" required>
      </span>
      <small class="form-text text-muted">مثال: علی بزرگ زاد ارباب، Ali Bozorgzad Arbab</small>
    </div>

    <div class="form-group mt-3">
      <label class="d-block mb-0" for="uniStudentAssistant">معاون دانشجویی</label>
      <span>
        <input name="uniStudentAssistantFa" type="text" class="form-control mt-2 d-inline col-lg-4 col-md-10 col-sm-12 fillField" placeholder="<?=_add_uni_input_fa?>" value="<?=$uni['uniStudentAssistantFa']?>" required>
        <input name="uniStudentAssistantEn" type="text" class="form-control mt-2 d-inline col-lg-4 col-md-10 col-sm-12 fillField" placeholder="<?=_add_uni_input_en?>" value="<?=$uni['uniStudentAssistantEn']?>" required>
      </span>
      <small class="form-text text-muted">مثال: علی بزرگ زاد ارباب، Ali Bozorgzad Arbab</small>
    </div>

    <div class="form-group mt-5">
      <label for="uniAssociateDegreeMajors">رشته های کاردانی</label>
      <div>
        <input name="uniAssociateDegreeMajorsFa" type="text" class="form-control fillField" placeholder="<?=_add_uni_input_fa?>" value="<?=$uni['uniAssociateDegreeMajorsFa']?>" required>
        <small class="form-text text-muted">مثال: صنايع شيميايي، حسابداری، نقشه کشی، تاسیسات، صنایع فلز، متالورژی، ساخت و تولید، صنایع چوب، ساختمان، چاپ، گرافیک، نقشه برداری، الکترونیک، کامپیوتر، الکتروتکنیک</small>
        <input name="uniAssociateDegreeMajorsEn" type="text" class="form-control mt-2 fillField" placeholder="<?=_add_uni_input_en?>" value="<?=$uni['uniAssociateDegreeMajorsEn']?>" required>
        <small class="form-text text-muted">مثال: Chemical industry, accounting, cartography, facilities, metal industry, metallurgy, manufacturing, wood industry, building, printing, graphics, mapping, electronics, computers, electrotechnics</small>
      </div>
    </div>

    <div class="form-group mt-4">
      <label for="uniBachelorDegreeMajors">رشته های کارشناسی</label>
      <div>
        <input name="uniBachelorDegreeMajorsFa" type="text" class="form-control fillField" placeholder="<?=_add_uni_input_fa?>" value="<?=$uni['uniBachelorDegreeMajorsFa']?>" required>
        <small class="form-text text-muted">مثال: الکترونیک، حسابداری، فناوری اطلاعات و ارتباطات، نرم‌افزار کامپیوتر</small>
        <input name="uniBachelorDegreeMajorsEn" type="text" class="form-control mt-2 fillField" placeholder="<?=_add_uni_input_en?>" value="<?=$uni['uniBachelorDegreeMajorsEn']?>" required>
        <small class="form-text text-muted">مثال: Electronic, Accounting, ICT, Computer Engineering</small>
      </div>
    </div>

    <div class="form-group" id="imageContainer">
      <label for="uniLogo" style="font-size: 110%;">بارگذاری لوگو و تعدادی عکس از دانشکده</label>
      <div class="alert alert-warning col-lg-7 col-sm-12 pt-1 pb-1 mt-1 small" role="alert">
        <strong>توجه:</strong>
        <span>بارگذاری لوگو و دو عکس اول از دانشکده الزامی میباشد.</span>
      </div>
      <div class="alert alert-info col-lg-7 col-sm-12 pt-1 pb-1 mt-1 small" role="alert">
        <strong>اطلاع:</strong>
        <span>اندازه تصویر لوگو باید حداقل 200*200 باشد و نسبت طول به عرض آن برابر یک(1) باشد.</span>
        <div>عکس های 1 تا 5 میبایست دارای حداقل ارتفاع 300 باشد و نسبت طول به عرض آن بیشتر از یک و نیم(1.5) باشد.</div>
      </div>
      <div class="card-deck">
        <div class="card">
          <img id="imgUniLogo" src="<?if($uni!=null){echo(baseUrl().$uni['uniLogo']);}?>" class="card-img-top uniImages" src="#" alt="Image Logo">
          <div class="card-block imagesTitle">
            <span class="card-title rtl m-0 d-inline">لوگو دانشکده</span>
            <small class="form-text text-danger d-inline">(الزامی)</small>
          </div>
          <div class="card-footer small border-top-0">
            <label class="custom-file customFile ltr">
              <input name="inputImgUniLogo" id="0" type="file" class="custom-file-input" accept=".png, .jpg"  data-toggle="popover" data-placement="top"  title="<?=_image_error_title?>" data-content="<?=_image_logo_error_datat_content?>" <?if($uni==null){?>required<?}?>>
              <span id="uniLogoText" class="custom-file-control form-control-file"></span>
            </label>
          </div>
        </div>
        <div class="card">
          <img id="imgUni1" src="<?if($uni!=null){echo(baseUrl().explode('|',$uni['uniPhotos'])[0]);}?>" class="card-img-top uniImages" src="#" alt="Image 1">
          <div class="card-block imagesTitle">
            <span class="card-title rtl m-0 d-inline">عکس شماره 1</span>
            <small class="form-text text-danger d-inline">(الزامی)</small>
          </div>
          <div class="card-footer small border-top-0">
            <label class="custom-file customFile ltr">
              <input name="inputImgUni1" id="1" type="file" class="custom-file-input" accept=".png, .jpg"  data-toggle="popover" data-placement="top" title="<?=_image_error_title?>" data-content="<?=_image_error_data_content?>" <?if($uni==null){?>required<?}?>>
              <span id="uniImageText1" class="custom-file-control form-control-file"></span>
            </label>
          </div>
        </div>
        <div class="card">
          <img id="imgUni2" src="<?if($uni!=null){echo(baseUrl().explode('|',$uni['uniPhotos'])[1]);}?>" class="card-img-top uniImages" src="#" alt="Image 2">
          <div class="card-block imagesTitle">
            <span class="card-title rtl m-0 d-inline">عکس شماره 2</span>
            <small class="form-text text-danger d-inline">(الزامی)</small>
          </div>
          <div class="card-footer small border-top-0">
            <label class="custom-file customFile ltr">
              <input name="inputImgUni2" id="2" type="file" class="custom-file-input" accept=".png, .jpg"  data-toggle="popover" data-placement="top" title="<?=_image_error_title?>" data-content="<?=_image_error_data_content?>" <?if($uni==null){?>required<?}?>>
              <span id="uniImageText2" class="custom-file-control form-control-file"></span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="card-deck">
        <div class="card">
          <img id="imgUni3" src="<?if($uni!=null){echo(baseUrl());$parts3=explode('|',$uni['uniPhotos']);if(count($parts3)>=3){echo($parts3[3-1]);}}?>" class="card-img-top uniImages" src="#" alt="Image 3">
          <div class="card-block imagesTitle">
            <span class="card-title rtl m-0 d-inline">عکس شماره 3</span>
            <small class="form-text text-muted d-inline">(اختیاری)</small>
          </div>
          <div class="card-footer small border-top-0">
            <label class="custom-file customFile ltr">
              <input name="inputImgUni3" id="3" type="file" class="custom-file-input" accept=".png, .jpg"  data-toggle="popover" data-placement="top" title="<?=_image_error_title?>" data-content="<?=_image_error_data_content?>" >
              <span id="uniImageText3" class="custom-file-control form-control-file"></span>
            </label>
          </div>
        </div>
        <div class="card">
          <img id="imgUni4" src="<?if($uni!=null){echo(baseUrl());$parts4=explode('|',$uni['uniPhotos']);if(count($parts4)>=4){echo($parts4[4-1]);}}?>" class="card-img-top uniImages" src="#" alt="Image 4">
          <div class="card-block imagesTitle">
            <span class="card-title rtl m-0 d-inline">عکس شماره 4</span>
            <small class="form-text text-muted d-inline">(اختیاری)</small>
          </div>
          <div class="card-footer small border-top-0">
            <label class="custom-file customFile ltr">
              <input name="inputImgUni4" id="4" type="file" class="custom-file-input" accept=".png, .jpg"  data-toggle="popover" data-placement="top" title="<?=_image_error_title?>" data-content="<?=_image_error_data_content?>" >
              <span id="uniImageText4" class="custom-file-control form-control-file"></span>
            </label>
          </div>
        </div>
        <div class="card">
          <img id="imgUni5" src="<?if($uni!=null){echo(baseUrl());$parts5=explode('|',$uni['uniPhotos']);if(count($parts5)>=5){echo($parts5[5-1]);}}?>" class="card-img-top uniImages" src="#" alt="Image 5">
          <div class="card-block imagesTitle">
            <span class="card-title rtl m-0 d-inline">عکس شماره 5</span>
            <small class="form-text text-muted d-inline">(اختیاری)</small>
          </div>
          <div class="card-footer small border-top-0">
            <label class="custom-file customFile ltr">
              <input name="inputImgUni5" id="5" type="file" class="custom-file-input" accept=".png, .jpg"  data-toggle="popover" data-placement="top" title="<?=_image_error_title?>" data-content="<?=_image_error_data_content?>" >
              <span id="uniImageText5" class="custom-file-control form-control-file"></span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group mt-5 col-lg-6 col-md-10 col-sm-12 pr-0">
      <label for="uniWebsite">آدرس وب سایت دانشکده</label>
      <div>
        <input name="uniWebsite" type="url" class="form-control ltr fillField" aria-describedby="basic-addon3" value="<?if($uni==null){echo("http://");}else{echo($uni['uniWebsite']);}?>"  required>
        <small class="form-text text-muted">مثال: http://shamsipour.tvu.ac.ir</small>
      </div>
    </div>

    <div class="form-group mt-4 col-lg-9 col-md-12 col-sm-12 pr-0">
      <label for="uniAddress">نشانی دانشکده</label>
      <div>
        <input name="uniAddressFa" type="text" class="form-control fillField" placeholder="<?=_add_uni_input_fa?>" value="<?=$uni['uniAddressFa']?>" required>
        <small class="form-text text-muted">مثال: میدان امام حسین (ع) - ابتدای خیابان دماوند - روبروی خیابان شهید منتظری</small>
        <input name="uniAddressEn" type="text" class="form-control mt-2 fillField" placeholder="<?=_add_uni_input_en?>" value="<?=$uni['uniAddressEn']?>" required>
        <small class="form-text text-muted">مثال: Imam Hussein Square (AS) - Beginning at Damavand Street - In front of Shahid Montazeri Street</small>
      </div>
    </div>

    <div class="form-group mt-5">
      <label>تعیین موقعیت جغرافیایی دانشکده</label>
      <div class="alert alert-info col-lg-6 col-sm-12 pt-1 pb-1 mt-1 small" role="alert">
        <strong>اطلاع:</strong>
        <span>برای سادگی کار میتوانید نام دانشکده خود را در نقشه زیر جستجو نمایید.</span>
      </div>
      <div class="alert alert-danger col-lg-6 col-sm-12 pt-1 pb-1 mt-1 small" role="alert">
        <strong>هشدار:</strong>
        <span>در صورتی که به دلیل تحریم یا هر علت دیگری نقشه گوگل برای شما به نمایش در نیامد، عرض و طول جغرافیایی را به صورت دستی وارد نمایید.</span>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-12 mt-4">
          <label class="fs90p">عرض جغرافیایی (Latitude)</label>
          <div class="ml-4">
            <input name="inputLatitude" id="inputLatitude" class="form-control ltr text-right latLngInputs fillField" type="number" step="any" value="<?if($uni!=null){echo(trim(explode(',',$uni['uniLatLng'])[0]));}?>" required>
          </div>
          <label class="mt-4 fs90p">طول جغرافیایی (Longitude)</label>
          <div class="ml-4">
            <input name="inputLongitude" id="inputLongitude" class="form-control ltr text-right latLngInputs fillField" type="number" step="any" value="<?if($uni!=null){echo(trim(explode(',',$uni['uniLatLng'])[1]));}?>" required>
          </div>
        </div>
        <div class="col-lg-9 col-sm-12 mt-2">
          <div id="searchContainer">
            <input id="pac-input" class="controls" type="text" placeholder="نام دانشکده را وارد نمایید...">
            <div id="map"></div>
            <div id="infowindow-content">
              <span id="place-name"  class="title"></span><br>
              <span id="place-address"></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group" style="margin-top: 6rem;">
      <hr>
      <label style="font-size: 120%;">اطلاعات بیشتر در مورد دانشکده</label>
      <div class="alert alert-warning col-lg-6 col-sm-12 fs90p pt-2 pb-2" role="alert">
        <strong>توجه:</strong>
        <span>در این بخش تنها دو مورد اول یعنی "توصیف کوتاه از دانشکده" و "تاریخچه دانشکده" الزامی میباشند، ولی موارد دیگر همگی اختیاری هستند.</span>
      </div>

      <div class="form-group mt-5">
        <label for="uniLittleDesc" class="fs105p">توصیف کوتاه از دانشکده</label>
        <small class="form-text text-danger d-inline">(الزامی)</small>
        <div>
          <textarea name="uniLittleDescFa" class="form-control fillField" rows="3"  placeholder="<?=_add_uni_input_fa?>" required><?=$uni['uniLittleDescFa']?></textarea>
          <small class="form-text text-muted">مثال: دانشکده فنی و حرفهای شهید شمسیپور یکی از مراکز آموزش عالی تهران تحت نظارت وزارت علوم است. نام قدیم این دانشکده، «انستیتو تکنولوژی تهران» بود که بعد از انقلاب، به افتخار یکی از فارغ التحصیلان حسین علی شیسی پور به «فنی فنی شهید شمسیپور» تغییر نام داد. این دانشکده که اکنون تحت نظر دانشگاه فنی و حرفهای است، در مقطعی دانشگاهی کاردانی پیوسته و کارشناسی ناپیوسته دانشجو پذیرش می شود. از سال 1384 تاکنون، پذیرش دانشجو در این دانشکده، تنها از میان مردان انجام می شود.</small>
          <textarea name="uniLittleDescEn" class="form-control mt-2 ltr fillField" rows="3"  placeholder="English" required><?=$uni['uniLittleDescEn']?></textarea>
          <small class="form-text text-muted ltr fs75p">Example: Shamsipour Technical and Vocational College (STVC) is one of the higher education centers in Tehran, Iran. The old name of this college was "Tehran Institute of Technology" and then was changed to "Shamsipour Technical and Vocational College" after the 1979 revolution.STVC provides a ranges of study programs in three major subjects for associate and undergraduate students and now is under supervision of Ministry of Science, Research and Technology.</small>
        </div>
      </div>

      <div class="form-group mt-5">
        <label for="uniHistory" class="fs105p">تاریخچه دانشکده</label>
        <small class="form-text text-danger d-inline">(الزامی)</small>
        <div>
          <textarea name="uniHistoryFa"class="form-control fillField" rows="3"  placeholder="<?=_add_uni_input_fa?>" required><?=$uni['uniHistoryFa']?></textarea>
          <small class="form-text text-muted">مثال: این موسسه در سال 1343 خورشیدی و با عنوان «حسابداری مؤسسه عالی» و به عنوان یک دانشکده خصوصی تأسیس شد. این مرکز، بعدها نام «انستیتو تکنولوژی تهران» نامگذاری شد. در آن زمان، این مرکز به کامپیوترهای مینفریم و مرکز منابع آموزشی آموزشی تجهیز شده بود، و با نظارت مشاوران دانشگاههای آی تی امریکا اداره می شود. این مرکز در سال 1355 توسط وزارت آموزش و پرورش خریداری شد. دانشکده فنی شهید شمسیپور تا پیش از سال 1389 بنام «دانشکده فنی شهید شمسیپور» خوانده می شود. فضا و امکانات قدیم دانشکده شمسی پور در میدان ونک که از سال 1343 ساخته شده بود.</small>
          <textarea name="uniHistoryEn" class="form-control mt-2 ltr fillField" rows="3"  placeholder="English" required><?=$uni['uniHistoryEn']?></textarea>
          <small class="form-text text-muted ltr fs75p">Example: The college was first founded in 1964 with the name of the Higher Institute of Accounting by Aziz Nabavi (The father of Iranian accounting). The center was later renamed Tehran Institute of Technology. At that time it was equipped with mainframe computers and the Learning Resource Center and was administered under the supervision of American advisers from MIT University and by that time was named "American College".</small>
        </div>
      </div>

      <div class="form-group mt-5">
        <label for="uniNamesFromTheBeginning" class="fs105p">نام های دانشکده از آغار تاکنون</label>
        <small class="form-text text-success d-inline">(اختیاری)</small>
        <div class="alert alert-danger col-lg-6 col-sm-12 pt-1 pb-1 mt-0 small" role="alert">
          <strong>نکته مهم:</strong>
          <span>هر کدام از نام های دانشکده را همانند مثال در یک سطر جدا قرار دهید.</span>
        </div>
        <div>
          <textarea name="uniNamesFromTheBeginningFa" class="form-control" rows="3"  placeholder="<?=_add_uni_input_fa?>"><?=$uni['uniNamesFromTheBeginningFa']?></textarea>
          <small class="form-text text-muted">مثال: مؤسسهٔ عالی حسابداری</small>
          <small class="form-text text-muted mr-4">&nbsp;&nbsp;انستیتو تکنولوژی تهران</small>
          <textarea name="uniNamesFromTheBeginningEn" class="form-control mt-2" rows="3"  placeholder="<?=_add_uni_input_en?>"><?=$uni['uniNamesFromTheBeginningEn']?></textarea>
          <small class="form-text text-muted">مثال: Accounting Institute</small>
          <small class="form-text text-muted mr-4">&nbsp;Tehran Institute of Technology</small>
        </div>
      </div>

      <div class="form-group mt-5">
        <label for="uniPresidentsFromTheBeginning" class="fs105p">رئیسان دانشکده از آغاز تاکنون</label>
        <small class="form-text text-success d-inline">(اختیاری)</small>
        <div class="alert alert-danger col-lg-6 col-sm-12 pt-1 pb-1 mt-0 small" role="alert">
          <strong>نکته مهم:</strong>
          <span>هر کدام از نام های رئیسان را همانند مثال در یک سطر جدا قرار دهید.</span>
        </div>
        <div>
          <textarea name="uniPresidentsFromTheBeginningFa" class="form-control" rows="3"  placeholder="<?=_add_uni_input_fa?>"><?=$uni['uniPresidentsFromTheBeginningFa']?></textarea>
          <small class="form-text text-muted">مثال: احمد ریاضی از سال ۱۳۵۹ تا ۱۳۶۰</small>
          <small class="form-text text-muted mr-4">&nbsp;&nbsp;دکتر کاردان از ۱۳۶۰ تا ۱۳۶۲</small>
          <textarea name="uniPresidentsFromTheBeginningEn" class="form-control mt-2" id="uniNamesFromTheBeginningEn" rows="3"  placeholder="<?=_add_uni_input_en?>"><?=$uni['uniPresidentsFromTheBeginningEn']?></textarea>
          <small class="form-text text-muted">مثال: Ahmad Riazi from 1359 to 1360</small>
          <small class="form-text text-muted mr-4">&nbsp;Dr. Kardan from 1360 to 1362</small>
        </div>
      </div>

      <div class="form-group mt-5">
        <label for="uniEducationalGroupsAndMajors" class="fs105p">گروه های آموزشی و رشته ها</label>
        <small class="form-text text-success d-inline">(اختیاری)</small>
        <div>
          <textarea name="uniEducationalGroupsAndMajorsFa" class="form-control" rows="3"  placeholder="<?=_add_uni_input_fa?>"><?=$uni['uniEducationalGroupsAndMajorsFa']?></textarea>
          <small class="form-text text-muted">مثال: ۱.انستیتو برق:</small>
          <small class="form-text text-muted mr-4">&nbsp;&nbsp;کامپیوتر - کاردانی و کارشناسی</small>
          <small class="form-text text-muted mr-4">&nbsp;&nbsp;۲. انستیتو عمران:</small>
          <small class="form-text text-muted mr-4">&nbsp;&nbsp;نقشه برداری - کاردانی</small>
          <textarea name="uniEducationalGroupsAndMajorsEn" class="form-control mt-2 ltr" rows="3"  placeholder="English"><?=$uni['uniEducationalGroupsAndMajorsEn']?></textarea>
          <small class="form-text text-muted">مثال: 1. Electric Institute</small>
          <small class="form-text text-muted mr-4">&nbsp;Computer - Associate Degree & Bachelor</small>
          <small class="form-text text-muted mr-4">&nbsp;2. Civil Engineering Institute</small>
          <small class="form-text text-muted mr-4">&nbsp;Building - Bachelor</small>
        </div>
      </div>

      <div class="form-group mt-5">
        <label for="uniHonours" class="fs105p">افتخارات دانشکده</label>
        <small class="form-text text-success d-inline">(اختیاری)</small>
        <div class="alert alert-danger col-lg-6 col-sm-12 pt-1 pb-1 mt-0 small" role="alert">
          <strong>نکته مهم:</strong>
          <span>هر کدام از افتخارات را همانند مثال در یک سطر جدا قرار دهید.</span>
        </div>
        <div>
          <textarea name="uniHonoursFa" class="form-control" rows="3"  placeholder="<?=_add_uni_input_fa?>"><?=$uni['uniHonoursFa']?></textarea>
          <small class="form-text text-muted">مثال: حضور در مسابقات ربوکاپ ۲۰۰۶ کشور آلمان</small>
          <small class="form-text text-muted mr-4">&nbsp;&nbsp;کسب مقام قهرمانی مسابقات رباتیک کشوری در سال ۱۳۸۵</small>
          <textarea name="uniHonoursEn" class="form-control mt-2 ltr" id="uniHonoursEn" rows="3"  placeholder="English"><?=$uni['uniHonoursEn']?></textarea>
          <small class="form-text text-muted">مثال: Attending the 2006 RoboCup Championship in Germany</small>
          <small class="form-text text-muted mr-4">&nbsp;First place of national robotics championship in 2006</small>
        </div>
      </div>

      <div class="form-group mt-5">
        <label for="uniAdditionalExplanations" class="fs105p">توضیحات اضافی و دلخواه شما در مورد دانشکده</label>
        <small class="form-text text-success d-inline">(اختیاری)</small>
        <div>
          <textarea name="uniAdditionalExplanationsFa" class="form-control" rows="3"  placeholder="<?=_add_uni_input_fa?>"><?=$uni['uniAdditionalExplanationsFa']?></textarea>
          <small class="form-text text-muted">مثال: انتقال ساختمان دانشکده و حواشی پیرامون آن</small>
          <small class="form-text text-muted">ساختمان فعلی دانشکده (میدان امام حسین (ع) - ابتدای خیابان دماوند - روبروی خیابان شهید منتظری) انتقال یافته از میدان ونک (خیابان برزیل) بود که این انتقال حواشی و تنش‌های بسیاری را در پی داشت. دانشجویان به دلیل کمبود امکانات در مکان موردنظر مسئولان اعتراضات خود را نسبت به این تصمیم اعلام کردند، اما در نهایت و بعد از ۲ سال کشمکش ساختمان دانشکده به مکان فعلی انتقال یافت.</small>
          <textarea name="uniAdditionalExplanationsEn" class="form-control mt-2 ltr" rows="3"  placeholder="English"><?=$uni['uniAdditionalExplanationsEn']?></textarea>
          <small class="form-text text-muted ltr fs75p">Example: Transfer of the Faculty Building</small>
          <small class="form-text text-muted ltr fs75p">The current building of the faculty (Imam Hussein Square - the front of Damavand Street - opposite the Martyr Montazeri Street) was transferred from the Vanak Square (Brazil Street), which resulted in many edges and tensions. Students announced their objections to this decision due to lack of facilities at the place, but eventually and after 2 years of school building congestion moved to the current location.</small>
        </div>
      </div>
    </div>

    <input type="hidden" value="<?if($uni==null){echo('Add');}else{echo($uni['uni_id']);}?>" name="addOrEdit" />
    <button type="submit" class="btn btn-success mt-5 mb-2">ثبت اطلاعات</button>
  </form>

  <!-- Progress Modal -->
  <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">بارگذاری اطلاعات</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="height: 1.7rem; line-height: 1.7rem;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div id="targetLayer"></div>
        </div>
        <div class="modal-footer ltr">
          <span class="rtl">با تشکر از صبر شما...</span>
        </div>
      </div>
    </div>
  </div>

</div>

<script>


  // Mine Code
  $(document).ready(function() {
    // required message
    var elements = document.getElementsByClassName("fillField");
    for (var i = 0; i < elements.length; i++) {
      elements[i].oninvalid = function(e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
          e.target.setCustomValidity("لطفا این قسمت رو پر کنید.");
        }
      };
      elements[i].oninput = function(e) {
        e.target.setCustomValidity("");
      };
    }

    // when select one of the state, disable the textInput
    $('#uniStateSelector').change(function(){
      var uniStateSelector = $(this).find(":selected").text();
      if(uniStateSelector == 'انتخاب استان'){
        $('#uniStateFa').prop('disabled', false);
        $('#uniStateEn').prop('disabled', false);
      }else{
        $('#uniStateFa').prop('disabled', true);
        $('#uniStateEn').prop('disabled', true);
        $('#uniStateFa').val('');
        $('#uniStateEn').val('');
      }
    });

    // when select one of the city, disable the textInput
    $('#uniCitySelector').change(function(){
      var uniCitySelector = $(this).find(":selected").text();
      if(uniCitySelector == 'انتخاب شهر'){
        $('#uniCityFa').prop('disabled', false);
        $('#uniCityEn').prop('disabled', false);
      }else{
        $('#uniCityFa').prop('disabled', true);
        $('#uniCityEn').prop('disabled', true);
        $('#uniCityFa').val('');
        $('#uniCityEn').val('');
      }
    });

    /* show file value after file select */
    $('.custom-file-input').on('change',function(){
      var filename = $(this).val().split('\\').pop();
      $(this).next('.form-control-file').addClass("selected").html(filename);

      var inputId = $(this).attr('id');
      $('#' +inputId).popover('dispose');

      var file, img;
      var _URL = window.URL || window.webkitURL;
      if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
          var ratio = this.width / this.height;

          if(inputId == 0){
            if(this.height >= 200 && this.width >= 200 && ratio == 1){
              readURL(this, "imgUniLogo", file);
            }else{
              $('#' +inputId).popover('show');
              $('#' +inputId).val('');
            }
          }else{
            if(this.height >= 300 && ratio >= 1.5){
              readURL(this, "imgUni"+inputId, file);
            }else{
              $('#' +inputId).popover('show');
              $('#' +inputId).val('');
            }
          }
        };
        img.src = _URL.createObjectURL(file);
      }
    })

    function readURL(input, imageId, file) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#'+imageId).attr('src', e.target.result);
      }
      reader.readAsDataURL(file);
    }

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      $(this).ajaxSubmit({
        target:   '#targetLayer',
        beforeSubmit: function() {
          $('#progressModal').modal('show');
          $(".progress-bar").width('0%');
        },
        uploadProgress: function (event, position, total, percentComplete){
          $(".progress-bar").width(percentComplete + '%');
          $(".progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
        },
        success:function (){
          $('#progressModal').modal('hide');
          window.location.replace("<?=baseUrl()?>/page/home");
        },
        resetForm: true
      });
      return false;
    });

  });
</script>


<script>
  // This sample uses the Place Autocomplete widget requesting only a place
  // ID to allow the user to search for and locate a place. The sample
  // then reverse geocodes the place ID and displays an info window
  // containing the place ID and other information about the place that the
  // user has selected.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: <?if($uni!=null){echo(trim(explode(',',$uni['uniLatLng'])[0]));}else{echo('32.947093');}?>,
               lng: <?if($uni!=null){echo(trim(explode(',',$uni['uniLatLng'])[1]));}else{echo('54.407328');}?>},
      zoom: <?if($uni!=null){echo('17');}else{echo('5');}?>
    });

    var input = document.getElementById('pac-input');

    var autocomplete = new google.maps.places.Autocomplete(
      input, {placeIdOnly: true});
    autocomplete.bindTo('bounds', map);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var geocoder = new google.maps.Geocoder;
    var marker = new google.maps.Marker({
      map: map
    });
    marker.addListener('click', function() {
      infowindow.open(map, marker);
    });

    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      var place = autocomplete.getPlace();

      if (!place.place_id) {
        return;
      }
      geocoder.geocode({'placeId': place.place_id}, function(results, status) {

        if (status !== 'OK') {
          window.alert('Geocoder failed due to: ' + status);
          return;
        }
        map.setZoom(17);
        map.setCenter(results[0].geometry.location);
        // Set the position of the marker using the place ID and location.
        marker.setPlace({
          placeId: place.place_id,
          location: results[0].geometry.location
        });
        marker.setVisible(true);
        infowindowContent.children['place-name'].textContent = place.name;
        //infowindowContent.children['place-id'].textContent = place.place_id;
        infowindowContent.children['place-address'].textContent = results[0].formatted_address;
        infowindow.open(map, marker);

        var lat = results[0].geometry.location.lat();
        var lng =  results[0].geometry.location.lng();
        $('#inputLatitude').val(lat);
        $('#inputLongitude').val(lng);
      });
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJlzUjk1TtVktTzGvTEI0bo2rlQQ80gs8&libraries=places&callback=initMap"
        async defer></script>