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
                    <div class="toolbar no-padding">
                        <div class="btn-group btn-grade" data-action="add">
                            <span class="btn btn-xs">
                                <strong>
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Grade
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="widget-content no-padding" id="viewGrade"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Range Credits</h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group btn-range-credit" data-action="add">
                            <span class="btn btn-xs">
                                <strong>
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Range
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="widget-content no-padding" id="viewRangeCredit"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        loadDataClassroom();
        loadGrade();
        loadRangeCredits();
    });

    // ----- Classroom --------
    $(document).on('click','.btn-classroom',function () {
        var action = $(this).attr('data-action');
        var classroom = (action=='edit' || action=='delete') ? $(this).attr('data-form').split('|') : '';
        var ID = (action=='edit' || action=='delete') ? classroom[0] : '';
        var Room = (action=='edit' || action=='delete') ? classroom[1] : '';
        var Seat = (action=='edit') ? parseInt(classroom[2]) : '';
        var SeatForExam = (action=='edit') ? parseInt(classroom[3]) : '';

        if(action=='add' || action=='edit'){
            var readonly = (action=='edit')? 'readonly' : '';
            $('#GlobalModal .modal-header').html('<h4 class="modal-title">Classroom</h4>');
            $('#GlobalModal .modal-body').html('<div class="row">' +
                '                            <div class="col-xs-4">' +
                '                                <label>Room</label>' +
                '                                <input type="text" class="form-control" value="'+Room+'" '+readonly+' style="color:#333;" id="formRoom">' +
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
                '<button type="button" id="btnDeleteClassroom" data-id="'+ID+'" class="btn btn-primary" style="margin-right: 5px;">Yes</button>' +
                '<button type="button" id="btnTidak" class="btn btn-default" data-dismiss="modal">No</button>' +
                '</div>');
            $('#NotificationModal').modal('show');
        }


    });
    $(document).on('click','#btnSaveClassroom',function () {

        var action = $(this).attr('data-action');
        var ID = $(this).attr('data-id');

        var process = true;

        var Room = $('#formRoom').val(); process = (Room=='') ? errorInput('#formRoom') : true ;
        var Seat = $('#formSeat').val(); var processSeat = (Seat!='' && $.isNumeric(Seat) && Math.floor(Seat)==Seat) ? true : errorInput('#formSeat') ;
        var SeatForExam = $('#formSeatForExam').val(); var processSeatForExam = (SeatForExam!='' && $.isNumeric(SeatForExam) && Math.floor(SeatForExam)==SeatForExam) ? true : errorInput('#formSeatForExam') ;


        if(Room!='' && processSeat && processSeatForExam){
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

            $.post(url,{token:token},function (data_result) {

                loadDataClassroom();

                setTimeout(function () {

                    if(data_result.inserID!=0) {
                        toastr.success('Data tersimpan','Success!');
                        $('#GlobalModal').modal('hide');
                        // if(action=='add'){$('#formRoom,#formSeat,#formSeatForExam').val('');}
                    } else {
                        $('#formRoom,#formSeat,#formSeatForExam,#btnCloseClassroom').prop('disabled',false);
                        $('#btnSaveClassroom').prop('disabled',false).html('Save');
                        toastr.warning('Room is exist','Warning');
                    }
                },1000);

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
            // console.log(json_result);

            if(json_result.length>0){
                $('#viewClassroom').html('<table class="table table-bordered" id="tbClassroom">' +
                    '                        <thead>' +
                    '                        <tr>' +
                    '                            <th class="th-center" style="width:5px;">No</th>' +
                    '                            <th class="th-center" style="width: ">Class</th>' +
                    '                            <th class="th-center">Seat</th>' +
                    '                            <th class="th-center">Seat For Exam</th>' +
                    '                            <th class="th-center" style="width: 110px;">Action</th>' +
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
                        '<button class="btn btn-default btn-default-success btn-classroom" data-action="edit" data-form="'+data.ID+'|'+data.Room+'|'+data.Seat+'|'+data.SeatForExam+'"><i class="fa fa-pencil" aria-hidden="true"></i></button> ' +
                        ' <button class="btn btn-default btn-default-danger btn-classroom" data-action="delete" data-form="'+data.ID+'|'+data.Room+'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>' +
                        '</td>' +
                        '</tr>');
                }

                $('#tbClassroom').DataTable({
                    "sDom": "<'row'<'dataTables_header clearfix'<'col-md-3'><'col-md-9'f>r>>t<'row'<'dataTables_footer clearfix'<'col-md-12'p>>>", // T is new
                    'bLengthChange' : false,
                    'bInfo' : false,
                    'pageLength' : 7
                });

                $('.dataTables_header .col-md-3').html('<button class="btn btn-default btn-default-primary btn-classroom" data-action="add"><i class="fa fa-plus-circle fa-right" aria-hidden="true"></i> Add Classroom</button>');
            }


        });
    }


    // ------ GRADE ------
    $(document).on('click','.btn-grade',function () {

        var action = $(this).attr('data-action');
        var formData = (action!='add') ? $(this).attr('data-form') : '';
        var ID = (action!='add') ? formData.split('|')[0] : '';
        var Grade = (action!='add') ? formData.split('|')[1] : '';
        var Score = (action=='edit') ? formData.split('|')[2] : '';
        var StartRange = (action=='edit') ? formData.split('|')[3] : '';
        var EndRange = (action=='edit') ? formData.split('|')[4] : '';
        var Description = (action=='edit') ? formData.split('|')[5] : '';
        var DescriptionEng = (action=='edit') ? formData.split('|')[6] : '';
        var Status = (action=='edit') ? formData.split('|')[7] : '';

        if(action=='add' || action=='edit'){

            var readonly = (action=='edit')? 'readonly' : '';
            $('#GlobalModal .modal-header').html('<h4 class="modal-title">Grade</h4>');
            $('#GlobalModal .modal-body').html('<div class="form-group">' +
                '    <div class="row">' +
                '        <div class="col-xs-3">' +
                '            <label>Grade</label>' +
                '            <input type="text" id="formGrade" value="'+Grade+'" '+readonly+'  style="color:#333;" class="form-control" />' +
                '        </div>' +
                '        <div class="col-xs-3">' +
                '            <label>Score</label>' +
                '            <input type="number" id="formScore" value="'+Score+'" class="form-control" />' +
                '        </div>' +
                '        <div class="col-xs-3">' +
                '            <label>Start Range</label>' +
                '            <input type="number" id="formStartRange" value="'+StartRange+'" class="form-control" />' +
                '        </div>' +
                '        <div class="col-xs-3">' +
                '            <label>End Range</label>' +
                '            <input type="number" id="formEndRange" value="'+EndRange+'" class="form-control" />' +
                '        </div>' +
                '    </div>' +
                '</div>' +
                '<div class="form-group">' +
                '    <div class="row">' +
                '        <div class="col-xs-4">' +
                '            <label>Description</label>' +
                '            <input type="text" id="formDescription" value="'+Description+'" class="form-control" />' +
                '        </div>' +
                '        <div class="col-xs-4">' +
                '            <label>Description English</label>' +
                '            <input type="text" id="formDescriptionEng" value="'+DescriptionEng+'" class="form-control" />' +
                '        </div>' +
                '        <div class="col-xs-4">' +
                '            <label>Status</label>' +
                '            <select id="formStatus" class="form-control">' +
                '                <option value="1">Lulus</option>' +
                '                <option value="0">Tidak Lulus</option>' +
                '            </select>' +
                '        </div>' +
                '    </div>' +
                '</div>');
            if(action=='edit'){$('#formStatus').val(Status);}
            $('#GlobalModal .modal-footer').html('<button type="button" id="btnCloseGrade" class="btn btn-default" data-dismiss="modal">Close</button>' +
                '<button type="button" class="btn btn-success" data-id="'+ID+'" data-action="'+action+'" id="btnSaveGrade">Save</button>');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        }
        else if (action=='delete'){
            $('#NotificationModal .modal-body').html('<div style="text-align: center;">Hapus Grade <b style="color: red;">'+Grade+'</b>  ?? | ' +
                '<button type="button" id="btnDeleteGrade" data-id="'+ID+'" class="btn btn-primary" style="margin-right: 5px;">Yes</button>' +
                '<button type="button" id="btnTidak" class="btn btn-default" data-dismiss="modal">No</button>' +
                '</div>');
            $('#NotificationModal').modal('show');
        }

    });
    $(document).on('click','#btnSaveGrade',function () {

        var process = true;

        var action = $(this).attr('data-action');
        var ID = $(this).attr('data-id');

        var Grade = $('#formGrade').val(); process = (Grade=='') ? errorInput('#formGrade') : true;
        var Score = $('#formScore').val(); process = (Score=='') ? errorInput('#formScore') : true;
        var StartRange = $('#formStartRange').val(); process = (StartRange=='') ? errorInput('#formStartRange') : true;
        var EndRange = $('#formEndRange').val(); process = (EndRange=='') ? errorInput('#formEndRange') : true;
        var Description = $('#formDescription').val(); process = (Description=='') ? errorInput('#formDescription') : true;
        var DescriptionEng = $('#formDescriptionEng').val(); process = (DescriptionEng=='') ? errorInput('#formDescriptionEng') : true;
        var Status = $('#formStatus').val();

        if(Grade!='' && Score!='' && StartRange!='' && EndRange!='' && Description!='' && DescriptionEng!=''){

            $('#formGrade,#formScore,#formStartRange,#formEndRange,#formDescription,#formDescriptionEng,#formStatus,#btnCloseGrade').prop('disabled',true);
            loading_buttonSm('#btnSaveGrade');
            loading_page('#viewGrade');
            var data = {
                action : action,
                ID : ID,
                formData : {
                    Grade : Grade,
                    Score : Score,
                    StartRange : StartRange,
                    EndRange : EndRange,
                    Description : Description,
                    DescriptionEng : DescriptionEng,
                    Status : Status,
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()
                }
            };

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+'api/__crudGrade';
            $.post(url,{token:token},function (dataResult) {

                loadGrade();
                setTimeout(function () {
                    if(dataResult.inserID==0){
                        $('#formGrade,#formScore,#formStartRange,#formEndRange,#formDescription,#formDescriptionEng,#formStatus,#btnCloseGrade').prop('disabled',false);
                        $('#btnSaveGrade').prop('disabled',false).html('Save');
                        toastr.warning('Grade Is Exist','Warning!');
                    } else {
                        toastr.success('Data Saved','Success!');
                        $('#GlobalModal').modal('hide');
                    }

                },1000);
            });
        } else {
            toastr.error('Form Required','Error!!');
        }
    });
    $(document).on('click','#btnDeleteGrade',function () {
        var ID = $(this).attr('data-id');
        var token = jwt_encode({action:'delete',ID:ID},'UAP)(*');
        var url = base_url_js+'api/__crudGrade';
        $.post(url,{token:token},function (result) {
            loadGrade();

            toastr.success('Data Deleted','Success!');
            $('#NotificationModal').modal('hide');
        });

    });
    function loadGrade() {

        var token = jwt_encode({action:'read'},'UAP)(*');
        var url = base_url_js+'api/__crudGrade';
        $.post(url,{token:token},function (result) {

            if(result.length>0){
                $('#viewGrade').html('<table class="table table-bordered table-striped" id="">' +
                    '                        <thead>' +
                    '                        <tr>' +
                    '                            <th class="th-center">Grade</th>' +
                    '                            <th class="th-center">Score</th>' +
                    '                            <th class="th-center">Start</th>' +
                    '                            <th class="th-center">End</th>' +
                    '                            <th class="th-center">Description</th>' +
                    '                            <th class="th-center" style="width: 110px;">Action</th>' +
                    '                        </tr>' +
                    '                        </thead><tbody id="trGrade"></tbody>' +
                    '                    </table>');
                var tr = $('#trGrade');
                for(var i=0;i<result.length;i++){
                    var data = result[i];
                    var colorGrade = (data.Status==1)? 'style="color:green;"' : 'style="color:red;"';
                    tr.append('<tr>' +
                        '<td class="td-center"><b '+colorGrade+'>'+data.Grade+'</b></td>' +
                        '<td class="td-center">'+data.Score+'</td>' +
                        '<td class="td-center">'+data.StartRange+'</td>' +
                        '<td class="td-center">'+data.EndRange+'</td>' +
                        '<td>' +
                        '<b>'+data.Description+'</b><br/>' +
                        '<i>'+data.DescriptionEng+'</i>' +
                        '</td>' +
                        '<td class="td-center">' +
                        '<button class="btn btn-default btn-default-success btn-grade" data-action="edit" data-form="'+data.ID+'|'+data.Grade+'|'+data.Score+'|'+data.StartRange+'|'+data.EndRange+'|'+data.Description+'|'+data.DescriptionEng+'|'+data.Status+'"><i class="fa fa-pencil" aria-hidden="true"></i></button> ' +
                        '<button class="btn btn-default btn-default-danger btn-grade" data-action="delete" data-form="'+data.ID+'|'+data.Grade+'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>' +
                        '</td>' +
                        '</tr>');
                }
            }

        });
    }

    // ----- Range Credit ----
    $(document).on('click','.btn-range-credit',function () {
        var action = $(this).attr('data-action');
        var ID = (action!='add')? $(this).attr('data-id') : '';

        if(action=='add'||action=='edit'){

            var form = (action=='edit') ? $(this).attr('data-form').split('|') : '';

            $('#GlobalModal .modal-header').html('<h4 class="modal-title">Range Credits</h4>');
            $('#GlobalModal .modal-body').html('<div class="form-group">' +
                '    <div class="row">' +
                '        <div class="col-xs-4">' +
                '            <label>IPS Start</label>' +
                '            <input type="number" class="form-control hide" hidden readonly id="formID" value="'+ID+'">' +
                '            <input type="number" class="form-control" id="formIPSStart" value="'+form[0]+'">' +
                '        </div>' +
                '        <div class="col-xs-4">' +
                '            <label>IPS End</label>' +
                '            <input type="number" class="form-control" id="formIPSEnd" value="'+form[1]+'">' +
                '        </div>' +
                '        <div class="col-xs-4">' +
                '            <label>Credit</label>' +
                '            <input type="number" class="form-control" id="formCredit" value="'+form[2]+'">' +
                '        </div>' +
                '    </div>' +
                '</div>');

            $('#GlobalModal .modal-footer').html('<button type="button" id="btnCloseRange" class="btn btn-default" data-dismiss="modal">Close</button>' +
                '<button type="button" class="btn btn-success" id="btnSaveRange" data-action="'+action+'">Save</button>');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        }
        else if(action='delete'){


            $('#NotificationModal .modal-body').html('<div style="text-align: center;">Hapus Data  ?? | ' +
                '<button type="button" id="btnDeleteRangeCredit" data-id="'+ID+'" class="btn btn-primary" style="margin-right: 5px;">Yes</button>' +
                '<button type="button" id="btnNo" class="btn btn-default" data-dismiss="modal">No</button>' +
                '</div>');
            $('#NotificationModal').modal('show');


        }
    });
    $(document).on('click','#btnSaveRange',function () {

        var process = [];
        var action = $(this).attr('data-action');

        var formID = $('#formID').val();
        var formIPSStart = $('#formIPSStart').val(); if(formIPSStart==''){process.push(0); $('#formIPSStart').css('border','1px solid red');}
        var formIPSEnd = $('#formIPSEnd').val(); if(formIPSEnd==''){process.push(0); $('#formIPSEnd').css('border','1px solid red');}
        var formCredit = $('#formCredit').val(); if(formCredit==''){process.push(0); $('#formCredit').css('border','1px solid red');}

        if($.inArray(0,process)==-1){

            loading_buttonSm('#btnSaveRange');
            $('#formIPSStart,#formIPSEnd,#formCredit,#btnCloseRange').prop('disabled',true);

            var data = {
              action : action,
                ID : formID,
                formData : {
                    IPSStart : formIPSStart,
                    IPSEnd : formIPSEnd,
                    Credit : formCredit
                }
            };

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+'api/__crudRangeCredits';
            $.post(url,{token:token},function (result) {
                if(result!=0){
                    loadRangeCredits();
                    toastr.success('Data Saved','Success');
                    setTimeout(function () {
                        $('#GlobalModal').modal('hide');
                    },1000);
                }
            });
        } else {
            toastr.error('Form Required','Error!');
            setTimeout(function () {
                $('#formIPSStart,#formIPSEnd,#formCredit').css('border','1px solid #ccc');
            },5000);
        }

    });
    $(document).on('click','#btnDeleteRangeCredit',function () {

        loading_buttonSm('#btnDeleteRangeCredit');
        $('#btnNo').prop('disabled',true);

        var ID = $(this).attr('data-id');

        var token = jwt_encode({action:'delete',ID:ID},'UAP)(*');
        var url = base_url_js+'api/__crudRangeCredits';

        $.post(url,{token:token},function (result) {
            if(result==1){
                loadRangeCredits();
                setTimeout(function () {
                    toastr.success('Data Deleted','Success!');
                    $('#NotificationModal').modal('hide');
                },1000);
            }
        });
    });
    function loadRangeCredits() {

        var token = jwt_encode({action:'read'},'UAP)(*');
        var url = base_url_js+'api/__crudRangeCredits';

        $.post(url,{token:token},function (jsonResult) {
            // console.log(jsonResult);
            if(jsonResult.length>0){
                $('#viewRangeCredit').html('<table class="table table-bordered table-striped">' +
                    '                        <thead>' +
                    '                        <tr>' +
                    '                            <th class="th-center" style="width: 5%;">No</th>' +
                    '                            <th class="th-center" style="width: 20%;">Start</th>' +
                    '                            <th class="th-center" style="width: 20%;">End</th>' +
                    '                            <th class="th-center">Credit</th>' +
                    '                            <th class="th-center" style="width: 20%;">Action</th>' +
                    '                        </tr>' +
                    '                        </thead>' +
                    '                       <tbody id="trRangeCredit"></tbody>' +
                    '                    </table>');

                var tr = $('#trRangeCredit');
                var no=1;
                for(var i=0;i<jsonResult.length;i++){
                    var data = jsonResult[i];
                    tr.append('<tr>' +
                        '<td  class="td-center">'+no+'</td>' +
                        '<td class="td-center">'+data.IPSStart+'</td>' +
                        '<td class="td-center">'+data.IPSEnd+'</td>' +
                        '<td class="td-center">'+data.Credit+'</td>' +
                        '<td class="td-center">' +
                        '<button class="btn btn-default btn-default-success btn-range-credit" data-action="edit" data-id="'+data.ID+'" data-form="'+data.IPSStart+'|'+data.IPSEnd+'|'+data.Credit+'"><i class="fa fa-pencil" aria-hidden="true"></i></button> ' +
                        '<button class="btn btn-default btn-default-danger btn-range-credit" data-action="delete" data-id="'+data.ID+'"><i class="fa fa-trash-o" aria-hidden="true"></i></button> ' +
                        '</td>' +
                        '</tr>');

                    no +=1 ;
                }
            }
        });

    }


</script>