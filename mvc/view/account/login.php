<?
if (isset($_SESSION['email'])){
  header("Location: " . baseUrl() . "/page/home");
}
?>

<div class="container" id="loginAndRegisterContainer">
  <div class="row justify-content-center">
    <div class="col-xl-4 col-md-4 col-12">

      <div id="emailNotRegisterd" class="alert alert-danger d-none fs90p" role="alert">
        <strong>خطا: </strong>
        <span>این ایمیل در سیستم ثبت نشده است.</span>
      </div>

      <div id="invalidPassword" class="alert alert-danger d-none fs90p" role="alert">
        <strong>خطا: </strong>
        <span>رمز عبور وارد شده اشتباه میباشد.</span>
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="login" role="tabpanel">
          <div class="card">
            <div class="card-block pt-3">
              <h4 class="card-title text-center text-uppercase text-success">ورود</h4>
              <p class="card-text text-center text-muted">
                <small>لطفا موارد خواسته شده جهت ورود را تکمیل نمایید</small>
              </p>

              <form action="<?=baseUrl()?>/account/login" method="post">
                <fieldset class="form-group">
                  <label for="loginEmail">آدرس ایمیل</label>
                  <input id="userEmail" class="form-control" type="email" name="userEmail"  data-toggle="popover" data-placement="right" data-content="ایمیل خود را وارد نمایید." placeholder="ایمیل را وارد نمایید">
                </fieldset>

                <fieldset class="form-group">
                  <label for="loginPassword">رمز عبور</label>
                  <input id="userPassword" class="form-control" type="password" name="userPassword"  data-toggle="popover" data-placement="right" data-content="پسورد خود را وارد نمایید."  placeholder="پسورد خود را وارد نمایید">
                </fieldset>

                <button id="btnSubmit" type="button" class="btn btn-success btn-block mt-5">ورود</button>
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
    $("#userEmail").on('keyup',function(){
      $(this).popover('hide');
      $("#emailNotRegisterd").addClass("d-none");
    });

    $("#userPassword").on('keyup',function(){
      $(this).popover('hide');
      $("#invalidPassword").addClass("d-none");
    });

    $("#btnSubmit").click(function () {
      if ($("#userEmail").val() == '') {
        $("#userEmail").popover('show');
        return;
      }

      if ($("#userPassword").val() == '') {
        $("#userPassword").popover('show');
        return;
      }

      submitForm();
    });

  });

  function submitForm(){
    var userEmail = $("#userEmail").val();
    var userPassword = $("#userPassword").val();

    $.ajax({
      url: "<?=baseUrl()?>/account/login",
      method: 'POST',
      data: {
        userEmail: userEmail,
        userPassword: userPassword
      }
    }).done(function(output) {
      if(output == 'emailNotRegisterd'){
        $("#emailNotRegisterd").removeClass("d-none");
        $("#userPassword").val('');
        return;
      }else if(output == 'invalidPassword'){
        $("#invalidPassword").removeClass("d-none");
        $("#userPassword").val('');
        return;
      }else if(output == 'mustChangePassword'){
        window.location.replace("<?=baseUrl()?>/account/changePassword");
        return;
      }
      window.location.replace("<?=baseUrl()?>/page/home");
    });
  };


</script>
