<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Lecturers</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs" id="btn_addmk">
											<i class="icon-plus"></i> Add Lecturer
										</span>

                    </div>
                </div>
            </div>
            <div class="widget-content no-padding">

                <div class="table-responsive">
                    <table id="tableLecturers" class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr>
                            <th style="width: 5%;">Foto</th>
                            <th>NIP</th>
                            <th>NIDN</th>
                            <th>Name</th>
                            <th style="width: 5%;">JK</th>
                            <th>Jabatan</th>
                            <th>Prodi</th>
                            <th style="width: 5%;">Action</th>
                        </tr>
                        </thead>
                        <!--                        <tfoot>-->
                        <!--                        <tr>-->
                        <!--                            <th colspan="2">Lecturer</th>-->
                        <!--                            <th>KTP</th>-->
                        <!--                            <th>TTL</th>-->
                        <!--                            <th>Email</th>-->
                        <!--                            <th>Email PU</th>-->
                        <!--                            <th>Alamat</th>-->
                        <!--                        </tr>-->
                        <!--                        </tfoot>-->
                        <tbody id="data_lecturers">

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        load_lecturers();
    });
    function load_lecturers() {
        var url = base_url_js+'api/__getLecturer';
        var tr = $('#data_lecturers');
        $.get(url,function (data) {
            for(var i=0;i<data.length;i++){
                tr.append('<tr>'+
                    '<td><img src="<?php echo base_url('images/avatar.png'); ?>" class="img-circle" style="max-width: 30px;border: 1px solid #0f1f4b;"/></td>' +
                    '<td>'+data[i].NIP+'</td>'+
                    '<td>'+data[i].NIDN+'</td>'+
                    '<td><a href="javascript:void(0)"><b>'+data[i].TitleAhead+' '+data[i].Name+' '+data[i].TitleBehind+'</b></a></td>'+
                    '<td>'+data[i].Gender+'</td>'+
                    '<td>Jabatan</td>' +
                    '<td>Posisi</td>' +
                    '<td><div class="btn-group">' +
                    '  <button type="button" class="btn btn-default btn-default-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                    '    Action <span class="caret"></span>' +
                    '  </button>' +
                    '  <ul class="dropdown-menu">' +
                    '<li><a href="javascript:void(0)" data-id="" data-action="edit" class="btn-mk-action"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>' +
                    '<li><a href="javascript:void(0)" data-id="" data-action="delete" class="btn-mk-action"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>' +
                    '  </ul>' +
                    '</div></td>' +
                    '</tr>');
            }

            $('#tableLecturers').DataTable({
                'iDisplayLength' : 10,
                'ordering': false
            });
        });

    }
</script>