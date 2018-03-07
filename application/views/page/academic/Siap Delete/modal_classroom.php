
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th class="th-center">Room</th>
        <th class="th-center" style="width: 90px;">Quantities</th>
        <th class="th-center" style="width: 130px;">Action</th>
    </tr>
    </thead>
    <tbody id="datarow">
    <?php foreach ($dataClassroom as $item){ ?>
        <tr id="tr<?php echo $item['ID']; ?>">
            <td>
                <span id="spanRoom<?php echo $item['ID']; ?>"><?php echo $item['Room']; ?></span>
                <input type="text" id="formRoom<?php echo $item['ID']; ?>" value="<?php echo $item['Room']; ?>" class="form-control hide" />
            </td>
            <td>
                <span id="spanQty<?php echo $item['ID']; ?>"><?php echo $item['Quantities']; ?></span>
                <input type="number" id="formQty<?php echo $item['ID']; ?>" value="<?php echo $item['Quantities']; ?>" class="form-control hide" />
            </td>
            <td class="td-center">
                <button id="modalDel<?php echo $item['ID']; ?>" data-id="<?php echo $item['ID']; ?>" class="btn btn-default btn-default-danger btn-delete" <?php echo $btnAction; ?> >
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
                <button id="modalEdit<?php echo $item['ID']; ?>" data-id="<?php echo $item['ID']; ?>" class="btn btn-default btn-default-success btn-edit" <?php echo $btnAction; ?> >
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
                <button class="btn btn-danger btn-cencle-edit hide" data-id="<?php echo $item['ID']; ?>" id="modalCencleEdit<?php echo $item['ID']; ?>"  <?php echo $btnAction; ?> ><i class="fa fa-times"></i></button>
                <button class="btn btn-success btn-save-edit hide" data-room="<?php echo $item['Room']; ?>" data-id="<?php echo $item['ID']; ?>" id="modalSaveEdit<?php echo $item['ID']; ?>"  <?php echo $btnAction; ?> ><i class="fa fa-check"></i></button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div style="text-align: right;">
    <button data-dismiss="modal" class="btn btn-default">Close</button>
    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#addItem">
        <i class="fa fa-plus-circle right-margin" aria-hidden="true"></i> Add</button>
</div>

<div class="collapse" id="addItem" style="margin-top: 10px;">
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <input type="text" class="form-control" id="addRoom" placeholder="Room..."/>
            </div>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="addQty" placeholder="Quantities..."/>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-success btn-block" id="modalBtnSave">Save</button>
            </div>
        </div>

    </div>
</div>

<script>

    $(document).ready(function () {
        window.url = base_url_js+'academic/kurikulum/getClassroom';
    });

    $('#modalBtnSave').click(function () {
        var Room = $('#addRoom').val();
        var Quantities = $('#addQty').val();

        if(Room==''){
            toastr.error('Form Tidak Boleh Kosong','Error!!');
            $('#addRoom').css('border','1px solid red');
            setTimeout(function () {
                $('#addRoom').css('border','1px solid #ccc');
            },2000);
            return false;

        } else if (Quantities==''){
            toastr.error('Form Tidak Boleh Kosong','Error!!');
            $('#addQty').css('border','1px solid red');
            setTimeout(function () {
                $('#addQty').css('border','1px solid #ccc');
            },2000);
            return false;

        }else if(Room!='' && Quantities!=''){

            loading_buttonSm('#modalBtnSave');
            $('#addRoom , #addQty').prop('disabled',true);

            var data = {
              action : 'add',
              dataForm : {
                  Room : Room,
                  Quantities : Quantities,
                  UpdateBy : sessionNIP,
                  UpdateAt : dateTimeNow()
              }
            };
            var token = jwt_encode(data,'UAP)(*');
            $.post(url,{token:token},function (insert_id) {
                var ID = insert_id;
                setTimeout(function () {
                    $('#modalBtnSave').prop('disabled',false).html('Save');
                    $('#addRoom , #addQty').prop('disabled',false);
                    if(ID==0){
                        toastr.warning('Ruangan Sudah Di Input','Warning!');
                    } else {
                        toastr.success('Data Tersimpan','Success!');

                        var btnAction = ' <?php echo $btnAction; ?>';
                        $('#addRoom , #addQty').val('');
                        $('#datarow').append('<tr>' +
                            '<td><span id="spanRoom'+ID+'">'+Room+'</span>' +
                            '<input type="text" id="formRoom'+ID+'" value="'+Room+'" class="form-control hide" /></td>' +
                            '<td><span id="spanQty'+ID+'">'+Quantities+'</span>' +
                            '<input type="number" id="formQty'+ID+'" value="'+Quantities+'" class="form-control hide" /></td>' +
                            '<td class="td-center">' +
                            '<button id="modalDel'+ID+'" data-id="'+ID+'" style="margin-right:3px;" class="btn btn-default btn-default-danger btn-delete" '+btnAction+'>' +
                            '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                            '</button>' +
                            '<button id="modalEdit'+ID+'" data-id="'+ID+'" class="btn btn-default btn-default-success btn-edit" '+btnAction+'>' +
                            '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>' +
                            '</button>' +

                            '<button class="btn btn-danger btn-cencle-edit hide" data-id="'+ID+'" style="margin-right:3px;" id="modalCencleEdit'+ID+'" '+btnAction+'><i class="fa fa-times"></i></button>' +
                            '<button class="btn btn-success btn-save-edit hide" data-room="'+Room+'" data-id="'+ID+'" id="modalSaveEdit'+ID+'" '+btnAction+'><i class="fa fa-check"></i></button></td>' +
                            '</tr>');
                    }

                },2000);
            });
        }

    });

    $(document).on('click','.btn-delete',function () {
        var ID = $(this).attr('data-id');
        if(window.confirm()){

            loading_buttonSm('#modalDel'+ID);
            $('#modalEdit'+ID).prop('disabled',true);

            var token = jwt_encode({action:'delete',ID:ID},'UAP)(*');
            $.post(url,{token:token},function () {
                setTimeout(function () {
                    toastr.success('Data Terhapus','Success!!');
                    $('#tr'+ID).hide();
                },2000);
            });
        }
    });

    $(document).on('click','.btn-edit',function () {
       var ID = $(this).attr('data-id');

       $('#formRoom'+ID+',#formQty'+ID+',#modalCencleEdit'+ID+',#modalSaveEdit'+ID).removeClass('hide');
       $('#spanRoom'+ID+',#spanQty'+ID+',#modalDel'+ID+',#modalEdit'+ID).addClass('hide');

    });

    $(document).on('click','.btn-cencle-edit',function () {
        var ID = $(this).attr('data-id');
        $('#formRoom'+ID+',#formQty'+ID+',#modalCencleEdit'+ID+',#modalSaveEdit'+ID).addClass('hide');
        $('#spanRoom'+ID+',#spanQty'+ID+',#modalDel'+ID+',#modalEdit'+ID).removeClass('hide');
    });

    $(document).on('click','.btn-save-edit',function () {
        var ID = $(this).attr('data-id');
        var RoomBefore = $(this).attr('data-room');
        var Room = $('#formRoom'+ID).val();
        var Quantities = $('#formQty'+ID).val();

        if(Room==''){
            toastr.error('Form Tidak Boleh Kosong','Error!!');
            $('#formRoom'+ID).css('border','1px solid red');
            setTimeout(function () {
                $('#formRoom'+ID).css('border','1px solid #ccc');
            },2000);
            return false;
        } else if(Quantities==''){
            toastr.error('Form Tidak Boleh Kosong','Error!!');
            $('#formQty'+ID).css('border','1px solid red');
            setTimeout(function () {
                $('#formQty'+ID).css('border','1px solid #ccc');
            },2000);
            return false;
        } else if(Room!='' && Quantities!=''){

            loading_buttonSm('#modalSaveEdit'+ID);
            $('#formRoom'+ID+',#formQty'+ID+',#modalCencleEdit'+ID).prop('disabled',true);

            var data = {
                action : 'edit',
                ID : ID,
                RoomBefore : RoomBefore,
                dataForm : {
                    Room : Room,
                    Quantities : Quantities,
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()
                }
            };

            var token = jwt_encode(data,'UAP)(*');
            $.post(url,{token:token},function (result) {

                setTimeout(function () {
                    $('#modalSaveEdit'+ID).prop('disabled',false).html('<i class="fa fa-check"></i>');
                    $('#formRoom'+ID+',#formQty'+ID+',#modalCencleEdit'+ID).prop('disabled',false);
                    if(result==0){
                        toastr.warning('Ruangan Sudah Di Input','Warning!');
                        $('#formRoom'+ID).val(RoomBefore);

                    } else {
                        toastr.success('Data Tersimpan','Success!!');
                        $('#modalSaveEdit'+ID).attr('data-room',Room);
                        $('#spanRoom'+ID).html(Room);
                        $('#spanQty'+ID).html(Quantities);
                    }


                },2000);
            });

        }
    });

</script>

