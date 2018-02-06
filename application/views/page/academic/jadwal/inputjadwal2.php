
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <button  data-page="jadwal" class="btn btn-info btn-action"><i class="fa fa-arrow-circle-left right-margin" aria-hidden="true"></i> Back</button>

        <table class="table table-striped" style="margin-top: 10px;">
            <tr>
                <td style="width: 190px;">Tahun Akademik</td>
                <td style="width: 1px;">:</td>
                <td>
                    <strong id="semesterName">-</strong>
                    <input id="formSemesterID" class="hide" type="hidden" readonly/>
                </td>
            </tr>
            <tr>
                <td>Kelas Gabungan ?</td>
                <td>:</td>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="formCombinedClassess" class="form-jadwal" value="0" checked> Tidak
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="formCombinedClassess" class="form-jadwal" value="1"> Ya
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    Program Kuliah
                </td>
                <td>:</td>
                <td>
                    <select class="form-control form-jadwal" id="formProgramsCampusID"></select>
                </td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>
<!--                    <select class="form-control" id="BaseProdi"></select>-->
                    <select id="formBaseProdi" class="select2-select-00 col-md-12 full-width-fix form-jadwal" size="5">
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mata Kuliah</td>
                <td>:</td>
                <td>
                    <select class="select2-select-00 full-width-fix form-jadwal"
                            size="5" id="formMataKuliah">
                        <option value=""></option>
                    </select>
                    <p style="margin-bottom: 0px;">
                        Semester : <span id="textSemester"></span> | <span id="textTotalSKS"></span> SKS | <span id="textTimeSKS"></span>
                    </p>

                </td>
            </tr>
            <tr>
                <td>Group Kelas</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-xs-6">
                            <select class="select2-select-00 full-width-fix form-jadwal"
                                    size="5" id="formClassGroup">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <button class="btn btn-default btn-block form-jadwal" id="btnRefreshDataGroupClass">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-default btn-default-success btn-block form-jadwal" id="btnAddGroupClass">Add Group</button>
                        </div>
                    </div>


                </td>
            </tr>
            <tr>
                <td>Dosen Team Teaching ?</td>
                <td>:</td>
                <td>
                    <label class="radio-inline">
                        <input type="radio" class="form-jadwal" name="formteamTeaching" value="0" checked> Tidak
                    </label>
                    <label class="radio-inline">
                        <input type="radio" class="form-jadwal" name="formteamTeaching" value="1"> Ya
                    </label>
                </td>
            </tr>
            <tr>
                <td>Dosen Koordinator</td>
                <td>:</td>
                <td>
                    <select class="select2-select-00 full-width-fix form-jadwal"
                            size="5" id="formDosenKoordinator">
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Team Dosen</td>
                <td>:</td>
                <td>
                    <select class="select2-select-00 full-width-fix form-jadwal"
                            size="5" multiple id="formTeamDosen" disabled></select>
                </td>
            </tr>
            <tr>
                <td>Ruangan</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-xs-6">
                            <select class="select2-select-00 full-width-fix form-jadwal"
                                    size="5" id="formClassroom">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <button class="btn btn-default btn-block form-jadwal" id="btnRefreshDataClassroom">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-default btn-default-success btn-block form-jadwal" id="btnAddClassroom">Add Ruangan</button>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-xs-4">
                            <select class="form-control form-jadwal" id="formDay"></select>
                        </div>
                        <div class="col-xs-4">
                            <input type="time" class="form-control form-jadwal" id="formSesiAwal" />
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" id="formSesiAkhir" style="color: #333;" readonly />
                        </div>
                    </div>
                </td>
            </tr>

<!--            <tr>-->
<!--                <td>Sesi Awal</td>-->
<!--                <td>:</td>-->
<!--                <td>-->
<!--                    <select class="form-control"></select>-->
<!--                </td>-->
<!--            </tr>-->

            <tr>
                <td colspan="3" style="text-align: center;">
                    <button class="btn btn-danger">Cancle</button>
                    <button class="btn btn-success" id="btnSaveSchedule" >Save</button>
                </td>
            </tr>
        </table>
<!--        <div style="text-align: center;">-->
<!--            <button class="btn btn-danger">Cancle</button>-->
<!--            <button class="btn btn-success">Save</button>-->
<!--        </div>-->
    </div>

</div>

<script>
    $(document).ready(function () {
        // $('.control-jadwal').prop("disabled",true);

        loadAcademicYearOnPublish();

        loadProdiSelectOption('#formBaseProdi');
        loadSelectOptionConf('#formProgramsCampusID','programs_campus','');
        loadSelectOptionAllMataKuliahSingle('#formMataKuliah','');
        loadSelectOptionLecturersSingle('#formDosenKoordinator','');
        loadSelectOptionLecturersSingle('#formTeamDosen','');

        loadSelectOptionClassGroup('#formClassGroup','');
        loadSelectOptionClassroom('#formClassroom','');

        fillDays('#formDay','Eng','');


        $('#formMataKuliah,#formDosenKoordinator,' +
            '#formClassGroup,#formTeamDosen,#formClassroom').select2({allowClear: true});


        $('input[type=radio][name=formCombinedClassess]').change(function () {
            loadformCombinedClassess($(this).val());
        });

        $('input[type=radio][name=formteamTeaching]').change(function () {
            loadformTeamTeaching($(this).val());
        });

        $('#formBaseProdi').select2({
            allowClear: true
        });
    });

    $('#btnSaveSchedule').click(function () {

        var process = true;


        var SemesterID = $('#formSemesterID').val();
        var CombinedClasses = $('input[name=formCombinedClassess]:checked').val();
        var ProgramsCampusID = $('#formProgramsCampusID').val();

        var formBaseProdi = $('#formBaseProdi').val();
        if(CombinedClasses==1){
            if(formBaseProdi=='' || formBaseProdi==null) { formRequired('#s2id_formBaseProdi ul.select2-choices'); process = false;}
        } else {
            if(formBaseProdi=='' || formBaseProdi==null) { formRequired('#s2id_formBaseProdi a'); process = false;}
        }



        var formMataKuliah = $('#formMataKuliah').val();
        if(formMataKuliah!=''){
            var MKID = formMataKuliah.split('.')[0].trim();
            var MKCode = formMataKuliah.split('.')[1].trim();
        } else {
            formRequired('#s2id_formMataKuliah a'); process = false;
        }

        var ClassGroupID = $('#formClassGroup').val();
        if(ClassGroupID=='' || ClassGroupID==null) { formRequired('#s2id_formClassGroup a'); process = false;}

        var TeamTeaching = $('input[name=formteamTeaching]:checked').val();

        var NIP = $('#formDosenKoordinator').val();
        if(NIP=='' || NIP==null) { formRequired('#s2id_formDosenKoordinator a'); process = false;}

        var ClassroomID = $('#formClassroom').val();
        if(ClassroomID=='' || ClassroomID==null) { formRequired('#s2id_formClassroom a'); process = false;}

        var DayID = $('#formDay').val();

        var StartSessions = $('#formSesiAwal').val();
        if(StartSessions=='' || StartSessions==null) { formRequired('#formSesiAwal'); process = false;}

        var EndSessions = $('#formSesiAkhir').val();


        var formTeamDosen = $('#formTeamDosen').val();
        if(TeamTeaching==1){
            if(formTeamDosen=='' || formTeamDosen==null) { formRequired('#s2id_formTeamDosen ul.select2-choices'); process = false;}
        }


        // $('.form-jadwal').prop('disabled',true);
        // loading_button('#btnSaveSchedule');
        //
        // setTimeout(function () {
        //     $('.form-jadwal,#btnSaveSchedule').prop('disabled',false);
        //     $('#btnSaveSchedule').html('Save');
        // },3000);

        return false;
        var data = {
            action : 'add',
            formData : {
                SemesterID : SemesterID,
                ProgramsCampusID : ProgramsCampusID,
                CombinedClasses : CombinedClasses,
                MKID : MKID,
                MKCode : MKCode,
                ClassGroupID : ClassGroupID,
                TeamTeaching : TeamTeaching,
                NIP : NIP,
                ClassroomID : ClassroomID,
                DayID : DayID,
                StartSessions : StartSessions,
                EndSessions : EndSessions,
                UpdateBy : sessionNIP,
                UpdateAt : dateTimeNow()
            },
            formBaseProdi : {
                formBaseProdi : formBaseProdi
            },
            formTeamTeaching : {
                formTeamDosen : formTeamDosen
            }
        };
        var url = base_url_js+'api/__crudSchedule';
        var token = jwt_encode(data,'UAP)(*');
        $.post(url,{token:token},function (result) {
            alert('ok');
        });



    });

    function formRequired(element) {
        $(''+element).css('border','1px solid red');
        setTimeout(function () {
            $(element).css('border','1px solid #ccc');
        },3000);
    }
    $('#formMataKuliah').change(function () {
        var dataMK = $('#formMataKuliah').find(':selected').val();

        if(dataMK!=''){
            getSesiMK(dataMK);
        }

    });

    $('#formSesiAwal').keyup(function () {
        var dataMK = $('#formMataKuliah').find(':selected').val();
        var time = $('#formSesiAwal').val();

        if(dataMK!='' && time!=''){
            getSesiMK(dataMK);
        }
    });
    
    function getSesiMK(dataMK) {
        var mk = dataMK.split('.');
        var data = {
            action : 'read',
            ID : mk[0],
            MKCode : mk[1]
        };

        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+"api/__crudMataKuliah";

        var sesi = $('#formSesiAwal').val();

        // log(timePerCredits);

        $.post(url,{token:token},function (data_json) {

            // log(data_json);

            $('#textSemester').html(data_json.Semester);
            $('#textTotalSKS').html(data_json.TotalSKS);

            var totalTime = parseInt(timePerCredits) * parseInt(data_json.TotalSKS);

            var h = parseInt(totalTime) / 60 | 0,
                m = parseInt(totalTime) % 60 |0;
            $('#textTimeSKS').html(totalTime+" menit ( "+h+" jam "+m+" menit )");

            if(sesi!=''){
                var expSesi = sesi.split(':');
                var sesiAwal = moment()
                    .hours(expSesi[0])
                    .minutes(expSesi[1])
                    .format('LT');

                var sesiAkhir = moment()
                    .hours(expSesi[0])
                    .minutes(expSesi[1])
                    .add(totalTime, 'minute').format('LT');

                $('#formSesiAkhir').val(sesiAkhir);

                // console.log(sesiAwal);
                // console.log(sesiAkhir);

                // console.log(moment().add(totalTime, 'minute').format('LT'));
            }


        });
    }

    $('#btnAddGroupClass').click(function () {
        modal_dataClassGroup('disabledBtnAction','Group Class');
    });

    $('#btnAddClassroom').click(function () {
        modal_dataClassroom('disabledBtnActio','Group Class');
    });

    $('#btnRefreshDataGroupClass').click(function () {

        loading_buttonSm('#btnRefreshDataGroupClass');
        $('#formClassGroup').prop('disabled',true);

        setTimeout(function () {
            $('#btnRefreshDataGroupClass').html('<i class="fa fa-refresh"></i>');
            $('#formClassGroup,#btnRefreshDataGroupClass').prop('disabled',false);

            $('#formClassGroup').select2("destroy").empty();
            $('#formClassGroup').append('<option value=""></option>');
            loadSelectOptionClassGroup('#formClassGroup','');
            $("#formClassGroup").select2();
        },2000);



    });

    $('#btnRefreshDataClassroom').click(function () {
        loading_buttonSm('#btnRefreshDataClassroom');
        $('#formClassroom').prop('disabled',true);

        setTimeout(function () {
            $('#btnRefreshDataClassroom').html('<i class="fa fa-refresh"></i>');
            $('#formClassroom,#btnRefreshDataClassroom').prop('disabled',false);

            $('#formClassroom').select2("destroy").empty();
            $('#formClassroom').append('<option value=""></option>');
            loadSelectOptionClassroom('#formClassroom','');
            $("#formClassroom").select2();
        },2000);
    });

    function loadProdiSelectOption(element){
        var url= base_url_js+'api/__getBaseProdiSelectOption';
        var option = $(''+element);
        option.append('<option></option>');
        $.get(url,function (data_json) {
            for(var i=0;i<data_json.length;i++){
                option.append('<option value="'+data_json[i].ID+'">'+data_json[i].Code+' | '+data_json[i].NameEng+'</option>');
            }
        });
    }

    function loadformCombinedClassess(value) {
        if(value==1){
            // $('.single-select').remove();
            $('#formBaseProdi').prop('multiple',true);
        } else {
            // $('#formBaseProdi').prepend('<option class="single-select"></option>');
            $('#formBaseProdi').prop('multiple',false);
        }

        $('#formBaseProdi').select2({
            allowClear: true
        });
    }

    function loadformTeamTeaching(value) {
        if(value==1){
            $('#formTeamDosen').prop('disabled',false);
        } else {
            $('#formTeamDosen').select2("val", null);
            $('#formTeamDosen').prop('disabled',true);
        }
    }

    function loadAcademicYearOnPublish() {
        var url = base_url_js+"api/__getAcademicYearOnPublish";
        loading_text('#semesterName');
        $.get(url,function (data_json) {
            $('#formSemesterID').val(data_json.ID);
            setTimeout(function () {
                $('#semesterName').html(data_json.YearCode+' | '+data_json.Name);
            },2000);

        });
    }

</script>