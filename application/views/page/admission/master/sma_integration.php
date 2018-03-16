<style>
    .row-sma {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .form-time {
        padding-left: 0px;
        padding-right: 0px;
    }
    .row-sma .fa-plus-circle {
        color: green;
    }
    .row-sma .fa-minus-circle {
        color: red;
    }
    .btn-action {

        text-align: right;
    }

    #tableDetailTahun thead th {
        text-align: center;
    }

    .form-filter {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #ccc;
    }
    .filter-time {
        padding-left: 0px;
    }
</style>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-10 formAddFormKD">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder"></i> Integration dari <a href="http://jendela.data.kemdikbud.go.id/api/index.php/Csekolah/detailSekolahGET?mst_kode_wilayah=010100">http://jendela.data.kemdikbud.go.id</a></h4>
            </div>
            <div class="widget-content">
                <!--  -->
                <div class="row row-sma">
                    <label class="col-xs-3 control-label">Please Submit</label>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-inverse btn-notification" id="btn-sbmt">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <strong>Note : </strong><br>
                Data yang diintegrasikan adalah Data Wilayah,Data SMA dan Data SMK
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    window.jsonData = [];
    
    $(document).ready(function () {
        $("#btn-sbmt").click(function(){
            loading_button('#btn-sbmt');
            loadIntegration();
        })
    });

    function loadIntegration()
    {
        var url_wilayah = "http://jendela.data.kemdikbud.go.id/api/index.php/cwilayah/wilayahKabGet";
        //proses wilayah dulu
            $.get(url_wilayah,function (data_json) {
                jsonData = data_json
            }).done(function () {
                saveWilayahtoDB(jsonData);
            });
    }

    function saveWilayahtoDB(jsonData)  
    {   
        var url = base_url_js+'api/__insertWilayahURLJson';
        $.post(url,{data : jsonData},function (argument) {
            jsonData = argument;
        }).always(function() {
            getSchool(jsonData);
        });
    }

    function getSchool(jsonData)
    {
        var kode_wilayah = "";
        for (var i = 0; i < jsonData.length; i++) {
            kode_wilayah = jsonData[i].trim();
            var url_sekolah ="http://jendela.data.kemdikbud.go.id/api/index.php/Csekolah/detailSekolahGET?mst_kode_wilayah=" + kode_wilayah +"&bentuk=sma";
            //var url_sekolah ="http://jendela.data.kemdikbud.go.id/api/index.php/Csekolah/detailSekolahGET?mst_kode_wilayah=" + kode_wilayah;
            $.get(url_sekolah,function (data_json) {
                saveSchooltoDB(data_json);
                /*if (i == (jsonData.length - 2)) {
                    $('#btn-sbmt').prop('disabled',false).html('Submit');
                }*/
                
            })
        }

        for (var i = 0; i < jsonData.length; i++) {
            kode_wilayah = jsonData[i].trim();
            var url_sekolah ="http://jendela.data.kemdikbud.go.id/api/index.php/Csekolah/detailSekolahGET?mst_kode_wilayah=" + kode_wilayah +"&bentuk=smk";
            //var url_sekolah ="http://jendela.data.kemdikbud.go.id/api/index.php/Csekolah/detailSekolahGET?mst_kode_wilayah=" + kode_wilayah;
            $.get(url_sekolah,function (data_json) {
                saveSchooltoDB(data_json);
                /*if (i == (jsonData.length - 2)) {
                    $('#btn-sbmt').prop('disabled',false).html('Submit');
                }*/
            })
        }
        setTimeout(function () {
            $('#btn-sbmt').prop('disabled',false).html('Submit');
        },200000);
    }

    function saveSchooltoDB(data_json)
    {
        var url = base_url_js+'api/__insertSchoolURLJson';
        $.post(url,{data : data_json},function (argument) {
            jsonData = argument;
        })
    }  
</script>