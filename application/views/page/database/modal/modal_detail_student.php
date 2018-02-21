
<style>
    .fa {
        margin-right: 5px;
    }
    .td-parent {
        background-color: lightgoldenrodyellow !important;
    }
</style>

<div style="text-align: center;" id="headData">

</div>

<div style="margin-top: 10px;">
    <hr/>
    <h4><i class="fa fa-user fa-" aria-hidden="true"></i> Biodata</h4>
    <table class="table table-bordered table-striped">
        <tbody id="dataStudent"></tbody>
    </table>


    <hr/>
    <h4><i class="fa fa-bookmark" aria-hidden="true"></i> Academic</h4>
    <table class="table table-bordered table-striped">
        <tbody id="dataaAcademic"></tbody>
    </table>

    <hr/>
    <h4><i class="fa fa-user-secret" aria-hidden="true"></i> Data Parent</h4>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="th-center"  style="width:20%;">#</th>
            <th class="th-center" style="width:40%;">Father</th>
            <th class="th-center" style="width:40%;">Mother</th>
        </tr>
        </thead>

        <tbody id="dataParent"></tbody>
    </table>

</div>

<script>
    $(document).ready(function () {
        getData();
    });

    function getData() {
        var url = base_url_js+'api/__crudeStudent';
        var img = 'http://siak.podomorouniversity.ac.id/includes/foto';

        var token = '<?php echo $token; ?>';
        $.post(url,{token:token},function (jsonResult) {
            // console.log(jsonResult);
            var data = jsonResult[0];

            var label = '';
            if(data.StatusStudentID==7 || data.StatusStudentID==6 || data.StatusStudentID==4){
                label = 'label-danger';
            } else if(data.StatusStudentID==2){
                label = 'label-warning';
            } else if(data.StatusStudentID==3){
                label = 'label-success';
            } else if(data.StatusStudentID==1){
                label = 'label-primary';
            }

            $('#headData').html('<img src="'+img+'/'+data.Photo+'" class="img-rounded" alt="Nama Murid" style="max-width: 100px;">'+
                                '    <h4 style="margin-bottom: 5px;font-weight: bold;">'+data.Name+'</h4>' + data.NPM +' | <span class="label '+label+'">'+data.StatusStudentDesc+'</span><br/>'+
                '<i class="fa fa-google-plus-square" aria-hidden="true" style="margin-right: 0px;color: #f44336;"></i> | <span style="color:#2196f3;">'+data.EmailPU+'</span>');

            $('#dataStudent').html('<tr>' +
                '            <td style="width:115px;">Gender</td>' +
                '            <td>'+data.Gender+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Place Of Birth</td>' +
                '            <td>'+data.PlaceOfBirth+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Date Of Birth</td>' +
                '            <td>'+data.DateOfBirth+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Phone</td>' +
                '            <td>'+data.Phone+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>HP</td>' +
                '            <td>'+data.HP+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Email</td>' +
                '            <td>'+data.Email+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>EmailPU</td>' +
                '            <td>'+data.EmailPU+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Address</td>' +
                '            <td>'+data.Address+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>jacket</td>' +
                '            <td>'+data.Jacket+'</td>' +
                '        </tr>');

            $('#dataaAcademic').html('<tr>' +
                '            <td style="width:115px;">Program Study</td>' +
                '            <td>'+data.ProdiNameEng+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Programs</td>' +
                '            <td></td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Study Level</td>' +
                '            <td></td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Status</td>' +
                '            <td>'+data.StatusStudentDesc+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Lecturer</td>' +
                '            <td></td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td>Class Of</td>' +
                '            <td>'+data.ClassOf+'</td>' +
                '        </tr>');

            $('#dataParent').html('<tr>' +
                '            <td class="td-parent">Name</td>' +
                '            <td>'+data.Father+'</td>' +
                '            <td>'+data.Mother+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td class="td-parent">Status</td>' +
                '            <td>'+data.StatusFather+'</td>' +
                '            <td>'+data.StatusMother+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td class="td-parent">Education</td>' +
                '            <td>'+data.AddressFather+'</td>' +
                '            <td>'+data.AddressMother+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td class="td-parent">Occupation</td>' +
                '            <td>'+data.OccupationFather+'</td>' +
                '            <td>'+data.OccupationMother+'</td>' +
                '        </tr>' +
                '        <tr>' +
                '            <td class="td-parent">Address</td>' +
                '            <td>'+data.AddressFather+'</td>' +
                '            <td>'+data.AddressMother+'</td>' +
                '        </tr>');
        });
    }
</script>