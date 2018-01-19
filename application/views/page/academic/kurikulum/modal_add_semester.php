
<div class="col-md-12">
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-4 control-label">Jenis Kurikulum</label>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-10">
                        <select class="form-control" id="">
                            <option value="">Kurikulum Inti</option>
                            <option value="">Kurikulum Institusionak</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <a href="#addJenisKurikulum" role="button" data-toggle="collapse" class="btn btn-default btn-default-success" style="float: right;">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="collapse" id="addJenisKurikulum" style="margin-top: 10px;">
                            <div class="well">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input class="form-control" placeholder="Input jenis kurikulum...">
                                    </div>
                                    <label class="col-xs-3">
                                        <a href="javascript:void(0)" class="btn btn-default btn-block btn-default-success"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
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
                <select class="select2-select-00 full-width-fix" size="5" id="ModalSelectMK">
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
                        <select class="form-control" id="">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <a href="#addKelompokMK" role="button" data-toggle="collapse" class="btn btn-default btn-default-success" style="float: right;"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="collapse" id="addKelompokMK" style="margin-top: 10px;">
                            <div class="well">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <input class="form-control" placeholder="Input kelompok...">
                                    </div>
                                    <label class="col-xs-3">
                                        <a href="javascript:void(0)" class="btn btn-default btn-block btn-default-success"><i class="fa fa-floppy-o" aria-hidden="true"></i></a>
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
                <input class="form-control" type="number">
            </div>
            <div class="col-sm-3">
                <label>Teori</label>
                <input class="form-control" type="number">
            </div>
            <div class="col-sm-3">
                <label>Praktek</label>
                <input class="form-control" type="number">
            </div>
            <div class="col-sm-3">
                <label>Praktek Lap.</label>
                <input class="form-control" type="number">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Status MK</label>
            <div class="col-sm-8">
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
            <div class="col-sm-8">
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
            <div class="col-sm-8">
                <label class="radio-inline">
                    <input type="radio" name="sap" value="1"> Ada
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sap" value="0" checked> Tidak Ada
                </label>
            </div>
        </div>


        <div class="form-group" style="border-top: 1px solid #d3d3d3;padding-top: 10px;text-align: right;">
            <div class="col-sm-12">
                <button type="button" data-dismiss="modal" class="btn btn-default">Cancle</button>
                <button type="button" class="btn btn-success">Save</button>
            </div>
        </div>

    </form>
</div>


<script>
    $(document).ready(function () {
        loadSelectOptionBaseProdi('#ModalSelectProdi');
        loadSelectOptionEducationLevel('#ModalSelectJenjang');
        loadSelectOptionAllMataKuliah('#ModalSelectMK');
        loadSelectOptionAllMataKuliah('#ModalPrasyaratSelectMK');
        loadSelectOptionLecturers('#ModalLecturers');

        $('#ModalSelectMK, #ModalPrasyaratSelectMK, #ModalLecturers').select2({
            allowClear: true
        });

    });

    $(document).on('change','#ModalPrasyarat',function () {
       if($(this).is(":checked")){
           $("#ModalPrasyaratSelectMK").select2("val", "");
           $('#ModalPrasyaratSelectMK').prop('disabled',true);
       } else {
           $('#ModalPrasyaratSelectMK').prop('disabled',false);
       }
    });


</script>