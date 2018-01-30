<div class="col-md-12" id="modalAddSmester">
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-4 control-label">Jenis Kurikulum</label>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-10">
                        <select class="form-control" id="ModalJenisKurikulum">
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-default btn-default-success" type="button" data-toggle="collapse" data-target="#addJenisKurikulum" aria-expanded="false" aria-controls="addJenisKurikulum">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="collapse" id="addJenisKurikulum" style="margin-top: 10px;">
                            <div class="well">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input class="form-control" id="FormAddItemJenisKurikulum" placeholder="Input jenis kurikulum...">
                                    </div>
                                    <label class="col-xs-3">
                                        <a href="javascript:void(0)" id="btnAddItemJenisKurikulum" class="btn btn-default btn-block btn-default-success"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Base Prodi</label>
            <div class="col-sm-8">
                <select class="form-control" id="ModalSelectProdi">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Jenjang</label>
            <div class="col-sm-8">
                <select class="form-control" id="ModalSelectJenjang">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Mata Kuliah</label>
            <div class="col-sm-8">
                <select class="select2-select-00 full-width-fix"
                        size="5" id="ModalSelectMK">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Jenis Mata Kuliah</label>
            <div class="col-sm-8">
                <label class="radio-inline">
                    <input type="radio" name="jenisMK" value="1" checked> Wajib
                </label>
                <label class="radio-inline">
                    <input type="radio" name="jenisMK" value="0"> Pilihan
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Pra Syarat</label>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="ModalPrasyarat" value="0" checked> Tidak Ada
                        </label>
                        <div style="margin-top: 10px;">
                            <select class="select2-select-00 full-width-fix" size="5" multiple disabled id="ModalPrasyaratSelectMK">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Dosen Pengajar</label>
            <div class="col-sm-8">
                <select class="select2-select-00 full-width-fix" size="5" id="ModalLecturers">
                    <option value=""></option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Kelompok</label>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-10">
                        <select class="form-control" id="ModalKelompokMK">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-default btn-default-success" type="button" data-toggle="collapse" data-target="#addKelompokMK" aria-expanded="false" aria-controls="addKelompokMK">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="collapse" id="addKelompokMK" style="margin-top: 10px;">
                            <div class="well">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input class="form-control" id="FormAddItemMK" placeholder="Input kelompok...">
                                    </div>
                                    <label class="col-xs-3">
                                        <a href="javascript:void(0)" id="btnAddItemMK" class="btn btn-default btn-block btn-default-success"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group" style="border-top: 1px solid #d3d3d3;border-bottom: 1px solid #d3d3d3; padding: 15px 0px 15px 0px;background: lightyellow;">

            <div class="col-sm-3">
                <label>Total SKS</label>
                <input class="form-control" id="ModalFormTotalSKS" type="number">
            </div>
            <div class="col-sm-3">
                <label>Teori</label>
                <input class="form-control" id="ModalFormSKSTeori" type="number">
            </div>
            <div class="col-sm-3">
                <label>Praktek</label>
                <input class="form-control" id="ModalFormSKSPraktek" type="number">
            </div>
            <div class="col-sm-3">
                <label>Praktek Lap.</label>
                <input class="form-control" id="ModalFormSKSPraktekLapangan" type="number">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Status MK</label>
            <div class="col-sm-8" style="border-top: 1px solid #d3d3d3;">
                <label class="radio-inline">
                    <input type="radio" name="statusMK" value="1" checked> Aktif
                </label>
                <label class="radio-inline">
                    <input type="radio" name="statusMK" value="0"> Tidak Aktif
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Silabus</label>
            <div class="col-sm-8" style="border-top: 1px solid #d3d3d3;">
                <label class="radio-inline">
                    <input type="radio" name="silabus" value="1"> Ada
                </label>
                <label class="radio-inline">
                    <input type="radio" name="silabus" value="0" checked> Tidak Ada
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">SAP</label>
            <div class="col-sm-8" style="border-top: 1px solid #d3d3d3;">
                <label class="radio-inline">
                    <input type="radio" name="sap" value="1"> Ada
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sap" value="0" checked> Tidak Ada
                </label>
            </div>
        </div>


        <div class="form-group" style="border-top: 1px solid #d3d3d3;padding-top: 10px;text-align: right;">
            <div class="col-sm-12" id="BtnFooter">
                <button type="button" id="ModalbtnCancleForm" data-dismiss="modal" class="btn btn-default">Cancle</button>
                <button type="button" id="ModalbtnSaveForm" class="btn btn-success">Save</button>
                <button type="button" id="ModalbtnEditForm" class="btn btn-default hide">Edit Data</button>
            </div>
        </div>

    </form>
</div>


<script>
    $(document).ready(function () {

        loadSelectOptionBaseProdi('#ModalSelectProdi','');
        loadSelectOptionEducationLevel('#ModalSelectJenjang');

        loadSelectOptionAllMataKuliah('#ModalPrasyaratSelectMK');


        loadSelectOptionConf('#ModalJenisKurikulum','curriculum_types');
        loadSelectOptionConf('#ModalKelompokMK','courses_groups');

        $('#ModalPrasyaratSelectMK').select2({allowClear: true});

        window.action = '<?php echo $action; ?>';
        window.ID = 0;
        window.StatusPrecondition = 0;
        if(action=='add')
        {
            loadSelectOptionLecturersSingle('#ModalSelectMK','');
            loadSelectOptionLecturersSingle('#ModalLecturers','');
            $('#ModalSelectMK, #ModalLecturers').select2({allowClear: true});
            // log('add');
        }
        else if(action=='edit')
        {
            $('#modalAddSmester .form-control,' +
                '#modalAddSmester .select2-select-00,' +
                '#modalAddSmester #ModalPrasyarat,' +
                '#modalAddSmester input[type=radio],' +
                '#modalAddSmester .btn[data-toggle=collapse]')
                .prop('disabled',true);

            $('#ModalbtnSaveForm').addClass('hide');
            $('#ModalbtnEditForm').removeClass('hide');
            $('#BtnFooter').append('<button type="button" class="btn btn-danger" style="float:left;">Delete</button>');

            var CDID = '<?php echo $CDID; ?>';
            var data = {
                CDID : CDID
            };
            ID = CDID;

            var url = base_url_js+"api/__getdetailKurikulum";
            var token = jwt_encode(data,"UAP)(*");
            $.post(url,{token:token},function (data_json) {
                var data = data_json[0];

                $('#ModalJenisKurikulum').val(data.CurriculumTypeID);

                $('#ModalSelectProdi').val(data.ProdiID);

                $('#ModalSelectJenjang').val(data.EducationLevelID);



                loadSelectOptionAllMataKuliahSingle('#ModalSelectMK',data.MKID+'.'+data.MKCode);
                $('#ModalSelectMK, #ModalLecturers').select2({allowClear: true});

                $('input[name=jenisMK][value='+data.MKType+']').prop('checked',true);


                loadSelectOptionLecturersSingle('#ModalLecturers',data.LecturerNIP);
                // $('#ModalLecturers').select2({allowClear: true});

                // $('#ModalLecturers').select2({allowClear: true}).val(data.LecturerNIP).trigger('change');

                $('#ModalKelompokMK').val(data.CoursesGroupsID);


                StatusPrecondition = data.StatusPrecondition;
                if(StatusPrecondition==1){
                    $('#ModalPrasyarat').prop('checked',false);
                    // $('#ModalPrasyaratSelectMK').prop('disabled',false);
                } else {
                    // $('#ModalPrasyarat').prop('checked',true);
                }

                $('#ModalLecturersVal').html(data.LecturerNIP+' | '+data.NameLecturer);

                $('#ModalKelompokMKVal').html(data.NameCoursesGroups);

                $('#ModalFormTotalSKS').val(data.TotalSKS);
                $('#ModalFormSKSTeori').val(data.SKSTeori);
                $('#ModalFormSKSPraktek').val(data.SKSPraktikum);
                $('#ModalFormSKSPraktekLapangan').val(data.SKSPraktikLapangan);

                $('input[name=statusMK][value='+data.StatusMK+']').prop('checked',true);
                $('input[name=silabus][value='+data.StatusSilabus+']').prop('checked',true);
                $('input[name=sap][value='+data.StatusSAP+']').prop('checked',true);

            });
        }



    });

    $(document).on('change','#ModalPrasyarat',function () {
       if($(this).is(":checked")){
           $("#ModalPrasyaratSelectMK").select2("val", null);
           $('#ModalPrasyaratSelectMK').prop('disabled',true);
       } else {
           $('#ModalPrasyaratSelectMK').prop('disabled',false);
       }
    });

    $('#btnAddItemJenisKurikulum').click(function () {
        var name = $('#FormAddItemJenisKurikulum').val();
        if(name==''){
            $('#FormAddItemJenisKurikulum').css('border','1px solid red');
        } else {
            addConf(name,'curriculum_types','#FormAddItemJenisKurikulum',
                '#btnAddItemJenisKurikulum','#ModalJenisKurikulum');
        }
    });

    $('#btnAddItemMK').click(function () {
        var name = $('#FormAddItemMK').val();

        if(name==''){
            $('#FormAddItemMK').css('border','1px solid red');
        } else {
            addConf(name,'courses_groups','#FormAddItemMK',
                '#btnAddItemMK','#ModalKelompokMK');
        }
    });

    $('#ModalbtnSaveForm').click(function () {

        var process = true;

        var kurikulum = $('#selectKurikulum').find(':selected').val().split('.');
        var CurriculumID = kurikulum[0];
        var Semester = '<?php echo $semester; ?>';
        var CurriculumTypeID = $('#ModalJenisKurikulum').find(':selected').val();


        var ProdiID = $('#ModalSelectProdi').find(':selected').val();
        process = formRequiredError(ProdiID,'#ModalSelectProdi');

        var EducationLevelID = $('#ModalSelectJenjang').find(':selected').val();
        process = formRequiredError(EducationLevelID,'#ModalSelectJenjang');

        var Datamk = $('#ModalSelectMK').val();

        if(Datamk!=null){
            mk = Datamk.split('.');
            var MKID = mk[0].trim();
            var MKCode = mk[1].trim();
            $('#s2id_ModalSelectMK').css('border','1px solid green');
        } else {
            $('#s2id_ModalSelectMK').css('border','1px solid red');
            process = false;
        }


        var MKType = $('input[name=jenisMK]:checked').val();

        var StatusPrecondition = 1;
        var DataPraSyart = $('#ModalPrasyaratSelectMK').val();

        if($('#ModalPrasyarat').is(':checked')){
            StatusPrecondition = 0;
        } else {
            if(DataPraSyart==null){
                toastr.error('Prasyarat Wajib Diisi','Error!!');
                process = false;
            } else if(DataPraSyart[0]=='') {
                toastr.error('Prasyarat Wajib Diisi','Error!!');
                process = false;
            }
        }

        var LecturerNIP = $('#ModalLecturers').val();
        process = formRequiredError(LecturerNIP,'#s2id_ModalLecturers');
        var CoursesGroupsID = $('#ModalKelompokMK').find(':selected').val();
        var TotalSKS = $('#ModalFormTotalSKS').val();
        process = formRequiredError(TotalSKS,'#ModalFormTotalSKS');
        var SKSTeori = $('#ModalFormSKSTeori').val();
        var SKSPraktikum = $('#ModalFormSKSPraktek').val();
        var SKSPraktikLapangan = $('#ModalFormSKSPraktekLapangan').val();

        var StatusMK = $('input[name=statusMK]:checked').val();
        var StatusSilabus = $('input[name=silabus]:checked').val();
        var StatusSAP = $('input[name=sap]:checked').val();



        // Proses Dulu
        if(process){
            $('#modalAddSmester .form-control,' +
                '#modalAddSmester .select2-select-00,' +
                '#modalAddSmester #ModalPrasyarat,' +
                '#modalAddSmester input[type=radio],' +
                '#modalAddSmester .btn')
                .prop('disabled',true);


            var data = {
                action : action,
                ID : ID,
                DataPraSyart : DataPraSyart,
                dataForm : {
                    CurriculumID : CurriculumID,
                    Semester : Semester,
                    CurriculumTypeID : CurriculumTypeID,
                    ProdiID : ProdiID,
                    EducationLevelID : EducationLevelID,

                    MKID : MKID,
                    MKCode : MKCode,
                    MKType : MKType,

                    StatusPrecondition : StatusPrecondition,

                    LecturerNIP : LecturerNIP,
                    CoursesGroupsID : CoursesGroupsID,
                    TotalSKS : TotalSKS,
                    SKSTeori : SKSTeori,
                    SKSPraktikum : SKSPraktikum,
                    SKSPraktikLapangan : SKSPraktikLapangan,

                    StatusMK : StatusMK,
                    StatusSilabus : StatusSilabus,
                    StatusSAP : StatusSAP,

                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()
                }
            };

            var token = jwt_encode(data,"UAP)(*");
            var url = base_url_js+"api/__crudDetailMK";
            loading_button('#ModalbtnSaveForm');
            // return false;
            $.post(url,{token:token},function (result) {
                setTimeout(function () {
                    toastr.success('Data tersimpan','Success');

                    $('#ModalbtnSaveForm').html('Save');
                    $('#modalAddSmester .form-control,' +
                        '#modalAddSmester .select2-select-00,' +
                        '#modalAddSmester #ModalPrasyarat,' +
                        '#modalAddSmester input[type=radio],' +
                        '#modalAddSmester .btn')
                        .prop('disabled',false);

                    resetForm();
                    pageKurikulum();


                },2000);
            });
        } else {
            toastr.error('Form Required Wajib Diisi','Error!!');
        }




    });

    $('#ModalbtnEditForm').click(function () {
        $(this).addClass('hide');
        $('#ModalbtnSaveForm').removeClass('hide');
        $('#modalAddSmester .form-control,' +
            '#modalAddSmester .select2-select-00,' +
            '#modalAddSmester #ModalPrasyarat,' +
            '#modalAddSmester input[type=radio],' +
            '#modalAddSmester .btn[data-toggle=collapse]')
            .prop('disabled',false);

        if(StatusPrecondition!=1){
            $('#ModalPrasyaratSelectMK').prop('disabled',true);
        }
    });

    function resetForm() {

        $('#ModalSelectProdi').val('');
        $('#ModalSelectJenjang').val('');
        $('#ModalSelectMK').val(null).trigger('change');
        $('input[name=jenisMK][value=1]').prop('checked',true);

        $('#ModalPrasyarat').prop('checked',true);

        $("#ModalPrasyaratSelectMK").select2("val", null);
        $('#ModalPrasyaratSelectMK').prop('disabled',true);

        $('#ModalLecturers').val(null).trigger('change');
        $('#ModalKelompokMK').val('');

        $('#ModalFormTotalSKS').val('');
        $('#ModalFormSKSTeori').val('');
        $('#ModalFormSKSPraktek').val('');
        $('#ModalFormSKSPraktekLapangan').val('');

        $('input[name=statusMK][value=1]').prop('checked',true);

        $('input[name=silabus][value=0]').prop('checked',true);
        $('input[name=sap][value=0]').prop('checked',true);

    }

    function addConf(Name,table,form,btn,selectOPtion) {

        $(''+form).css('border','1px solid #ccc');
        loading_buttonSm(btn);
        $(''+form).prop('disabled',true);
        var data = {
            action : 'add',
            ID : '',
            table : table,
            data_insert : {
                Name : Name,
                UpdateBy : sessionNIP,
                UpdateAt : dateTimeNow()
            }
        };
        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+"api/__crudKurikulum";
        $.post(url,{token : token},function (result) {
            setTimeout(function () {

                $(''+selectOPtion).empty();
                loadSelectOptionConf(''+selectOPtion,table);

                $(''+btn).html('<i class="fa fa-floppy-o" aria-hidden="true"></i>');
                toastr.success('Data tersimpan','Success');
                $(btn+', '+form).prop('disabled',false);
                $(''+form).val('');
            },3000);



        });
    }

    function formRequiredError(value,element) {
        if(value=='' || value==0 || value==null){
            $(''+element).css('border','1px solid red');
            return false;
        } else {
            $(''+element).css('border','1px solid green');
            return true;
        }

    }

</script>