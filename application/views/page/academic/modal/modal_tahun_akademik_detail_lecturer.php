
<style>
    .table-custom th ,.table-custom td {
        text-align: center;
    }
</style>

<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <select class="form-control input-sm form-tahun-akademik">
                <option selected disabled>Select Lecturer</option>
                <option>Budi</option>
                <option>Doremi</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" id="krs_start2" name="regular" class="form-control input-sm form-tahun-akademik" placeholder="Start">
        </div>
        <div class="col-md-4">
            <input type="text" id="krs_end2" name="regular" class="form-control input-sm form-tahun-akademik" placeholder="End">
        </div>
    </div>
</div>


<div style="text-align: right;">
    <button type="button" class="btn btn-success form-tahun-akademik">Save</button>
</div>

<hr/>
<table class="table table-bordered table-striped table-custom">
    <thead>
    <tr>
        <th>Lecturer</th>
        <th style="width: 25%;">Start</th>
        <th style="width: 25%;">End</th>
        <th style="width: 1%;">Action</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="text-align: left;">Budi</td>
        <td>9 Janury 2018</td>
        <td>9 Janury 2018</td>
        <td><button class="btn btn-sm btn-danger form-tahun-akademik"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
    </tr>
    </tbody>
</table>


<script>
    $(document).ready(function () {

        $( "#krs_start2" ).datepicker({
            showOtherMonths:true,
            autoSize: true,
            dateFormat: 'dd MM yy',
            minDate: new Date(moment().year(),moment().month(),moment().date()),
            onSelect : function () {
                var data_date = $(this).val().split(' ');
                var CustomMoment = moment(data_date[2]+'-'+(parseInt(convertDateMMtomm(data_date[1])) + 1)+'-'+data_date[0]).add(1,'days');
                var CustomMomentYear = CustomMoment.year();
                var CustomMomentMonth = CustomMoment.month();
                var CustomMomentDate = CustomMoment.date();

                $( "#krs_end2" ).val('');
                $( "#krs_end2" ).datepicker( "destroy" );
                $( "#krs_end2" ).datepicker({
                    showOtherMonths:true,
                    autoSize: true,
                    dateFormat: 'dd MM yy',
                    minDate: new Date(CustomMomentYear,CustomMomentMonth,CustomMomentDate)
                });
            }
        });


    });
</script>
