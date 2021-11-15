<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-xl-4 col-md-4 col-12">

      <div id="alreadyRegistered" class="alert alert-danger d-none fs90p" role="alert">
        <strong>خطا: </strong>
        <span>این حساب کاربری قبلا در سیستم ثبت شده است.</span>
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="register" role="tabpanel">
          <div class="card">
            <div class="card-block pt-3">
              <h4 class="card-title text-center text-uppercase text-warning">ثبت نام</h4>
              <p class="card-text text-center text-muted">
                <small>لطفا موارد خواسته شده جهت ثبت نام را تکمیل نمایید.</small>
              </p>

              <form id="formUserRegister" action="<?=baseUrl();?>/account/register" method="post">
                <fieldset class="form-group">
                  <label for="registerEmail">آدرس ایمیل</label>
                  <input id="userEmail" class="form-control" type="email" name="userEmail" data-toggle="popover" data-placement="right" data-content="ایمیل خود را وارد نمایید." placeholder="ایمیل را وارد نمایید">
                </fieldset>

                <fieldset class="form-group">
                  <label for="registerPassword1">رمز عبور</label>
                  <div class="input-group">
                    <input class="form-control passwordBorderRadius" id="userPassword1" type="password" name="userPassword1" data-toggle="popover" data-placement="right" data-content="حداقل طول کلمه عبور 8 حرف میباشد."  placeholder="پسورد خود را وارد نمایید">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" id="btnShowPassword" style="border-radius: 0.5rem 0 0 0.5rem" type="button">نمایش</button>
                    </span>
                  </div>
                  <label for="registerPassword2">تکرار رمز عبور</label>
                  <input class="form-control" id="userPassword2" type="password" name="userPassword2"  data-toggle="popover" data-placement="right" data-content="رمز های عبور با هم تطابق ندارند." placeholder="پسورد را دوباره وارد نمایید">
                </fieldset>

                <button id="btnSubmit" type="button" class="btn btn-warning btn-block mt-5">ثبت نام</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>

  $(document).ready(function () {
    $("#btnShowPassword").click(function () {
      if ($("#userPassword1").attr("type") === "password") {
        $("#userPassword1").attr("type", "text");
        $("#userPassword2").attr("type", "text");
      } else {
        $("#userPassword1").attr("type", "password");
        $("#userPassword2").attr("type", "password");
      }
    });

    $("#userEmail").on('keyup',function(){
      $(this).popover('hide');
      $("#alreadyRegistered").addClass("d-none");
    });

    $("#userPassword1").on('keyup',function(){
      $(this).popover('hide');
    });

    $("#userPassword2").on('keyup',function(){
      $(this).popover('hide');
    });

    $("#btnSubmit").click(function () {
      if ($("#userEmail").val() == '') {
        $("#userEmail").popover('show');
        return;
      }

      if ($("#userPassword1").val().length < 8) {
        $("#userPassword1").popover('show');
        return;
      }

      if ($("#userPassword1").val() != $("#userPassword2").val()) {
        $("#userPassword2").popover('show');
        return;
      }

      submitForm();
    });

  });

  function submitForm(){
    var userEmail = $("#userEmail").val();
    var userPassword1 = $("#userPassword1").val();

    $.ajax({
      url: "<?=baseUrl()?>/account/register",
      method: 'POST',
      data: {
        userEmail: userEmail,
        userPassword1: userPassword1
      }
    }).done(function(output) {
      if(output == 'alreadyRegistered'){
        $("#alreadyRegistered").removeClass("d-none");
        $("#userPassword1").val('');
        $("#userPassword2").val('');
        return;
      }
      window.location.replace("<?=baseUrl()?>/page/home");
    });
  };


</script>
