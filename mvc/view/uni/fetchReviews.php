<? $btnClasses = ' btn pl-3 pr-3 pt-2 pb-2';?>
<div class="mt-3">
  <?if($pageCount != 0 && $pageCount != 1){?>
    <?= pagination('', 2, 'btn-success'.$btnClasses , 'btn-primary'.$btnClasses, $pageIndex, $pageCount, 'readData'); ?>
  <?}?>
</div>

<table class="table mt-4">
  <thead>
  <tr class="headerRow">
    <th>#</th>
    <th>شماره کاربر</th>
    <th>متن نظر</th>
    <th>رای مثبت</th>
    <th>رای منفی</th>
    <th>تاریخ ثبت</th>
    <th>اعمال تغییرات</th>
  </tr>
  </thead>

  <tbody>

  <?
  if($reviews != null) {
    $i = ($pageIndex-1) * $itemCount;
    foreach ($reviews as $review) {?>
      <tr class="<?if($review['reviewReport']=='Advertising'){echo('table-warning');}else if($review['reviewReport']=='Inappropriate Content'){echo('table-danger');}?>">
        <th scope="row" class="text-right"><?=++$i?></th>
        <td><?=$review['user_id']?></td>
        <td><?echo(mb_substr($review['reviewText'],0,13,"UTF-8"));if(strlen($review['reviewText'])>13){echo(' ...');}?></td>
        <td><?=$review['reviewUpVote']?></td>
        <td><?=$review['reviewDownVote']?></td>
        <td><?$parts=explode('-',$review['reviewDate']);echo(calcGregorianToJalali(substr($parts[2],0,2),$parts[1],$parts[0]));?></td>
        <td>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showReviewTextModal<?=$i?>">متن کامل</button>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteReviewModal<?=$i?>">حذف</button>

          <!-- Show Review Text Modal -->
          <div class="modal fade" id="showReviewTextModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">متن نظر</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <span>نظر کاربر شماره </span>
                  <strong>'<?=$review['user_id']?>'</strong>
                  <div class="alert mt-3 textModalWrapper">
                    <span class="w-100" style="white-space:pre-wrap ; word-wrap:break-word;"><?=$review['reviewText']?></span>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Delete Review Modal -->
          <div class="modal fade" id="deleteReviewModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">حذف نظر</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <span>آیا از حذف نظر </span>
                  <div>
                    <strong>'<?echo(mb_substr($review['reviewText'],0,40,"UTF-8"));if(strlen($review['reviewText'])>40){echo(' ...');}?>'</strong>
                  </div>
                  <span> اطمینان دارید؟</span>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                  <button type="button" class="btn btn-danger mr-2" onclick="deleteReview(<?=$review['uniReview_id']?>,<?=$i?>)">بله</button>
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
      <td colspan="6">موردی یافت نشد.</td>
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
