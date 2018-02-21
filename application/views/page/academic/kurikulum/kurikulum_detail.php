

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
<!--                <div class="col-md-12" style="text-align: center;margin-bottom: 20px;">-->
<!--                    <div class="btn-group">-->
<!--                        <button type="button" class="btn btn-default btn-default-success btn-addsmt">Add Semester</button>-->
<!--                        <button type="button" class="btn btn-default btn-default-success btn-addsmt dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                            <span class="caret"></span>-->
<!--                            <span class="sr-only">Toggle Dropdown</span>-->
<!--                        </button>-->
<!--                        <ul class="dropdown-menu" id="addSmt">-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
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
        window.allSmt = [];


        $.post(url,{token:token},function (data_json) {
            allSmt = [];

            console.log(data_json);

            if(data_json!=''){
                LoadDetailKurikulum(data_json.DetailKurikulum);
                LoadGrade(data_json.Grade);
                if(data_json.MataKuliah.length>0){
                    LoadDetailMK(data_json.MataKuliah);
                } else {
                    $('#DataMataKuliah').html('--- Mata Kuliah Belum Ditambahkan ---');
                }
                loadSemesterAdd();
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

        for(var i=0;i<MataKuliah.length;i++){
            if(MataKuliah.length==8){
                $('.btn-addsmt').prop('disabled',true);
            } else {
                $('.btn-addsmt').prop('disabled',false);
            }

            allSmt.push(parseInt(MataKuliah[i].Semester));

            $('#DataMataKuliah').append('<div class="col-md-12"> <div class="widget box">' +
                '                    <div class="widget-header" id="widgetSmt'+i+'">' +
                '                        <h4><i class="icon-reorder"></i> SEMESTER '+MataKuliah[i].Semester+'</h4>' +
                '<div class="toolbar no-padding">' +
                '    <div class="btn-group">' +
                '                        <span data-smt="'+MataKuliah[i].Semester+'" class="btn btn-xs btn-add-mksmt">' +
                '    <i class="icon-plus"></i> Add Mata Kuliah' +
                '     </span>' +
                '    </div>' +
                '</div>' +
                '                    </div>' +
                '                    <div class="widget-content no-padding ">' +
                '                        <table id="tableSemester'+i+'" class="table table-bordered table-striped table-smt">' +
                '                            <thead>' +
                '                            <tr>' +
                '                                <th rowspan="2" style="width:80px;">No</th>' +
                '                                <th rowspan="2" style="width:150px;">Kode MK</th>' +
                '                                <th rowspan="2">Nama MK</th>' +
                '                                <th rowspan="2">Dosen Pengampu</th>' +
                '                                <th rowspan="2">Base Prodi</th>' +
                '                                <th rowspan="2">Total SKS</th>' +
                '                                <th colspan="3">SKS</th>' +
                '                            </tr>' +
                '                            <tr>' +
                '                                <th style="width:80px;">T</th>' +
                '                                <th style="width:80px;">P</th>' +
                '                                <th style="width:80px;">PKL</th>' +
                '                            </tr>' +
                '                            </thead>' +
                '                            <tbody id="dataSmt'+i+'"></tbody>' +
                '                        </table>' +
                '                    </div>' +
                '                </div></div>');

            var detailSemester = MataKuliah[i].DetailSemester;
            var no=1;
            for(var s=0;s<detailSemester.length;s++){
                $('#dataSmt'+i).append('<tr>' +
                    '<td class="td-center">'+(no++)+'</td>' +
                    '<td class="td-center">'+detailSemester[s].MKCode+'</td>' +
                    '<td><div><a href="javascript:void(0)" class="detailMataKuliah" data-smt="'+MataKuliah[i].Semester+'" data-id="'+detailSemester[s].CDID+'"><b>'+detailSemester[s].NameMKEng+'</b></a>' +
                    '</td>' +
                    '<td><div>'+detailSemester[s].NameLecturer+'</td>' +
                    '<td>'+detailSemester[s].ProdiName+'</td>' +
                    '<td class="td-center"><div>'+detailSemester[s].TotalSKS+'</div></td>' +
                    '<td class="td-center"><div>'+detailSemester[s].SKSTeori+'</div></td>' +
                    '<td class="td-center"><div>'+detailSemester[s].SKSPraktikum+'</div></td>' +
                    '<td class="td-center"><div>'+detailSemester[s].SKSPraktikLapangan+'</div></td>' +
                    '</tr>');
            }

            LoaddataTable(i);
        }


    }


    function loadSemesterAdd() {

        $('#addSmt').empty();
        for(var i2=1;i2<=8;i2++){
            if($.inArray(i2,allSmt)==-1){
                $('#addSmt').append('<li><a href="javascript:void(0)" data-smt="'+i2+'" data-action="add-semester" class="btn-control">Semester '+i2+'</a></li>');
            }

        }
        $('.btn-addsmt').prop('disabled',false);
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
        var table = $('#tableSemester'+element).DataTable({
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
            // initComplete: function () {
            //     var elm = '#widgetSmt'+element;
            //     console.log(elm);
            //     this.api().columns().every( function () {
            //
            //         var column = this;
            //         var select = $('<select class="form-control filter-prodi"><option value=""></option></select>')
            //             .appendTo( $('#widgetSmt0 .dataTables_header .col-md-9'))
            //             .on( 'change', function () {
            //                 var val = $.fn.dataTable.util.escapeRegex(
            //                     $(this).val()
            //                 );
            //
            //                 column
            //                     .search( val ? '^'+val+'$' : '', true, false )
            //                     .draw();
            //             } );
            //         column.data().unique().sort().each( function ( d, j ) {
            //             var f = d.split('div');
            //             if(f.length<=1){
            //                 select.append( '<option value="'+d+'">'+d+'</option>' )
            //             } else {
            //                 select.remove();
            //             }
            //         } );
            //     } );
            // }
        });
    }
</script>