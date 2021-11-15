<div class="container mb-4">
  <div class="alert alert-heading col-8" role="alert">
    <strong>نظرات <?=$uniFullNameFa?></strong>
    <div class="small text-danger mt-1 mr-3">
      <strong>نکته 1:</strong>
      <span>ردیف های قرمز نشان دهنده نظرات گزارش شده با محتوای نامناسب هستند.</span>
    </div>
    <div class="small text-warning mt-1 mr-3">
      <strong>نکته 2:</strong>
      <span>ردیف های زرد نشان دهنده نظرات گزارش شده با مورد تبلیغات هستند.</span>
    </div>
    <hr class="mt-2 mb-2">
  </div>

  <div class="row mt-3">
    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">جستجو</label>
        <div class="col-10">
          <input class="form-control" type="search" id="inputSearch" placeholder="جستجو در متن نظرات">
        </div>
      </div>
    </div>

    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">تاریخ</label>
        <div class="col-10">
          <select name="dateSelector" id="dateSelector" class="form-control d-inline">
            <option value="New">جدید ترین</option>
            <option value="Old">قدیمی ترین</option>
          </select>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-3 col-form-label">گزارش&nbsp;شده</label>
        <div class="col-9">
          <select name="reportSelector" id="reportSelector" class="form-control d-inline">
            <option value="">نوع گزارش</option>
            <option value="Inappropriate Content">محتوای نامناسب</option>
            <option value="Advertising">تبلیغات</option>
          </select>
        </div>
      </div>
    </div>

  </div>

  <div id="reviewsContainer">
  </div>

</div>


<script>
  $(function(){
    readData();
  });

  $("#dateSelector").change(function(){
    readData();
  });

  $("#reportSelector").change(function(){
    readData();
  });

  $("#inputSearch").on('keyup',function(){
    readData();
  });

  function readData(pageIndex){
    pageIndex = pageIndex || 1;
    var dateSelector = $("#dateSelector").val();
    var reportSelector = $("#reportSelector").val();
    var searchPhrase = $("#inputSearch").val();

    $.ajax({
      url: "<?=baseUrl()?>/uni/fetchReviews/" + pageIndex,
      method: 'POST',
      data: {
        dateSelector: dateSelector,
        reportSelector: reportSelector,
        searchPhrase: searchPhrase,
        uniId: <?=$uniId?>
      }
    }).done(function(output) {
      $("#reviewsContainer").empty();
      $("#reviewsContainer").append(output);
    });
  };


  function deleteReview($uniReviewId, $modalNumber){
    $('#deleteReviewModal'+ $modalNumber).modal('hide');

    $('#deleteReviewModal'+ $modalNumber).on('hidden.bs.modal', function (e) {

      $.ajax({
        url: "<?=baseUrl()?>/uni/deleteReview",
        method: 'POST',
        data: {
          uniReviewId: $uniReviewId
        }
      }).done(function(output) {
        readData();
      });

    });
  }

</script>