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
                <h4 class="header"><i class="icon-reorder"></i>Set Email To</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                      <span data-smt="" class="btn btn-xs btn-add">
                        <i class="icon-plus"></i> Add Email To
                       </span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <!--  -->
                  <div id = "pageEmailTo"></div>
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
     modal_generate('add','Add Email To');
  });

  $(document).on('click','.btn-edit', function () {
    var ID = $(this).attr('data-smt');
     modal_generate('edit','Edit Email To',ID);
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
        var url = base_url_js+'admission/master-config/submit_email_to';
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
            },2000);
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
        var url = base_url_js+'admission/master-config/submit_email_to';
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
            },2000);
        });
  });


  $(document).on('click','#ModalbtnSaveForm', function () {
    loading_button('#ModalbtnSaveForm');
     var aksi = $("#ModalbtnSaveForm").attr('aksi');
     var id = $("#ModalbtnSaveForm").attr('kodeuniq');
     var fungsi = $("#Function").val()
     var EmailTo = $("#EmailTo").val();
     var url = base_url_js+'admission/master-config/submit_email_to';
     var data = {
         Action : aksi,
         CDID : id,
         EmailTo:EmailTo,
         fungsi:fungsi
     };

     if (validationInput = validation(data)) {
         var token = jwt_encode(data,"UAP)(*");
         $.post(url,{token:token},function (data_json) {
             setTimeout(function () {
                toastr.options.fadeOut = 10000;
                toastr.success('Data berhasil disimpan', 'Success!');
                $('#ModalbtnSaveForm').prop('disabled',false).html('Save');
                loadTable();
             },2000);
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
        case  "EmailTo" :
              result = Validation_email(arr[key],key);
              if (result['status'] == 0) {
                toatString += result['messages'] + "<br>";
              }
              break;
        case  "fungsi" :
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
      var url = base_url_js+"admission/master-config/modalform/email_to";
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
    $("#pageEmailTo").empty();
    loading_page('#pageEmailTo');
    var url = base_url_js+'admission/master-config/loadTableEmailTo';
    $.post(url,function (data_json) {
        setTimeout(function () {
            $("#pageEmailTo").html(data_json);
        },2000);
    });
  }  

</script>