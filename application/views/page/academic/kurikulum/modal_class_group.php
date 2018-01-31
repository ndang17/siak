

<table class="table table-bordered">
    <thead>
    <tr>
        <th class="th-center">Name</th>
        <th class="th-center" style="width: 10%;">Status</th>
        <th class="th-center" style="width: 20%;">Action</th>
    </tr>
    </thead>
    
</table>

<?php print_r($dataClassGroup); ?>

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
        loadSelectOptionBaseProdi('#modalBaseProdi','');
    });

    $('#modalBtnSave').click(function () {
        var BaseProdiID = $('#modalBaseProdi').find(':selected').val();
        var Name = $('#modalGroupName').val();

        if(Name==''){
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
            var url = base_url_js+'academic/kurikulum/getClassGroup';
            $.post(url,{token:token},function () {
                setTimeout(function () {
                    toastr.success('Data tersimpan','Success!!');
                    $('#modalBtnSave').prop('disabled',false).html('Save');
                    $('#addItem .form-control').prop('disabled',false);
                    // $('#GlobalModal').modal('hide');
                },2000);
            });
        }

    });


</script>
