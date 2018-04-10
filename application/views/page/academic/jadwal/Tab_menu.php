
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

            <button data-page="jadwal" type="button" class="btn btn-primary btn-action
                        control-jadwal"><i class="fa fa-calendar right-margin" aria-hidden="true"></i> Schedule</button>

            <button data-page="ruangan" type="button" class="btn btn-default btn-default-primary btn-action
                        control-jadwal"><i class="fa fa-window-restore right-margin" aria-hidden="true"></i> Room Schedule</button>
        </div>
        |
        <button data-page="penawaran_mk" type="button" class="btn btn-default btn-default-primary btn-action control-jadwal">
            <i class="fa fa-exchange right-margin" aria-hidden="true"></i> Course Offerings
        </button>
        <button data-page="inputjadwal" type="button" class="btn btn-default btn-default-primary btn-action control-jadwal">
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

        if(PageNow=='inputjadwal'){
            if(SemesterAntara==0){
                loadAcademicYearOnPublish('');
            } else {
                loadAcademicYearOnPublish('SemesterAntara');
            }
            resetFormSetSchedule();
        } else if(PageNow=='penawaran_mk'){
            resetPenawaranMK();
        } else if(PageNow=='jadwal'){
            loadPage('jadwal','');
        }


        
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

        if(page!='editjadwal'){
            $('.btn-action').removeClass('btn-primary');
            $('.btn-action').addClass('btn-default btn-default-primary');

            $('button[data-page='+page+']').removeClass('btn-default btn-default-primary');
            $('button[data-page='+page+']').addClass('btn-primary');
        }



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

<script>
    // Untuk Page Jadwal
    $(document).on('change','#filterSemester',function () {
        var Semester = $('#filterSemester').val();
        var SemesterID = (Semester!='' && Semester!= null) ? Semester.split('.')[0] : '';

        $('#selectSemesterSc').html('<select class="form-control" id="filterSemesterSchedule"></select>');
        // $('#filterSemesterSchedule').empty();
        $('#filterSemesterSchedule').append('<option value="" disabled selected>-- Semester --</option>' +
            '                <option disabled>------------</option>');
        loadSelectOPtionAllSemester('#filterSemesterSchedule','',SemesterID,SemesterAntara);
        console.log('ok');
        // filterSchedule();

    });

    $(document).on('change','#filterProgramCampus,#filterBaseProdi,#filterCombine,#filterSemesterSchedule',function () {
        filterSchedule();
    });

    $('input[type=checkbox][class=filterDay]').change(function () {
        var v = $(this).val();

        // console.log($('input[type=checkbox][class=filterDay]:checked').val());

        if(v==0){
            $('input[type=checkbox][class=filterDay]').prop('checked',false);
            $(this).prop('checked',true);
            checkedDay = [];
        } else {

            if($('input[type=checkbox][value='+v+']').is(':checked')){
                checkedDay.push($(this).val());
            } else {
                checkedDay = $.grep(checkedDay, function(value) {
                    return value != v;
                });
            }


            $('input[type=checkbox][value=0]').prop('checked',false);
            // $(this).prop('checked',true);
        }

        if(checkedDay.length==0){
            $('input[type=checkbox][value=0]').prop('checked',true);
            $('.widget-schedule').removeClass('hide');
        } else {
            $('.widget-schedule').addClass('hide');
            if(checkedDay.length>0){
                for(var i=0;i<checkedDay.length;i++){
                    $('#dayWidget'+checkedDay[i]).removeClass('hide');
                }
            }
        }



    });
</script>