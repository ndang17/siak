
<style>
    .tab-right {
        float: right !important;
    }
</style>


<div class="row" style="margin-top: 30px;">

    <div class="col-md-6 col-md-offset-3">
        <div class="thumbnail">
            <div class="row">
                <div class="col-xs-4" style="">
                    <select class="form-control control-jadwal"></select>
                </div>
                <div class="col-xs-8" style="text-align: right;">
                    <button data-page="inputjadwal" class="btn btn-success btn-action control-jadwal"><i class="fa fa-plus-circle right-margin" aria-hidden="true"></i> Add Jadwal</button>
                    <button data-page="ruangan" class="btn btn-primary btn-action control-jadwal"><i class="fa fa-eye right-margin" aria-hidden="true"></i> Liat Ruangan</button>
                    <button class="btn btn-default control-jadwal"><i class="fa fa-download right-margin" aria-hidden="true"></i> PDF</button>
                    <button class="btn btn-default control-jadwal"><i class="fa fa-download right-margin" aria-hidden="true"></i> CSV</button>
                </div>
            </div>


        </div>


    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr/>
        <div id="dataPage"></div>
    </div>
</div>


<script>
    $(document).ready(function () {
        loadPage('jadwal');
    });
    $(document).on('click','.btn-action',function () {
        var page = $(this).attr('data-page');
        loadPage(page);
    });

    function loadPage(page) {
        loading_page('#dataPage');
        var data = {
            page : page
        }

        var token = jwt_encode(data,"UAP)(*");
        var url = base_url_js+'academic/__setPageJadwal';
        $.post(url,{token:token},function (page) {
            setTimeout(function () {
                $('#dataPage').html(page);
            },2000);
        });
    }
</script>

<!--<div class="tabbable tabbable-custom tabbable-full-width">-->
<!--    <ul class="nav nav-tabs">-->
<!--        <li class="--><?php //if($this->uri->segment(2)=='jadwal' && $this->uri->segment(3)==''){echo 'active';} ?><!--">-->
<!--            <a href="--><?php //echo base_url('academic/jadwal'); ?><!--">Jadwal</a>-->
<!--        </li>-->
<!--        <li class="--><?php //if($this->uri->segment(2)=='jadwal1' && $this->uri->segment(3)==''){echo 'active';} ?><!--">-->
<!--            <a href="--><?php //echo base_url('academic/jadwal'); ?><!--">Ruang</a>-->
<!--        </li>-->
<!---->
<!--        <li class="tab-right --><?php //if($this->uri->segment(3)=='group-kelas'){echo 'active';} ?><!--">-->
<!--            <a href="--><?php //echo base_url('academic/jadwal/group-kelas'); ?><!--"><i class="fa fa-wrench right-margin" aria-hidden="true"></i>  Group Kelas</a>-->
<!--        </li>-->
<!--        <li class="tab-right --><?php //if($this->uri->segment(3)=='ruang'){echo 'active';} ?><!--">-->
<!--            <a href="--><?php //echo base_url('academic/jadwal/ruang'); ?><!--"><i class="fa fa-wrench right-margin" aria-hidden="true"></i>  Ruang</a>-->
<!--        </li>-->
<!--        <li class="tab-right --><?php //if($this->uri->segment(3)=='input-jadwal'){echo 'active';} ?><!--">-->
<!--            <a href="--><!--"><i class="fa fa-wrench right-margin" aria-hidden="true"></i> Jadwal</a>-->
<!--        </li>-->
<!---->
<!--    </ul>-->
<!--    <div style="border:none; border-top:1px solid #ddd;padding-top: 30px;">-->
<!--        --><?php //echo $contenttabs; ?>
<!--    </div>-->
<!--</div>-->