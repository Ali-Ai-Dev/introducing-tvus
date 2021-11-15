<? $btnClasses = ' btn pl-3 pr-3 pt-2 pb-2';?>
<div class="mt-3">
  <?if($pageCount != 0 && $pageCount != 1){?>
    <?= pagination('', 2, 'btn-success'.$btnClasses , 'btn-primary'.$btnClasses, $pageIndex, $pageCount, 'readData'); ?>
  <?}?>
</div>

<table id="tableUni" class="table table-striped mt-4">
  <thead>
  <tr class="headerRow">
    <th>#</th>
    <th>نام دانشکده</th>
    <th>نام استان</th>
    <th>نام شهر</th>
    <th>جنسیت</th>
    <th>اعمال تغییرات</th>
  </tr>
  </thead>

  <tbody>

<?
if($unis != null) {
  $i = ($pageIndex-1) * $itemCount;
  foreach ($unis as $uni) {?>
      <tr>
        <th scope="row" class="text-right"><?=++$i?></th>
        <td><?=$uni['uniFullNameFa']?></td>
        <td><?=$uni['uniStateFa']?></td>
        <td><?=$uni['uniCityFa']?></td>
        <td><?if($uni['uniGender'] == 'boys'){
            ?>پسرانه<?
          }else{
            ?>دخترانه<?
          }?>
        </td>
        <td>
          <button type="button" class="btnReview btn btn-success" data-uni-id="<?=$uni['uni_id']?>" data-uni-name="<?=$uni['uniFullNameFa']?>">نظرات</button>
          <button type="button" class="btnEdit btn btn-primary" data-uni-id="<?=$uni['uni_id']?>">ویرایش</button>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUniModal<?=$i?>">حذف</button>

          <!-- Modal -->
          <div class="modal fade" id="deleteUniModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">حذف دانشکده</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <span>آیا از حذف </span>
                  <strong>'<?=$uni['uniFullNameFa']?>'</strong>
                  <span> اطمینان دارید؟</span>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                  <button type="button" class="btn btn-danger mr-2" onclick="deleteUni(<?=$uni['uni_id']?>,<?=$i?>)">بله</button>
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
  $(document).ready(function() {

    $('.btnEdit').on('click', function(){
      var uniId = $(this).data('uni-id');
      post("<?=baseUrl();?>/page/editUni", {uniId: uniId});
    });

    $('.btnReview').on('click', function(){
      var uniId = $(this).data('uni-id');
      var uniFullNameFa = $(this).data('uni-name');
      post("<?=baseUrl();?>/page/reviews", {uniId: uniId, uniFullNameFa: uniFullNameFa});
    });

    function post(path, params, method) {
      method = method || "post"; // Set method to post by default if not specified.

      // The rest of this code assumes you are not using a library.
      // It can be made less wordy if you use one.
      var form = document.createElement("form");
      form.setAttribute("method", method);
      form.setAttribute("action", path);

      for(var key in params) {
        if(params.hasOwnProperty(key)) {
          var hiddenField = document.createElement("input");
          hiddenField.setAttribute("type", "hidden");
          hiddenField.setAttribute("name", key);
          hiddenField.setAttribute("value", params[key]);

          form.appendChild(hiddenField);
        }
      }
      document.body.appendChild(form);
      form.submit();
    }

  });
</script>
