
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
</style>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-5 formAddFormKD">
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
        <div class="thumbnail" style="padding: 15px;margin-bottom: 15px;">
            <!-- Nama Dosen -->
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
<!--            <button class="btn btn-default btn-default-success" id="btnAddMK">Tambah Mata Kuliah</button>-->
            <button class="btn btn-success" id="saveData">Save</button>
            <hr/>
        </div>

    </div>
    <div class="col-md-5">
        <div class="widget box widget-closed">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder" aria-hidden="true"></i> Detail Kesediaan Dosen Mengajar</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-up"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content no-padding" style="min-height: 200px;"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget box" style="display: block;">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder" aria-hidden="true"></i> Detail Kesediaan Dosen Mengajar</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs" id="addData">
											<i class="icon-plus"></i> Add Data
										</span>

                    </div>
                </div>
            </div>
            <div class="widget-content no-padding" id="detailKetersediaanDosen"></div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {

        window.arr_ElementDay = [1];
        window.noElement=1;
        loadSemester('form_semester');
        fillDays('DayName1','Eng');
        fillMK('dataMK');


        var url = base_url_js+'api/__getLecturer';
        $.get(url,function (data) {
            var option = $('#form_lecturer');
            for(var i=0; i<data.length; i++){
                option.append('<option value="'+data[i].NIP+'">'+data[i].NIP+' | '+data[i].Name+'</option>');
            }
        });

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
        fillDays('DayName'+noElement,'Eng');
        console.log(arr_ElementDay);
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

        var UpdateBy = '2017090';
        var UpdateAt = moment().format('YYYY-MM-DD HH:mm:ss');
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
                'SemesterID' : SemesterID,
                'LecturerID' : LecturerID,
                'MKID' : MKID,
                'MKCode' : MKCode,
                'UpdateBy' : UpdateBy,
                'UpdateAt' : UpdateAt
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
                var url = base_url_js+'api/__setLecturersAvailability/insert';
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
                div.html('<table id="tableDetailTahun" class="table table-bordered table-striped" xmlns="http://www.w3.org/1999/html">' +
                    '                    <thead>' +
                    '                    <tr>' +
                    '                        <th rowspan="2" style="width: 30%;">Name</th>' +
                    '                        <th rowspan="2">Mata Kuliah</th>' +
                    '                        <th rowspan="2" style="width: 10%;">Day</th>' +
                    '                        <th colspan="2">Time</th>' +
                    '                    </tr>' +
                    '                    <tr>' +
                    '                        <th style="width: 10%;">Start</th>' +
                    '                        <th style="width: 10%;">End</th>' +
                    '                    </tr>' +
                    '                    </thead>' +
                    '                    <tfoot>' +
                    '                    <tr>' +
                    '                        <th>Name</th>' +
                    '                        <th>Mata Kuliah</th>' +
                    '                        <th>Day</th>' +
                    '                        <th>Start</th>' +
                    '                        <th>End</th>' +
                    '                    </tr>' +
                    '                    </tfoot>' +
                    '                    <tbody id="TrdataDetailDosen">' +
                    '                    </tbody>' +
                    '                </table>');
                var tr = $('#TrdataDetailDosen');
                for(var i=0;i<data_json.length;i++){

                    tr.append('<tr>' +
                        '<td>'+data_json[i].LecturerName+'</td>' +
                        '<td>' +
                        '<div><b>'+data_json[i].MKName+'</b><br/><i>'+data_json[i].MKNameEng+'</i></div>' +
                        '</td>' +
                        '<td>'+day[data_json[i].DayID]+'</td>' +
                        '<td class="td-center">'+data_json[i].Start+'</td>' +
                        '<td class="td-center">'+data_json[i].End+'</td>' +
                        '</tr>');
                }

                var table = $('#tableDetailTahun').DataTable({
                    'iDisplayLength' : 10,
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
                });

            }, 2000);

        });
    }

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

    function fillMK(element) {
        var url = base_url_js+'api/__getAllMK';
        var option = $('#'+element);

        $.get(url,function (data) {
            for(var i=0;i<data.length;i++){
                option.append('<option value="'+data[i].ID+'.'+data[i].MKCode+'">'+data[i].MKCode+' | '+data[i].Code+' | '+data[i].MKCode+' - '+data[i].Name+'</option>');
            }
        });
    }

    function fillDays(element,lang) {
        var days = [];
        if(lang=='Eng'){
            days = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
        } else {
            days = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        }

        // $('#NameDay1');
        var val = 1;
        for(var i=0;i<days.length;i++){
            $('#'+element).append('<option value="'+val+'">'+days[i]+'</option>');
            val += 1;
        }
    }

    function loadSemester(element) {
        var url = base_url_js+'api/__getSemester';
        $.get(url,function (data) {
            var option = $('#'+element);
            option.append('<option value="0" selected disabled>----- Semester -----</option>');
            for(var i=0;i<data.length;i++){
                option.append('<option value="'+data[i].ID+'">'+data[i].YearCode+' | '+data[i].Name+'</option>');
            }
            // log(data);
        });
    }

</script>