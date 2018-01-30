

<style>
    .tr-invers {
        background: #0f1f4bc4;
        color: #fff;
    }

    #tableDetailTA .form-control[readonly] {
        cursor: cell;
        background-color: #fff;
        color: #333;
    }
</style>

<a href="<?php echo base_url('academic/tahun-akademik'); ?>" class="btn btn-info"><i class="fa fa-arrow-circle-left right-margin" aria-hidden="true"></i> Back</a>
<button class="btn btn-success" id="btnSaveDetail">Save</button>
<hr/>


<div class="alert alert-info" role="alert">
    <b><span id="nameTahunAkademik"></span></b>
</div>
<table class="table table-bordered table-striped" id="tableDetailTA">
    <thead>
    <tr class="tr-invers">
        <th rowspan="2" class="th-center">Keterangan</th>
        <th colspan="2" class="th-center">
            Global Setting
        </th>
        <th rowspan="2" class="th-center">Action</th>
    </tr>
    <tr class="tr-invers">
        <th class="th-center">Start</th>
        <th class="th-center">End</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Krs</td>
        <td>
            <input type="text" id="krs_start" nextElement="krs_end" name="regular" class="form-control form-tahun-akademik" readonly>
        </td>
        <td>
            <input type="text" id="krs_end" name="regular" class="form-control form-tahun-akademik form-next">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="KRS" data-load="prodi" class="btn btn-sm btn-warning btn-block more_details">Special Case</a>
        </td>
    </tr>
    <tr>
        <td>Bayar</td>
        <td>
            <input type="text" id="bayar_start" nextelement="bayar_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="bayar_end" name="regular" class="form-control form-tahun-akademik form-next">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="Bayar" data-load="prodi" class="btn btn-sm btn-warning btn-block more_details">Special Case</a>
        </td>
    </tr>
    <tr>
        <td>Kuliah</td>
        <td>
            <input type="text" id="kuliah_start" nextelement="kuliah_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="kuliah_end" name="regular" class="form-control form-tahun-akademik form-next">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="Kuliah" data-load="prodi" class="btn btn-sm btn-warning btn-block more_details">Special Case</a>
        </td>
    </tr>
    <tr>
        <td>UTS</td>
        <td>
            <input type="text" id="uts_start" nextelement="uts_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="uts_end" name="regular" class="form-control form-tahun-akademik form-next">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="UTS" data-load="prodi" class="btn btn-sm btn-warning btn-block more_details">Special Case</a>
        </td>
    </tr>
    <tr>
        <td>Input Nilai UTS</td>
        <td>
            <input type="text" id="nilaiuts_start" nextelement="nilaiuts_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="nilaiuts_end" name="regular" class="form-control form-tahun-akademik form-next">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="Input Nilai UTS" data-load="lecturer" class="btn btn-sm btn-warning btn-block more_details">Special Case</a>
        </td>
    </tr>
    <tr>
        <td>Show Nilai UTS</td>
        <td>
            <input type="text" id="show_nilai_uts" nextelement="" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>

        </td>
        <td></td>
    </tr>
    <tr>
        <td>UAS</td>
        <td>
            <input type="text" id="uas_start" nextelement="uas_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="uas_end" name="regular" class="form-control form-tahun-akademik form-next">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="UAS" data-load="prodi" class="btn btn-sm btn-warning btn-block more_details">Special Case</a>
        </td>
    </tr>
    <tr>
        <td>Input Nilai UAS</td>
        <td>
            <input type="text" id="nilaiuas_start" nextelement="nilaiuas_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="nilaiuas_end" name="regular" class="form-control form-tahun-akademik form-next">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="Input Nilai UAS" data-load="lecturer" class="btn btn-sm btn-warning btn-block more_details">Special Case</a>
        </td>
    </tr>
    <tr>
        <td>Show Nilai UAS</td>
        <td>
            <input type="text" id="show_nilai_uas" nextelement="" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Edom</td>
        <td>
            <input type="text" id="edom_start" nextelement="edom_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="edom_end" name="regular" class="form-control form-tahun-akademik form-next">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="EDOM" data-load="prodi" class="btn btn-sm btn-warning btn-block more_details">Special Case</a>
        </td>
    </tr>
    </tbody>
</table>


<script>
    $(document).ready(function () {
        window.ID = '<?php echo $ID; ?>';
        loadData(ID);
        $('.form-tahun-akademik').prop('readonly',true);
        $( "#krs_start ,#bayar_start,#kuliah_start,#edom_start," +
            "#uts_start,#show_nilai_uts,#nilaiuts_start," +
            "#uas_start,#nilaiuas_start,#show_nilai_uas" )
            .datepicker({
            showOtherMonths:true,
            autoSize: true,
            dateFormat: 'dd MM yy',
            minDate: new Date(moment().year(),moment().month(),moment().date()),
            onSelect : function () {
                var data_date = $(this).val().split(' ');
                var nextelement = $(this).attr('nextelement')
                nextDatePick(data_date,nextelement);
            }
        });
    });

    $('#btnSaveDetail').click(function () {
        // var k = $('#krs_start').datepicker("getDate");
        // log(k);
        //
        // if(k==null){
        //     alert(123)
        // }
        //
        // return false;

        var data = {
            action : 'edit',
            dataForm : {
                SemesterID : ID,
                krsStart : ($('#krs_start').datepicker("getDate")!=null) ? moment($('#krs_start').datepicker("getDate")).format('YYYY-MM-DD') : '',
                krsEnd : ($('#krs_end').datepicker("getDate")!=null) ? moment($('#krs_end').datepicker("getDate")).format('YYYY-MM-DD') : '',
                bayarStart : ($('#bayar_start').datepicker("getDate")!=null) ? moment($('#bayar_start').datepicker("getDate")).format('YYYY-MM-DD') : '',
                bayarEnd : ($('#bayar_end').datepicker("getDate")!=null) ? moment($('#bayar_end').datepicker("getDate")).format('YYYY-MM-DD') : '',
                kuliahStart : ($('#kuliah_start').datepicker("getDate")!=null) ? moment($('#kuliah_start').datepicker("getDate")).format('YYYY-MM-DD') : '',
                kuliahEnd : ($('#kuliah_end').datepicker("getDate")!=null) ? moment($('#kuliah_end').datepicker("getDate")).format('YYYY-MM-DD') : '',
                utsStart : ($('#uts_start').datepicker("getDate")!=null) ? moment($('#uts_start').datepicker("getDate")).format('YYYY-MM-DD') : '',
                utsEnd : ($('#uts_end').datepicker("getDate")!=null) ? moment($('#uts_end').datepicker("getDate")).format('YYYY-MM-DD') : '',
                utsInputNilaiStart : ($('#nilaiuts_start').datepicker("getDate")!=null) ? moment($('#nilaiuts_start').datepicker("getDate")).format('YYYY-MM-DD') : '',
                utsInputNilaiEnd : ($('#nilaiuts_end').datepicker("getDate")!=null) ? moment($('#nilaiuts_end').datepicker("getDate")).format('YYYY-MM-DD') : '',
                showNilaiUts : ($('#show_nilai_uts').datepicker("getDate")!=null) ? moment($('#show_nilai_uts').datepicker("getDate")).format('YYYY-MM-DD') : '',
                uasStart : ($('#uas_start').datepicker("getDate")!=null) ? moment($('#uas_start').datepicker("getDate")).format('YYYY-MM-DD') : '',
                uasEnd : ($('#uas_end').datepicker("getDate")!=null) ? moment($('#uas_end').datepicker("getDate")).format('YYYY-MM-DD') : '',
                uasInputNilaiStart : ($('#nilaiuas_start').datepicker("getDate")!=null) ? moment($('#nilaiuas_start').datepicker("getDate")).format('YYYY-MM-DD') : '',
                uasInputNilaiEnd : ($('#nilaiuas_end').datepicker("getDate")!=null) ? moment($('#nilaiuas_end').datepicker("getDate")).format('YYYY-MM-DD') : '',
                showNilaiUas : ($('#show_nilai_uas').datepicker("getDate")!=null) ? moment($('#show_nilai_uas').datepicker("getDate")).format('YYYY-MM-DD') : '',
                edomStart : ($('#edom_start').datepicker("getDate")!=null) ? moment($('#edom_start').datepicker("getDate")).format('YYYY-MM-DD') : '',
                edomEnd : ($('#edom_end').datepicker("getDate")!=null) ? moment($('#edom_end').datepicker("getDate")).format('YYYY-MM-DD') : ''
            }
        }

        console.log(data);

        // var krsStart = ;
        // log(krsStart);
        // log();

    });

    function loadData(ID) {
        var url = base_url_js+'api/__crudDataDetailTahunAkademik';
        var data = {
            action : 'read',
            ID : ID
        }
        var token = jwt_encode(data,'UAP)(*');
        $.post(url,{token:token}, function (data) {
            console.log(data);
            $('#nameTahunAkademik').html(data[0].Name);
        });
    }

    function nextDatePick(value,nextElement) {

        // $('#'+nextElement).prop('disabled',false);

        var data_date = value;
        var CustomMoment = moment(data_date[2]+'-'+(parseInt(convertDateMMtomm(data_date[1])) + 1)+'-'+data_date[0]).add(1,'days');
        var CustomMomentYear = CustomMoment.year();
        var CustomMomentMonth = CustomMoment.month();
        var CustomMomentDate = CustomMoment.date();

        $( "#"+nextElement ).val('');
        $( "#"+nextElement ).datepicker( "destroy" );
        $( "#"+nextElement ).datepicker({
            showOtherMonths:true,
            autoSize: true,
            dateFormat: 'dd MM yy',
            minDate: new Date(CustomMomentYear,CustomMomentMonth,CustomMomentDate)
        });
    }

</script>