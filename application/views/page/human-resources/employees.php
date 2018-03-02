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
                        <tr class="tr-center">
                            <th class="th-center" style="width: 5%;">Foto</th>
                            <th class="th-center">NIK</th>
                            <th class="th-center">Nama</th>
                            <th class="th-center">jabatan Struktural 1</th>
                            <th class="th-center">jabatan Struktural 2</th>
                            <th class="th-center" style="width: 5%;">JK</th>
                            <th class="th-center">Status Karyawan</th>
                            <th class="th-center" style="width: 5%;">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="th-center">Foto</th>
                            <th class="th-center">NIK</th>
                            <th class="th-center">Nama</th>
                            <th class="th-center">jabatan Struktural 1</th>
                            <th class="th-center">jabatan Struktural 2</th>
                            <th class="th-center">JK</th>
                            <th class="th-center">Status karyawan</th>
                            <th class="th-center">Action</th>
                        </tr>
                        </tfoot>
                        <tbody id="data_employees">

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        load_employees();
    });
    function load_employees() {
        var url = base_url_js+'api/__getEmployees';
        var tr = $('#data_employees');
        $.get(url,function (data) {
            for(var i=0;i<data.length;i++){
                var imgsrc = 'http://siak.podomorouniversity.ac.id/includes/foto/'+data[i].Photo;
                tr.append('<tr>'+
                    '<td class="td-center"><img src="'+imgsrc+'" class="img-rounded" width="30" height="30" style="max-width: 30px;object-fit: scale-down;"/></td>' +
                    '<td>'+data[i].NIK+'</td>'+
                    '<td><a href="javascript:void(0)"><b>'+data[i].Name+'
                    </b></a></td>'+
                    '<td class="td-center">'+data[i].Gender+'</td>'+
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

            $('#tablemployees').DataTable({
                'iDisplayLength' : 10,
                'ordering': false
            });


        });

    }
</script>
