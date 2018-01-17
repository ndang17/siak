

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
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_mata_kuliah" data-toggle="tab">Mata Kuliah</a></li>
            <li><a href="#tab_grade" data-toggle="tab">Grade & Bobot</a></li>
            <li><a href="#tab_detail_kurikulum" data-toggle="tab">Detail Kurikulum</a></li>
        </ul>
        <div class="tab-content row">
            <!--=== Overview ===-->
            <div class="tab-pane active" id="tab_mata_kuliah">
                <div class="col-md-12" style="text-align: center;margin-bottom: 20px;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-default-success btn-addsmt">Add Semester</button>
                        <button type="button" class="btn btn-default btn-default-success btn-addsmt dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" id="addSmt">
                        </ul>
                    </div>
                </div>
                <div id="DataMataKuliah"></div>
            </div>
            <div class="tab-pane" id="tab_grade">
                <div class="col-md-6">
                    <div class="widget box">
                        <div class="widget-header">
                            <h4><i class="icon-reorder"></i> Grade</h4>
                        </div>
                        <div class="widget-content no-padding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="th-center">Value</th>
                                    <th class="th-center" style="width: 20%;">Start</th>
                                    <th class="th-center" style="width: 20%;">End</th>
                                </tr>
                                </thead>
                                <tbody id="dataGrade"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget box">
                        <div class="widget-header">
                            <h4><i class="icon-reorder"></i> Bobot</h4>
                        </div>
                        <div class="widget-content no-padding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="th-center">Value</th>
                                    <th class="th-center" style="width: 20%;">Start</th>
                                    <th class="th-center" style="width: 20%;">End</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_detail_kurikulum"></div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var token = "<?php echo $token; ?>";
        var url = base_url_js+"api/__getKurikulumByYear";

        $.post(url,{token:token},function (data_json) {

            if(data_json!=''){
                LoadDetailKurikulum(data_json.DetailKurikulum);
                LoadGrade(data_json.Grade);
                if(data_json.MataKuliah.length>0){
                    LoadDetailMK(data_json.MataKuliah);
                } else {
                    $('#DataMataKuliah').html('--- Mata Kuliah Belum Ditambahkan ---');
                }
            } else {
                log('Data JSON Kosong');
            }


        });
    });

    $(document).on('click','.btn-add-mksmt',function () {
       var CurriculumID = $(this).attr('data-id');
       var Semester = $(this).attr('data-smt');
    });

    function LoadDetailMK(MataKuliah) {
        var allSmt = [];
        for(var i=0;i<MataKuliah.length;i++){
            if(MataKuliah.length==8){
                $('.btn-addsmt').prop('disabled',true);
            }

            allSmt.push(parseInt(MataKuliah[i].Semester));

            $('#DataMataKuliah').append('<div class="col-md-12"> <div class="widget box">' +
                '                    <div class="widget-header">' +
                '                        <h4><i class="icon-reorder"></i> SEMESTER '+MataKuliah[i].Semester+'</h4>' +
                '<div class="toolbar no-padding">' +
                '    <div class="btn-group">' +
                '                        <span data-smt="'+MataKuliah[i].Semester+'" data-id="'+MataKuliah[i].CurriculumID+'" class="btn btn-xs btn-add-mksmt">' +
                '    <i class="icon-plus"></i> Add Mata Kuliah' +
                '     </span>' +
                '    </div>' +
                '</div>' +
                '                    </div>' +
                '                    <div class="widget-content no-padding ">' +
                '                        <table id="tableSemester'+i+'" class="table table-bordered table-striped table-smt">' +
                '                            <thead>' +
                '                            <tr>' +
                '                                <th rowspan="2" style="width:5%;">Kode MK</th>' +
                '                                <th rowspan="2">Nama MK</th>' +
                '                                <th rowspan="2">Dosen Pengampu</th>' +
                '                                <th rowspan="2">Base Prodi</th>' +
                '                                <th rowspan="2">Total SKS</th>' +
                '                                <th colspan="3">SKS</th>' +
                '                                <th rowspan="2" style="width:5%;">Action</th>' +
                '                            </tr>' +
                '                            <tr>' +
                '                                <th style="width:5%;">Teori</th>' +
                '                                <th style="width:5%;">Praktek</th>' +
                '                                <th style="width:5%;">Praktek Lapangan</th>' +
                '                            </tr>' +
                '                            </thead>' +
                '                            <tfoot>' +
                '                            <tr>' +
                '                                <th>Kode MK</th>' +
                '                                <th>Nama MK</th>' +
                '                                <th>Dosen Pengampu</th>' +
                '                                <th>Base Prodi</th>' +
                '                                <th>Total SKS</th>' +
                '                                <th>Teori</th>' +
                '                                <th>Praktek</th>' +
                '                                <th>Praktek Lapangan</th>' +
                '                                <th>Action</th>' +
                '                            </tr>' +
                '                            </tfoot>' +
                '                            <tbody id="dataSmt'+i+'"></tbody>' +
                '                        </table>' +
                '                    </div>' +
                '                </div></div>');

            var detailSemester = MataKuliah[i].DetailSemester;
            for(var s=0;s<detailSemester.length;s++){
                $('#dataSmt'+i).append('<tr>' +
                    '<td class="td-center"><div><b>'+detailSemester[s].MKCode+'</b></div></td>' +
                    '<td><div><b>'+detailSemester[s].NameMK+'</b><br/>' +
                    '<i>'+detailSemester[s].NameMKEng+'</i></div>' +
                    '</td>' +
                    '<td>'+detailSemester[s].NameLecturer+'</td>' +
                    '<td>'+detailSemester[s].ProdiName+'</td>' +
                    '<td class="td-center">'+detailSemester[s].TotalSKS+'</td>' +
                    '<td class="td-center">'+detailSemester[s].SKSTeori+'</td>' +
                    '<td class="td-center">'+detailSemester[s].SKSPraktikum+'</td>' +
                    '<td class="td-center">'+detailSemester[s].SKSPraktikLapangan+'</td>' +
                    '<td class="td-center"><div><button class="btn btn-default btn-default-success">Action</button></div></td>' +
                    '</tr>');
            }

            LoaddataTable('tableSemester'+i);
        }

        for(var i2=1;i2<=8;i2++){
            if($.inArray(i2,allSmt)==-1){
                $('#addSmt').append('<li><a href="#">Semester '+i2+'</a></li>');
            }

        }
    }

    function LoadGrade(Grade) {
        for(var i=0;i<Grade.length;i++){
            $('#dataGrade').append('<tr>' +
                '<td class="td-center">'+Grade[i].Grade+'</td>' +
                '<td class="td-center">'+Grade[i].StartRange+'</td>' +
                '<td class="td-center">'+Grade[i].EndRange+'</td>' +
                '</tr>');
        }
    }

    function LoadDetailKurikulum(DetailKurikulum) {
        $('#tab_detail_kurikulum').append('<div class="col-md-4 col-md-offset-4">' +
            '                    <table class="table table-striped">' +
            '                        <tr>' +
            '                            <td style="width: 15%;">Year</td>' +
            '                            <td style="width: 1%;">:</td>' +
            '                            <td>'+DetailKurikulum.Year+'</td>' +
            '                        </tr>' +
            '                        <tr>' +
            '                            <td>Name</td>' +
            '                            <td>:</td>' +
            '                            <td>'+DetailKurikulum.Name+'</td>' +
            '                        </tr>' +
            '                        <tr>' +
            '                            <td>CreateBy</td>' +
            '                            <td>:</td>' +
            '                            <td><b>'+DetailKurikulum.CreateByName+'</b><br/>' +
            '                                   <i>'+moment(DetailKurikulum.CreateAt).format('LLLL')+'</i>' +
            '                            </td>' +
            '                        </tr>' +
            '                        <tr>' +
            '                            <td>UpdateBy</td>' +
            '                            <td>:</td>' +
            '                            <td><b>'+DetailKurikulum.UpdateByName+'</b><br/>' +
            '                                   <i>'+moment(DetailKurikulum.UpdateAt).format('LLLL')+'</i>' +
            '                            </td>' +
            '                        </tr>' +
            '                    </table>' +
            '                </div>');
    }

    function LoaddataTable(element) {
        var table = $('#'+element).DataTable({
            'iDisplayLength' : 5,
            'ordering' : false,
            "sDom": "<'row'<'dataTables_header clearfix'<'col-md-4'l><'col-md-8'Tf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>", // T is new
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "print",
                    "csv",
                    "xls",
                    "pdf"
                ],
                "sSwfPath": "../assets/template/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf"
            },
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
                    column.data().unique().sort().each( function ( d, j ) {
                        var f = d.split('div');
                        if(f.length<=1){
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } else {
                            select.prop('disabled',true);
                            select.addClass('hide');
                        }
                    } );
                } );
            }
        });
    }
</script>