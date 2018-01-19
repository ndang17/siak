
<div class="col-md-12">
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Jenis Kurikulum</label>
            <div class="col-sm-7">
                <select class="form-control" id="">
                    <option value="">Kurikulum Inti</option>
                    <option value="">Kurikulum Institusionak</option>
                </select>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-default btn-default-success" style="float: right;"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Base Prodi</label>
            <div class="col-sm-9">
                <select class="form-control" id="ModalSelectProdi">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Jenjang</label>
            <div class="col-sm-9">
                <select class="form-control" id="ModalSelectJenjang">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Mata Kuliah</label>
            <div class="col-sm-9">
                <select class="select2-select-00 full-width-fix" size="5" id="ModalSelectMK">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Jenis Mata Kuliah</label>
            <div class="col-sm-9">
                <label class="radio-inline">
                    <input type="radio" name="jenisMK" value="1" checked> Wajib
                </label>
                <label class="radio-inline">
                    <input type="radio" name="jenisMK" value="0"> Pilihan
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Pra Syarat</label>
            <div class="col-sm-9">
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
            <label class="col-sm-3 control-label">Dosen Pengampu</label>
            <div class="col-sm-9">
                <select class="select2-select-00 full-width-fix" size="5" id="ModalLecturers">
                    <option value=""></option>
                </select>
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