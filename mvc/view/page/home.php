<div class="container mb-5">
  <div class="row mt-4">
    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">جستجو</label>
        <div class="col-10">
          <input class="form-control" type="search" id="inputSearch" placeholder="نام دانشکده">
        </div>
      </div>
    </div>

    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">استان</label>
        <div class="col-10">
          <select name="uniStateSelector" id="uniStateSelector" class="form-control d-inline">
            <option>انتخاب استان</option>
            <?foreach($uniStates as $uniState){?>
              <option><?=$uniState['uniStateFa']?></option>
            <?}?>
          </select>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="form-group row">
        <label for="example-search-input" class="col-2 col-form-label">شهر</label>
        <div class="col-10">
          <select name="uniCitySelector" id="uniCitySelector" class="form-control d-inline">
            <option>انتخاب شهر</option>
            <?foreach($uniCities as $uniCity){?>
              <option><?=$uniCity['uniCityFa']?></option>
            <?}?>
          </select>
        </div>
      </div>
    </div>

  </div>

  <div id="tableContainer">
  </div>

</div>


<script>
  $(function(){
    readData();
  });

  $("#uniStateSelector").change(function(){
    readData();
  });

  $("#uniCitySelector").change(function(){
    readData();
  });

  $("#inputSearch").on('keyup',function(){
    readData();
  });

  function readData(pageIndex){
    pageIndex = pageIndex || 1;
    var uniStateSelector = $("#uniStateSelector").val();
    var uniCitySelector = $("#uniCitySelector").val();
    var searchPhrase = $("#inputSearch").val();

    $.ajax({
      url: "<?=baseUrl()?>/uni/fetchUnis/" + pageIndex,
      method: 'POST',
      data: {
        uniStateSelector: uniStateSelector,
        uniCitySelector: uniCitySelector,
        searchPhrase: searchPhrase
      }
    }).done(function(output) {
      $("#tableContainer").empty();
      $("#tableContainer").append(output);
    });
  };


  function deleteUni($uniId, $modalNumber){
    $('#deleteUniModal'+ $modalNumber).modal('hide');

    $('#deleteUniModal'+ $modalNumber).on('hidden.bs.modal', function (e) {

      $.ajax({
        url: "<?=baseUrl()?>/uni/deleteUni",
        method: 'POST',
        data: {
          uniId: $uniId
        }
      }).done(function(output) {
        readData();
      });

    });
  }

</script>