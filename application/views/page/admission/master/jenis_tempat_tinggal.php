<style type="text/css">
  .setfont
  {
    font-size: 12px;
  }
  
</style>
<div class="row" style="margin-top: 30px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder"></i>Jenis Tempat Tinggal</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                      <span data-smt="" class="btn btn-xs btn-add">
                        <i class="icon-plus"></i> Add Jenis Tempat Tinggal
                       </span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <!--  -->
                  <div id = "pageData"></div>
                <!-- end widget -->
            </div>
            <hr/>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    loadTable();
  }); // exit document Function

  $(document).on('click','.btn-add', function () {
     modal_generate('add','Add Jenis Tempat Tinggal');
  });

  $(document).on('click','.btn-edit', function () {
    var ID = $(this).attr('data-smt');
     modal_generate('edit','Edit Jenis Tempat Tinggal',ID);
  });

  $(document).on('click','.btn-delete', function () {
    var ID = $(this).attr('data-smt');
     $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Apakah anda yakin untuk melakukan request ini ?? </b> ' +
         '<button type="button" id="confirmYesDelete" class="btn btn-primary" style="margin-right: 5px;" data-smt = "'+ID+'">Yes</button>' +
         '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
         '</div>');
     $('#NotificationModal').modal('show');
  });

  $(document).on('click','.btn-Active', function () {
    var ID = $(this).attr('data-smt');
    var Active = $(this).attr('data-active');
     $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Apakah anda yakin untuk melakukan request ini ?? </b> ' +
         '<button type="button" id="confirmYesActive" class="btn btn-primary" style="margin-right: 5px;" data-smt = "'+ID+'" data-active = "'+Active+'">Yes</button>' +
         '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
         '</div>');
     $('#NotificationModal').modal('show');
  });

  $(document).on('click','#confirmYesDelete',function () {
        $('#NotificationModal .modal-header').addClass('hide');
        $('#NotificationModal .modal-body').html('<center>' +
            '                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>' +
            '                    <br/>' +
            '                    Loading Data . . .' +
            '                </center>');
        $('#NotificationModal .modal-footer').addClass('hide');
        $('#NotificationModal').modal({
            'backdrop' : 'static',
            'show' : true
        });
        var url = base_url_js+'admission/master-config/submit_jenis_tempat_tinggal';
        var aksi = "delete";
        var ID = $(this).attr('data-smt');
        var data = {
            Action : aksi,
            CDID : ID,
        };
        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{token:token},function (data_json) {
            setTimeout(function () {
               toastr.options.fadeOut = 10000;
               toastr.success('Data berhasil disimpan', 'Success!');
               loadTable();
               $('#NotificationModal').modal('hide');
            },500);
        });
  });

  $(document).on('click','#confirmYesActive',function () {
        $('#NotificationModal .modal-header').addClass('hide');
        $('#NotificationModal .modal-body').html('<center>' +
            '                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>' +
            '                    <br/>' +
            '                    Loading Data . . .' +
            '                </center>');
        $('#NotificationModal .modal-footer').addClass('hide');
        $('#NotificationModal').modal({
            'backdrop' : 'static',
            'show' : true
        });
        var url = base_url_js+'admission/master-config/submit_jenis_tempat_tinggal';
        var aksi = "getactive";
        var ID = $(this).attr('data-smt');
        var Active = $(this).attr('data-active');
        var data = {
            Action : aksi,
            CDID : ID,
            Active:Active,
        };
        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{token:token},function (data_json) {
            setTimeout(function () {
               toastr.options.fadeOut = 10000;
               toastr.success('Data berhasil disimpan', 'Success!');
               loadTable();
               $('#NotificationModal').modal('hide');
            },500);
        });
  });


  $(document).on('click','#ModalbtnSaveForm', function () {
    loading_button('#ModalbtnSaveForm');
     var aksi = $("#ModalbtnSaveForm").attr('aksi');
     var id = $("#ModalbtnSaveForm").attr('kodeuniq');
     var JenisTempatTinggal = $("#JenisTempatTinggal").val();
     var url = base_url_js+'admission/master-config/submit_jenis_tempat_tinggal';
     var data = {
         Action : aksi,
         CDID : id,
         JenisTempatTinggal:JenisTempatTinggal,
     };

     if (validationInput = validation(data)) {
         var token = jwt_encode(data,"UAP)(*");
         $.post(url,{token:token},function (data_json) {
             setTimeout(function () {
                toastr.options.fadeOut = 10000;
                toastr.success('Data berhasil disimpan', 'Success!');
                $('#ModalbtnSaveForm').prop('disabled',false).html('Save');
                loadTable();
             },500);
         });
     }
     else
     {
        $('#ModalbtnSaveForm').prop('disabled',false).html('Save');
     }

  });

  function validation(arr)
  {
    var toatString = "";
    var result = "";
    for(var key in arr) {
       switch(key)
       {
        case  "Action" :
        case  "CDID" :
              break;
        case  "JenisTempatTinggal" :
              result = Validation_leastCharacter(3,arr[key],key);
              if (result['status'] == 0) {
                toatString += result['messages'] + "<br>";
              }
              break;
       }

    }
    if (toatString != "") {
      toastr.error(toatString, 'Failed!!');
      return false;
    }

    return true;
  }

  function modal_generate(action,title,ID='') {
      var url = base_url_js+"admission/master-config/modalform/register_jtinggal_m";
      var data = {
          Action : action,
          CDID : ID,
      };
      var token = jwt_encode(data,"UAP)(*");
      $.post(url,{ token:token }, function (html) {
          $('#GlobalModal .modal-header').html('<h4 class="modal-title">'+title+'</h4>');
          $('#GlobalModal .modal-body').html(html);
          $('#GlobalModal .modal-footer').html(' ');
          $('#GlobalModal').modal({
              'show' : true,
              'backdrop' : 'static'
          });
      })
  }

  function loadTable()
  {
    $("#pageData").empty();
    loading_page('#pageData');
    var url = base_url_js+'admission/master-config/loadTableMaster/register_jtinggal_m';
    $.post(url,function (data_json) {
        setTimeout(function () {
            $("#pageData").html(data_json);
        },500);
    });
  }  

</script>