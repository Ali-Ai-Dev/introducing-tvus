<div class="container mt-5" id="loginAndRegisterContainer">
  <div class="row justify-content-center">
    <div class="col-xl-4 col-md-4 col-12">

      <div class="tab-content">
        <div class="tab-pane active" role="tabpanel">
          <div class="card">
            <div class="card-block pt-3">
              <h4 class="card-title text-center text-uppercase text-warning">تغییر رمز عبور</h4>
              <p class="card-text text-center text-muted">
                <small>لطفا یک رمز عبور جدید برای خود تعیین نمایید.</small>
              </p>

              <form id="formChangePassword" action="<?=baseUrl();?>/account/changePassword" method="post">
                <fieldset class="form-group">
                  <label for="registerEmail">آدرس ایمیل</label>
                  <input class="form-control" type="email" name="userEmail" value="<?=session_get('email')?>" disabled>
                </fieldset>

                <fieldset class="form-group">
                  <label for="changePassword1">رمز عبور</label>
                  <div class="input-group">
                    <input class="form-control passwordBorderRadius" id="userPassword1" type="password" name="userPassword1" data-toggle="popover" data-placement="right" data-content="حداقل طول کلمه عبور 8 حرف میباشد."  placeholder="پسورد خود را وارد نمایید">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" id="btnShowPassword" style="border-radius: 0.5rem 0 0 0.5rem" type="button">نمایش</button>
                    </span>
                  </div>
                  <label for="registerPassword2">تکرار رمز عبور</label>
                  <input class="form-control" id="userPassword2" type="password" name="userPassword2"  data-toggle="popover" data-placement="right" data-content="رمز های عبور با هم تطابق ندارند." placeholder="پسورد را دوباره وارد نمایید">
                </fieldset>

                <button id="btnSubmit" type="button" class="btn btn-warning btn-block mt-5">تغییر رمز عبور</button>
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

    $("#userPassword1").on('keyup',function(){
      $(this).popover('hide');
    });

    $("#userPassword2").on('keyup',function(){
      $(this).popover('hide');
    });

    $("#btnSubmit").click(function () {
      if ($("#userPassword1").val().length < 8) {
        $("#userPassword1").popover('show');
        return;
      }

      if ($("#userPassword1").val() != $("#userPassword2").val()) {
        $("#userPassword2").popover('show');
        return;
      }

      $("#formChangePassword").submit();
    });

  });

</script>
