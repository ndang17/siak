<div class="" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-6">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Classroom</h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs" style="background: #083f88;color: #fff;">
                                <strong>
                                    <span id="totalRoom"></span> Room
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="widget-content no-padding" id="viewClassroom"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Grade</h4>
<!--                    <div class="toolbar no-padding">-->
<!--                        <div class="btn-group">-->
<!--                            <span class="btn btn-xs" style="background: #083f88;color: #fff;">-->
<!--                                <strong>-->
<!--                                    <span id="totalRoom"></span> Room-->
<!--                                </strong>-->
<!--                            </span>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
                <div class="widget-content no-padding">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="th-center">Start</th>
                            <th class="th-center">End</th>
                            <th class="th-center">Grade</th>
                            <th class="th-center">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        loadDataClassroom()
    });

    $(document).on('click','#btnAddClassroom,.btn-classroom',function () {
        var action = $(this).attr('data-action');
        var classroom = (action=='edit' || action=='delete') ? $(this).attr('data-form').split('|') : '';
        var ID = (action=='edit' || action=='delete') ? classroom[0] : '';
        var Room = (action=='edit' || action=='delete') ? classroom[1] : '';
        var Seat = (action=='edit') ? parseInt(classroom[2]) : '';
        var SeatForExam = (action=='edit') ? parseInt(classroom[3]) : '';

        if(action=='add' || action=='edit'){
            $('#GlobalModal .modal-header').html('<h4 class="modal-title">Add Classroom</h4>');
            $('#GlobalModal .modal-body').html('<div class="row">' +
                '                            <div class="col-xs-4">' +
                '                                <label>Room</label>' +
                '                                <input type="text" class="form-control" value="'+Room+'" id="formRoom">' +
                '                            </div>' +
                '                            <div class="col-xs-4">' +
                '                                <label>Seat</label>' +
                '                                <input type="number" class="form-control" value="'+Seat+'" id="formSeat">' +
                '                            </div>' +
                '                            <div class="col-xs-4">' +
                '                                <label>Seat For Exam</label>' +
                '                                <input type="number" class="form-control" value="'+SeatForExam+'" id="formSeatForExam">' +
                '                            </div>' +
                '                        </div>');
            $('#GlobalModal .modal-footer').html('<button type="button" id="btnCloseClassroom" class="btn btn-default" data-dismiss="modal">Close</button>' +
                '<button type="button" class="btn btn-success" data-id="'+ID+'" data-action="'+action+'" id="btnSaveClassroom">Save</button>');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        }
        else {
            $('#NotificationModal .modal-body').html('<div style="text-align: center;">Hapus <b style="color: red;">'+Room+'</b>  ?? | ' +
                '<button type="button" id="btnDeleteClassroom" data-id="'+ID+'" class="btn btn-primary" style="margin-right: 5px;">Ya</button>' +
                '<button type="button" id="btnTidak" class="btn btn-default" data-dismiss="modal">Tidak</button>' +
                '</div>');
            $('#NotificationModal').modal('show');
        }


    });
    $(document).on('click','#btnSaveClassroom',function () {

        var action = $(this).attr('data-action');
        var ID = $(this).attr('data-id');

        var process = true;

        var Room = $('#formRoom').val(); process = (Room=='') ? errorInput('#formRoom') : true ;
        var Seat = $('#formSeat').val(); process = (Seat!='' && $.isNumeric(Seat) && Math.floor(Seat)==Seat) ? true : errorInput('#formSeat') ;
        var SeatForExam = $('#formSeatForExam').val(); process = (SeatForExam!='' && $.isNumeric(SeatForExam) && Math.floor(SeatForExam)==SeatForExam) ? true : errorInput('#formSeatForExam') ;


        if(process){
            $('#formRoom,#formSeat,#formSeatForExam,#btnCloseClassroom').prop('disabled',true);
            loading_button('#btnSaveClassroom');
            loading_page('#viewClassroom');

            var data = {
                action : action,
                ID : ID,
                formData : {
                    Room : Room,
                    Seat : Seat,
                    SeatForExam : SeatForExam,
                    Status : 0,
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()
                }
            };

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+"api/__crudClassroom";

            $.post(url,{token:token},function (insertID) {

                loadDataClassroom();

                setTimeout(function () {
                    $('#formRoom,#formSeat,#formSeatForExam,#btnCloseClassroom').prop('disabled',false);
                    $('#btnSaveClassroom').prop('disabled',false).html('Save');
                    toastr.success('Data tersimpan','Success!');
                },1000);

                // $('#dataClassroom').html('<tr><td></td></tr>');
                // setTimeout(function () {
                //     loadDataClassroom();
                // },1000);
                // loadDataClassroom();
            });
        } else {
            toastr.error('Form Required','Error!');
        }
    });
    $(document).on('click','#btnDeleteClassroom',function () {
        var ID = $(this).attr('data-id');
        var token = jwt_encode({action:'delete',ID:ID},'UAP)(*');
        var url = base_url_js+"api/__crudClassroom";

        $('#btnTidak').prop('disabled',true);
        loading_buttonSm('#btnDeleteClassroom');
        $.post(url,{token:token},function () {
            loadDataClassroom();
            setTimeout(function () {
                toastr.success('Data Terhapus','Success!');
                $('#NotificationModal').modal('hide');
            });
        });
    });



    function loadDataClassroom() {
        var token = jwt_encode({action:'read'},"UAP)(*");
        var url = base_url_js+'api/__crudClassroom';
        $.post(url,{token:token},function (json_result) {
            console.log(json_result);

            $('#viewClassroom').html('<table class="table table-bordered" id="tbClassroom">' +
                '                        <thead>' +
                '                        <tr>' +
                '                            <th class="th-center" style="width:5px;">No</th>' +
                '                            <th class="th-center" style="width: ">Class</th>' +
                '                            <th class="th-center">Seat</th>' +
                '                            <th class="th-center">Seat For Exam</th>' +
                '                            <th class="th-center">Action</th>' +
                '                        </tr>' +
                '                        </thead>' +
                '                        <tbody id="dataClassroom"></tbody>' +
                '                    </table>');

            var tr = $('#dataClassroom');
            var no=1;
            for(var i=0;i<json_result.length;i++){
                var data = json_result[i];

                $('#totalRoom').text(json_result.length);
                tr.append('<tr>' +
                    '<td class="td-center">'+(no++)+'</td>' +
                    '<td class="td-center">'+data.Room+'</td>' +
                    '<td class="td-center">'+data.Seat+'</td>' +
                    '<td class="td-center">'+data.SeatForExam+'</td>' +
                    '<td class="td-center">' +
                    '<button class="btn btn-success btn-classroom" data-action="edit" data-form="'+data.ID+'|'+data.Room+'|'+data.Seat+'|'+data.SeatForExam+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> ' +
                    ' <button class="btn btn-danger btn-classroom" data-action="delete" data-form="'+data.ID+'|'+data.Room+'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>' +
                    '</td>' +
                    '</tr>');
            }

            $('#tbClassroom').DataTable({
                "sDom": "<'row'<'dataTables_header clearfix'<'col-md-3'><'col-md-9'f>r>>t<'row'<'dataTables_footer clearfix'<'col-md-12'p>>>", // T is new
                'bLengthChange' : false,
                'bInfo' : false
            });

            $('.dataTables_header .col-md-3').html('<button class="btn btn-default btn-default-primary" data-action="add" id="btnAddClassroom"><i class="fa fa-plus-circle fa-right" aria-hidden="true"></i> Add Classroom</button>');
        });
    }


</script>