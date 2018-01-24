
<style>
    .row-kesediaan {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .form-time {
        padding-left: 0px;
        padding-right: 0px;
    }
    .row-kesediaan .fa-plus-circle {
        color: green;
    }
    .row-kesediaan .fa-minus-circle {
        color: red;
    }
    .btn-action {

        text-align: right;
    }

    #tableDetailTahun thead th {
        text-align: center;
    }

    .form-filter {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #ccc;
    }
    .filter-time {
        padding-left: 0px;
    }
</style>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-10 formAddFormKD">
        <div class="thumbnail" style="padding: 15px;margin-bottom: 15px;background: lightyellow;">
            <div class="row">
                <label class="col-xs-3 control-label">
                    Tahun Akademik
                </label>
                <div class="col-xs-9">
                    <select class="form-control" id="form_semester"></select>
                </div>
            </div>
        </div>
        <hr/>
        <div class="collapse" id="collapseDataAdd">
            <div class="well">
                <div class="row">
                    <label class="col-xs-3 control-label">Name</label>
                    <div class="col-xs-9">
                        <div class="form-group">
                            <select id="form_lecturer" class="select2-select-00 col-md-12 full-width-fix">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="widget box">
                    <div class="widget-header">
                        <h4 class="header"><i class="icon-reorder"></i> Mata Kuliah</h4>
                    </div>
                    <div class="widget-content">
                        <!-- Kesediaan Mata Kuliah -->
                        <div class="row row-kesediaan">
                            <label class="col-xs-3 control-label">Mata Kuliah</label>
                            <div class="col-xs-9">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <select class="select2-select-00 col-md-12 full-width-fix" id="dataMK">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kesediaan Hari dan Jam -->
                        <div class="row row-kesediaan">
                            <!--                    <label class="col-xs-3 control-label">Day</label>-->
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-4 form-day">
                                        <select class="form-control" id="DayName1" ></select>
                                    </div>
                                    <div class="col-xs-3 form-time">
                                        <input type="time" id="timeStart1" class="form-control">
                                    </div>
                                    <div class="col-xs-3 form-time">
                                        <input type="time" id="timeEnd1" class="form-control">
                                    </div>
                                    <div class="col-xs-2 btn-action">
                                        <button class="btn btn-default btn-sm addFormDay" data-elment="1"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <div id="MultyDay"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="text-align: right;">
                    <hr/>
                    <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseDataAdd" aria-expanded="false" aria-controls="collapseExample">Cencle</button>
                    <button class="btn btn-success" id="saveData">Save</button>
                    <hr/>
                </div>
            </div>
        </div>





    </div>
    <div class="col-md-2">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseDataAdd" aria-expanded="false" aria-controls="collapseExample">Add data</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget box" id="boxDetail" style="display: block;">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder" aria-hidden="true"></i> Detail Kesediaan Dosen Mengajar</h4>
            </div>
            <div class="widget-content no-padding">
                <div id="detailKetersediaanDosen"></div>

            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {

        window.arr_ElementDay = [1];
        window.noElement=1;
        loadSemester('form_semester');
        fillDays('#DayName1','Eng','');
        loadSelectOptionAllMataKuliah('#dataMK');
        loadSelectOptionLecturersSingle('#form_lecturer','');

    });

    $(document).on('click','.addFormDay',function () {
        noElement +=1;

        arr_ElementDay.push(noElement);

        $('#MultyDay').append('<div id="rwDays'+noElement+'" class="row" style="margin-top: 10px;">' +
            '<div class="col-xs-4 form-day">' +
            '<select class="form-control" id="DayName'+noElement+'"></select>' +
            '</div>' +
            '<div class="col-xs-3 form-time">' +
            '<input type="time"  id="timeStart'+noElement+'" class="form-control">' +
            '</div>' +
            '<div class="col-xs-3 form-time">' +
            '<input type="time" id="timeEnd'+noElement+'" class="form-control">' +
            '</div>' +
            '<div class="col-xs-2 btn-action">' +
            '<button class="btn btn-default btn-sm remove-days" data-element="'+noElement+'"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>' +
            '</div></div>');
        $('#rwDays'+noElement).animateCss('slideInDown');
        fillDays('#DayName'+noElement,'Eng','');
    });

    $(document).on('click','.remove-days',function () {
        var rwElement = $(this).attr('data-element');
        $('#rwDays'+rwElement).animateCss('fadeOutUp',function () {
            $('#rwDays'+rwElement).remove();
            arr_ElementDay = $.grep(arr_ElementDay, function(value) {
                return value != rwElement;
            });
        });

    });



    $(document).on('click','#saveData',function () {

        var UpdateBy = sessionNIP;
        var UpdateAt = dateTimeNow();
        var SemesterID = $('#form_semester').find(":selected").val();
        var LecturerID = $('#form_lecturer').find(":selected").val();
        var data_mk = $('#dataMK').find(":selected").val().split('.');
        var MKID = $.trim(data_mk[0]);
        var MKCode = $.trim(data_mk[1]);

        if(SemesterID==0){
            // alert('');
            toastr.error('Form Required', 'Select Semester');
        } else if (LecturerID==''){
            toastr.error('Form Required', 'Select Lecturer');
        } else if(data_mk==''){
            toastr.error('Form Required', 'Select Mata Kuliah');
        } else {

            var data = {
                action : 'add',
                dataForm : {
                    SemesterID : SemesterID,
                    LecturerID : LecturerID,
                    MKID : MKID,
                    MKCode : MKCode,
                    UpdateBy : UpdateBy,
                    UpdateAt : UpdateAt
                }

            };

            //Cek data time
            var lanjut = true;
            for(var i=0;i<arr_ElementDay.length;i++){
                var DayID = $('#DayName'+arr_ElementDay[i]).find(":selected").val();
                var tStart = $('#timeStart'+arr_ElementDay[i]).val();
                var tEnd = $('#timeEnd'+arr_ElementDay[i]).val();
                if(tStart=='' || tEnd=='' || DayID==''){
                    lanjut = false;
                    toastr.error('Form Required', 'Please Set Time Start / End');
                    break;
                } else if(tStart>=tEnd){
                    lanjut = false;
                    toastr.error('Form Required', 'Please Set Time End > Start');
                    break;
                }
            }

            if(lanjut==true){
                $('.formAddFormKD .select2-select-00, .formAddFormKD .form-control, #btnAddMK').prop('disabled',true);
                $(this).html('<i class="fa fa-refresh fa-spin fa-fw"></i> Saving...');
                setTimeout(function(){
                    $('.select2-select-00').val(null).trigger('change');
                    $('.formAddFormKD .select2-select-00, .formAddFormKD .form-control, #btnAddMK').prop('disabled',false);
                    $('.formAddFormKD .select2-select-00, .formAddFormKD .form-control, #btnAddMK').val('');
                    $('#saveData').html('Save');
                }, 3000);

                // Insert MK
                var token = jwt_encode(data,'UAP)(*');
                var url = base_url_js+'api/__setLecturersAvailability';
                $.post(url,{ token : token },function (insert_id) {
                    LecturerDetail(insert_id);
                });
            }



        }



    });

    $('#form_semester').change(function () {
        var year = $(this).find(":selected").val();
        page_detailDosen(year);
    });
    $(document).on('change','#form_semester1',function () {
        var year = $(this).find(":selected").val();
        page_detailDosen(year);
    });


    function page_detailDosen(ID) {
        loading_page('#detailKetersediaanDosen');
        var day = {
            1 : 'Monday',
            2 : 'Tuesday',
            3 : 'Wednesday',
            4 : 'Thrusday',
            5 : 'Friday',
        };

        var url = base_url_js+"api/__changeTahunAkademik";
        var data = {
            ID : ID
        }
        var token = jwt_encode(data,'UAP)(*');
        $.post(url,{token:token},function (data_json) {

            var div = $('#detailKetersediaanDosen');

            setTimeout(function(){

                if(data_json.length>0){
                    div.html('<table id="tableDetailTahun" class="table table-bordered table-striped">' +
                        '                    <thead>' +
                        '                    <tr>' +
                        '                        <th rowspan="2" style="width: 20%;">Name</th>' +
                        '                        <th rowspan="2">Mata Kuliah</th>' +
                        '                        <th rowspan="2" style="width: 5%;">Day</th>' +
                        '                        <th colspan="2">Time</th>' +
                        '                        <th rowspan="2" style="width: 5%;">Action</th>' +
                        '                    </tr>' +
                        '                    <tr>' +
                        '                        <th style="width: 10%;">Start</th>' +
                        '                        <th style="width: 10%;">End</th>' +
                        '                    </tr>' +
                        '                    </thead>' +
                        '                    <tbody id="TrdataDetailDosen">' +
                        '                    </tbody>' +
                        '                </table>');
                    var tr = $('#TrdataDetailDosen');
                    for(var i=0;i<data_json.length;i++){

                        var st = data_json[i].Start.split(':');
                        var en = data_json[i].End.split(':');

                        tr.append('<tr>' +
                            '<td>'+data_json[i].LecturerName+'</td>' +
                            '<td>'+data_json[i].MKName+'</td>' +
                            '<td>'+day[data_json[i].DayID]+'</td>' +
                            '<td class="td-center">'+moment().hour(st[0]).minute(st[1]).second(st[2]).format('hh:mm A')+'</td>' +
                            '<td class="td-center">'+moment().hour(en[0]).minute(en[1]).second(en[2]).format('hh:mm A')+'</td>' +
                            '<td class="td-center"><div>' +
                            '<button class="btn btn-default btn-default-success btn-sm btn-action" data-id="'+data_json[i].ID+'"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>' +
                            '</div></td>' +
                            '</tr>');
                    }

                    var table = $('#tableDetailTahun').DataTable({
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
                                    // "sPdfMessage" : "Daftar Seluruh Mata Kuliah"
                                }
                            ],
                            "sSwfPath": "../assets/template/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf"
                        },

                        initComplete: function () {
                            var no=1;
                            this.api().columns().every( function () {
                                var column = this;

                                var grid = '';
                                var filterBy = '';
                                if(no==1){
                                    filterBy = '--- Lecturer ---';
                                    grid = 'col-md-3';
                                } else if(no==2){
                                    filterBy = '--- Mata Kuliah ---';
                                    grid = 'col-md-5'
                                } else if(no==3){
                                    filterBy = '--- Date ---';
                                    grid = 'col-md-2';
                                } else if(no==4){
                                    filterBy = 'Start';
                                    grid = 'col-md-1 filter-time';
                                } else if (no==5) {
                                    filterBy = 'End';
                                    grid = 'col-md-1 filter-time';
                                }
                                $('#boxDetail .dataTables_header').append('<div class="'+grid+' form-filter" id="filter'+no+'"></div>');
                                // $('#filter2').append('<div class="col-md-2"></div>');
                                var select = $('<select class="form-control" ><option selected disabled>'+filterBy+'</option><option value="">All</option></select>')
                                // .appendTo( $(column.footer()).empty() )
                                    .appendTo( $('#filter'+no) )
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
                                        $('#filter'+no).remove();
                                    }
                                } );
                                no++;
                            } );
                        }
                    });

                } else {
                    div.html('<div class="col-md-12" style="text-align: center;"><h3>Data Empty</h3></div>')
                }


            }, 2000);

        });
    }

    $(document).on('click','.btn-action',function (html) {
        var ID = $(this).attr('data-id');
        var url = base_url_js+'academic/ModalKetersediaanDosen';


        $.post(url,{ID:ID},function (html) {

            $('#GlobalModal .modal-header').html('<h4 class="modal-title">Ketersediaan Dosen</h4>');
            $('#GlobalModal .modal-body').html(html);
            $('#GlobalModal .modal-footer').html('<button type="button" id="modalBtnClose" class="btn btn-default" data-dismiss="modal">Close</button>' +
                '<button type="button" id="modalBtnEdit" class="btn btn-success">Save</button>' +
                '<button type="button" id="modalBtnDelete" class="btn btn-danger" style="float: left;">Delete</button>' +
                '');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });

        });



    });

    function LecturerDetail(insert_id) {

        var url_detail = base_url_js+'api/__setLecturersAvailabilityDetail/insert';

        for(var i=0;i<arr_ElementDay.length;i++){
            var DayID = $('#DayName'+arr_ElementDay[i]).find(":selected").val();
            var tStart = $('#timeStart'+arr_ElementDay[i]).val();
            var tEnd = $('#timeEnd'+arr_ElementDay[i]).val();

            var data_detail = {
                'LecturersAvailabilityID' : insert_id,
                'DayID' : DayID,
                'Start' : tStart,
                'End' : tEnd
            }

            var token_detail = jwt_encode(data_detail,'UAP)(*');
            $.post(url_detail,{token:token_detail},function () {

            });


        }
        // noElement = 1;
        // arr_ElementDay = [1];


    }

    function loadSemester(element) {
        var url = base_url_js+'api/__getSemester';
        $.get(url,function (data) {
            var option = $('#'+element);
            option.append('<option value="0" selected disabled>----- Semester -----</option>');
            for(var i=0;i<data.length;i++){
                option.append('<option value="'+data[i].ID+'">'+data[i].YearCode+' | '+data[i].Name+'</option>');
            }

        });
    }

</script>