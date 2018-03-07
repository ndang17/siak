
<table class="table table-bordered table-striped" id="tableGroupKelas">
    <thead>
    <tr>
        <th class="th-center" style="width: 150px;">Name</th>
        <th class="th-center">Base Prodi</th>
<!--        <th class="th-center" style="width: 10%;">Status</th>-->
        <th class="th-center" style="width: 130px;">Action</th>
    </tr>
    </thead>
    <tbody id="dataRow">
    <?php foreach ($dataClassGroup as $item) { ?>
    <tr id="modaltr<?php echo $item['ID']; ?>">
        <td>
            <span id="name<?php echo $item['ID']; ?>">
            <?php echo $item['Name']; ?>
            </span>
            <input class="form-control hide" value="<?php echo $item['Name']; ?>" id="formName<?php echo $item['ID']; ?>" />
        </td>
        <td>
            <span id="prodi<?php echo $item['ID']; ?>">
            <?php echo $item['ProdiName']; ?>
            </span>
            <select class="form-control hide" id="formProdi<?php echo $item['ID']; ?>"></select>
        </td>
<!--        <td>--><?php //echo $item['Status']; ?><!--</td>-->
        <td class="td-center">
            <button id="modalDel<?php echo $item['ID']; ?>" data-id="<?php echo $item['ID']; ?>"
                    class="btn btn-default btn-default-danger btn-delete" <?php echo $btnAction; ?> >
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </button>
            <button id="modalEdit<?php echo $item['ID']; ?>" data-id="<?php echo $item['ID']; ?>" data-idProdi="<?php echo $item['BaseProdiID']; ?>"
                    class="btn btn-default btn-default-success btn-edit" <?php echo $btnAction; ?>>
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>
            <button class="btn btn-danger btn-cancle-class-group hide" data-id="<?php echo $item['ID']; ?>" id="modalCencleEdit<?php echo $item['ID']; ?>"><i class="fa fa-times"></i></button>
            <button class="btn btn-success btn-save-class-group hide" data-id="<?php echo $item['ID']; ?>" id="modalSaveEdit<?php echo $item['ID']; ?>"><i class="fa fa-check"></i></button>
        </td>
    </tr>
    <?php } ?>
    </tbody>

</table>

<hr/>

<div style="text-align: right;">
    <button data-dismiss="modal" class="btn btn-default">Close</button>
    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#addItem">
        <i class="fa fa-plus-circle right-margin" aria-hidden="true"></i> Add</button>
</div>

<div class="collapse" id="addItem" style="margin-top: 10px;">
    <div class="well">
        <div class="form-group">
            <label>Base Prodi</label>
            <select class="form-control" id="modalBaseProdi"></select>
        </div>
        <div class="form-group">
            <label>Group Name</label>
            <input type="text" class="form-control" id="modalGroupName" />
        </div>
        <div style="text-align: right;">
            <button class="btn btn-success" id="modalBtnSave">Save</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#modalBaseProdi').empty();
        $('#modalBaseProdi > option').remove();
        loadSelectOptionBaseProdi('#modalBaseProdi','');
        window.table = $('#tableGroupKelas').dataTable({
            ordering :false
        });
        window.url = base_url_js+'academic/kurikulum/getClassGroup';
    });

    $('#modalBtnSave').click(function () {
        var BaseProdiID = $('#modalBaseProdi').find(':selected').val().split('.')[0];
        var Name = $('#modalGroupName').val();

        if(Name==''){
            $('#modalGroupName').css('border','1px solid red');
            setTimeout(function () {
                $('#modalGroupName').css('border','1px solid #ccc');
            },2000);
            toastr.error('Semua form harus diisi','Error!!');
            return false;
        } else {

            loading_button('#modalBtnSave');
            $('#addItem .form-control').prop('disabled',true);

            var data = {
                action : 'add',
                dataForm : {
                    BaseProdiID : BaseProdiID,
                    Name : Name,
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()
                }

            };

            var token = jwt_encode(data,'UAP)(*');

            $.post(url,{token:token},function (insert_id) {
                var ID = insert_id;

                var btnAction = '<?php echo $btnAction; ?>';

                setTimeout(function () {
                    toastr.success('Data tersimpan','Success!!');
                    $('#modalBtnSave').prop('disabled',false).html('Save');
                    $('#addItem .form-control').prop('disabled',false);

                    $('#modalGroupName').val('');

                    table.fnAddData([
                        '<span id="name'+ID+'">'+Name+'</span>' +
                         '<input class="form-control hide" value="'+Name+'" id="formName'+ID+'" />',

                        '<span id="prodi'+ID+'">'+$('#modalBaseProdi').find(':selected').text()+'</span>' +
                         '<select class="form-control hide" id="formProdi'+ID+'"></select>',


                        '<td class="td-center" style="text-align: center;"><center>' +
                         '<button id="modalDel'+ID+'" data-id="'+ID+'" style="margin-right: 3px;" class="btn btn-default btn-default-danger btn-delete" '+btnAction+'>' +
                          '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                         '</button>' +
                         '<button id="modalEdit'+ID+'" data-id="'+ID+'" data-idProdi="'+BaseProdiID+'" class="btn btn-default btn-default-success btn-edit" '+btnAction+'>' +
                          '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>' +
                         '</button>' +

                          '<button class="btn btn-danger btn-cancle-class-group hide"  style="margin-right: 5px;" data-id="'+ID+'" id="modalCencleEdit'+ID+'"><i class="fa fa-times"></i></button>' +
                          '<button class="btn btn-success btn-save-class-group hide" data-id="'+ID+'" id="modalSaveEdit'+ID+'"><i class="fa fa-check"></i></button>' +
                        '</center></td>'
                    ]);

                    // $('#dataRow').prepend('<tr>' +
                    //     '<td>'+Name+'</td>' +
                    //     '<td>'++'</td>' +
                    //     '<td class="td-center"></td>' +
                    //     '</tr>');
                    // $('#modalGroupName').val('');

                    // $('#GlobalModal').modal('hide');
                },2000);
            });
        }

    });

    $(document).on('click','.btn-edit',function () {
        var ID = $(this).attr('data-id');
        var BaseProdiID = $(this).attr('data-idProdi');

        $('#modalDel'+ID+',#modalEdit'+ID+',#name'+ID+',#prodi'+ID).addClass('hide');

        $('#modalSaveEdit'+ID+',#modalCencleEdit'+ID+',#formName'+ID+',#formProdi'+ID).removeClass('hide');

        $('#formProdi'+ID).empty();
        $('#formProdi'+ID+' > option').remove();
        loadSelectOptionBaseProdi('#formProdi'+ID,BaseProdiID);
    });

    // $('.btn-delete').click(function () {
    //     if(window.confirm('Hapus Data?')){
    //         var ID = $(this).attr('data-id');
    //         var token = jwt_encode({action:'delete',ID:ID},'UAP)(*');
    //         // table.fnRemoveData('#modaltr'+ID).remove().draw( false );
    //
    //         loading_buttonSm('#modalDel'+ID);
    //         $('#modalEdit'+ID).prop('disabled',true);
    //         $.post(url,{token:token},function (result) {
    //             setTimeout(function () {
    //                 $('#modaltr'+ID).hide();
    //             },2000);
    //
    //             // table.row().remove().draw( false );
    //         });
    //     }
    // });

    $(document).on('click','.btn-delete',function () {
        if(window.confirm('Hapus Data?')){
            var ID = $(this).attr('data-id');
            var token = jwt_encode({action:'delete',ID:ID},'UAP)(*');

            loading_buttonSm('#modalDel'+ID);
            $('#modalEdit'+ID).prop('disabled',true);
            $.post(url,{token:token},function (result) {
                setTimeout(function () {
                    $('#modaltr'+ID).hide();
                },2000);

                // table.row().remove().draw( false );
            });
        }

    });

    $(document).on('click','.btn-cancle-class-group',function () {
        var ID = $(this).attr('data-id');
        $('#modalDel'+ID+',#modalEdit'+ID+',#name'+ID+',#prodi'+ID).removeClass('hide');
        $('#modalSaveEdit'+ID+',#modalCencleEdit'+ID+',#formName'+ID+',#formProdi'+ID).addClass('hide');

    });

    $(document).on('click','.btn-save-class-group',function () {
        var ID = $(this).attr('data-id');

        var Name = $('#formName'+ID).val();
        var BaseProdiID = $('#formProdi'+ID).find(':selected').val().split('.')[0];

        if(Name==''){
            $('#formName'+ID).css('border','1px solid red');
            setTimeout(function () {
                $('#formName'+ID).css('border','1px solid #ccc');
            },2000);
            toastr.error('Semua form harus diisi','Error!!');
            return false;
        } else {
            var data = {
                action : 'edit',
                ID : ID,
                dataForm : {
                    BaseProdiID : BaseProdiID,
                    Name : Name,
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()
                }
            };

            var token = jwt_encode(data,'UAP)(*');

            loading_buttonSm('#modalSaveEdit'+ID);
            $('#formName'+ID+',#formProdi'+ID+',#modalCencleEdit'+ID).prop('disabled',true);
            $.post(url,{token:token},function () {

                setTimeout(function () {
                    $('#modalEdit'+ID).attr('data-idProdi',BaseProdiID);
                    toastr.success('Data tersimpan','Success!!');
                    $('#name'+ID).html(Name);
                    $('#prodi'+ID).html($('#formProdi'+ID).find(':selected').text());

                    $('#modalSaveEdit'+ID).prop('disabled',false).html('<i class="fa fa-check"></i>');
                    $('#formName'+ID+',#formProdi'+ID+',#modalCencleEdit'+ID).prop('disabled',false);

                    $('#modalDel'+ID+',#modalEdit'+ID+',#name'+ID+',#prodi'+ID).removeClass('hide');
                    $('#modalSaveEdit'+ID+',#modalCencleEdit'+ID+',#formName'+ID+',#formProdi'+ID).addClass('hide');
                },2000);

            });
        }


    });


</script>
