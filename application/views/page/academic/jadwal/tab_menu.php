
<style>
    .tab-right {
        float: right !important;
    }

    .toggle-group .btn-default {
        z-index: 1000 !important;
    }
    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
    .toggle.ios .toggle-handle { border-radius: 20px; }
</style>


<div class="row" style="margin-top: 30px;">

    <div class="col-md-4">
        <div class="">
            <label>Semester Antara</label>
            <input type="checkbox" id="formSemesterAntara" data-toggle="toggle" data-style="ios"/>
        </div>
    </div>
    <div class="col-md-8" style="text-align: right;">
        <div class="btn-group" role="group" aria-label="...">

            <button data-page="jadwal" type="button" class="btn btn-default btn-default-primary btn-action
                        control-jadwal"><i class="fa fa-calendar right-margin" aria-hidden="true"></i> Schedule</button>

            <button data-page="ruangan" type="button" class="btn btn-default btn-default-primary btn-action
                        control-jadwal"><i class="fa fa-window-restore right-margin" aria-hidden="true"></i> Room Schedule</button>
        </div>
        |
        <button data-page="penawaran_mk" type="button" class="btn btn-info btn-action control-jadwal">
            <i class="fa fa-exchange right-margin" aria-hidden="true"></i> Course Offerings
        </button>
        <button data-page="inputjadwal" type="button" class="btn btn-success btn-action control-jadwal">
            <i class="fa fa-pencil right-margin" aria-hidden="true"></i> Set Schedule
        </button>
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
        loadPage('jadwal','');
        $('input[type=checkbox][data-toggle=toggle]').bootstrapToggle();

        checkSemesterAntara();
        window.SemesterAntara = 0;
        window.PageNow = 'jadwal';
        window.PageScdNow = '';
    });

    $('#formSemesterAntara').change(function () {

        if($('#formSemesterAntara').is(':checked')){
            SemesterAntara = 1;
        } else {
            SemesterAntara = 0;
        }

        resetPenawaranMK();
        
        // Reset Penawaran MK
    });
    
    function resetPenawaranMK() {
        $('#formSemester').val('');
        $('#box1View,#box1Storage,#box2View,#box2Storage').empty();
        $('#OfferingDiv').addClass('hide');
        $('#btnAnother').html('');
        $('#dataOfferings').empty();
    }

    $(document).on('click','.btn-action',function () {
        var page = $(this).attr('data-page');
        var ScheduleID = (page=='editjadwal') ? $(this).attr('data-id') : '';
        PageNow = page;
        PageScdNow = ScheduleID;
        loadPage(page,ScheduleID);
    });

    function checkSemesterAntara() {
        var url = base_url_js+'api/__crudTahunAkademik';
        var token = jwt_encode({action:'checkSemesterAntara'},'UAP)(*');
        $.post(url,{token:token},function (jsonResult) {
            if(jsonResult.length>0){
                $('#formSemesterAntara').prop('disabled',false);
            } else {
                $('#formSemesterAntara').prop('disabled',true);
            }
        });
    }

    function loadPage(page,ScheduleID) {
        loading_page('#dataPage');
        var data = {
            page : page,
            ScheduleID : ScheduleID
        };

        var token = jwt_encode(data,"UAP)(*");
        var url = base_url_js+'academic/__setPageJadwal';
        $.post(url,{token:token},function (page) {
            setTimeout(function () {
                $('#dataPage').html(page);
            },500);
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