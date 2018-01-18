<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Matakuliah</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs" id="btn_addmk">
											<i class="icon-plus"></i> Add Mata Kuliah
										</span>
                        <!--                        <span class="btn btn-xs dropdown-toggle" data-toggle="dropdown">-->
                        <!--											Manage <i class="icon-angle-down"></i>-->
                        <!--										</span>-->
                        <!--                        <ul class="dropdown-menu pull-right">-->
                        <!--                            <li><a href="#"><i class="icon-plus"></i> Add</a></li>-->
                        <!--                        </ul>-->
                    </div>
                </div>
            </div>
            <div class="widget-content no-padding">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div id="test"></div>
                    </div>
                </div>
                <div class="table-responsive">

                    <table id="tableMK2" class="table table-striped table-bordered table-hover table-tabletools table-responsive">
                        <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 150px">Code MK</th>
                            <th>Name</th>
                            <th>Name English</th>
                            <th>Base Prodi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach ($data_mk as $item_mk) { ?>
                            <tr>
                                <td class="td-center">
                                    <div><?php echo $no++; ?></div>
                                </td>
                                <td>
                                    <div><?php echo $item_mk['MKCode']; ?></div>
                                </td>
                                <td>
                                    <div>
                                        <a href="javascript:void(0)" data-id="<?php echo $item_mk['mkID']; ?>" data-action="edit" class="btn-mk-action" ><b><?php echo $item_mk['Name']; ?></b></a>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <i><?php echo $item_mk['NameEng']; ?></i>
                                    </div>
                                </td>

                                <td><?php echo $item_mk['Code'].' | '.$item_mk['NameProdi']; ?></td>
<!--                                <td>-->
<!--                                    <div class="btn-group">-->
<!--                                        <button type="button" class="btn btn-default btn-default-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                                            Action <span class="caret"></span>-->
<!--                                        </button>-->
<!--                                        <ul class="dropdown-menu">-->
<!--                                            <li><a href="javascript:void(0)" data-id="--><?php //echo $item_mk['mkID']; ?><!--" data-action="edit" class="btn-mk-action"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>-->
<!--                                            <li><a href="javascript:void(0)" data-id="--><?php //echo $item_mk['mkID']; ?><!--" data-action="delete" class="btn-mk-action"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                </td>-->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>


<!-- MODAL -->
<div class="modal fade" id="modal_mk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<style>
    .TableTools_collection {
        z-index : 1;
    }
</style>
<script>
    $(document).ready(function() {

        var table = $('#tableMK2').DataTable({
            'iDisplayLength' : 10,
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
                        "sPdfMessage" : "Daftar Seluruh Mata Kuliah"
                    }

                ],
                "sSwfPath": "../assets/template/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf"
            },
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control filter-prodi"><option selected disabled>--- Base Prodi ---</option><option value="">All</option></select>')
                        .appendTo( $('.dataTables_header .col-md-9') )
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
                            select.remove();
                            // select.addClass('hide');
                        }
                    } );
                } );
            }

        });



    } );

    $('#btn_addmk').click(function () {

        $('#modal_mk .modal-title').text('Mata Kuliah');
        $('#modal_mk .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-success">Add</button>');
        $('#modal_mk .modal-body').html('<div class="row">' +
            '<table class="table">' +
            '<tr>' +
            '<td>MKCode</td>' +
            '<td>:</td>' +
            '<td><input class="form-control"></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Name (Indo)</td>' +
            '<td>:</td>' +
            '<td><input class="form-control"></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Name (Eng)</td>' +
            '<td>:</td>' +
            '<td><input class="form-control"></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Base Prodi</td>' +
            '<td>:</td>' +
            '<td>' +
            '<select class="form-control" id="FormBaseProdi"></select>' +
            '</td>' +
            '</tr>' +
            '</table>' +
            '</div>');

        OptionBaseProdi('FormBaseProdi',false);
        $('#modal_mk').modal({
            'show' : true,
            'backdrop' : 'static'
        });


    });

    $(document).on('click','.btn-mk-action',function () {
        var action = $(this).attr('data-action');
        var idMK = $(this).attr('data-id');
        var url = base_url_js+'api/__getMKByID';
        $.post(url,{idMK:idMK},function (data) {
            var valueMK = data[0];

            $('#modal_mk .modal-title').text('Mata Kuliah');

            $('#modal_mk .modal-body').html('<div class="row">' +
                '<table class="table">' +
                '<tr>' +
                '<td>MKCode</td>' +
                '<td>:</td>' +
                '<td><input class="form-control form-mk" value="'+valueMK.MKCode+'"></td>' +
                '</tr>' +
                '<tr>' +
                '<td>Name (Indo)</td>' +
                '<td>:</td>' +
                '<td><input class="form-control form-mk" value="'+valueMK.Name+'"></td>' +
                '</tr>' +
                '<tr>' +
                '<td>Name (Eng)</td>' +
                '<td>:</td>' +
                '<td><input class="form-control form-mk" value="'+valueMK.NameEng+'"></td>' +
                '</tr>' +
                '<tr>' +
                '<td>Base Prodi</td>' +
                '<td>:</td>' +
                '<td>' +
                '<select class="form-control form-mk" id="FormBaseProdiEdit"></select>' +
                '</td>' +
                '</tr>' +
                '</table>' +
                '<div id="toDel"></div>' +
                '</div>');
            OptionBaseProdi('FormBaseProdiEdit',valueMK.BaseProdiID);
            if(action=='delete') {
                $('.form-mk').prop('disabled',true);
                $('#modal_mk .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                    '<button type="button" class="btn btn-danger">Delete</button>');
                $('#toDel').html('<hr/>' +
                    '<div style="text-align: center;"> Are you sure to <span style="color:red;">Delete</span> ?? </div>');

            } else {
                $('.form-mk').prop('disabled',false);
                $('#modal_mk .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                    '<button type="button" class="btn btn-success">Save</button>');
            }
            $('#modal_mk').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        });
    });


    function OptionBaseProdi(element,selected) {
        var url = base_url_js+'api/__getBaseProdi';
        $.get(url,function (data) {
            var OptionFormBaseProdi = $('#'+element);
            OptionFormBaseProdi.html('');
            if(selected==false){
                OptionFormBaseProdi.append('<option disabled selected>--------- Base Prodi ---------</option>');
            }

            for(var i=0;i<data.length;i++){
                var selc = (data[i].ID==selected) ? 'selected' : '';
                OptionFormBaseProdi.append('<option value="'+data[i].ID+'" '+selc+'>'+data[i].Name+'</option>');

            }
        });
    }
</script>