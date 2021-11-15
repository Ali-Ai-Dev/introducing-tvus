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
    <th>متن بازخورد</th>
    <th>تعداد عکس</th>
    <th>Brand</th>
    <th>Model</th>
    <th>Device</th>
    <th>SDK</th>
    <th>اعمال تغییرات</th>
  </tr>
  </thead>

  <tbody>

  <?
  if($feedbacks != null) {
    $i = ($pageIndex-1) * $itemCount;
    foreach ($feedbacks as $feedback) {?>
      <tr>
        <th scope="row" class="text-right"><?=++$i?></th>
        <td><?echo(mb_substr($feedback['feedbackText'],0,13,"UTF-8"));if(strlen($feedback['feedbackText'])>13){echo(' ...');}?></td>
        <td><?$parts=explode('|',$feedback['feedbackImages']);if(count($parts)>0){echo(count($parts)-1);}else{echo('0');}?></td>
        <td><?=explode('|',$feedback['mobileInfoBrandModelDeviceSdk'])[0]?></td>
        <td><?=explode('|',$feedback['mobileInfoBrandModelDeviceSdk'])[1]?></td>
        <td><?=explode('|',$feedback['mobileInfoBrandModelDeviceSdk'])[2]?></td>
        <td><?=explode('|',$feedback['mobileInfoBrandModelDeviceSdk'])[3]?></td>

        <td>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showFeedbackModal<?=$i?>">مشاهده کامل</button>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteFeedbackdModal<?=$i?>">حذف</button>

          <!-- showFeedbackModal -->
          <div class="modal fade" id="showFeedbackModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    <span>بازخورد شماره </span>
                    <strong><?=$i?></strong>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <span>متن بازخورد:</span>
                  <div class="alert mt-2 mb-4 textModalWrapper">
                    <span class="w-100" style="white-space:pre-wrap ; word-wrap:break-word;"><?=$feedback['feedbackText']?></span>
                  </div>

                  <span>عکس ها:</span>
                  <?$parts=explode('|',$feedback['feedbackImages']);
                    $imageCounts = count($parts);
                    if($imageCounts == 0 || $imageCounts == 1){?>
                      <div class="tac">عکسی موجود نیست!</div>
                    <?}else{?>
                      <div class="card-deck">
                        <?for($j=1; $j<4; $j++){
                          $parts=explode('|',$feedback['feedbackImages']);
                          if($imageCounts>$j){?>
                            <div class="card mt-3">
                              <img class="card-img-top feedbackImages m-1" id="imgFeedback<?=$j?>" src="<?echo(baseUrl().$parts[$j]);?>" alt="Image <?=$j?>">
                              <div class="card-block imagesTitle">
                                <span class="card-title rtl m-0 d-inline">عکس شماره <?=$j?></span>
                              </div>
                            </div>
                          <?}
                        }?>
                      </div>
                  <?}?>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
              </div>
            </div>
          </div>

          <!-- deleteFeedbackdModal -->
          <div class="modal fade" id="deleteFeedbackdModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">حذف بازخورد</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <span>آیا از حذف بازخورد </span>
                  <div>
                    <strong>'<?echo(mb_substr($feedback['feedbackText'],0,40,"UTF-8"));if(strlen($feedback['feedbackText'])>40){echo(' ...');}?>'</strong>
                  </div>
                  <span> اطمینان دارید؟</span>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                  <button type="button" class="btn btn-danger mr-2" onclick="deleteFeedback(<?=$feedback['feedback_id']?>,<?=$i?>)">بله</button>
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
      <td colspan="7">موردی یافت نشد.</td>
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
