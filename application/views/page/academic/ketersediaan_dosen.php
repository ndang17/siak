
<style>
    .row-kesediaan {
        padding-top: 5px;
        padding-bottom: 5px;
    }


    .form-time {
        padding-left: 0px;
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
                                <select class="select2-select-00 col-md-12 full-width-fix" id="dataMK1">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kesediaan Hari dan Jam -->
                <div class="row row-kesediaan">
                    <label class="col-xs-3 control-label">Day</label>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-4 form-day">
                                <select class="form-control" name="DayName1[]" id="NameDay11"></select>
                            </div>
                            <div class="col-xs-3 form-time">
                                <input type="time" name="timeStart1[]" class="form-control">
                            </div>
                            <div class="col-xs-3 form-time">
                                <input type="time" name="timeEnd1[]" class="form-control">
                            </div>
                            <div class="col-xs-2 btn-action">
                                <button class="btn btn-default btn-sm addFormDay" data-elment="1"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div id="MultyDay1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="multyMK"></div>

        <div style="text-align: right;">
            <hr/>
            <button class="btn btn-default btn-default-success" id="btnAddMK">Tambah Mata Kuliah</button>
            <button class="btn btn-success" id="saveData">Save</button>
            <hr/>
        </div>

    </div>
    <div class="col-md-7">
        <div class="widget box" style="display: block;">
            <div class="widget-header">
                <h4 class="header"><i class="fa fa-arrow-right" aria-hidden="true"></i> Detail Kesediaan Dosen Mengajar</h4>

                <div class="toolbar no-padding">

                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>

                </div>


            </div>
            <div class="widget-content" id="kesediaan_dosen">

                <div class="row">

                    <div class="col-md-7">
                        <div class="thumbnail" style="min-height: 100px;">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        window.ArrnoElement = [1];
        loadSemester('form_semester');
        fillDays('NameDay11','Eng');
        fillMK('dataMK1');

        var url = base_url_js+'api/__getLecturer';
        $.get(url,function (data) {
            var option = $('#form_lecturer');
            for(var i=0; i<data.length; i++){
                option.append('<option value="'+data[i].NIP+'">'+data[i].NIP+' | '+data[i].Name+'</option>');
            }
        });

    });

    var noElement=1;
    $(document).on('click','.addFormDay',function () {
        noElement +=1;
        var dataElm = $(this).attr('data-elment');
        var rwElement = "rwDays"+noElement;
        $('#MultyDay'+dataElm).append('<div id="'+rwElement+'" class="row" style="margin-top: 10px;">' +
            '<div class="col-xs-4 form-day">' +
            '<select class="form-control" name="DayName'+dataElm+'[]" id="NameDay'+noElement+'"></select>' +
            '</div>' +
            '<div class="col-xs-3 form-time">' +
            '<input type="time"  name="timeStart'+dataElm+'[]" class="form-control">' +
            '</div>' +
            '<div class="col-xs-3 form-time">' +
            '<input type="time" name="timeEnd'+dataElm+'[]" class="form-control">' +
            '</div>' +
            '<div class="col-xs-2 btn-action">' +
            '<button class="btn btn-default btn-sm remove-days" data-element="'+rwElement+'"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>' +
            '</div></div>');
        $('#'+rwElement).animateCss('slideInDown');
        fillDays('NameDay'+noElement,'Eng');
    });

    $(document).on('click','.remove-days',function () {
        var rwElement = $(this).attr('data-element');
        $('#'+rwElement).animateCss('fadeOutUp',function () {
            $('#'+rwElement).remove();
        });

    });

    var noElmtMK = 1;
    $(document).on('click','#btnAddMK',function () {

        noElmtMK += 1;

        ArrnoElement.push(noElmtMK);

        var mk = '<div class="widget box multyMKForm animated fadeInDown" id="divMK'+noElmtMK+'">' +
            '            <div class="widget-header">' +
            '                <h4 class="header"><i class="icon-reorder"></i> Mata Kuliah</h4>' +
            '            </div>' +
            '            <div class="widget-content">' +
            '                <div class="row row-kesediaan">' +
            '                    <label class="col-xs-3 control-label">Mata Kuliah</label>' +
            '                    <div class="col-xs-9">' +
            '                        <div class="row">' +
            '                            <div class="col-xs-12">' +
            '                                <select class="select2-select-00 col-md-12 full-width-fix" id="dataMK'+noElmtMK+'"><option></option></select>' +
            '                            </div>' +
            '                        </div>' +
            '                    </div>' +
            '                </div>' +
            '                <div class="row row-kesediaan">' +
            '                    <label class="col-xs-3 control-label">Day</label>' +
            '                    <div class="col-xs-9">' +
            '                        <div class="row">' +
            '                            <div class="col-xs-4 form-day">' +
            '                                <select class="form-control" name="DayName'+noElmtMK+'[]" id="NameDay'+noElmtMK+'1"></select>' +
            '                            </div>' +
            '                            <div class="col-xs-3 form-time">' +
            '                                <input type="time" name="timeStart'+noElmtMK+'[]" class="form-control">' +
            '                            </div>' +
            '                            <div class="col-xs-3 form-time">' +
            '                                <input type="time" name="timeEnd'+noElmtMK+'[]" class="form-control">' +
            '                            </div>' +
            '                            <div class="col-xs-2 btn-action">' +
            '                                <button class="btn btn-default btn-sm addFormDay" data-elment="'+noElmtMK+'"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>' +
            '                            </div>' +
            '                        </div>' +
            '                        <div id="MultyDay'+noElmtMK+'"></div>' +
            '                    </div>' +
            '                </div>' +
            '            </div>' +
            '           <div  style="text-align: right;">' +
            '               <button class="btn btn-danger removeFormMK"  data-elment="'+noElmtMK+'">Remove</button>' +
            '           </div>' +
            '   </div>';

        $('#multyMK').append(mk);
        fillDays('NameDay'+noElmtMK+'1','Eng');
        fillMK('dataMK'+noElmtMK);
        $('#dataMK'+noElmtMK).select2({
            allowClear: true
        });

    });

    $(document).on('click','#saveData',function () {

        $('.formAddFormKD .select2-select-00, .formAddFormKD .form-control, #btnAddMK').prop('disabled',true);
        $(this).html('<i class="fa fa-refresh fa-spin fa-fw"></i> Saving...');
        setTimeout(function(){
            $('.select2-select-00').val(null).trigger('change')
            $('.formAddFormKD .select2-select-00, .formAddFormKD .form-control, #btnAddMK').prop('disabled',false);
            $('#saveData').html('Save');
            $('.multyMKForm').animateCss('slideOutLeft',function () {
                $('.multyMKForm').remove();
            });
        }, 3000);


        log(ArrnoElement);
        for(var ar=0;ar<ArrnoElement.length;ar++){
            var arr_dayName = [];
            var arr_timeStart = [];
            var arr_timeEnd = [];

            $('select[name^="DayName1"]').find(":selected").each(function() {
                arr_dayName.push($(this).val());
            });

            $('input[name^="timeStart1"]').each(function() {
                // log();
                arr_timeStart.push($(this).val());
            });

            $('input[name^="timeEnd1"]').each(function() {
                // log();
                arr_timeEnd.push($(this).val());
            });

            log(arr_dayName);
            log(arr_timeStart);
            log(arr_timeEnd);
        }


        ArrnoElement = [1];

    });

    $(document).on('click','.removeFormMK',function () {
        var noElm = $(this).attr('data-elment');


        ArrnoElement = $.grep(ArrnoElement, function(value) {
            return value != noElm;
        });


        $('#divMK'+noElm).animateCss('fadeOutUp',function () {
            $('#divMK'+noElm).remove();
        });
    });

    function fillMK(element) {
        var url = base_url_js+'api/__getAllMK';
        var option = $('#'+element);

        $.get(url,function (data) {
            for(var i=0;i<data.length;i++){
                option.append('<option>'+data[i].Code+' | '+data[i].MKCode+' - '+data[i].Name+'</option>');
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
            option.append('<option selected disabled>----- Semester -----</option>');
            for(var i=0;i<data.length;i++){
                option.append('<option value="'+data[i].ID+'">'+data[i].YearCode+' | '+data[i].Name+'</option>');
            }
            // log(data);
        });
    }

</script>