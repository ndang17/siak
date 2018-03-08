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
                <h4 class="header"><i class="icon-reorder"></i> Integration</h4>
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
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    window.jsonData = [];
    
    $(document).ready(function () {
        $("#btn-sbmt").click(function(){
            loadIntegration();
        })
    });

    function loadIntegration()
    {
        var url_wilayah = "http://jendela.data.kemdikbud.go.id/api/index.php/cwilayah/wilayahKabGet";
        var url_sekolah ="http://jendela.data.kemdikbud.go.id/api/index.php/Csekolah/detailSekolahGET?mst_kode_wilayah=010100&bentuk=sma";
        //proses wilayah dulu
            $.get(url_wilayah,function (data_json) {
                jsonData = data_json
            }).done(function () {
                saveWilayahtoDB(jsonData);
            });
        //proses sekolah dulu
                

    }

    function saveWilayahtoDB(jsonData)  
    {   

        loading_button('#btn-sbmt');
        var url = base_url_js+'api/__getWilayahURLJson';

        $.post(url,{data : jsonData},function (argument) {
            console.log('success');

        })  .done(function() {
            $('#btn-sbmt').prop('disabled',false).html('Submit');
                /*setTimeout(function (argument) {
                    $('#btn-sbmt').prop('disabled',false).html('Submit');
                },10000);*/
        });

    }  
</script>