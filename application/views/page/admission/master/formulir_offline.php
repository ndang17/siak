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
    <div class="col-md-12 formAddFormKD">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder"></i> Formulir Offline</h4>
            </div>
            <div class="widget-content">
                <!--  -->
                <div class="row row-sma">
                    <label class="col-xs-3 control-label">Tahun</label>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-4">
                                <select class="select2-select-00 col-md-4 full-width-fix" id="selectTahun">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-inverse btn-notification" id="generate">Generate Formulir Code</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr/>
            <div id="pageData">
                
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        loadTahun();
        loadNumberFormulir();
    });

    $(document).on('click','#generate', function () {
       var selectTahun = $("#selectTahun").val();
       processGenerate(selectTahun);
    });

    $(document).on('change','#selectTahun',function () {
        loadNumberFormulir();
    });

    function processGenerate(tahun)
    {
        loading_button('#generate');
        var url = base_url_js+'admission/master-registration/GenerateFormulirOffline';
        var data = {
            selectTahun : tahun
        };
        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{token:token},function (data_json) {
            setTimeout(function () {
             loadNumberFormulir();
             $('#generate').prop('disabled',false).html('Generate Formulir Code');  
            },2000);
        });
    }

    function loadTahun()
    {
        var startTahun = 2018;
        var thisYear = (new Date()).getFullYear();
        var selisih = parseInt(thisYear) - parseInt(startTahun);
        for (var i = 0; i <= selisih; i++) {
            var selected = (i==0) ? 'selected' : '';
            $('#selectTahun').append('<option value="'+ ( parseInt(startTahun) + parseInt(i) ) +'" '+selected+'>'+( parseInt(startTahun) + parseInt(i) )+'</option>');
        }
        $('#selectTahun').select2({
          // allowClear: true
        });
    }

    function loadNumberFormulir()
    {
        $("#pageData").empty();
        loading_page('#pageData');
        var selectTahun = $("#selectTahun").val();
        var url = base_url_js+'admission/master-registration/loadDataFormulirOffline';
        var data = {
            selectTahun : selectTahun
        };
        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{token:token},function (data_json) {
            setTimeout(function () {
               $("#pageData").html(data_json);
            },1000);
        });
    }
</script>