
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
                        <option value=""></option>
                    </select>
                    <input type="hide" class="hide" id="groupCode" readonly />
                </td>
            </tr>
            <tr>
                <td>Group Kelas</td>
                <td>:</td>
                <td>
                    <span class="btn-default-primary" style="padding-left: 5px;padding-right: 5px;"> HBP-12 </span>
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
                    <p style="margin-bottom: 0px;">
                        Semester : <span id="textSemester"></span> | <span id="textTotalSKS"></span> SKS
                    </p>

                    <input type="hide" class="hide" id="totalTime1" readonly />

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
                <td>Dosen Team Teaching ?</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" class="form-jadwal" fm="dtt-form" name="formteamTeaching1" data-id="1" value="0" checked> Tidak
                            </label>
                            <label class="radio-inline">
                                <input type="radio" class="form-jadwal"  fm="dtt-form" name="formteamTeaching1" data-id="1" value="1"> Ya
                            </label>
                        </div>
                        <div class="col-md-8">
                            <select class="select2-select-00 full-width-fix form-jadwal"
                                    size="5" multiple id="formTeamDosen" disabled></select>
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
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control form-jadwal" id="formDay1"></select>
                        </div>
                        <div class="col-xs-3">
                            <input class="form-control" placeholder="SKS" id="formSKS1" type="number"/>
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
                            <select class="form-control" id="formTimePerSKS1">
                                <option></option>
                                <option></option>
                            </select>
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
            <button class="btn btn-success">Save</button>
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
        loadSelectOptionLecturersSingle('#formDosenKoordinator','');
        loadSelectOptionLecturersSingle('#formTeamDosen','');

        loadSelectOptionClassroom('#formClassroom'+dataSesi,'');
        fillDays('#formDay'+dataSesi,'Eng','');


        // loadSelectOptionLecturersSingle('#formTeamDosen'+dataGroup,'');
        // fillDays('#formDay'+dataGroup,'Eng','');
        //
        // loadSelectOptionClassGroup('#formClassGroup','');


        $('#formMataKuliah,#formDosenKoordinator,#formTeamDosen,#formClassroom'+dataSesi).select2({allowClear: true});


        $(document).on('change','input[type=radio][fm=dtt-form]',function () {
            loadformTeamTeaching($(this).val(),'#formTeamDosen');
        });

        $('input[type=radio][name=formCombinedClassess]').change(function () {
            loadformCombinedClassess($(this).val());
            loadGroupClass();
        });


        $('#formBaseProdi').select2({
            allowClear: true
        });
    });

    $(document).on('change','#formMataKuliah',function () {
        var dataMK = $('#formMataKuliah').val();
        // var dataMK = $(this).val();
        if(dataMK!=''){
            loadDataSKS(dataMK);
        }
    });

    $('#addNewSesi').click(function () {

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
            '                            <input class="form-control" placeholder="SKS" id="formSKS'+dataSesi+'" type="number"/>' +
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
            '                            <select class="form-control" id="formTimePerSKS'+dataSesi+'">' +
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

    });
    
    $('#removeNewSesi').click(function () {
        if(dataSesi>1){
            $('.trNewSesi'+dataSesi).remove();
            dataSesi = dataSesi - 1;
        } else {
            toastr.info('Minimal 1 sesi dalam penjadwalan','Info');
        }

    });

    function loadAcademicYearOnPublish() {
        var url = base_url_js+"api/__getAcademicYearOnPublish";
        $.get(url,function (data_json) {
            $('#formSemesterID').val(data_json.ID);
            $('#semesterName').html(data_json.YearCode+' | '+data_json.Name);

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

    function loadGroupClass() {
        var ProdiCode = $('#formBaseProdi').val();
        // var MKCode = $('#formMataKuliah').val();
        var formCombinedClassess = $('input[type=radio][name=formCombinedClassess]:checked').val();

        // if(ProdiCode!=null && MKCode!='' ){
        //     var P = ProdiCode.split('.')[1];
        //     var MK = MKCode.split('.')[1];

        // $('#groupCode').val(P+'.'+MK);
        // $('.TextGroupCode').html(P+'.'+MK);
        // }

        if(ProdiCode!=null){
            var g = (formCombinedClassess==1) ? 'ZO' : ProdiCode.split('.')[1];

            $('#groupCode').val(g);
            $('.TextGroupCode').html(g);
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

            // var totalTime = parseInt(timePerCredits) * parseInt(data_json.TotalSKS);
            //
            // var h = parseInt(totalTime) / 60 | 0,
            //     m = parseInt(totalTime) % 60 |0;
            // $('#textTimeSKS'+dg).html(totalTime+" menit ( "+h+" jam "+m+" menit )");
            // $('#totalTime'+dg).val(totalTime);

            // var value = $('#formSesiAwal').val();
            // loadEndSession(value,dg);
            // for(var i=1;i<=dataGroup;i++){
            //     var value = $('#formSesiAwal'+i).val();
            //     loadEndSession(value,'#formSesiAkhir'+);
            // }

        });

    }
</script>