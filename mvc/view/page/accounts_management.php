<div class="container mb-5">
  <div class="row mt-4 col-xl-10 col-md-12">
    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">جستجو</label>
        <div class="col-10">
          <input class="form-control" type="search" id="inputSearch" placeholder="ایمیل کاربر">
        </div>
      </div>
    </div>

    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">دسترسی</label>
        <div class="col-10">
          <select name="accessTypeSelector" id="accessTypeSelector" class="form-control d-inline">
            <option value="">سطح دسترسی</option>
            <option value="superadmin">مدیر کل</option>
            <option value="admin">مدیر</option>
            <option value="author">نویسنده</option>
          </select>
        </div>
      </div>
    </div>

  </div>

  <div id="accountsManagementContainer">
  </div>

</div>


<script>
  $(function(){
    readData();
  });

  $("#accessTypeSelector").change(function(){
    readData();
  });

  $("#inputSearch").on('keyup',function(){
    readData();
  });

  function readData(pageIndex){
    pageIndex = pageIndex || 1;
    var accessTypeSelector = $("#accessTypeSelector").val();
    var searchPhrase = $("#inputSearch").val();

    $.ajax({
      url: "<?=baseUrl()?>/account/fetchAccounts/" + pageIndex,
      method: 'POST',
      data: {
        accessTypeSelector: accessTypeSelector,
        searchPhrase: searchPhrase
      }
    }).done(function(output) {
      $("#accountsManagementContainer").empty();
      $("#accountsManagementContainer").append(output);
    });
  }


  <?if(isSuperAdmin()){?>
  function changeAccess($userId, $modalNumber){
    $('#changeAccessModal'+ $modalNumber).modal('hide');

    $('#changeAccessModal'+ $modalNumber).on('hidden.bs.modal', function (e) {
      var accessType = $("#changeAccessTypeSelector"+ $modalNumber).val();

      $.ajax({
        url: "<?=baseUrl()?>/account/changeAccess",
        method: 'POST',
        data: {
          userId: $userId,
          accessType: accessType
        }
      }).done(function(output) {
        readData();
      });

    });
  }
  <?}?>

</script>