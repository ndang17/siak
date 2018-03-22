
<style>
    .left-box, .right-box {
        width: 46% !important;
    }
</style>


<div class="row" style="margin-bottom: 15px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="thumbnail">
            <select class="form-control form-offer" id="formProdi">
                <option value="" disabled selected>--- Select Program Study ---</option>
                <option disabled>------------------------------------------</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Semester <span id="textSemester"></span></h4>
                <input id="formSemesterID" type="hide" class="hide" readonly>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Left box -->
                        <div class="left-box">
                            <input type="text" id="box1Filter" class="form-control box-filter form-offer" placeholder="Filter entries..."><button type="button" id="box1Clear" class="filter">x</button>
                            <select id="box1View" multiple="multiple" class="multiple form-offer">
                            </select>
                            <span id="box1Counter" class="count-label"></span>
                            <select id="box1Storage" class="form-offer"></select>
                        </div>
                        <!--left-box -->

                        <!-- Control buttons -->
                        <div class="dual-control">
                            <button id="to2" type="button" class="btn btn-default btn-default-success form-offer"><i class="fa fa-step-forward" aria-hidden="true"></i></button>
<!--                            <button id="allTo2" type="button" class="btn btn-default btn-default-success"><i class="fa fa-fast-forward" aria-hidden="true"></i></button>-->
                            <hr/>
                            <button id="to1" type="button" class="btn btn-default btn-default-danger form-offer"><i class="fa fa-step-backward" aria-hidden="true"></i></button>
<!--                            <button id="allTo1" type="button" class="btn btn-default btn-default-danger"><i class="fa fa-fast-backward" aria-hidden="true"></i></button>-->
                        </div>
                        <!--control buttons -->

                        <!-- Right box -->
                        <div class="right-box">
                            <input type="text" id="box2Filter" class="form-control box-filter form-offer" placeholder="Filter entries..."><button type="button" id="box2Clear" class="filter">x</button>
                            <select id="box2View" multiple="multiple" class="multiple form-offer"></select>
                            <span id="box2Counter" class="count-label"></span>
                            <select id="box2Storage" class="form-offer"></select>
                        </div>
                        <!--right box -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>Offerings To Semester</h4>
                        <div class="well">
                            <div id="formOfferingsToSemester"></div>
                        </div>
                        <div style="padding-left: 20px;">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="formCheckSmesterAll" value="" checked> <b>All Semester</b>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: right;">
                        <hr/>
                        <button class="btn btn-success form-offer" id="btnSaveMK">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12" style="margin-bottom: 30px;">
        <hr/>
        <h3>List Course Offerings</h3>

<!--        <div class="thumbnail">-->
<!--            <div id="listProdi">-->
<!--                <label class="checkbox-inline" style="font-weight: bold;color: blue;">-->
<!--                    <input type="checkbox" class="checkProdi" value="All"> All-->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->

        <div class="row" id="dataOfferings"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        App.init(); // Init layout and core plugins
        Plugins.init(); // Init all plugins
        FormComponents.init(); // Init all form-specific plugins
        loadSelectOptionBaseProdi('#formProdi','');
        getOfferingsToSemester();

        window.formSemester = [];
        window.formSemesterEdit = [];
        // getSemesterActive();

    });


    $(document).on('change','#formProdi',function () {
        var ProdiID = $(this).val();
        getSemesterActive(ProdiID)
    });

    $('#btnSaveMK').click(function () {
        var dataID = $('#box2View').find('option').map(function() { return this.value }).get().join(",");
        var arrID = dataID.split(',');
        var SemesterID = $('#formSemesterID').val();
        var ProdiID = $('#formProdi').val();

        if(dataID!='' && ProdiID!=null && arrID.length>0){

            var formData = [];
            for(var i=0;i<arrID.length;i++){
                var datainsert = {
                    SemesterID : SemesterID,
                    ProdiID : ProdiID,
                    CurriculumDetailID : arrID[i],
                    ToSemester : JSON.stringify(formSemester.sort()),
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()
                };

                formData.push(datainsert);
            }

            var data = {
                action : 'add',
                formData : formData
            };

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+'api/__crudCourseOfferings';
            $.post(url,{token:token},function (jsonResult) {

                $('.form-offer').prop('disabled',true);
                loading_button('#btnSaveMK');
                toastr.success('Data Saved','Success!');
                setTimeout(function () {
                    $('.form-offer').prop('disabled',false);
                    $('#btnSaveMK').html('Save');
                },1000);

                getSemesterActive(ProdiID);
            });
        } else {
            toastr.error('Form Required','Error!');
        }

    });

    $(document).on('click','.btn-semester-offer',function () {
        var ID = $(this).attr('data-id');
        var Prodi = $(this).attr('data-prodi');
        var Smt = $(this).attr('data-smt');

        var SmtArr = Smt.split(',');



        formSemesterEdit = (Smt!='') ? SmtArr.sort() : [];
        var sAll = (Smt!='') ? '' : 'checked';

        var url = base_url_js+'api/__crudSemester';
        var token = jwt_encode({action:'read',order:'ASC'},'UAP)(*');
        $.post(url,{token:token},function (jsonResult) {



            $('#NotificationModal .modal-body').html('<div id="smt"></div>' +
                '<hr/>' +
                '<div style="text-align: right;">' +
                '<label class="checkbox-inline" style="margin-right: 15px;">' +
                '  <input type="checkbox" id="formCheckSmesterAllEdit" value="" '+sAll+'> All Semester' +
                '</label>'+
                '<button class="btn btn-success" data-id="'+ID+'" data-prodi="'+Prodi+'" id="btnSaveSemesterEdit">Save</button> <button id="btnCloseSemesterEdit" data-dismiss="modal" class="btn btn-default">Close</button></div>');

            var semester = 1;
            for(var i=0;i<jsonResult.length;i++){

                var s = ($.inArray(""+semester,SmtArr)!=-1) ? 'checked' : '';
                $('#smt').append('<label class="checkbox-inline">' +
                    '  <input type="checkbox" class="check-smt-edit" value="'+semester+'" '+s+'> Semester '+semester+' ' +
                    '</label>');

                semester += 1;
            }

            $('#NotificationModal').modal('show');
        });


    });

    $(document).on('change','.check-smt-edit',function () {
        var v = $(this).val();

        if($(this).is(':checked')){
            formSemesterEdit.push(v);
        } else {
            formSemesterEdit = $.grep(formSemesterEdit, function(value) {
                return value != v;
            });
        }

        if(formSemesterEdit.length==0){
            $('#formCheckSmesterAllEdit').prop('checked',true);
        } else {
            $('#formCheckSmesterAllEdit').prop('checked',false);
        }

        formSemesterEdit.sort();

    });

    $(document).on('change','#formCheckSmesterAllEdit',function () {
        if($(this).is(':checked')){
            formSemesterEdit = [];
            $('.check-smt-edit').prop('checked',false);
        } else {
            if(formSemesterEdit.length==0){
                $('#formCheckSmesterAllEdit').prop('checked',true);
            } else {
                $('#formCheckSmesterAllEdit').prop('checked',false);
            }
        }
    });

    $(document).on('click','#btnSaveSemesterEdit',function () {

        var ID = $(this).attr('data-id');
        var Prodi = $(this).attr('data-prodi');

        var data = {
            action : 'editSemester',
            ID : ID,
            ToSemester : JSON.stringify(formSemesterEdit)
        };

        loading_buttonSm('#btnSaveSemesterEdit');
        $('#btnCloseSemesterEdit').prop('disabled',true);

        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+'api/__crudCourseOfferings';
        $.post(url,{token:token},function (result) {
            getSemesterActive(Prodi);
            setTimeout(function () { $('#NotificationModal').modal('hide'); },1000);
        });


    });

    $(document).on('change','.check-smt',function () {
        var v = $(this).val();

        if($(this).is(':checked')){
            formSemester.push(v);
        } else {
            formSemester = $.grep(formSemester, function(value) {
                return value != v;
            });
        }

        if(formSemester.length==0){
            $('#formCheckSmesterAll').prop('checked',true);
        } else {
            $('#formCheckSmesterAll').prop('checked',false);
        }

        formSemester.sort();

    });

    $('#formCheckSmesterAll').change(function () {

        if($(this).is(':checked')){
            formSemester = [];
            $('.check-smt').prop('checked',false);
        } else {
            if(formSemester.length==0){
                $('#formCheckSmesterAll').prop('checked',true);
            } else {
                $('#formCheckSmesterAll').prop('checked',false);
            }
        }


    });

    $(document).on('click','.btn-delete-offer',function () {

        // Cek Apakah Offering sudah di set jadwal atau belum
        var ID = $(this).attr('data-id');
        var Prodi = $(this).attr('data-prodi');
        var SemesterID = $('#formSemesterID').val();
        var Course = $(this).attr('data-mk').split('|');

        var data = {
            action : 'checkCourse',
            dataWhere : {
                SemesterID : SemesterID,
                MKID : Course[0],
                MKCode : Course[1]
            }

        };

        var url = base_url_js+'api/__crudCourseOfferings';
        var token = jwt_encode(data,'UAP)(*');

        $.post(url,{token:token},function (result) {
            if(result==0){
                $('#NotificationModal .modal-body').html('<div style="text-align: center;color: red;"><h4><strong>Courses Are Scheduled</strong></h4>' +
                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                    '</div>');
            } else {
                $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Delete Offerings ?? </b> ' +
                    '<button type="button" id="btnDeleteOfferYes" data-id="'+ID+'" data-prodi="'+Prodi+'" class="btn btn-primary" style="margin-right: 5px;">Yes</button> ' +
                    '<button type="button" id="btnDeleteOfferNo" class="btn btn-default" data-dismiss="modal">No</button>' +
                    '</div>');
            }


            $('#NotificationModal').modal('show');
        });

    });

    $(document).on('click','#btnDeleteOfferYes',function () {

        var ID = $(this).attr('data-id');
        var Prodi = $(this).attr('data-prodi');
        var token = jwt_encode({action:'delete',ID:ID},"UAP)(*");
        var url = base_url_js+'api/__crudCourseOfferings';

        loading_buttonSm('#btnDeleteOfferYes');
        $('#btnDeleteOfferNo').prop('disabled',true);

        $.post(url,{token:token},function (result) {
            toastr.success('Data Deleted','Success');
            getSemesterActive(Prodi);
            setTimeout(function () {
                $('#NotificationModal').modal('hide');
            },1000);
        });

    });

    function getSemesterActive(ProdiID) {
        var url = base_url_js+'api/__crudSemester';
        var data = {
          action : 'ReadSemesterActive',
          formData : {
              ProdiID : ProdiID
          }
        };
        var token = jwt_encode(data,'UAP)(*');
        $.post(url,{token:token},function (jsonResult) {
            var SemesterActive = jsonResult.SemesterActive;
            $('#textSemester').text(SemesterActive.Name);
            $('#formSemesterID').val(SemesterActive.ID);

            getListCourseOfferings(ProdiID);
            $('#box1View,#box1Storage,#box2View,#box2Storage').empty();
            for(var i=0;i<jsonResult.DetailCourses.length;i++){
                var Courses = jsonResult.DetailCourses[i];
                var color = (Courses.StatusMK==1) ? 'green' : 'red';
                var status = (Courses.StatusMK==1) ? '' : 'disabled';
                var type = (Courses.MKType==1) ? '*' : '';
                $('#box1View').append('<option value="'+Courses.CurriculumDetailID+'" style="color: '+color+';" '+status+'>Smt '+Courses.Semester+' - '+Courses.ProdiCode+' | '+Courses.MKNameEng+' (Credit : '+Courses.TotalSKS+')'+type+'</option>');
            }

        });
    }

    function getListCourseOfferings(ProdiID) {
        var url = base_url_js+'api/__crudCourseOfferings';
        var SemesterID = $('#formSemesterID').val();

        var Prodi = (ProdiID.split('.').length>0) ? ProdiID.split('.')[0] : ProdiID;

        var data = {
            action : 'read',
            formData : {
                SemesterID : SemesterID,
                ProdiID : Prodi
            }
        };
        var token = jwt_encode(data,'UAP)(*');

        $.post(url,{token:token},function (jsonResult) {

            $('#dataOfferings').empty();

            for(var i=0;i<jsonResult.length;i++){
                var data = jsonResult[i];

                $('#listProdi').append('<label class="checkbox-inline">' +
                    '  <input type="checkbox" class="checkProdi" value="'+data.Prodi.ID+'"> '+data.Prodi.NameEng+
                    '</label>');

                $('#dataOfferings').append('<div class="col-md-12"><h3><span class="label label-primary" style="font-size: 15px;">'+data.Prodi.NameEng+'</span></h3>' +
                    '        <table id="tbData'+i+'" class="table table-bordered table-striped">' +
                    '            <thead>' +
                    '            <tr>' +
                    '                <th class="th-center" style="width: 1%;">No</th>' +
                    '                <th class="th-center" style="width: 5%;">Code</th>' +
                    '                <th class="th-center">Course</th>' +
                    '                <th class="th-center" style="width: 15%;">Offerings To Semester</th>' +
                    '                <th class="th-center" style="width: 5%;">Semester</th>' +
                    '                <th class="th-center" style="width: 5%;">Credit</th>' +
                    '                <th class="th-center" style="width: 5%;">Type</th>' +
                    '                <th class="th-center" style="width: 15%;">Action</th>' +
                    '            </tr>' +
                    '            </thead>' +
                    '<tbody id="trData'+i+'"></tbody>' +
                    '        </table><hr/></div>');

                var Offerings = data.Offerings;
                var tr = $('#trData'+i);
                var no=1;
                for(var s=0;s<Offerings.length;s++){
                    var _data = Offerings[s];
                    var label = (_data.MKType=='1') ? '<span class="label label-success">Required</span>' : '<span class="label label-danger">Optional</span>';

                    var smt = JSON.parse(_data.ToSemester);
                    var smt__ = '';
                    var dataSmt = '';
                    if(smt.length>0){
                        for(var i=0;i<smt.length;i++){
                            // var k = (i!=(smt.length - 1)) ? '' : ', ';
                            var k = (i!=0) ? ', ':'';
                            // var k2 = (i!=0) ? ',':'';


                            smt__ = smt__+''+k+'Smt '+smt[i];
                            dataSmt = dataSmt+''+k.trim()+''+smt[i]
                        }
                    } else {
                        smt__ = 'All Semester';
                    }


                    var btnDelete = (_data.ScheduleID!=null) ? 'Courses Are Scheduled'
                        : '<button class="btn btn-default btn-default-danger btn-delete-offer" data-id="'+_data.ID+'" data-prodi="'+ProdiID+'" data-mk="'+_data.MKID+'|'+_data.MKCode+'">Remove Offer</button>' ;


                    tr.append('<tr>' +
                        '<td class="td-center">'+(no++)+'</td>' +
                        '<td class="td-center">'+_data.MKCode+'</td>' +
                        '<td><b>'+_data.MKName+'</b><br/><i>'+_data.MKNameEng+'</i></td>' +
                        '<td class="td-center"> '+smt__+' ' +
                        // ' '+_data.ToSemester+' ' +
                        '<br/><a href="javascript:void(0)" class="btn-semester-offer" data-id="'+_data.ID+'" data-prodi="'+ProdiID+'" data-smt="'+dataSmt+'" style="float: right;"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a> </td>' +
                        '<td class="td-center">'+_data.Semester+'</td>' +
                        '<td class="td-center">'+_data.TotalSKS+'</td>' +
                        '<td class="td-center">'+label+'</td>' +
                        '<td class="td-center">'+btnDelete+'</td>' +
                        '</tr>');
                }

                var table = $('#tbData'+i).DataTable({
                    'iDisplayLength' : 5
                });
            }

        });
    }

    function getOfferingsToSemester() {
        var smt = $('#formOfferingsToSemester');
        var url = base_url_js+'api/__crudSemester';
        var token = jwt_encode({action:'read',order:'ASC'},'UAP)(*');
        var semester = 1;
        $.post(url,{token:token},function (jsonResult) {
            console.log(jsonResult);
           for(var i=0;i<jsonResult.length;i++){
               smt.append('<label class="checkbox-inline">' +
                   '  <input type="checkbox" class="check-smt" value="'+semester+'"> Semester '+semester+' ' +
                   '</label>');

               semester += 1;
           }
        });
    }



</script>