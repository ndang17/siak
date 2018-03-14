

<style>
    .tab-pane {
        margin-bottom: 20px;
    }
    .table-smt thead th {
        text-align: center;
    }
</style>

<div class="col-md-12">
    <div class="tabbable tabbable-custom tabbable-full-width">
        <div class="tab-content row">
            <!--=== Overview ===-->
            <div class="tab-pane active" id="tab_sma_table">

                <div id="DataSMA"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        var token = "<?php echo $token; ?>";
        var url = base_url_js+"api/__getSMAWilayah";
        window.allSmt = [];


        $.post(url,{token:token},function (data_json) {
            allSmt = [];

            if(data_json!=''){
                if(data_json.length>0){
                    //LoadDetailMK(data_json.MataKuliah);
                    LoadDataSMAWilayah(data_json);
                } else {
                    $('#DataSMA').html('--- Data SMA / SMK belum terisi ---');
                }
            } else {
                log('Data JSON Kosong');
            }


        });
    });

    function LoadDataSMAWilayah(dataJsonSMA)
    {
        var selectWilayahText = $('#selectWilayah').find(':selected').text();
        $("#DataSMA").append('' + 
                             '<div class="widget-header">'  +
                             '  <h4><i class="icon-reorder"></i> Wilayah '+ selectWilayahText +'</h4>' +
                             '  <div class="widget-content no-padding ">'+
                             '      <table id="tableSMA" class="table table-bordered table-striped table-smt">' +
                             '          <thead>'+
                             '              <tr>'+ 
                             '                  <th style="width:10px;">No</th>'+
                             '                  <th>Province</th>'+
                             '                  <th>CityName</th>'+
                             '                  <th>DistrictName</th>'+
                             '                  <th style="width:20px;">SchoolType</th>'+
                             '                  <th>SchoolName</th>'+
                             '              </tr>'+
                             '          </thead>'+
                             '          <tbody id="rowsma"></tbody>'+
                             '      </table>'+
                             '  </div>'+
                             '</div>'+
                            '');
        for (var i = 0; i < dataJsonSMA.length; i++) {
            $("#rowsma").append('' +
                                '<tr>'+
                                '   <td>'+ (parseInt(i) + 1) + '</td>'+
                                '   <td>'+ dataJsonSMA[i].ProvinceName  + '</td>'+
                                '   <td>'+ dataJsonSMA[i].CityName  + '</td>'+
                                '   <td>'+ dataJsonSMA[i].DistrictName  + '</td>'+
                                '   <td>'+ dataJsonSMA[i].SchoolType  + '</td>'+
                                '   <td>'+ dataJsonSMA[i].SchoolName  + '</td>'+
                                '</tr>'+    
                                '')
        }

        LoaddataTable();
    }

    function LoaddataTable() {
        var table = $('#tableSMA').DataTable({
            'iDisplayLength' : 5,
            'ordering' : false,
            "sDom": "<'row'<'dataTables_header clearfix'<'col-md-3'l><'col-md-9'Tf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>", // T is new
            "oTableTools": {
                "aButtons": [
                    // "copy",
                    // "print",
                    // "csv",
                    {
                        "sExtends" : "xls",
                        "sButtonText" : '<i class="fa fa-download" aria-hidden="true"></i> Excel',
                    },
                    {
                        "sExtends" : "pdf",
                        "sButtonText" : '<i class="fa fa-download" aria-hidden="true"></i> PDF',
                        "sPdfOrientation" : "landscape",
                        // "sPdfMessage" : "Daftar Seluruh Mata Kuliah"
                    }
                ],
                "sSwfPath": "../assets/template/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf"
            },
        });
    }
</script>