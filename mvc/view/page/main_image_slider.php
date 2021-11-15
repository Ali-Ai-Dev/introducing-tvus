<div class="container mb-5">
  <div class="alert alert-danger col-9" role="alert">
    <strong>تذکر:</strong>
    <span>تصاویر اسلایدر اصلی، یکی از موارد تعیین کننده در ظاهر اپلیکیشن هستند، در انتخاب آنها دقت نمایید.</span>
  </div>
  <form id="uploadForm" class="mt-5" action="<?=baseUrl()?>/page/mainImageSlider" method="post" enctype="multipart/form-data">

    <? $i = 1;
    for($j=0; $j<2; $j++){?>
      <div class="form-group">

        <div class="card-deck">
          <?for($k=0; $k<3; $k++,$i++){?>
            <div class="card">
              <img class="card-img-top uniImages" id="imgSlider<?=$i?>" src="<?echo(baseUrl());$parts=explode('|',$imageSlider['images']);if(count($parts)>=$i){echo($parts[$i-1]);}?>" alt="Image <?=$i?>">
                <div class="card-block imagesTitle">
                <span class="card-title rtl m-0 d-inline">تصویر شماره <?=$i?></span>
                <?if($j==0){?>
                  <small class="form-text text-danger d-inline">(اجباری)</small>
                <?}else{;?>
                  <small class="form-text text-muted d-inline">(اختیاری)</small>
                <?}?>
              </div>
              <div class="card-footer small border-top-0">
                <label class="custom-file customFile ltr">
                  <input name="inputImgSlider<?=$i?>" id="<?=$i?>" type="file" class="custom-file-input" accept=".png, .jpg"  data-toggle="popover" data-placement="top" title="<?=_image_error_title?>" data-content="<?=_image_error_data_content?>" >
                  <span id="sliderImageText<?=$i?>" class="custom-file-control form-control-file"></span>
                </label>
              </div>
            </div>
          <?}?>
        </div>

      </div>
    <?}?>

    <input type="hidden" value="<?=$imageSlider['imageSliderMain_id']?>" name="imageSliderMainId" />
    <button type="submit" class="btn btn-success col-2 mt-5 mb-2 mr-3">ثبت تصاویر</button>
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
  $(document).ready(function() {
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

          if(this.height >= 300 && ratio >= 1.5){
            readURL(this, "imgSlider"+inputId, file);
          }else{
            $('#' +inputId).popover('show');
            $('#' +inputId).val('');
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
