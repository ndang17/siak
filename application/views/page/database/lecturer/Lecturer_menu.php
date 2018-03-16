
<div class="" style="margin-top: 30px;">

    <div class="col-md-12" style="margin-bottom: 15px;">
        <a href="<?php echo base_url('database/lecturers') ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back to list lecturers</a>
    </div>

    <div class="col-md-12">
        <div class="tabbable tabbable-custom tabbable-full-width">
            <ul class="nav nav-tabs">
                <li class="active"><a href="javascript:void(0)" class="menuDetails" data-page="lecturer_details" data-toggle="tab">Biodata</a></li>
                <li class=""><a href="javascript:void(0)" class="menuDetails" data-page="lecturer_academic" data-toggle="tab">Academic</a></li>
            </ul>
            <div class="tab-content">
                <!--=== Overview ===-->
                <div id="divPage"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        loadPage('lecturer_details');
    });

    $('.menuDetails').click(function () {
        var page = $(this).attr('data-page');
        loadPage(page);
    });

    function loadPage(page) {
        var url = base_url_js+'database/loadpagelecturersDetails';
        var NIP = '<?php echo $NIP; ?>';

        loading_page('#divpage');
        $.post(url,{NIP:NIP,page:page},function (html) {
            setTimeout(function () {
                $('#divPage').html(html);
            },500)
        });
    }


</script>

