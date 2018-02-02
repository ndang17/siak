
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
                        <input type="radio" name="kelasGabungan" value="0" checked> Tidak
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="kelasGabungan" value="1"> Ya
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    Program Kuliah
                </td>
                <td>:</td>
                <td>
                    <select class="form-control" id="modalProgram"></select>
                </td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>
<!--                    <select class="form-control" id="BaseProdi"></select>-->
                    <select id="BaseProdi" class="select2-select-00 col-md-12 full-width-fix" size="5">
                    </select>
                </td>
            </tr>
            <tr>
                <td>Mata Kuliah</td>
                <td>:</td>
                <td>
                    <select class="select2-select-00 full-width-fix"
                            size="5" id="ModalSelectMK">
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Group Kelas</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-xs-7">
                            <select class="select2-select-00 full-width-fix"
                                    size="5" id="formClassGroup">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <button class="btn btn-default btn-block" id="btnRefreshDataGroupClass">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                        <div class="col-xs-3">
                            <button class="btn btn-default btn-default-success btn-block" id="btnAddGroupClass">Add Group</button>
                        </div>
                    </div>


                </td>
            </tr>
            <tr>
                <td>Dosen Team Teaching ?</td>
                <td>:</td>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="teamTeaching" value="0" checked> Tidak
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="teamTeaching" value="1"> Ya
                    </label>
                </td>
            </tr>
            <tr>
                <td>Dosen Koordinator</td>
                <td>:</td>
                <td>
                    <select class="select2-select-00 full-width-fix"
                            size="5" id="formDosenKoordinator">
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Team Dosen</td>
                <td>:</td>
                <td>
                    <select class="select2-select-00 full-width-fix"
                            size="5" multiple id="formTeamDosen" disabled></select>
                </td>
            </tr>
            <tr>
                <td>Ruangan</td>
                <td>:</td>
                <td>
                    <select class="form-control"></select>
                </td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>:</td>
                <td>
                    <select class="form-control"></select>
                </td>
            </tr>

            <tr>
                <td>Sesi Awal</td>
                <td>:</td>
                <td>
                    <select class="form-control"></select>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <button class="btn btn-danger">Cancle</button>
                    <button class="btn btn-success">Save</button>
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

        loadProdiSelectOption('#BaseProdi');
        loadSelectOptionConf('#modalProgram','programs_campus','');
        loadSelectOptionAllMataKuliahSingle('#ModalSelectMK','');
        loadSelectOptionLecturersSingle('#formDosenKoordinator','');
        loadSelectOptionLecturersSingle('#formTeamDosen','');

        loadSelectOptionClassGroup('#formClassGroup','');

        $('#ModalSelectMK,#formDosenKoordinator,#formClassGroup,#formTeamDosen').select2({allowClear: true});


        $('input[type=radio][name=kelasGabungan]').change(function () {
            loadKelasGabungan($(this).val());
        });

        $('input[type=radio][name=teamTeaching]').change(function () {
            loadTeamTeaching($(this).val());
        });

        $('#BaseProdi').select2({
            allowClear: true
        });
    });

    $('#btnAddGroupClass').click(function () {
        modal_dataClassGroup('disabledDelete','Group Class');
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

    function loadKelasGabungan(value) {
        if(value==1){
            // $('.single-select').remove();
            $('#BaseProdi').prop('multiple',true);
        } else {
            // $('#BaseProdi').prepend('<option class="single-select"></option>');
            $('#BaseProdi').prop('multiple',false);
        }

        $('#BaseProdi').select2({
            allowClear: true
        });
    }

    function loadTeamTeaching(value) {
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