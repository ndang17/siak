
<style>
    .tab-right {
        float: right !important;
    }
</style>


<div class="row" style="margin-top: 30px;">

    <div class="col-md-12">
        <div class="thumbnail">
            <div class="row">
                <div class="col-xs-2" style="">
                    <select class="form-control form-filter-jadwal" id="filterProgramCampus"></select>
                </div>
                <div class="col-xs-2" style="">
                    <select id="filterSemester" class="form-control form-filter-jadwal">
                    </select>
                </div>
                <div class="col-xs-3" style="">
                    <select id="filterBaseProdi" class="form-control form-filter-jadwal">
                        <option value="">--- All Program Study ---</option>
                        <option disabled>------------------------------------------</option>
                    </select>
                </div>

                <div class="col-xs-2" style="">
                    <select class="form-control form-filter-jadwal" id="filterCombine">
                        <option value="">--- Show All ---</option>
                        <option value="1">Combine Class Yes</option>
                        <option value="0">Combine Class No</option>
                    </select>
                </div>
                <div class="col-xs-3" style="text-align: right;padding-left: 0px;">
                    <div class="btn-group" role="group" aria-label="...">
                        <button data-page="inputjadwal" type="button" class="btn btn-success btn-action control-jadwal">
                            <i class="fa fa-plus-circle right-margin" aria-hidden="true"></i> Schedule
                        </button>
                        <button data-page="ruangan" type="button" class="btn btn-default btn-default-success btn-action
                        control-jadwal">Room Mode</button>
                    </div>

                </div>
<!--                <div class="col-xs-2">-->
<!--                    <button class="btn btn-"><i class="fa fa-eye right-margin" aria-hidden="true"></i> Liat </button>-->
<!--                </div>-->
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
        loadSelectOptionProgramCampus('#filterProgramCampus','');
        loadSelectOptionBaseProdi('#filterBaseProdi','');
        loSelectOptionSemester('#filterSemester','selectedNow');
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
            },1000);
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