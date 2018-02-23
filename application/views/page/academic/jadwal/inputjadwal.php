
<style>
    .span-sesi {
        font-size: 1.3em;
        font-weight: bold;
    }
    .td-center {
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }
</style>

<div class="row" style="margin-bottom: 30px;">
    <label class="col-md-8 col-md-offset-2">
<!--        <button  data-page="jadwal" class="btn btn-info btn-action">-->
<!--            <i class="fa fa-arrow-circle-left right-margin" aria-hidden="true"></i> Back</button>-->

        <table class="table table-hover" style="margin-top: 10px;">
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
                    <select id="formBaseProdi" class="select2-select-00 col-md-12 full-width-fix form-jadwal" size="5">
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
                    <select class="select2-select-00 selec2-mk full-width-fix form-jadwal"
                            size="5" id="formMataKuliah">
                        <option value=""></option>
                    </select>
                    <p style="margin-bottom: 0px;font-size: 10px;">
                        Semester : <span id="textSemester">-</span> | Total SKS : <span id="textTotalSKS">-</span>
                    </p>
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
                <td colspan="3" class="td-center">
                    <span class="label label-warning span-sesi">--- Sesi <span id="TextNoSesi1"></span> ---</span>
                </td>
            </tr>
            <tr>
                <td>Ruang | Hari | SKS</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-xs-5">
                            <select class="select2-select-00 full-width-fix form-jadwal form-classroom"
                                    size="5" id="formClassroom1">
                                <option value=""></option>
                            </select>
                            <a href="javascript:void(0)" id="addClassRoom" style="font-size:10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Ruangan</a>
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control form-jadwal" id="formDay1"></select>
                        </div>
                        <div class="col-xs-3">
                            <input class="form-control" placeholder="SKS" id="formCredit1" type="number"/>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Time</td>
                <td>:</td>
                <td>
                    <div class="row">

                        <div class="col-xs-4">
                            <select class="form-control" id="formTimePerCredit1">
                                <option></option>
                                <option></option>
                            </select>
                            <a href="javascript:void(0)" id="addTimePerCredit" style="font-size:10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah <i>Time Per Credit</i></a>
                        </div>
                        <div class="col-xs-4">
                            <input type="time" class="form-control form-jadwal formSesiAwal" id="formSesiAwal1" data-id="1" />
                        </div>
                        <div class="col-xs-4">
                            <input type="time" class="form-control" id="formSesiAkhir1" style="color: #333;" readonly />
                        </div>
                    </div>
                </td>
            </tr>
            <tbody id="bodyAddSesi"></tbody>
        </table>

        <hr/>
        <div style="text-align: right;">
            <button class="btn btn-default btn-default-danger" id="removeNewSesi">Remove Sesi</button>
            <button class="btn btn-default btn-default-success" data-group="1" id="addNewSesi">Add New Sesi</button>
            |
            <button class="btn btn-success" id="btnSavejadwal">Save</button>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {

        window.dataSesi = 1;

        $('#TextNoSesi'+dataSesi).html(dataSesi);
        $('.form-filter-jadwal').prop('disabled',true);

        loadAcademicYearOnPublish();

        loadSelectOptionBaseProdi('#formBaseProdi');
        loadSelectOptionConf('#formProgramsCampusID','programs_campus','');
        loadSelectOptionAllMataKuliahSingle('#formMataKuliah','');
        loadSelectOptionLecturersSingle('#formCoordinator','');
        loadSelectOptionLecturersSingle('#formTeamTeaching','');

        loadSelectOptionClassroom('#formClassroom'+dataSesi,'');
        fillDays('#formDay'+dataSesi,'Eng','');


        // loadSelectOptionLecturersSingle('#formTeamTeaching'+dataGroup,'');
        // fillDays('#formDay'+dataGroup,'Eng','');
        //
        // loadSelectOptionClassGroup('#formClassGroup','');


        $('#formMataKuliah,#formCoordinator,#formTeamTeaching,#formClassroom'+dataSesi).select2({allowClear: true});


        $(document).on('change','input[type=radio][fm=dtt-form]',function () {
            loadformTeamTeaching($(this).val(),'#formTeamTeaching');
        });

        $('input[type=radio][name=formCombinedClasses]').change(function () {
            loadformCombinedClasses($(this).val());
            setGroupClass();
        });


        $('#formBaseProdi').select2({
            allowClear: true
        });
    });


    $('#btnSavejadwal').click(function () {

        var process = true;

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
            process = requiredForm('#s2id_formMataKuliah a');
        }


        var Coordinator = $('#formCoordinator').val(); if(Coordinator==''){ process = requiredForm('#s2id_formCoordinator a'); }

        var TeamTeaching = $('input[name=formteamTeaching]:checked').val();
        var UpdateBy = sessionNIP;
        var UpdateAt = dateTimeNow();




        // schedule_team_teaching ---
        var teamTeachingArray = [];
        if(TeamTeaching==1){
            var formTeamTeaching = $('#formTeamTeaching').val();
            console.log(formTeamTeaching);
            if(formTeamTeaching!=null){
                for(var t=0;t<formTeamTeaching.length;t++){
                    var dt = {
                        NIP :  formTeamTeaching[t],
                        Status : '0'
                    };
                    teamTeachingArray.push(dt);
                }
            }
            else {
                process = requiredForm('#s2id_formTeamTeaching .select2-choices');
            }
        }

        // schedule_combinedclasses ---
        var ProdiIDArray = [];
        var formProdiID = $('#formBaseProdi').val();
        if(formProdiID!=null){
            if(CombinedClasses==0){
                var ProdiID = formProdiID.split('.')[0];
                ProdiIDArray.push(ProdiID);
            } else {
                for(var p=0;p<formProdiID.length;p++){
                    var ProdiID = formProdiID[p].split('.')[0];
                    ProdiIDArray.push(ProdiID);
                }
            }
        }
        else {
            var choices = (CombinedClasses==0) ? '.select2-choice' : '.select2-choices' ;
            process = requiredForm('#s2id_formBaseProdi '+choices);
        }


        // schedule_sesi ---
        var dataSesiArray = [];
        for(var i=1;i<=dataSesi;i++){
            var ClassroomID = '';
            var Credit = '';
            var DayID = '';
            var TimePerCredit = '';
            var StartSessions = '';
            var EndSessions = '';

            var arrSesi = {
                ClassroomID : ClassroomID,
                Credit : Credit,
                DayID : DayID,
                TimePerCredit : TimePerCredit,
                StartSessions : StartSessions,
                EndSessions : EndSessions
            };

            dataSesiArray.push(arrSesi);
        }

        if(process){

        } else {
            toastr.error('Form Required','Error');
        }

        return false;

        var data = {
          action : 'add',
          formData :
              {
                  schedule : {
                      SemesterID : SemesterID,
                      ProgramsCampusID : ProgramsCampusID,
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
                  schedule_combinedclasses : {
                      ProdiIDArray : ProdiIDArray
                  },
                  schedule_sesi : {
                      dataSesiArray : dataSesiArray
                  }

              }
        };

        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+'';
        $.post(url,{token:token},function (result) {

        });

    });

    $(document).on('change','#formMataKuliah',function () {
        var dataMK = $('#formMataKuliah').val();
        // var dataMK = $(this).val();
        if(dataMK!=''){
            loadDataSKS(dataMK);
        }
    });

    $('#formBaseProdi').change(function () {
        setGroupClass();
    });


    $('#addNewSesi').click(function () {

        var newSesi = true;

        var Classroom = $('#formClassroom'+dataSesi).val(); if(Classroom==null){ console.log('er'); newSesi = requiredForm('#s2id_formClassroom'+dataSesi+' a'); }
        var Credit = $('#formCredit'+dataSesi).val(); if(Credit==''){newSesi = requiredForm('#formCredit'+dataSesi);}
        var TimePerCredit = $('#formTimePerCredit'+dataSesi).val(); if(TimePerCredit==''){newSesi = requiredForm('#formTimePerCredit'+dataSesi);}
        var StartSessions = $('#formSesiAwal'+dataSesi).val(); if(StartSessions==''){newSesi = requiredForm('#formSesiAwal'+dataSesi);}
        var EndSessions = $('#formSesiAkhir'+dataSesi).val(); if(EndSessions==''){newSesi = requiredForm('#formSesiAkhir'+dataSesi);}

        if(newSesi){
            dataSesi = dataSesi + 1;

            $('#bodyAddSesi').append('<tr class="trNewSesi'+dataSesi+'">' +
                '                <td colspan="3" class="td-center">' +
                '                    <span class="label label-warning span-sesi">--- Sesi '+dataSesi+' ---</span>' +
                '                </td>' +
                '            </tr>' +
                '            <tr class="trNewSesi'+dataSesi+'">' +
                '                <td>Ruang | Hari | SKS</td>' +
                '                <td>:</td>' +
                '                <td>' +
                '                    <div class="row">' +
                '                        <div class="col-xs-5">' +
                '                            <select class="select2-select-00 full-width-fix form-jadwal form-classroom"' +
                '                                    size="5" id="formClassroom'+dataSesi+'">' +
                '                                <option value=""></option>' +
                '                            </select>' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <select class="form-control form-jadwal" id="formDay'+dataSesi+'"></select>' +
                '                        </div>' +
                '                        <div class="col-xs-3">' +
                '                            <input class="form-control" placeholder="SKS" id="formCredit'+dataSesi+'" type="number"/>' +
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
                '                            <select class="form-control" id="formTimePerCredit'+dataSesi+'">' +
                '                                <option></option>' +
                '                                <option></option>' +
                '                            </select>' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <input type="time" class="form-control form-jadwal formSesiAwal" id="formSesiAwal'+dataSesi+'" data-id="1" />' +
                '                        </div>' +
                '                        <div class="col-xs-4">' +
                '                            <input type="time" class="form-control" id="formSesiAkhir'+dataSesi+'" style="color: #333;" readonly />' +
                '                        </div>' +
                '                    </div>' +
                '                </td>' +
                '            </tr>');

            loadSelectOptionClassroom('#formClassroom'+dataSesi,'');
            fillDays('#formDay'+dataSesi,'Eng','');

            $('#formClassroom'+dataSesi).select2();
        } else {
            toastr.warning('Form Sesi '+dataSesi+' Harus Diisi','Warning!');
        }

    });
    
    $('#removeNewSesi').click(function () {
        if(dataSesi>1){
            $('.trNewSesi'+dataSesi).remove();
            dataSesi = dataSesi - 1;
        } else {
            toastr.info('Minimal 1 sesi dalam penjadwalan','Info');
        }

    });

    $('#addTimePerCredit').click(function () {
        $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">Announcement</h4>');
        $('#GlobalModal .modal-body').html('Announcement');
        $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary"><i class="fa fa-paper-plane-o right-margin" aria-hidden="true"></i> Publish</button>');
        $('#GlobalModal').modal({
            'show' : true,
            'backdrop' : 'static'
        });
    });

    $('#addClassRoom').click(function () {
        $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">Announcement</h4>');
        $('#GlobalModal .modal-body').html('Announcement');
        $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-primary"><i class="fa fa-paper-plane-o right-margin" aria-hidden="true"></i> Publish</button>');
        $('#GlobalModal').modal({
            'show' : true,
            'backdrop' : 'static'
        });
    });

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

    function loadformTeamTeaching(value,element_dosen) {
        if(value==1){
            $(element_dosen).prop('disabled',false);
        } else {
            $(element_dosen).select2("val", null);
            $(element_dosen).prop('disabled',true);
        }
    }

    function loadDataSKS(dataMK) {
        var mk = dataMK.split('.');
        var data = {
            action : 'read',
            ID : mk[0],
            MKCode : mk[1]
        };

        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+"api/__crudMataKuliah";
        $.post(url,{token:token},function (data_json) {
            $('#textSemester').html(data_json.Semester);
            $('#textTotalSKS').html(data_json.TotalSKS);

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
</script>