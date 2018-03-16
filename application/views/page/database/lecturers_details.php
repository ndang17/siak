
<div class="" style="margin-top: 30px;">

    <div class="col-md-12" style="margin-bottom: 15px;">
        <a href="<?php echo base_url('database/lecturers') ?>" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back to list lecturers</a>
    </div>

    <div class="col-md-12">
        <div class="tabbable tabbable-custom tabbable-full-width">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_mata_kuliah" data-toggle="tab">Biodata</a></li>
                <li class=""><a href="#tab_mata_kuliah" data-toggle="tab">Academic</a></li>
            </ul>
            <div class="tab-content row">
                <!--=== Overview ===-->
                <div class="tab-pane active" id="tab_mata_kuliah">

                    <div style="text-align: center;">
                        <div id="dataImg"></div>
                        <h3 id="dataName"></h3>
                        <hr/>
                    </div>

                    <table class="table table-bordered table-striped">
                        <tr>
                            <td style="width: 25%">NIP</td>
                            <td><span id="dataNIP"></span></td>
                        </tr>
                        <tr>
                            <td>NIDN</td>
                            <td><span id="dataNIDN"></span></td>
                        </tr>
                        <tr>
                            <td>No KTP</td>
                            <td><span id="dataKTP"></span></td>
                        </tr>

                        <tr>
                            <td>Pasport</td>
                            <td><span id="dataPasport"></span></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><span id="dataGender"></span></td>
                        </tr>
                        <tr>
                            <td>Religion</td>
                            <td><span id="dataReligian"></span></td>
                        </tr>
                        <tr>
                            <td>Place Of Birth</td>
                            <td><span id="dataPlaceOfBirth"></span></td>
                        </tr>
                        <tr>
                            <td>Date Of Birth</td>
                            <td><span id="dataDateOfBirth"></span></td>
                        </tr>
                        <tr>
                            <td>Telephone</td>
                            <td><span id="dataTelephone"></span></td>
                        </tr>
                        <tr>
                            <td>HP</td>
                            <td><span id="dataHP"></span></td>
                        </tr>
                        <tr>
                            <td>Email PU</td>
                            <td><span id="dataEmailPU"></span></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><span id="dataEmail"></span></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><span id="dataAddress"></span></td>
                        </tr>
                        <tr>
                            <td>Postal Code</td>
                            <td><span id="dataPostalCode"></span></td>
                        </tr>
                        <tr>
                            <td>Province</td>
                            <td><span id="dataProvince"></span></td>
                        </tr>
                        <tr>
                            <td>Districts</td>
                            <td><span id="dataDistricts"></span></td>
                        </tr>
                        <tr>
                            <td>Nationality</td>
                            <td><span id="dataNationality"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        loadLecturerDetails();
    });

    function loadPage() {
        var url = base_url_js;
        $.post(url,{NIP:NIP},function () {

        });
    }

    function loadLecturerDetails() {
        var url = base_url_js+'api/__crudLecturer';
        var NIP = '<?php echo $NIP; ?>';

        var token = jwt_encode({action:'read',NIP:NIP},'UAP)(*');

        $.post(url,{token:token},function (resultJson) {

            $('#dataImg').html('<img src="http://siak.podomorouniversity.ac.id/includes/foto/'+resultJson.Photo+'" class="img-thumbnail">');

            $('#dataName').html(resultJson.TitleAhead+' '+resultJson.Name+' '+resultJson.TitleBehind);

            $('#dataNIP').html(resultJson.NIP);
            $('#dataNIDN').html(resultJson.NIDN);
            $('#dataKTP').html(resultJson.KTP);
            // $('#dataPasport').html(resultJson.NIP);
            $('#dataGender').html(resultJson.Gender);
            $('#dataReligian').html(resultJson.ReligionID);
            $('#dataPlaceOfBirth').html(resultJson.PlaceOfBirth);
            $('#dataDateOfBirth').html(resultJson.DateOfBirth);
            $('#dataTelephone').html(resultJson.Phone);
            $('#dataHP').html(resultJson.HP);
            // $('#dataEmailPU').html(resultJson.HP);
            $('#dataEmail').html(resultJson.Email);
            $('#dataAddress').html(resultJson.Address);
            // $('#dataPostalCode').html(resultJson.Address);
            $('#dataProvince').html(resultJson.ProvinceID);
            // $('#dataDistricts').html(resultJson.ProvinceID);
            // $('#dataNationality').html(resultJson.ProvinceID);
        });
    }
</script>

