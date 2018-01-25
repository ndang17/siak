
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="th-center">Name</th>
            <th class="th-center" style="width: 25%;">Action</th>
        </tr>
    </thead>
    <tbody id="datatbodyItem">
    <?php
        if(count($conf)<1){
            echo '<tr id="dataEmpty"><td colspan="2" class="td-center">--- Data Empty ---</td></tr>';
        }
    ?>
    <?php foreach ($conf as $item){ ?>
        <tr id="tr<?php echo $item['ID']; ?>">
            <td>
                <span id="nameItem<?php echo $item['ID']; ?>"><?php echo $item['Name']; ?></span>
                <input class="form-control hide" value="<?php echo $item['Name']; ?>" id="editForm<?php echo $item['ID']; ?>">
            </td>
            <td class="td-center">
                <button class="btn btn-default btn-default-danger btn-action-conf" id="btnRemove<?php echo $item['ID']; ?>" data-action="delete" data-id="<?php echo $item['ID']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                <button class="btn btn-default btn-default-success btn-action-conf" id="btnEdit<?php echo $item['ID']; ?>" data-action="edit" data-id="<?php echo $item['ID']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <button class="btn btn-success btn-action-conf hide" id="btnConfSave<?php echo $item['ID']; ?>" data-action="saveEdit" data-id="<?php echo $item['ID']; ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div style="text-align: right;">
    <button data-dismiss="modal" class="btn btn-default">Close</button>
    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#addItem"><i class="fa fa-plus-circle right-margin" aria-hidden="true"></i> Add</button>
</div>

<div class="collapse" id="addItem" style="margin-top: 10px;">
    <div class="well">
        <div class="row">
            <div class="col-sm-8">
                <input class="form-control" id="FormAddItem">
            </div>
            <div class="col-sm-4" style="text-align: right;">
                <button class="btn btn-success btn-block" id="ModalbtnAdd">Save</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).on('click','.btn-action-conf',function () {
        var action = $(this).attr('data-action');
        var ID = $(this).attr('data-id');

        if(action=='delete'){
            if(window.confirm('Hapus data ?')){
                crudItem(action,'',ID);
            }

        } else if(action=='edit') {
            $('#btnRemove'+ID).prop('disabled',true);
            $('#editForm'+ID).removeClass('hide');
            $('#btnConfSave'+ID).removeClass('hide');
            $(this).addClass('hide');
            $('#nameItem'+ID).addClass('hide');
        } else if(action=='saveEdit'){
            var name = $('#editForm'+ID).val();
            var name_before = $('#nameItem'+ID).text();
            log('New : '+name);
            log('Law : '+name_before);
            if(name==''){
                toastr.warning('Form Required','Warning!!!');
            } else if(name==name_before) {
                toastr.info('Tidak Ada Perubahan','Info');

                $('#btnEdit'+ID).removeClass('hide');
                $('#nameItem'+ID).removeClass('hide');

                $('#editForm'+ID).addClass('hide');
                $('#btnConfSave'+ID).addClass('hide');
                $('#btnRemove'+ID).prop('disabled',false);
            } else {
                loading_buttonSm('#btnConfSave'+ID);
                crudItem('edit',name,ID);
            }

        }

    });

    $('#ModalbtnAdd').click(function () {

        var Name = $('#FormAddItem').val();

        if(Name==''){
            toastr.warning('Form Required','Warning!!');
            $('#FormAddItem').css('border','1px solid red');
        } else {
            $('#FormAddItem').css('border','1px solid green');
            loading_button('#ModalbtnAdd');
            $('#FormAddItem').prop('disabled',true);
            crudItem('add',Name,'');
        }
    });

    function crudItem(action,Name,ID) {

        var data = {
            action : action,
            ID : ID,
            table : '<?php echo $table; ?>',
            data_insert : {
                Name : Name,
                UpdateBy : sessionNIP,
                UpdateAt : dateTimeNow()
            }
        };

        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+"api/__crudKurikulum";

        $.post(url,{token : token},function (result) {

            if(action=='add'){
                setTimeout(function () {
                    $('#dataEmpty').animateCss('slideOutLeft',function () {
                        $('#dataEmpty').remove();
                    });
                    $('#datatbodyItem').append('<tr id="tr'+result+'" class="animated ">' +
                        '<td>' +
                        '<span id="nameItem'+result+'">'+Name+'</span>' +
                        '<input class="form-control hide" value="'+Name+'" id="editForm'+result+'">' +
                        '</td>' +
                        '<td class="td-center">' +
                        '<button class="btn btn-default btn-default-danger btn-action-conf" id="btnRemove'+result+'" style="margin-right:3px;" data-action="delete" data-id="'+result+'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>' +
                        '<button class="btn btn-default btn-default-success btn-action-conf" id="btnEdit'+result+'" data-action="edit" data-id="'+result+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>' +
                        '<button class="btn btn-success btn-action-conf hide" id="btnConfSave'+result+'" data-action="saveEdit" data-id="'+result+'"><i class="fa fa-check" aria-hidden="true"></i></button>' +
                        '</td>' +
                        '</tr>');
                    $('#ModalbtnAdd').html('Save');
                    toastr.success('Data tersimpan','Success');
                    $('#ModalbtnAdd, #FormAddItem').prop('disabled',false);
                    $('#FormAddItem').val('');

                    $('#tr'+result).animateCss('slideInDown');
                },3000);
            }
            else if(action=='edit'){
                setTimeout(function () {
                    toastr.success('Data tersimpan','Success');

                    $('#btnEdit'+ID).removeClass('hide');
                    $('#nameItem'+ID).removeClass('hide');
                    $('#nameItem'+ID).html(''+Name);

                    $('#editForm'+ID).addClass('hide');
                    $('#btnConfSave'+ID).prop('disabled',false);
                    $('#btnConfSave'+ID).html('<i class="fa fa-check" aria-hidden="true"></i>');
                    $('#btnConfSave'+ID).addClass('hide');
                    $('#btnRemove'+ID).prop('disabled',false);


                },2000);
            }
            else if(action=='delete'){
                $('#tr'+ID).animateCss('slideOutUp',function () {
                    $('#tr'+ID).remove();
                });
            }


        });

    }
</script>

