<? $btnClasses = ' btn pl-3 pr-3 pt-2 pb-2';?>
<div class="mt-3">
  <?if($pageCount != 0 && $pageCount != 1){?>
    <?= pagination('', 2, 'btn-success'.$btnClasses , 'btn-primary'.$btnClasses, $pageIndex, $pageCount, 'readData'); ?>
  <?}?>
</div>

<table class="table table-striped mt-4">
  <thead>
  <tr class="headerRow">
    <th>#</th>
    <th>ایمیل کاربر</th>
    <th>سطح دسترسی</th>
    <th>اعمال تغییرات</th>
  </tr>
  </thead>

  <tbody>

  <?
  if($accounts != null) {
    $i = ($pageIndex-1) * $itemCount;
    foreach ($accounts as $account) {?>
      <tr>
        <th scope="row" class="text-right"><?=++$i?></th>
        <td><?=$account['userEmail']?></td>
        <td>
          <?if($account['userAccess'] == '|superadmin|'){
              echo('مدیر کل');
            }else if($account['userAccess'] == '|admin|'){
              echo('مدیر');
            }else if($account['userAccess'] == '|author|'){
              echo('نویسنده');
            }
          ?>
        </td>

        <td>
          <?if(isSuperAdmin()){?>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeAccessModal<?=$i?>">تغییر دسترسی</button>
          <?}?>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#resetPasswordModal<?=$i?>">reset password</button>

          <!-- changeAccessModal -->
          <div class="modal fade" id="changeAccessModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">تغییر سطح دسترسی</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <span>تعیین سطح دسترسی برای کاربر </span>
                  <strong>'<?=$account['userEmail']?>'</strong>

                  <div class="mt-4 col-6">
                    <select id="changeAccessTypeSelector<?=$i?>" class="form-control d-inline">
                      <option value="superadmin" <?if($account['userAccess'] == '|superadmin|'){echo('selected');}?>>مدیر کل</option>
                      <option value="admin" <?if($account['userAccess'] == '|admin|'){echo('selected');}?>>مدیر</option>
                      <option value="author" <?if($account['userAccess'] == '|author|'){echo('selected');}?>>نویسنده</option>
                    </select>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                  <button type="button" class="btn btn-primary mr-2" onclick="changeAccess(<?=$account['user_id']?>,<?=$i?>)">ثبت</button>
                </div>
              </div>
            </div>
          </div>

          <!-- resetPasswordModal -->
          <div class="modal fade" id="resetPasswordModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">تنظیم مجدد کلمه عبور</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="alert alert-danger fs95p" role="alert">
                    <strong>نکته بسیار مهم:</strong>
                    <span>بعد از ریست کردن پسورد، نام کاربری و رمز عبور حساب مورد نظر یکسان خواهد شد.</span>
                  </div>
                  <span>آیا از ریست کردن رمز عبور کاربر </span>
                  <strong>'<?=$account['userEmail']?>'</strong>
                  <span> اطمینان دارید؟</span>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                  <button type="button" class="btn btn-danger mr-2" onclick="resetPassword(<?=$account['user_id']?>,'<?=$account['userEmail']?>',<?=$i?>)">بله</button>
                </div>
              </div>
            </div>
          </div>

        </td>
      </tr>
    <?}?>
  <?}else{?>
    <tr>
      <th scope="row" class="text-right">1</th>
      <td colspan="5">موردی یافت نشد.</td>
    </tr>
  <?}
  ?>

  </tbody>
</table>
<div class="mt-4">
  <?if($pageCount != 0 && $pageCount != 1){?>
    <?= pagination('', 2, 'btn-success'.$btnClasses , 'btn-primary'.$btnClasses, $pageIndex, $pageCount, 'readData'); ?>
  <?}?>
</div>


<script>

  function resetPassword($userId, $userEmail, $modalNumber){
    $('#resetPasswordModal'+ $modalNumber).modal('hide');

    $('#resetPasswordModal'+ $modalNumber).on('hidden.bs.modal', function (e) {
      $.ajax({
        url: "<?=baseUrl()?>/account/resetPassword",
        method: 'POST',
        data: {
          userId: $userId,
          userEmail: $userEmail
        }
      }).done(function(output) {

      });

    });
  }

</script>
