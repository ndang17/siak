<div style="margin-top: 30px;">
    <table id="tableMK2" class="table table-striped table-hover table-bordered table-tabletools table-responsive">
        <thead>
        <tr>
            <th class="th-center" style="width: 15px;">No</th>
            <th class="th-center" style="width: 40px">Photo</th>
            <th class="th-center">NPM</th>
            <th class="th-center">Name</th>
            <th class="th-center">Class Of</th>
            <th class="th-center">Prodi</th>
            <th class="th-center" style="width: 50px;">Status</th>
        </tr>
        </thead>
        <tbody id="dataStudent"></tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        loadDataStudentds();
    });

    function loadDataStudentds() {
        var url = base_url_js+'api/__getAllStudents';
        $.getJSON(url,function (data_json) {
            console.log(data_json);
            var tr = $('#dataStudent');
            var no=1;
            var url_foto_student = 'http://siak.podomorouniversity.ac.id/includes/foto/';
            for(var i=0;i<data_json.length;i++){
                var data_stdn = data_json[i];

                for(var s=0;s<data_stdn.DataStudents.length;s++){
                    var std = data_stdn.DataStudents[s];
                    var label = '';
                    if(std.StatusStudentID==7 || std.StatusStudentID==6 || std.StatusStudentID==4){
                        label = 'label-danger';
                    } else if(std.StatusStudentID==2){
                        label = 'label-warning';
                    } else if(std.StatusStudentID==3){
                        label = 'label-success';
                    } else if(std.StatusStudentID==1){
                        label = 'label-primary';
                    }


                    tr.append('<tr>' +
                        '<td class="td-center"><div>'+(no++)+'</div></td>' +
                        '<td class="td-center"><div><img src="'+url_foto_student+''+std.Photo+'"  class="img-rounded" width="30" height="30" style="max-width: 30px;object-fit: scale-down;"></div></td>' +
                        '<td class="td-center"><div><a href="javascript:void(0);" class="btnPortalStudent">'+std.NPM+'</a></div></td>' +
                        '<td><div><a href="javascript:void(0);" data-npm="'+std.NPM+'" data-ta="'+std.ClassOf+'" class="btnDetailStudent"><b>'+std.Name+'</b></a></div></td>' +
                        '<td class="td-center">'+std.ClassOf+'</td>' +
                        '<td class="td-center">'+std.ProdiNameEng+'</td>' +
                        '<td class="td-center"><span class="label '+label+'">'+std.StatusStudentDesc+'</span></td>' +
                        '</tr>');
                }
            }

            var table = $('#tableMK2').DataTable({
                'iDisplayLength' : 10,
                "sDom": "<'row'<'dataTables_header clearfix'<'col-md-3'l><'col-md-9'Tf>r>>t<'row'<'dataTables_header clearfix'<'col-md-1'><'col-md-11'>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>", // T is new
                "oTableTools": {
                    "aButtons": [
                        {
                            "sExtends" : "xls",
                            "sButtonText" : '<i class="fa fa-download" aria-hidden="true"></i> Excel',
                        },
                        {
                            "sExtends" : "pdf",
                            "sButtonText" : '<i class="fa fa-download" aria-hidden="true"></i> PDF',
                            "sPdfOrientation" : "landscape",
                            "sPdfMessage" : "Daftar Seluruh Mata Kuliah"
                        }

                    ],
                    "sSwfPath": "../assets/template/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf"
                },
                initComplete: function () {
                    // $('.dataTables_header').append('<div class="col-md-12"><div class="row"></div></div>');
                    $('.dataTables_header .col-md-11').css('padding-right','5px');
                    var nodiv = 1;
                    this.api().columns().every( function () {
                        var column = this;
                        var desc = '';
                        if(nodiv==7){
                            desc = '--- Status ---';
                        } else if(nodiv==5){
                            desc = '--- Class Of ---';
                        } else if(nodiv==6){
                            desc = '--- Base Prodi ---';
                        }
                        var select = $('<select class="form-control filter-prodi" style="width: 150px;"><option selected disabled>'+desc+'</option><option value="">All</option></select>')
                            .prependTo( $('.dataTables_header .col-md-11') )
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
                                if(nodiv==7){
                                    // console.log($(d).text());
                                    var d2 = $(d).text();
                                    select.append( '<option value="'+d2+'">'+d2+'</option>' );
                                } else {
                                    select.append( '<option value="'+d+'">'+d+'</option>' );
                                }

                            } else {
                                select.remove();
                                // select.addClass('hide');
                            }
                        } );
                        nodiv++;
                    } );
                }

            });
        });
    }

    $(document).on('click','.btnDetailStudent',function () {
        var ta = $(this).attr('data-ta');
        var NPM = $(this).attr('data-npm');

        // var url = base_url_js+'api/__crudeStudent';
        var url = base_url_js+'database/showStudent';
        var data = {
            action : 'read',
            formData : {
                ta : ta,
                NPM : NPM
            }
        };

        var token = jwt_encode(data,'UAP)(*');
        $.post(url,{token:token},function (html) {
            // console.log(jsonResult);
            //
            $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<h4 class="modal-title">Detail Mahasiswa</h4>');
            $('#GlobalModal .modal-body').html(html);
            $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        });


    });
</script>