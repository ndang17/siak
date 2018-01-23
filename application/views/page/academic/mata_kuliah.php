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
<!--<div class="modal fade" id="modal_mk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
<!--    <div class="modal-dialog" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
<!--                <h4 class="modal-title" id="myModalLabel">Modal title</h4>-->
<!--            </div>-->
<!--            <div class="modal-body"></div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

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

        $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">Mata Kuliah</h4>');
        // $('#GlobalModal .modal-body').html('Announcement');
        $('#GlobalModal .modal-body').html('<div class="row">' +
            '<table class="table">' +
            '<tr>' +
            '<td>Base Prodi</td>' +
            '<td>:</td>' +
            '<td>' +
            '<select class="form-control" id="FormBaseProdi"></select>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>MKCode</td>' +
            '<td>:</td>' +
            '<td>' +
            '<div class="row">' +
            '       <div class="col-sm-6"><label class="checkbox-inline">' +
            '  <input type="checkbox" id="generateMKCode" value="option1"> Genrate' +
            '</label></div>' +
            '       <div class="col-sm-6"><input id="formGenrate" class="form-control"></div> </div>' +
            '</td>' +
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
            '</table>' +
            '</div>');

        loadSelectOptionBaseProdi('#FormBaseProdi','');

        $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" class="btn btn-success" id="BtnAddMK">Add</button>');
        $('#GlobalModal').modal({
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

            $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<h4 class="modal-title">Mata Kuliah</h4>');

            $('#GlobalModal .modal-body').html('<div class="row">' +
                '<table class="table">' +
                '<tr>' +
                '<td>Base Prodi</td>' +
                '<td>:</td>' +
                '<td>' +
                '<select class="form-control form-mk" id="FormBaseProdiEdit"></select>' +
                '</td>' +
                '</tr>' +
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
                '</table>' +
                '<div id="toDel"></div>' +
                '</div>');
            loadSelectOptionBaseProdi('#FormBaseProdiEdit',valueMK.BaseProdiID+'.'+valueMK.MKCode);
            if(action=='delete') {
                $('.form-mk').prop('disabled',true);
                $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                    '<button type="button" class="btn btn-danger">Delete</button>');
                $('#toDel').html('<hr/>' +
                    '<div style="text-align: center;"> Are you sure to <span style="color:red;">Delete</span> ?? </div>');

            } else {
                $('.form-mk').prop('disabled',false);
                $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                    '<button type="button" class="btn btn-success">Save</button>');
            }
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        });
    });

    $(document).on('click','#BtnAddMK',function () {

    });

    $(document).on('change','#generateMKCode',function () {
        if($(this).is(':checked')){
            var prodi = $('#FormBaseProdi').find(':selected').val().split('.');
            var data = {
                ID : prodi[0],
                ProdiCOde : prodi[1]
            };
            var url = base_url_js+'api/__genrateMKCode';
            var token = jwt_encode(data,'UAP)(*');
            $.post(url,{token:token},function (result) {


                var MKCode = function gen (result) {
                    var url_ = base_url_js+"api/__cekMKCode";
                    var GenMKCode = prodi[1]+''+pad(result[0].TotalMK,4);
                    $.post(url_,{MKCode:GenMKCode},function (data) {

                        if(data.length>0){
                            return gen (parseInt(result) + 1);
                        } else {
                            return GenMKCode;
                        }

                    });
                }


            });

        } else {
            // alert("12");
        }
    });


    function pad(n, width, z) {
        z = z || '0';
        n = n + '';
        return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
    }

</script>