<div class="container mb-5">
  <div class="row mt-4 col-xl-10 col-md-12">
    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">جستجو</label>
        <div class="col-10">
          <input class="form-control" type="search" id="inputSearch" placeholder="جستجو در متن بازخورد">
        </div>
      </div>
    </div>

    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">مشخصات</label>
        <div class="col-10">
          <input class="form-control" type="search" id="mobileInfo" placeholder="Brand / Model / Device / SDK">
        </div>
      </div>
    </div>

  </div>

  <div id="feedbackContainer">
  </div>

</div>


<script>
  $(function(){
    readData();
  });

  $("#inputSearch").on('keyup',function(){
    readData();
  });

  $("#mobileInfo").on('keyup',function(){
    readData();
  });

  function readData(pageIndex){
    pageIndex = pageIndex || 1;
    var mobileInfo = $("#mobileInfo").val();
    var searchPhrase = $("#inputSearch").val();

    $.ajax({
      url: "<?=baseUrl()?>/android/fetchfeedbacks/" + pageIndex,
      method: 'POST',
      data: {
        mobileInfo: mobileInfo,
        searchPhrase: searchPhrase
      }
    }).done(function(output) {
      $("#feedbackContainer").empty();
      $("#feedbackContainer").append(output);
    });
  }

  function deleteFeedback($feedbackId, $modalNumber){
    $('#deleteFeedbackdModal'+ $modalNumber).modal('hide');

    $('#deleteFeedbackdModal'+ $modalNumber).on('hidden.bs.modal', function (e) {
      $.ajax({
        url: "<?=baseUrl()?>/android/deleteFeedback",
        method: 'POST',
        data: {
          feedbackId: $feedbackId
        }
      }).done(function(output) {
        readData();
      });

    });
  }


</script>