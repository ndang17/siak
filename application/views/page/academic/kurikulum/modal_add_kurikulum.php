

<div style="text-align: center;">
    <h3>Create <span style="color: green;font-weight: bold;">Kurikulum <?php echo $kurikulum['Year']; ?></span></h3>
    <hr/>
    <button class="btn btn-success" id="btnYes">Yes</button>
    |
    <button class="btn btn-danger" id="btnCancle" type="button" data-dismiss="modal">Cencle</button>

</div>

<script>
    $(document).on('click','#btnYes',function () {

        loading_button('#btnYes');
        $('#btnCancle').prop('disabled',true);
        var url = base_url_js+'api/__insertKurikulum';
        var token = "<?php echo $token; ?>";
        $.post(url,{token : token},function (data) {
            var data_ = parseInt(data);
            if(data_==0){
                setTimeout(function () {
                    toastr.error('Data Sudah Ada', 'Failed!!');
                    $('#GlobalModal').modal('hide');
                },2000);
            } else {
                setTimeout(function () {
                    toastr.success('Data tersimpan', 'Success!');
                    $('#GlobalModal').modal('hide');
                },2000);
            }
        });

    });
</script>