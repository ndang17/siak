
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
<!--        <button  data-page="jadwal" class="btn btn-info btn-action">-->
<!--            <i class="fa fa-arrow-circle-left right-margin" aria-hidden="true"></i> Back</button>-->

        <table class="table" id="tableForm" style="margin-top: 10px;">
            <tr>
                <td style="width: 190px;">Tahun Akademik</td>
                <td style="width: 1px;">:</td>
                <td>
                    <strong id="semesterName">-</strong>
                    <input id="formSemesterID" class="hide" type="hidden" readonly/>
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
                <td>Kelas Gabungan ?</td>
                <td>:</td>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="formCombinedClasses" class="form-jadwal" value="0" checked> Tidak
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="formCombinedClasses" class="form-jadwal" value="1"> Ya
                    </label>
                </td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>
                    <!--                    <select class="form-control" id="BaseProdi"></select>-->
                    <select id="formBaseProdi" class="form-control form-jadwal">
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Group Kelas</td>
                <td>:</td>
                <td>
                    <span class="btn-default-primary" id="viewClassGroup" style="padding-left: 5px;padding-right: 5px;"> - </span>
                    <input type="hide" class="hide" id="formClassGroup" />
                </td>
            </tr>
            <tr>
                <td style="width: 190px;">Mata Kuliah</td>
                <td style="width: 1px;">:</td>
                <td>
                    <div id="divMK">
                        -
                    </div>
                    <p style="margin-bottom: 0px;font-size: 10px;">
                        Semester : <span id="textSemester">-</span> | Total Credit : <span id="textTotalSKS">-</span>
                        <input type="hide" class="hide" id="textTotalSKSMK" />
                    </p>
                    <span style="color: red;" id="alertMK"></span>
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
                                <input type="radio" class="form-jadwal" fm="dtt-form" name="formteamTeaching" data-id="1" value="0" checked> Tidak
                            </label>
                            <label class="radio-inline">
                                <input type="radio" class="form-jadwal"  fm="dtt-form" name="formteamTeaching" data-id="1" value="1"> Ya
                            </label>
                        </div>
                        <div class="col-md-8">
                            <select class="select2-select-00 full-width-fix form-jadwal"
                                    size="5" multiple id="formTeamTeaching" disabled></select>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="3" class="td-center hide" id="subsesi1">
                    <span class="label label-warning span-sesi">--- Sub Sesi <span id="TextNoSesi1"></span> ---</span>
                </td>
            </tr>
            <tr class="trNewSesi1">
                <td>Ruang | Hari | Credit</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-xs-5">
                            <select class="form-control form-jadwal form-classroom" data-id="1" id="formClassroom1">
                                <option value=""></option>
                            </select>
                            <a href="javascript:void(0)" id="addClassRoom" style="font-size:10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Ruangan</a>
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control form-jadwal form-day" data-id="1" id="formDay1"></select>
                        </div>
                        <div class="col-xs-3">
                            <input class="form-control form-credit" data-id="1" placeholder="Credit" id="formCredit1" type="number"/>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="trNewSesi1">
                <td>Time</td>
                <td>:</td>
                <td>
                    <div class="row">

                        <div class="col-xs-4">
                            <select class="form-control form-timepercredit" data-id="1" id="formTimePerCredit1"></select>
                            <a href="javascript:void(0)" id="addTimePerCredit" style="font-size:10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah <i>Time Per Credit</i></a>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" readonly class="form-control form-jadwal formSesiAwal form-sesiawal" id="formSesiAwal1" data-id="1" />
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" id="formSesiAkhir1" style="color: #333;" readonly />
                        </div>
                    </div>
                    <div id="alertBentrok1"></div>
                </td>
            </tr>
            <tbody id="bodyAddSesi"></tbody>
        </table>

        <hr/>

        <div style="text-align: right;">
            <button class="btn btn-default btn-default-danger" id="removeNewSesi">Remove Sesi</button>
            <button class="btn btn-default btn-default-success" data-group="1" id="addNewSesi">Add Sub Sesi</button>
            |
            <button class="btn btn-success" id="btnSavejadwal">Save</button>
<!--            <button class="btn btn-default" onclick="checkSchedule(1,2,'10:41:00','11:01:00')" id="cek">cek</button>-->
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {

        window.dataSesi = 1;
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

        $('#TextNoSesi'+dataSesi).html(dataSesi);
        $('.form-filter-jadwal').prop('disabled',true);

        loadAcademicYearOnPublish();

        loadSelectOptionBaseProdi('#formBaseProdi');
        loadSelectOptionConf('#formProgramsCampusID','programs_campus','');
        // loadSelectOptionAllMataKuliahSingle('#formMataKuliah','');
        loadSelectOptionLecturersSingle('#formCoordinator','');
        loadSelectOptionLecturersSingle('#formTeamTeaching','');

        loadSelectOptionClassroom('#formClassroom'+dataSesi,'');
        fillDays('#formDay'+dataSesi,'Eng','');

        loadSelectOptionTimePerCredit('#formTimePerCredit'+dataSesi,'');


        // loadSelectOptionLecturersSingle('#formTeamTeaching'+dataGroup,'');
        // fillDays('#formDay'+dataGroup,'Eng','');
        //
        // loadSelectOptionClassGroup('#formClassGroup','');


        $('#formCoordinator,#formTeamTeaching').select2({allowClear: true});


        $(document).on('change','input[type=radio][fm=dtt-form]',function () {
            loadformTeamTeaching($(this).val(),'#formTeamTeaching');
        });

        $('input[type=radio][name=formCombinedClasses]').change(function () {
            loadformCombinedClasses($(this).val());
            setGroupClass();
        });


        // $('#formBaseProdi').select2({
        //     allowClear: true
        // });


        $("#formSesiAwal"+dataSesi).datetimepicker(timeOption);
    });



    $('#formBaseProdi').change(function () {
        var Prodi  = $(this).val();
        if(Prodi!=''){
            var ProdiID = Prodi.split('.');
            getCourseOfferings(ProdiID[0],'read');
            setGroupClass();
        }
    });

    function getCourseOfferings(ProdiID,action) {
        var url = base_url_js+'api/__crudCourseOfferings';
        var SemesterID = $('#formSemesterID').val();
        var data = {
            action : action,
            formData : {
                SemesterID : SemesterID,
                ProdiID : ProdiID
            }
        };
        var token = jwt_encode(data,'UAP)(*');

        $.post(url,{token:token},function (jsonResult) {
            console.log(jsonResult);
            if(jsonResult.length>0){
                $('#divMK').html('<select class="select2-select-00 selec2-mk full-width-fix form-jadwal" size="5" id="formMataKuliah">' +
                    '                        <option value=""></option>' +
                    '                    </select>');
                // $('#formMataKuliah')./html('');
                // $('#formMataKuliah').empty();
                if(action=='readgabungan'){
                    for(var i=0;i<jsonResult.length;i++) {
                        var data = jsonResult[i];
                        $('#formMataKuliah').append('<option value="'+data.MKID+'.'+data.MKCode+'.'+data.ScheduleID+'">'+data.MKCode+' | '+data.MKNameEng+'</option>');
                    }
                } else {
                    var Offerings = jsonResult[0].Offerings;
                    for(var i=0;i<Offerings.length;i++){
                        var data = Offerings[i];
                        $('#formMataKuliah').append('<option value="'+data.MKID+'.'+data.MKCode+'.'+data.ScheduleID+'">'+data.MKCode+' | '+data.MKNameEng+'</option>');
                    }
                }


                $('#formMataKuliah').select2({allowClear: true});
            } else {
                $('#divMK').html('-- No Offerings --');
            }
        });
    }


    $('#btnSavejadwal').click(function () {


        var process = [];

        // schedule ---
        var SemesterID = $('#formSemesterID').val();
        var ProgramsCampusID = $('#formProgramsCampusID').val();
        var CombinedClasses = $('input[name=formCombinedClasses]:checked').val();
        var ClassGroup = $('#formClassGroup').val();

        var formMataKuliah = $('#formMataKuliah').val();
        if(formMataKuliah!=''){
            var MKID = formMataKuliah.split('.')[0].trim();
            var MKCode = formMataKuliah.split('.')[1].trim();
        } else {
            process.push(0);
            requiredForm('#s2id_formMataKuliah a');
        }


        var Coordinator = $('#formCoordinator').val(); if(Coordinator==''){ process.push(0); requiredForm('#s2id_formCoordinator a'); }

        var TeamTeaching = $('input[name=formteamTeaching]:checked').val();
        var UpdateBy = sessionNIP;
        var UpdateAt = dateTimeNow();




        // schedule_team_teaching ---
        var teamTeachingArray = [];
        if(TeamTeaching==1){
            var formTeamTeaching = $('#formTeamTeaching').val();

            if(formTeamTeaching!=null){
                for(var t=0;t<formTeamTeaching.length;t++){
                    var dt = {
                        ScheduleID : 0,
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

        // schedule_combinedclasses ---
        var ProdiIDArray = [];
        var formProdiID = $('#formBaseProdi').val();
        if(formProdiID!=null){
            var ProdiID = (CombinedClasses==0) ? formProdiID.split('.')[0] : 0 ;

            // if(CombinedClasses==0){
            //     var ProdiID = formProdiID.split('.')[0];
            //     ProdiIDArray.push(ProdiID);
            // } else {
            //     for(var p=0;p<formProdiID.length;p++){
            //         var ProdiID = formProdiID[p].split('.')[0];
            //         ProdiIDArray.push(ProdiID);
            //     }
            // }
        }
        else {
            var choices = (CombinedClasses==0) ? '.select2-choice' : '.select2-choices' ;
            process.push(0); requiredForm('#s2id_formBaseProdi '+choices);
        }



        // schedule_sesi ---
        var textTotalSKSMK = $('#textTotalSKSMK').val();
        var dataScheduleDetailsArray = [];
        var totalCredit = 0;
        for(var i=1;i<=dataSesi;i++){
            var ClassroomID = $('#formClassroom'+i).val();
            var DayID = $('#formDay'+i).val();
            var Credit = $('#formCredit'+i).val(); if(Credit==''){process.push(0); requiredForm('#formCredit'+dataSesi);}
            var TimePerCredit = $('#formTimePerCredit'+i).val();
            var StartSessions = $('#formSesiAwal'+i).val(); if(StartSessions==''){process.push(0); requiredForm('#formSesiAwal'+dataSesi);}
            var EndSessions = $('#formSesiAkhir'+i).val();if(EndSessions==''){process.push(0); requiredForm('#formSesiAkhir'+dataSesi);}

            totalCredit = parseInt(totalCredit) + parseInt(Credit);
            var arrSesi = {
                ScheduleID : 0,
                ClassroomID : ClassroomID,
                Credit : Credit,
                DayID : DayID,
                TimePerCredit : TimePerCredit,
                StartSessions : StartSessions,
                EndSessions : EndSessions
            };

            dataScheduleDetailsArray.push(arrSesi);
        }

        if($.inArray(0,process)==-1){

            if(textTotalSKSMK==totalCredit){


                var data = {
                    action : 'add',
                    ID : '',
                    formData :
                        {
                            schedule : {
                                SemesterID : SemesterID,
                                ProgramsCampusID : ProgramsCampusID,
                                ProdiID : ProdiID,
                                CombinedClasses : CombinedClasses,
                                MKID : MKID,
                                MKCode : MKCode,
                                ClassGroup : ClassGroup,
                                Coordinator : Coordinator,
                                TeamTeaching : TeamTeaching,
                                UpdateBy : UpdateBy,
                                UpdateAt : UpdateAt
                            },
                            schedule_team_teaching : {
                                teamTeachingArray : teamTeachingArray
                            },
                            // schedule_combinedclasses : {
                            //     ProdiIDArray : ProdiIDArray
                            // },
                            schedule_details : {
                                dataScheduleDetailsArray : dataScheduleDetailsArray
                            },
                            schedule_class_group : {
                                ScheduleID : 0,
                                ProgramsCampusID : ProgramsCampusID,
                                SemesterID : SemesterID,
                                ProdiCode : ClassGroup.split('-')[0],
                                Group : ClassGroup
                            }

                        }
                };

                // console.log(data);
                $('#tableForm .form-sesiawal').prop('readonly',false);
                $('#tableForm .form-control, input[name=formCombinedClasses], input[name=formteamTeaching],#tableForm .select2-select-00,#tableForm .form-sesiawal').prop('disabled',true);
                $('#removeNewSesi,#addNewSesi').prop('disabled',true);
                loading_button('#btnSavejadwal');

                var token = jwt_encode(data,'UAP)(*');
                var url = base_url_js+'api/__crudSchedule';
                $.post(url,{token:token},function (jsonResult) {

                    setTimeout(function () {
                        $('#tableForm .form-control, input[name=formCombinedClasses], input[name=formteamTeaching],#tableForm .select2-select-00,#tableForm .form-sesiawal').prop('disabled',false);
                        $('#tableForm .form-sesiawal').prop('readonly',true);
                        $('#removeNewSesi,#addNewSesi,#btnSavejadwal').prop('disabled',false);
                        $('#btnSavejadwal').html('Save');


                        toastr.success('Data Saved','Success!');

                        $('input[name=formCombinedClasses][value=0],input[name=formteamTeaching][value=0]').prop('checked',true);
                        // $('#formBaseProdi,#formMataKuliah,#formCoordinator,#formTeamTeaching').select2("val",null);
                        $('#formBaseProdi').select2("val","");
                        $('#formMataKuliah').select2("val","");
                        $('#formCoordinator').select2("val","");
                        $('#formTeamTeaching').select2("val","");

                        $('#viewClassGroup,#textSemester,#textTotalSKS').text('-');
                        $('#formClassGroup,#formCredit1,#formSesiAwal1,#formSesiAkhir1,#textTotalSKSMK').val('');
                        $('#formTeamTeaching').prop('disabled',true);

                        dataSesi=1;
                        $('#subsesi1').addClass('hide');
                        $('#bodyAddSesi').html('');
                    },3000);

                });
            } else {
                toastr.warning('Credit Input & Total Credit Not Match','Warning!');
                errorInput('.form-credit');
                errorInput('.form-credit');
            }

        } else {
            toastr.error('Form Required','Error');
        }


    });

    $(document).on('change','#formMataKuliah',function () {
        var dataMK = $('#formMataKuliah').val();
        // var dataMK = $(this).val();
        if(dataMK!=''){

            loadDataSKS(dataMK);
        }
    });




    $('#addNewSesi').click(function () {

        var newSesi = true;

        var Classroom = $('#formClassroom'+dataSesi).val(); if(Classroom==''){ newSesi = requiredForm('#s2id_formClassroom'+dataSesi+' a'); }
        var Credit = $('#formCredit'+dataSesi).val(); if(Credit==''){newSesi = requiredForm('#formCredit'+dataSesi);}
        var TimePerCredit = $('#formTimePerCredit'+dataSesi).val(); if(TimePerCredit==''){newSesi = requiredForm('#formTimePerCredit'+dataSesi);}
        var StartSessions = $('#formSesiAwal'+dataSesi).val(); if(StartSessions==''){newSesi = requiredForm('#formSesiAwal'+dataSesi);}
        var EndSessions = $('#formSesiAkhir'+dataSesi).val(); if(EndSessions==''){newSesi = requiredForm('#formSesiAkhir'+dataSesi);}

        if(newSesi){
            dataSesi = dataSesi + 1;

            $('#subsesi1').removeClass('hide');
            $('#bodyAddSesi').append('<tr class="trNewSesi'+dataSesi+'">' +
                '                <td colspan="3" class="td-center">' +
                '                    <span class="label label-warning span-sesi">--- Sub Sesi '+dataSesi+' ---</span>' +
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
                '                            <input class="form-control form-credit" data-id="'+dataSesi+'" placeholder="Credit" id="formCredit'+dataSesi+'" type="number"/>' +
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
                '                            <select class="form-control form-timepercredit" data-id="'+dataSesi+'" id="formTimePerCredit'+dataSesi+'">' +
                '                                <option></option>' +
                '                                <option></option>' +
                '                            </select>' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <input type="text" readonly class="form-control form-jadwal formSesiAwal form-sesiawal" id="formSesiAwal'+dataSesi+'" data-id="'+dataSesi+'" />' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <input type="text" class="form-control" id="formSesiAkhir'+dataSesi+'" style="color: #333;" readonly />' +
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
    
    $('#removeNewSesi').click(function () {
        if(dataSesi>1){
            $('.trNewSesi'+dataSesi).remove();
            dataSesi = dataSesi - 1;
            if(dataSesi==1){
                $('#subsesi1').addClass('hide');
            }
        } else {
            $('#subsesi1').addClass('hide');
            toastr.info('Minimal 1 sesi dalam penjadwalan','Info');
        }

    });

    $('#addClassRoom').click(function () {
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


    
    function setSesiAkhir(ID) {
        var TimePerCredit = $('#formTimePerCredit'+ID).val();
        var SesiAwal = $('#formSesiAwal'+ID).val();
        var Credit = $('#formCredit'+ID).val();

        if(TimePerCredit!='' && SesiAwal!='' && Credit!=''){
            var totalTime = parseInt(TimePerCredit) * parseInt(Credit);
            var expSesi = SesiAwal.split(':');
            var sesiAkhir = moment()
                .hours(expSesi[0])
                .minutes(expSesi[1])
                .add(parseInt(totalTime), 'minute').format('HH:mm');

            $('#formSesiAkhir'+ID).val(sesiAkhir);
        }
    }

    function setGroupClass() {
        var CombinedClasses = $('input[name=formCombinedClasses]:checked').val();
        var formBaseProdi = $('#formBaseProdi').val();

        if(formBaseProdi!=null){
            var ProgramsCampusID = $('#formProgramsCampusID').val();
            var SemesterID = $('#formSemesterID').val();
            var ProdiCode = (CombinedClasses==0) ? formBaseProdi.split('.')[1] : 'ZO';

            var data = {
                ProgramsCampusID : ProgramsCampusID,
                SemesterID : SemesterID,
                ProdiCode : ProdiCode
            };
            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+'api/__getClassGroup';
            $.post(url,{token:token},function (result) {
                $('#viewClassGroup').html(result.Group);
                $('#formClassGroup').val(result.Group);
            });
        }
    }

    function loadAcademicYearOnPublish() {
        var url = base_url_js+"api/__getAcademicYearOnPublish";
        $.get(url,function (data_json) {
            $('#formSemesterID').val(data_json.ID);
            $('#semesterName').html(data_json.YearCode+' | '+data_json.Name);

        });
    }

    function loadformCombinedClasses(value) {

        if(value==1){
            getCourseOfferings('','readgabungan');
            $('#formBaseProdi').prop('disabled',true);

        } else {
            $('#formBaseProdi').prop('disabled',false);
            var Prodi  = $('#formBaseProdi').val();
            if(Prodi!=''){
                var ProdiID = Prodi.split('.');
                getCourseOfferings(ProdiID[0],'read');
            }
        }



        // if(value==1){
        //     $('#formBaseProdi').prop('multiple',true);
        // } else {
        //     $('#formBaseProdi').prop('multiple',false);
        // }
        // $('#formBaseProdi').select2({
        //     allowClear: true
        // });
    }

    function loadformTeamTeaching(value,element_dosen) {
        if(value==1){
            $(element_dosen).prop('disabled',false);
        } else {
            $(element_dosen).select2("val", null);
            $(element_dosen).prop('disabled',true);
        }
    }

    function loadDataSKS(dataMK) {
        // console.log(dataMK);
        var mk = dataMK.split('.');
        var data = {
            action : 'read',
            ID : mk[0],
            MKCode : mk[1]
        };

        // console.log(mk[2]);
        if(mk[2]!='null'){
            $('#alertMK').text(mk[1]+' - Jadwal Exist');
            $('#btnSavejadwal,#addNewSesi,#removeNewSesi').prop('disabled',true);
        } else {
            $('#alertMK').text('');
            $('#btnSavejadwal,#addNewSesi,#removeNewSesi').prop('disabled',false);
        }

        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+"api/__crudMataKuliah";
        $.post(url,{token:token},function (data_json) {
            $('#textSemester').html(data_json.Semester);
            $('#textTotalSKS').html(data_json.TotalSKS);
            $('#textTotalSKSMK').val(data_json.TotalSKS);

            var cr = $('#formCredit1').val();
            if(dataSesi==1){
                $('#formCredit1').val(data_json.TotalSKS);
            }


        });

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
                    ClassroomID : ClassroomID,
                    DayID : DayID,
                    StartSessions : StartSessions,
                    EndSessions : EndSessions
                }
            };

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+'api/__checkSchedule';
            $.post(url,{token:token},function (json_result) {
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
                        '                                <ul id="ulbentrok'+ID+'">' +
                        '                                </ul>' +
                        '                            </div>' +
                        '                        </div>' +
                        '' +
                        '                    </div>');

                    var ul = $('#ulbentrok'+ID);
                    for(var i=0;i<json_result.length;i++){
                        var data = json_result[i];
                        ul.append('<li>'+data.NameEng+' : <span style="color: blue;">'+data.Room+' | '+daysEng[(parseInt(data.DayID)-1)]+' '+data.StartSessions+' - '+data.EndSessions+'</span></li>');
                    }
                }
            });
        }

    }
</script>


<!-- CRUD Time Per Credit-->
<script>
    $('#addTimePerCredit').click(function () {

        var url = base_url_js+'api/__crudTimePerCredit';
        var token = jwt_encode({action:'read'},'UAP)(*');
        $.post(url,{token:token},function (data_json) {
            if(data_json.length>0){
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
                for(var i=0;i<data_json.length;i++){
                    $('#rowTime').append('<tr id="tr'+data_json[i].ID+'">' +
                        '<td class="td-center">'+data_json[i].Time+' Minute</td>' +
                        '<td class="td-center">' +
                        '<button class="btn btn-default btn-default-danger btn-delete-timepercredit" data-id="'+data_json[i].ID+'">Delete</button>' +
                        '</td>' +
                        '</tr>');
                };


                $('#NotificationModal').modal({
                    'show' : true
                });
            }
        });


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

    })
</script>