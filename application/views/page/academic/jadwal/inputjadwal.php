
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <button  data-page="jadwal" class="btn btn-info btn-action"><i class="fa fa-arrow-circle-left right-margin" aria-hidden="true"></i> Back</button>

        <table class="table table-striped" style="margin-top: 10px;">
            <tr>
                <td style="width: 30%;">Kelas Gabungan ?</td>
                <td style="width: 1%;">:</td>
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
                    <b>Reguler</b>
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
                    <select class="form-control"></select>
                </td>
            </tr>
            <tr>
                <td>Group Kelas</td>
                <td>:</td>
                <td>
                    <div class="row">
                        <div class="col-xs-7">
                            <select class="form-control"></select>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-default btn-default-success">Add Group</button>
                        </div>
                    </div>


                </td>
            </tr>
            <tr>
                <td>Dosen Team Teaching ?</td>
                <td>:</td>
                <td>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> Tidak
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Ya
                    </label>
                </td>
            </tr>
            <tr>
                <td>Dosen Koordinator</td>
                <td>:</td>
                <td>
                    <select class="form-control"></select>
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
        loadProdiSelectOption('#BaseProdi');


        $('input[type=radio][name=kelasGabungan]').change(function () {
            loadKelasGabungan($(this).val());
        });

        $('#BaseProdi').select2({
            allowClear: true
        });
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

</script>