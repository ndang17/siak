<style type="text/css">
    button, input, select, textarea {
        /*margin: 7px;*/
        font-family: inherit;
        font-size: 100%;
    }
</style>
    <form class="form-horizontal" id="formModal">
        <div class="form-group"> 
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label">Pilih Program Study:</label>
                </div>    
                <div class="col-sm-6">
                    <select class="full-width-fix" id="selectPrody">
                        <option value= "Belum Done" selected>Belum Done</option>
                        <option value= "Done">Done</option>
                    </select>
                </div>
            </div>
        </div> 
        <div class="form-group"> 
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label">Nama Ujian:</label>
                </div>    
                <div class="col-sm-6">
                    <input type="text" id="nm_ujian"  class="form-control" placeholder="Nama Ujian">
                </div>
            </div>
        </div>
        <div class="form-group"> 
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label">Pilih Bobot:</label>
                </div>    
                <div class="col-sm-2">
                    <select class="full-width-fix" id="selectBobot">
                        <option></option>
                    </select>
                </div>
            </div>
        </div>
        <div style="text-align: center;">       
    		<div class="col-sm-12" id="BtnFooter">
                <button type="button" id="ModalbtnCancleForm" data-dismiss="modal" class="btn btn-default">Cancel</button>
                <button type="button" id="ModalbtnSaveForm" class="btn btn-success" aksi = "<?php echo $action ?>" kodeuniq = "<?php echo $id ?>">Save</button>
                <!--<button type="button" id="ModalbtnEditForm" class="btn btn-default btn-default-success hide">Edit Data</button>-->
    		</div>
        </div>    
    </form>
<script type="text/javascript">
    $(document).ready(function () {
        loadBobot();
        loadDataAPI();
    });

    function loadBobot()
    {
        for (var i = 1; i <= 5; i++) {
            var selected = (i==5) ? 'selected' : '';
            $('#selectBobot').append('<option value="'+ i +'" '+selected+'>'+ i+'</option>');
        }
        $('#selectBobot').select2({
          // allowClear: true
        });
    }

    function loadDataAPI()
    {
        var url = base_url_js+"api/__getBaseProdiSelectOption";
        $('#selectPrody').empty()
        $.post(url,function (data_json) {
              for(var i=0;i<data_json.length;i++){
                  var selected = (i==0) ? 'selected' : '';
                  //var selected = (data_json[i].RegionName=='Kota Jakarta Pusat') ? 'selected' : '';
                  $('#selectPrody').append('<option value="'+data_json[i].ID+'" '+selected+'>'+data_json[i].Name+'</option>');
              }
              $('#selectPrody').select2({
                 //allowClear: true
              });
        }).done(function () {
          <?php if ($action == 'edit'): ?>
              loadDataEdit();
          <?php endif ?> 
        });
    }

    <?php if ($action == 'edit'): ?>

    function loadDataEdit()
    {
        var NamaUjian = "<?php echo $getDataEdit[0]['NamaUjian'] ?>";
        var ID_ProgramStudy = "<?php echo $getDataEdit[0]['ID_ProgramStudy'] ?>";
        var Bobot = "<?php echo $getDataEdit[0]['Bobot'] ?>";

        $("#selectPrody option").filter(function() {
           //may want to use $.trim in here
           return $(this).val() == ID_ProgramStudy; 
        }).prop("selected", true);

        $('#selectPrody').select2({
           //allowClear: true
        });

        $("#selectBobot option").filter(function() {
           //may want to use $.trim in here
           return $(this).val() == Bobot; 
        }).prop("selected", true);

        $('#selectBobot').select2({
          // allowClear: true
        });

        $("#nm_ujian").val(NamaUjian);
    }

    <?php endif ?> 
</script>