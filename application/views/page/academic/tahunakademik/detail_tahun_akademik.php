
<a href="<?php echo base_url('academic/tahun-akademik'); ?>" class="btn btn-info"><i class="fa fa-arrow-circle-left right-margin" aria-hidden="true"></i> Back</a>

<hr/>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Keterangan</th>
        <th>Start</th>
        <th>End</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Krs</td>
        <td>
            <input type="text" id="krs_start" nextElement="krs_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="krs_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="KRS" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
        </td>
    </tr>
    <tr>
        <td>Bayar</td>
        <td>
            <input type="text" id="bayar_start" nextelement="bayar_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="bayar_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="Bayar" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
        </td>
    </tr>
    <tr>
        <td>Kuliah</td>
        <td>
            <input type="text" id="kuliah_start" nextelement="kuliah_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="kuliah_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="Kuliah" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
        </td>
    </tr>
    <tr>
        <td>Edom</td>
        <td>
            <input type="text" id="edom_start" nextelement="edom_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="edom_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="EDOM" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
        </td>
    </tr>
    <tr>
        <td>UTS</td>
        <td>
            <input type="text" id="uts_start" nextelement="uts_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="uts_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="UTS" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
        </td>
    </tr>
    <tr>
        <td>Input Nilai UTS</td>
        <td>
            <input type="text" id="nilaiuts_start" nextelement="nilaiuts_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="nilaiuts_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="Input Nilai UTS" data-load="lecturer" class="btn btn-sm btn-info btn-block more_details">More details</a>
        </td>
    </tr>
    <tr>
        <td>Show Nilai UTS</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>UAS</td>
        <td>
            <input type="text" id="uas_start" nextelement="uas_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="uas_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="UAS" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
        </td>
    </tr>
    <tr>
        <td>Input Nilai UAS</td>
        <td>
            <input type="text" id="nilaiuas_start" nextelement="nilaiuas_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <input type="text" id="nilaiuas_end" name="regular" class="form-control form-tahun-akademik">
        </td>
        <td>
            <a href="javascript:void(0);" data-head="Input Nilai UAS" data-load="lecturer" class="btn btn-sm btn-info btn-block more_details">More details</a>
        </td>
    </tr>
    <tr>
        <td>Show Nilai UAS</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $( "#krs_start ,#bayar_start,#kuliah_start,#edom_start,#uts_start,#nilaiuts_start,#uas_start,#nilaiuas_start" ).datepicker({
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

    function nextDatePick(value,nextElement) {
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