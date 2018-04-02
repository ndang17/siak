
<style>
    .span-sesi {
        font-size: 1.3em;
        font-weight: bold;
    }
    .td-center {
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    .form-sesiawal[readonly] {
        background-color: #ffffff;
        color: #333333;
        cursor: text;
    }
</style>

<div class="row" style="margin-bottom: 30px;">
    <label class="col-md-8 col-md-offset-2">
<!--        <button data-page="jadwal" class="btn btn-warning btn-action"><i class="fa fa-arrow-left right-margin" aria-hidden="true"></i> Back Schedule</button>-->
<!--        <button  data-page="jadwal" class="btn btn-info btn-action">-->
<!--            <i class="fa fa-arrow-circle-left right-margin" aria-hidden="true"></i> Back</button>-->

        <table class="table" id="tableForm" style="margin-top: 10px;">
            <tr>
                <td style="width: 190px;">Tahun Akademik</td>
                <td style="width: 1px;">:</td>
                <td>
                    <div id="semesterName">-</div>
                    <input id="formSemesterID" class="hide" type="hidden" readonly/>
                </td>
            </tr>
            <tr>
                <td>
                    Program Kuliah
                </td>
                <td>:</td>
                <td>
                    <div id="viewProgramsCampus"></div>
                </td>
            </tr>

            <tr>
                <td>Kelas Gabungan ?</td>
                <td>:</td>
                <td>
                    <div id="viewCombinedClasses"></div>
                </td>
            </tr>
            <tr>
                <td>Course</td>
                <td>:</td>
                <td>
                    <div id="viewBaseProdi"></div>
                </td>
            </tr>
<!--            <tr>-->
<!--                <td style="width: 190px;">Mata Kuliah</td>-->
<!--                <td style="width: 1px;">:</td>-->
<!--                <td>-->
<!--                    <div id="viewMataKuliah"></div>-->
<!--                    <input type="hide" id="formMKID" class="hide" readonly />-->
<!--                    <input type="hide" id="formMKCode" class="hide" readonly />-->
<!--                    <input type="hide" id="formReplaceSD" class="hide" readonly />-->
<!---->
<!--                    <p style="margin-bottom: 0px;font-size: 10px;">-->
<!--                        Semester : <span id="textSemester">-</span> | Total Credit : <span id="textTotalSKS">-</span>-->
<!--                        <input type="hide" class="hide" id="textTotalSKSMK" />-->
<!--                    </p>-->
<!---->
<!--                </td>-->
<!--            </tr>-->

            <tr>
                <td>Group Kelas</td>
                <td>:</td>
                <td>
                    <span class="btn-default-primary" id="viewClassGroup" style="padding-left: 5px;padding-right: 5px;"> - </span>
                </td>
            </tr>
            <tr>
                <td>Dosen Koordinator</td>
                <td>:</td>
                <td>
                    <select class="select2-select-00 full-width-fix form-jadwal"
                            size="5" id="formCoordinator">
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Dosen Team Teaching ?</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" class="form-jadwal" fm="dtt-form" name="formteamTeaching" value="0" checked> Tidak
                            </label>
                            <label class="radio-inline">
                                <input type="radio" class="form-jadwal"  fm="dtt-form" name="formteamTeaching" value="1"> Ya
                            </label>
                        </div>
                        <div class="col-md-8">
                            <select class="select2-select-00 full-width-fix form-jadwal"
                                    size="5" multiple id="formTeamTeaching" disabled></select>
                        </div>
                    </div>
                </td>
            </tr>



            <tbody id="bodyAddSesi"></tbody>
        </table>

        <hr/>

        <div style="text-align: right;">
            <button class="btn btn-danger btn-act-editForm" style="float: left;" id="btnRemove">Remove</button>
            <button class="btn btn-default btn-default-success btn-act-editForm" id="addNewSesi">Add Sub Sesi</button>
            |
            <button class="btn btn-success btn-act-editForm" id="btnSavejadwal">Save</button>
<!--            <button class="btn btn-default" onclick="checkSchedule(1,2,'10:41:00','11:01:00')" id="cek">cek</button>-->
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        window.dataSesiArr = [];
        window.dataSesiDb = 1;
        window.dataSesi = 0;
        window.dataSesiNewArr = [];

        window.timeOption = {
            format : 'hh:ii',
            weekStart: 1,
            todayBtn:  0,
            autoclose: 1,
            todayHighlight: 0,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 1};
        window.ScheduleID = '<?php echo $ScheduleID; ?>';

        loadSelectOptionLecturersSingle('#formTeamTeaching','');
        $('#formTeamTeaching').select2({allowClear: true});
        getDataSchedule();

    });


    $('#btnSavejadwal').click(function () {


        var process = [];

        // schedule ---

        var Coordinator = $('#formCoordinator').val(); if(Coordinator==''){ process.push(0); requiredForm('#s2id_formCoordinator a'); }

        var TeamTeaching = $('input[name=formteamTeaching]:checked').val();
        var UpdateBy = sessionNIP;
        var UpdateAt = dateTimeNow();

        // schedule_team_teaching ---
        var teamTeachingArray = [];
        if(TeamTeaching==1){
            var formTeamTeaching = $('#formTeamTeaching').val();


            if(formTeamTeaching!=null){
                // console.log(formTeamTeaching);
                // console.log(formTeamTeaching.length);

                for(var t=0;t<formTeamTeaching.length;t++){
                    var dt = {
                        ScheduleID : ScheduleID,
                        NIP :  formTeamTeaching[t],
                        Status : '0'
                    };
                    teamTeachingArray.push(dt);
                }
            }
            else {
                process.push(0); requiredForm('#s2id_formTeamTeaching .select2-choices');
            }
        }


        // schedule_sesi ---
        var textTotalSKSMK = $('#textTotalSKSMK').val();
        var dataScheduleDetailsArray = [];
        var dataScheduleDetailsArrayNew = [];
        var totalCredit = 0;


        // Sub Sesi Dari DB
        if(dataSesiArr.length>0){
            for(var i=0;i<dataSesiArr.length;i++){
                var sdID = $('#sdID'+dataSesiArr[i]).val();
                var ClassroomID = $('#formClassroom'+dataSesiArr[i]).val();
                var DayID = $('#formDay'+dataSesiArr[i]).val();
                var Credit = $('#formCredit'+dataSesiArr[i]).val(); if(Credit=='' || Credit==0){process.push(0); requiredForm('#formCredit'+dataSesiArr[i]);}
                var TimePerCredit = $('#formTimePerCredit'+dataSesiArr[i]).val();
                var StartSessions = $('#formSesiAwal'+dataSesiArr[i]).val(); if(StartSessions==''){process.push(0); requiredForm('#formSesiAwal'+dataSesiArr[i]);}
                var EndSessions = $('#formSesiAkhir'+dataSesiArr[i]).val();if(EndSessions==''){process.push(0); requiredForm('#formSesiAkhir'+dataSesiArr[i]);}

                totalCredit = parseInt(totalCredit) + parseInt(Credit);
                var arrSesi = {
                    sdID : sdID,
                    update : {
                        ScheduleID : ScheduleID,
                        ClassroomID : ClassroomID,
                        Credit : Credit,
                        DayID : DayID,
                        TimePerCredit : TimePerCredit,
                        StartSessions : StartSessions,
                        EndSessions : EndSessions
                    }
                };

                dataScheduleDetailsArray.push(arrSesi);
            }
        }

        // Sub Sesi New
        if(dataSesiNewArr.length>0){
            for(var i=0;i<dataSesiNewArr.length;i++){
                var ClassroomID = $('#formClassroom'+dataSesiNewArr[i]).val();
                var DayID = $('#formDay'+dataSesiNewArr[i]).val();
                var Credit = $('#formCredit'+dataSesiNewArr[i]).val(); if(Credit=='' || Credit==0){process.push(0); requiredForm('#formCredit'+dataSesiNewArr[i]);}
                var TimePerCredit = $('#formTimePerCredit'+dataSesiNewArr[i]).val();
                var StartSessions = $('#formSesiAwal'+dataSesiNewArr[i]).val(); if(StartSessions==''){process.push(0); requiredForm('#formSesiAwal'+dataSesiNewArr[i]);}
                var EndSessions = $('#formSesiAkhir'+dataSesiNewArr[i]).val();if(EndSessions==''){process.push(0); requiredForm('#formSesiAkhir'+dataSesiNewArr[i]);}

                totalCredit = parseInt(totalCredit) + parseInt(Credit);
                var arrSesi = {
                    ScheduleID : ScheduleID,
                    ClassroomID : ClassroomID,
                    Credit : Credit,
                    DayID : DayID,
                    TimePerCredit : TimePerCredit,
                    StartSessions : StartSessions,
                    EndSessions : EndSessions
                };

                dataScheduleDetailsArrayNew.push(arrSesi);
            }
        }

        var SubSesi = ((parseInt(dataSesiArr.length) + parseInt(dataSesiNewArr.length))>1) ? '1' : '0';

        // console.log(dataSesiArr);
        // console.log(dataSesiNewArr);



        if($.inArray(0,process)==-1){

            // if(totalCredit<=textTotalSKSMK){


                var data = {
                    action : 'edit',
                    ID : ScheduleID,
                    formData :
                        {
                            schedule : {
                                Coordinator : Coordinator,
                                TeamTeaching : TeamTeaching,
                                SubSesi : SubSesi,
                                UpdateBy : UpdateBy,
                                UpdateAt : UpdateAt
                            },
                            schedule_team_teaching : {
                                teamTeachingArray : teamTeachingArray
                            },

                            schedule_details : {
                                dataScheduleDetailsArray : dataScheduleDetailsArray,
                                dataScheduleDetailsArrayNew : dataScheduleDetailsArrayNew
                            }

                        }
                };

                // console.log(data);
                // return false;

                $('#tableForm .form-sesiawal').prop('readonly',false);
                $('#formCoordinator,input[name=formteamTeaching],.form-jadwal,.btn-act-editForm,.btn-delete-sesi').prop('disabled',true);
                if(TeamTeaching==1 && formTeamTeaching!=null){
                    $('#formTeamTeaching').prop('disabled',true);
                }

                loading_button('#btnSavejadwal');


                // return false;

                var token = jwt_encode(data,'UAP)(*');
                var url = base_url_js+'api/__crudSchedule';
                $.post(url,{token:token},function (jsonResult) {

                    toastr.success('Data Saved','Success');

                    setTimeout(function () {
                        $('#tableForm .form-sesiawal').prop('readonly',true);
                        $('#formCoordinator,input[name=formteamTeaching],.form-jadwal,.btn-act-editForm,.btn-delete-sesi').prop('disabled',false);
                        $('#btnSavejadwal').html('Save');
                        if(TeamTeaching==1 && formTeamTeaching!=null){
                            $('#formTeamTeaching').prop('disabled',false);
                        }

                        window.location.href= base_url_js+'academic/jadwal';
                    },3000);

                });
            // } else {
            //     toastr.warning('Credit Input & Total Credit Not Match','Warning!');
            //     errorInput('.form-credit');
            //     errorInput('.form-credit');
            // }

        } else {
            toastr.error('Form Required','Error');
        }


    });


    $('#btnRemove').click(function () {
        // var ScheduleID = $(this).attr('data-id');
        $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Remove Schedule ?? </b> ' +
            '<button type="button" id="btnRemoveYes" class="btn btn-primary" style="margin-right: 5px;">Yes</button>' +
            '<button type="button" id="btnRemoveNo" class="btn btn-default" data-dismiss="modal">No</button>' +
            '</div>');
        $('#NotificationModal').modal({
            'show' : true,
            'backdrop' : 'static'
        });
    });


    $(document).on('click','#btnRemoveYes',function () {
        loading_buttonSm('#btnRemoveYes');
        $('#btnRemoveNo').prop('disabled',true);
        var data = {
            action : 'delete',
            ScheduleID : ScheduleID
        };
        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+'api/__crudSchedule';
        $.post(url,{token:token},function (result) {
            toastr.success('Data Removed','Sucess!');
            setTimeout(function () {
                window.location.href = base_url_js+'academic/jadwal';
            },1500);
        });
    });

    $(document).on('change','.form-sesiawal,.form-timepercredit,.form-credit',function () {
        var ID = $(this).attr('data-id');
        setSesiAkhir(ID);
        checkSchedule(ID);

    });

    $(document).on('keyup','.form-sesiawal,.form-credit',function () {
        var ID = $(this).attr('data-id');
        setSesiAkhir(ID);
        checkSchedule(ID);

    });

    // Onchange Cek kelas Bentrok
    $(document).on('change','.form-classroom,.form-day',function () {
        var ID = $(this).attr('data-id');
        checkSchedule(ID);
    });

    $(document).on('change','input[type=radio][fm=dtt-form]',function () {
        loadformTeamTeaching($(this).val(),'#formTeamTeaching');
    });
    
    function setSesiAkhir(ID) {
        var TimePerCredit = $('#formTimePerCredit'+ID).val();
        var SesiAwal = $('#formSesiAwal'+ID).val();
        var Credit = $('#formCredit'+ID).val();

        if(TimePerCredit!='' && SesiAwal!='' && Credit!='' && typeof SesiAwal != 'undefined'){
            var totalTime = parseInt(TimePerCredit) * parseInt(Credit);
            var expSesi = SesiAwal.split(':');
            var sesiAkhir = moment()
                .hours(expSesi[0])
                .minutes(expSesi[1])
                .add(parseInt(totalTime), 'minute').format('HH:mm');

            $('#formSesiAkhir'+ID).val(sesiAkhir);
        }
    }

    function loadformTeamTeaching(value,element_dosen) {
        if(value==1){
            $(element_dosen).prop('disabled',false);
        } else {
            $(element_dosen).select2("val", null);
            $(element_dosen).prop('disabled',true);
        }
    }

    function requiredForm(element) {
        $(element).css('border','1px solid red');
        setTimeout(function () {
            $(element).css('border','1px solid #cccccc');
        },5000);
        return false;
    }

    function checkSchedule(ID) {
        var SemesterID = $('#formSemesterID').val();
        var ProgramsCampusID = $('#formProgramsCampusID').val();

        var element = '#alertBentrok'+ID;
        var ClassroomID = $('#formClassroom'+ID).val();
        var DayID = $('#formDay'+ID).val();
        var StartSessions = $('#formSesiAwal'+ID).val();
        var EndSessions = $('#formSesiAkhir'+ID).val();

        if(ClassroomID!='' && DayID!='' && StartSessions!='' && EndSessions!='') {
            var data = {
                action : 'check',
                formData : {
                    SemesterID : SemesterID,
                    IsSemesterAntara : ''+SemesterAntara,
                    ClassroomID : ClassroomID,
                    DayID : DayID,
                    StartSessions : StartSessions,
                    EndSessions : EndSessions
                }
            };

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+'api/__checkSchedule';
            $.post(url,{token:token},function (json_result) {

                var MKID_ = $('#formMKID').val();
                var MKCode_ = $('#formMKCode').val();

                $('#btnSavejadwal,#addNewSesi').prop('disabled',false);
                $(element).html('');
                $('.trNewSesi'+ID).css('background','#ffffff');
                if(json_result.length>0){
                    $('#btnSavejadwal,#addNewSesi').prop('disabled',true);
                    $('.trNewSesi'+ID).css('background','#ffeb3b63');
                    $(element).append('<div class="row">' +
                        '                        <div class="col-xs-12" style="margin-top: 20px;">' +
                        '                            <div class="alert alert-danger" role="alert">' +
                        '                                <b><i class="fa fa-exclamation-triangle" aria-hidden="true" style="margin-right: 5px;"></i> Jadwal bentrok</b>, Silahklan rubah : Ruang / Hari / Jam' +
                        '                                <hr style="margin-bottom: 3px;margin-top: 10px;"/>' +
                        '                                <ol id="ulbentrok'+ID+'">' +
                        '                                </ol>' +
                        '                            </div>' +
                        '                        </div>' +
                        '' +
                        '                    </div>');

                    var ol = $('#ulbentrok'+ID);
                    for(var i=0;i<json_result.length;i++){
                        var data = json_result[i];
                        ol.append('<li>' +
                            'Group <strong style="color:#333;">'+data.ClassGroup+'</strong> : <span style="color: blue;">'+data.Room+' | '+daysEng[(parseInt(data.DayID)-1)]+' '+data.StartSessions+' - '+data.EndSessions+'</span>' +
                            '<ul style="color: #607d8b;" id="dtMK'+i+'"></ul>' +
                            '</li>');

                        var ul = $('#dtMK'+i);
                        for(var m=0;m<data.DetailsCourse.length;m++){
                            var mk_ = data.DetailsCourse[m];
                            ul.append('<li>'+mk_.MKCode+' | '+mk_.NameEng+'</li>');
                        }
                    }
                }
            });
        }

    }

    function getDataSchedule() {

        var url = base_url_js+'api/__crudSchedule';
        var data = {
            action : 'readOneSchedule',
            ScheduleID : ScheduleID
        };
        var token = jwt_encode(data,'UAP)(*');

        $.post(url,{token:token},function (JSONresult) {

            // console.log(JSONresult);

            $('#semesterName').html('<b style="color:green;">'+JSONresult.semesterName+'</b>');
            $('#viewProgramsCampus').html('<b style="color:green;">'+JSONresult.viewProgramsCampus+'</b>');
            var viewCombinedClasses = (JSONresult.CombinedClasses==1) ? 'Yes' : 'No';

            var dataProdi = JSONresult.Courses.length;
            var viewBaseProdi = $('#viewBaseProdi');
            for(var i=0;i<dataProdi;i++){

            }

            $('#viewCombinedClasses').html('<b style="color:green;">'+viewCombinedClasses+'</b>');

            // var viewBaseProdi = (JSONresult.CombinedClasses==1) ? '-' : JSONresult.ProgramStudy;
            // $('#viewBaseProdi').html('<b style="color:green;">'+viewBaseProdi+'</b>');

            // $('#viewMataKuliah').html('<b style="color:green;">'+JSONresult.viewMataKuliah+'</b><br/><i>'+JSONresult.viewMataKuliahEng+'</i>');
            //
            // $('#formMKID').val(JSONresult.MKID);
            // $('#formMKCode').val(JSONresult.MKCode);
            //
            // $('#textSemester').text(JSONresult.Semester);
            // $('#textTotalSKS').text(JSONresult.TotalSKS);


            $('#viewBaseProdi').html('<ul id="listCourse" style="list-style-type: none;padding-left:0px;"></ul>');
            for(var c=0;c<JSONresult.Courses.length;c++){
                var course = JSONresult.Courses[c];
                $('#listCourse').append('<li><strong><span style="color:#1785dc;">'+course.ProdiEng+'</span> | '+course.MKCode+' - '+course.NameEng+'</strong></li>');
            }

            $('#textTotalSKSMK').val(JSONresult.TotalSKS);

            $('#viewClassGroup').text(JSONresult.viewClassGroup);


            loadSelectOptionLecturersSingle('#formCoordinator',JSONresult.NIP);
            $('#formCoordinator').select2({allowClear: true});

            if(JSONresult.TeamTeaching==1) {
                $('#formTeamTeaching').empty();
                $('#formTeamTeaching').prop('disabled',false);
                $('input[name=formteamTeaching][value=1]').prop('checked',true);
                loadSelectOptionLecturersSingle('#formTeamTeaching',JSONresult.DetailTeamTeaching);
                $('#formTeamTeaching').select2({allowClear: true});
            } else {
                $('#formTeamTeaching').prop('disabled',true);
                $('input[name=formteamTeaching][value=0]').prop('checked',true);
            }

            $('#formSemesterID').val(JSONresult.SemesterID);

            loadSubSesi(JSONresult.SubSesiDetails);

            $('#btnRemove').attr('data-code',JSONresult.MKCode);

        });
    }

    function loadSubSesi(SubSesiDetails) {
        var hd = (SubSesiDetails.length==1) ? 'hide' : '';
        var btnRv = (SubSesiDetails.length==1) ? 'disabled' : '';
        var tb = $('#bodyAddSesi');

        dataSesi = SubSesiDetails.length;

        for(var i=0;i<SubSesiDetails.length;i++){


            var btn_conf = (i!=0) ? 'hide' : '';

            // dataSesiArr.push(parseInt(SubSesiDetails[i].sdID));
            dataSesiArr.push(parseInt(dataSesiDb));
            tb.append('<tr class="trNewSesi'+dataSesiDb+' '+hd+'"  id="headerSubSesi'+dataSesiDb+'">' +
                '                <td colspan="3" class="td-center " id="subsesi'+dataSesiDb+'">' +
                '                    <span class="btn btn-info span-sesi">--- Sub Sesi ---</span>' +
                '                    <button style="float:right;" '+btnRv+' class="btn btn-default btn-default-danger btn-delete-sesi" data-sesi="'+dataSesiDb+'" data-sd="'+SubSesiDetails[i].sdID+'">Remove This Sub Sesi</button>' +
                '                </td>' +
                '            </tr>' +
                '            <tr class="trNewSesi'+dataSesiDb+'">' +
                '                <td>Room | Day | Credit <input type="hide" class="hide" readonly id="sdID'+dataSesiDb+'" value="'+SubSesiDetails[i].sdID+'" /> </td>' +
                '                <td>:</td>' +
                '                <td>' +
                '                    <div class="row">' +
                '                        <div class="col-xs-5">' +
                '                            <select class="form-control form-jadwal form-classroom" data-id="'+dataSesiDb+'" id="formClassroom'+dataSesiDb+'">' +
                '                                <option value=""></option>' +
                '                            </select>' +
                '                            <a href="javascript:void(0)" id="addClassRoom"  class="'+btn_conf+'" style="font-size:10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Ruangan</a>' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <select class="form-control form-jadwal form-day" data-id="'+dataSesiDb+'" id="formDay'+dataSesiDb+'"></select>' +
                '                        </div>' +
                '                        <div class="col-xs-3">' +
                '                            <input class="form-control form-jadwal form-credit" placeholder="Credit" dataSesiDb="'+dataSesiDb+'" data-id="'+dataSesiDb+'" id="formCredit'+dataSesiDb+'" type="number"/>' +
                '                        </div>' +
                '                    </div>' +
                '                </td>' +
                '            </tr>' +
                '            <tr class="trNewSesi'+dataSesiDb+'">' +
                '                <td>Time</td>' +
                '                <td>:</td>' +
                '                <td>' +
                '                    <div class="row">' +
                '' +
                '                        <div class="col-xs-4">' +
                '                            <select class="form-control form-jadwal form-timepercredit" data-id="'+dataSesiDb+'" id="formTimePerCredit'+dataSesiDb+'"></select>' +
                '                            <a href="javascript:void(0)" id="addTimePerCredit" class="'+btn_conf+'" style="font-size:10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah <i>Time Per Credit</i></a>' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <input type="text" readonly class="form-control form-jadwal formSesiAwal form-sesiawal" data-id="'+dataSesiDb+'" id="formSesiAwal'+dataSesiDb+'" />' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <input type="text" class="form-control form-jadwal" id="formSesiAkhir'+dataSesiDb+'" style="color: #333;" readonly />' +
                '                        </div>' +
                '                    </div>' +
                '                    <div id="alertBentrok'+dataSesiDb+'"></div>' +
                '                </td>' +
                '            </tr>');

            loadSelectOptionClassroom('#formClassroom'+dataSesiDb,SubSesiDetails[i].ClassroomID);
            fillDays('#formDay'+dataSesiDb,'Eng',SubSesiDetails[i].DayID);
            $('#formCredit'+dataSesiDb).val(SubSesiDetails[i].Credit);

            loadSelectOptionTimePerCredit('#formTimePerCredit'+dataSesiDb,SubSesiDetails[i].TimePerCredit);

            var exSt = SubSesiDetails[i].StartSessions.split(':');
            var exEnd = SubSesiDetails[i].EndSessions.split(':');
            $("#formSesiAwal"+dataSesiDb).datetimepicker(timeOption);
            $('#formSesiAwal'+dataSesiDb).val(exSt[0]+':'+exSt[1]);
            $('#formSesiAkhir'+dataSesiDb).val(exEnd[0]+':'+exEnd[1]);


            dataSesiDb += 1;

        }
    }


    $('#addNewSesi').click(function () {

        var newSesi = true;

        if(dataSesiArr.length==1){
            $('#headerSubSesi'+dataSesiArr[0]).removeClass('hide');
        }

        // var Classroom = $('#formClassroom'+dataSesi).val(); if(Classroom==''){ newSesi = requiredForm('#s2id_formClassroom'+dataSesi+' a'); }
        // var Credit = $('#formCredit'+dataSesi).val(); if(Credit==''){newSesi = requiredForm('#formCredit'+dataSesi);}
        // var TimePerCredit = $('#formTimePerCredit'+dataSesi).val(); if(TimePerCredit==''){newSesi = requiredForm('#formTimePerCredit'+dataSesi);}
        // var StartSessions = $('#formSesiAwal'+dataSesi).val(); if(StartSessions==''){newSesi = requiredForm('#formSesiAwal'+dataSesi);}
        // var EndSessions = $('#formSesiAkhir'+dataSesi).val(); if(EndSessions==''){newSesi = requiredForm('#formSesiAkhir'+dataSesi);}

        if(newSesi){
            dataSesi = dataSesi + 1;

            dataSesiNewArr.push(dataSesi);

            // console.log(dataSesi);

            $('#subsesi1').removeClass('hide');
            $('#bodyAddSesi').append('<tr class="trNewSesi'+dataSesi+'">' +
                '                <td colspan="3" class="td-center">' +
                '                    <span class="btn btn-warning span-sesi">--- Sub Sesi ---</span>' +
                '                    <button style="float:right;" class="btn btn-default btn-default-danger btn-delete-sesi" data-sesi="'+dataSesi+'" data-sd="">Remove This Sub Sesi</button>' +
                '                </td>' +
                '            </tr>' +
                '            <tr class="trNewSesi'+dataSesi+'">' +
                '                <td>Ruang | Hari | Credit</td>' +
                '                <td>:</td>' +
                '                <td>' +
                '                    <div class="row">' +
                '                        <div class="col-xs-5">' +
                '                            <select class="form-control form-jadwal form-classroom" data-id="'+dataSesi+'" id="formClassroom'+dataSesi+'">' +
                '                                <option value=""></option>' +
                '                            </select>' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <select class="form-control form-jadwal form-day" data-id="'+dataSesi+'" id="formDay'+dataSesi+'"></select>' +
                '                        </div>' +
                '                        <div class="col-xs-3">' +
                '                            <input class="form-control form-jadwal form-credit" data-id="'+dataSesi+'" placeholder="Credit" id="formCredit'+dataSesi+'" type="number"/>' +
                '                        </div>' +
                '                    </div>' +
                '                </td>' +
                '            </tr>' +
                '            <tr class="trNewSesi'+dataSesi+'">' +
                '                <td>Time</td>' +
                '                <td>:</td>' +
                '                <td>' +
                '                    <div class="row">' +
                '                        <div class="col-xs-4">' +
                '                            <select class="form-control form-jadwal form-timepercredit" data-id="'+dataSesi+'" id="formTimePerCredit'+dataSesi+'">' +
                '                            </select>' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <input type="text" readonly class="form-control form-jadwal formSesiAwal form-sesiawal" id="formSesiAwal'+dataSesi+'" data-id="'+dataSesi+'" />' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <input type="text" class="form-control form-jadwal" id="formSesiAkhir'+dataSesi+'" style="color: #333;" readonly />' +
                '                        </div>' +
                '                    </div>' +
                '<div id="alertBentrok'+dataSesi+'"></div>' +
                '                </td>' +
                '            </tr>');

            loadSelectOptionClassroom('#formClassroom'+dataSesi,'');
            fillDays('#formDay'+dataSesi,'Eng','');
            loadSelectOptionTimePerCredit('#formTimePerCredit'+dataSesi,'');
            $("#formSesiAwal"+dataSesi).datetimepicker(timeOption);


        } else {
            toastr.warning('Form Sub Sesi '+dataSesi+' Harus Diisi','Warning!');
        }

    });

    $(document).on('click','.btn-delete-sesi',function () {
        var Sesi = $(this).attr('data-sesi');
        var sdID = $(this).attr('data-sd');

        if(sdID==''){

            $('.trNewSesi'+Sesi).remove();

            dataSesiNewArr = $.grep(dataSesiNewArr, function(value) {
                return value != Sesi;
            });

            // if(dataSesi<=0){
            //     dataSesi = dataSesiDb;
            // } else {
            //     dataSesi = dataSesi - 1;
            // }
            if(dataSesiArr.length==1 && dataSesiNewArr.length==0){
                $('#headerSubSesi'+dataSesiArr[0]).addClass('hide');
            }
        } else {
            $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Remove <span style="color:red;">Sub Sesi '+Sesi+'</span> ?? </b> ' +
                '<button type="button" id="btnRemoveSubSesiYes" data-sd="'+sdID+'" data-sesi="'+Sesi+'" class="btn btn-primary" style="margin-right: 5px;">Yes</button>' +
                '<button type="button" id="btnRemoveSubSesiNo" class="btn btn-default" data-dismiss="modal">No</button>' +
                '</div>');
            $('#NotificationModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        }


    });

    $(document).on('click','#btnRemoveSubSesiYes',function () {
        var Sesi = $(this).attr('data-sesi');
        var sdID = $(this).attr('data-sd');

        loading_buttonSm('#btnRemoveSubSesiYes');
        $('#btnRemoveSubSesiNo').prop('disabled',true);
        var url = base_url_js+'api/__crudSchedule';
        var token = jwt_encode({action:'deleteSubSesi',sdID:sdID},'UAP)(*');
        $.post(url,{token:token},function (result) {

            dataSesiArr = $.grep(dataSesiArr, function(value) {
                return value != Sesi;
            });
            $('.trNewSesi'+Sesi).remove();


            dataSesiDb = dataSesiDb - 1;

            if(dataSesiArr.length==1){
                $('#headerSubSesi'+dataSesiArr[0]).addClass('hide');
            }

            $('#NotificationModal').modal('hide');

        });
    });

    $(document).on('change','#replaceSchedule',function () {

        if ($(this).is(':checked')){
            var sdID = $(this).val();
            $('#formReplaceSD').val(sdID);
            $('#btnSavejadwal,#addNewSesi').prop('disabled',false);
        } else {
            $('#formReplaceSD').val('');
            $('#btnSavejadwal,#addNewSesi').prop('disabled',true);
        }

    });
</script>


<!-- CRUD Room -->
<script>
    $(document).on('click','#addClassRoom',function () {
        $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">Classroom</h4>');
        $('#GlobalModal .modal-body').html('<div class="row">' +
            '                            <div class="col-xs-4">' +
            '                                <label>Room</label>' +
            '                                <input type="text" class="form-control" id="formRoom">' +
            '                            </div>' +
            '                            <div class="col-xs-4">' +
            '                                <label>Seat</label>' +
            '                                <input type="number" class="form-control" id="formSeat">' +
            '                            </div>' +
            '                            <div class="col-xs-4">' +
            '                                <label>Seat For Exam</label>' +
            '                                <input type="number" class="form-control" id="formSeatForExam">' +
            '                            </div>' +
            '                        </div>');
        $('#GlobalModal .modal-footer').html('<button type="button" id="btnCloseClassroom" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-success" id="btnSaveClassroom">Save</button>');
        $('#GlobalModal').modal({
            'show' : true,
            'backdrop' : 'static'
        });
    });
    $(document).on('click','#btnSaveClassroom',function () {


        var process = true;

        var Room = $('#formRoom').val(); process = (Room=='') ? errorInput('#formRoom') : true ;
        var Seat = $('#formSeat').val(); var processSeat = (Seat!='' && $.isNumeric(Seat) && Math.floor(Seat)==Seat) ? true : errorInput('#formSeat') ;
        var SeatForExam = $('#formSeatForExam').val(); var processSeatForExam = (SeatForExam!='' && $.isNumeric(SeatForExam) && Math.floor(SeatForExam)==SeatForExam) ? true : errorInput('#formSeatForExam') ;


        if(Room!='' && processSeat && processSeatForExam){
            $('#formRoom,#formSeat,#formSeatForExam,#btnCloseClassroom').prop('disabled',true);
            loading_button('#btnSaveClassroom');
            loading_page('#viewClassroom');

            var data = {
                action : 'add',
                ID : '',
                formData : {
                    Room : Room,
                    Seat : Seat,
                    SeatForExam : SeatForExam,
                    Status : 0,
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()
                }
            };

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+"api/__crudClassroom";

            $.post(url,{token:token},function (data_result) {

                for(var i=1;i<=parseInt(dataSesi);i++){
                    var selected = $('#formClassroom'+i).val();
                    loadSelectOptionClassroom('#formClassroom'+i,selected);
                }

                setTimeout(function () {

                    if(data_result.inserID!=0) {
                        toastr.success('Data tersimpan','Success!');
                        $('#GlobalModal').modal('hide');

                    } else {
                        $('#formRoom,#formSeat,#formSeatForExam,#btnCloseClassroom').prop('disabled',false);
                        $('#btnSaveClassroom').prop('disabled',false).html('Save');
                        toastr.warning('Room is exist','Warning');
                    }
                },1000);

            });
        } else {
            toastr.error('Form Required','Error!');
        }
    });
</script>

<!-- CRUD Time Per Credit-->
<script>

    $(document).on('click','#addTimePerCredit',function () {

        var url = base_url_js + 'api/__crudTimePerCredit';
        var token = jwt_encode({action: 'read'}, 'UAP)(*');
        $.post(url, {token: token}, function (data_json) {
            if (data_json.length > 0) {
                $('#NotificationModal .modal-body').html('' +
                    '<div class="form-group">' +
                    '<div class="row">' +
                    '<div class="col-md-8">' +
                    '<div class="input-group">' +
                    '      <input type="number" class="form-control" id="formTime">' +
                    '      <span class="input-group-btn">' +
                    '        <button class="btn btn-success" id="btnAddTimePerCredit" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>' +
                    '      </span>' +
                    '    </div>' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<button class="btn btn-default" style="float: right;" data-dismiss="modal">Close</button>' +
                    '</div></div> </div> ' +
                    '<table class="table table-bordered">' +
                    '    <thead>' +
                    '    <tr>' +
                    '        <th class="th-center">Time</th>' +
                    '        <th class="th-center" style="width: 110px;">Action</th>' +
                    '    </tr>' +
                    '    </thead>' +
                    '    <tbody id="rowTime"></tbody>' +
                    '</table>');
                for (var i = 0; i < data_json.length; i++) {
                    $('#rowTime').append('<tr id="tr' + data_json[i].ID + '">' +
                        '<td class="td-center">' + data_json[i].Time + ' Minute</td>' +
                        '<td class="td-center">' +
                        '<button class="btn btn-default btn-default-danger btn-delete-timepercredit" data-id="' + data_json[i].ID + '">Delete</button>' +
                        '</td>' +
                        '</tr>');
                }
                ;


                $('#NotificationModal').modal({
                    'show': true
                });
            }
        })
    });

    $(document).on('click','#btnAddTimePerCredit',function () {
        var Time = $('#formTime').val();

        if(Time!=''){
            $('#formTime').prop('disabled',true);
            loading_buttonSm('#btnAddTimePerCredit');
            var url = base_url_js+'api/__crudTimePerCredit';
            var data = {
              action : 'add',
              formData : {
                  Time : Time,
                  UpdateBy : sessionNIP,
                  UpdateAt : dateTimeNow()
              }
            };
            var token = jwt_encode(data,'UAP)(*');
            $.post(url,{token:token},function (json_result) {
                $('#formTime,#btnAddTimePerCredit').prop('disabled',false);
                $('#btnAddTimePerCredit').html('<i class="fa fa-plus-circle" aria-hidden="true"></i> Add');

                setTimeout(function () {
                    if(json_result.inserID==0){
                        toastr.warning('Data Exist','Warning!');
                    } else {

                        for(var d=1;d<=parseInt(dataSesi);d++){
                            var selected = $('#formTimePerCredit'+d).val();
                            loadSelectOptionTimePerCredit('#formTimePerCredit'+d,selected);
                        }


                        $('#formTime').val('');
                        $('#rowTime').append('<tr id="tr'+json_result.inserID+'">' +
                            '<td class="td-center">'+Time+' Minute</td>' +
                            '<td class="td-center">' +
                            '<button class="btn btn-default btn-default-danger" data-id="'+json_result.inserID+'">Delete</button>' +
                            '</td>' +
                            '</tr>');
                        toastr.success('Data Saved','Success!');
                    }
                },1000);
            });

        } else {
            $('#formTime').css('border','1px solid red');
            setTimeout(function () {
                $('#formTime').css('border','1px solid #ccc');
            },5000);
        }
    });
    $(document).on('click','.btn-delete-timepercredit',function () {
        var ID = $(this).attr('data-id');
        var token = jwt_encode({action:'delete',ID:ID},'UAP)(*');
        var url = base_url_js+'api/__crudTimePerCredit';

        $.post(url,{token:token},function (json_result) {
            if(json_result.inserID==0){
                toastr.warning('Data tidak dapat di hapus','Warning!');
            } else {
                for(var d=1;d<=parseInt(dataSesi);d++){
                    var selected = $('#formTimePerCredit'+d).val();
                    loadSelectOptionTimePerCredit('#formTimePerCredit'+d,selected);
                }
                $('#tr'+ID).remove();
                toastr.success('Data deleted','Success!');
            }
        });

    });
</script>