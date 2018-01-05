<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Matakuliah</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
											Manage <i class="icon-angle-down"></i>
										</span>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#"><i class="icon-plus"></i> Add</a></li>
                            <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget-content no-padding">

                <div class="table-responsive">
                    <table id="tableMK2" class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Nama Mata Kuliah Eng</th>
                            <th>Base Prodi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Nama Mata Kuliah Eng</th>
                            <th>Base Prodi</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach ($data_mk as $item_mk) {?>
                            <tr>
                                <td>
                                    <div><?php echo $item_mk['MKCode']; ?></div>
                                </td>
                                <td><?php echo $item_mk['Name']; ?></td>
                                <td><?php echo $item_mk['NameEng']; ?></td>
                                <td><?php echo $item_mk['Code'].' | '.$item_mk['NameProdi']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
                                            <li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var table = $('#tableMK2').DataTable({
            'iDisplayLength' : 25,
            'scrollY' : '700px',
            "ordering": true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
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
                        }
                    } );
                } );
            }
        })



    } );
</script>