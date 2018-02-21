<div class="row" style="margin-bottom: 30px;">
    <label class="col-md-10 col-md-offset-1">
<!--        <button  data-page="jadwal" class="btn btn-info btn-action">-->
<!--            <i class="fa fa-arrow-circle-left right-margin" aria-hidden="true"></i> Back</button>-->

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
                        <option value=""></option>
                    </select>
                    <input type="hide" class="hide" id="groupCode" readonly />
                </td>
            </tr>
        </table>
    </div>
</div>



<script>
    $(document).ready(function () {

        window.dataGroup = 1;

        $('.TextNoGroupCode').html(dataGroup);
        $('.form-filter-jadwal').prop('disabled',true);

        loadAcademicYearOnPublish();

        loadSelectOptionBaseProdi('#formBaseProdi');
        loadSelectOptionConf('#formProgramsCampusID','programs_campus','');
        loadSelectOptionAllMataKuliahSingle('#formMataKuliah'+dataGroup,'');
        loadSelectOptionLecturersSingle('#formDosenKoordinator'+dataGroup,'');
        loadSelectOptionLecturersSingle('#formTeamDosen'+dataGroup,'');
        loadSelectOptionClassroom('#formClassroom'+dataGroup,'');
        fillDays('#formDay'+dataGroup,'Eng','');

        loadSelectOptionClassGroup('#formClassGroup','');


        $('#formMataKuliah'+dataGroup+',#formDosenKoordinator'+dataGroup+',' +
            '#formClassGroup,#formTeamDosen'+dataGroup+',#formClassroom'+dataGroup).select2({allowClear: true});


        $(document).on('change','input[type=radio][fm=dtt-form]',function () {
            var ID = $(this).attr('data-id');
            loadformTeamTeaching($(this).val(),'#formTeamDosen'+ID);
        });

        $('input[type=radio][name=formCombinedClassess]').change(function () {
            loadformCombinedClassess($(this).val());
            loadGroupClass();
        });


        $('#formBaseProdi').select2({
            allowClear: true
        });
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
</script>