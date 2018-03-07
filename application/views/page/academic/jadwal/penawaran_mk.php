
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
                // console.log(jsonResult);
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
        var data = {
            action : 'read',
            formData : {
                SemesterID : SemesterID,
                ProdiID : ProdiID
            }
        };
        var token = jwt_encode(data,'UAP)(*');

        $.post(url,{token:token},function (jsonResult) {
            // console.log(jsonResult);
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
                    tr.append('<tr>' +
                        '<td class="td-center">'+(no++)+'</td>' +
                        '<td class="td-center">'+_data.MKCode+'</td>' +
                        '<td><b>'+_data.MKName+'</b><br/><i>'+_data.MKNameEng+'</i></td>' +
                        '<td class="td-center">'+_data.Semester+'</td>' +
                        '<td class="td-center">'+_data.TotalSKS+'</td>' +
                        '<td class="td-center">'+label+'</td>' +
                        '<td class="td-center"><button class="btn btn-default btn-default-danger">Remove Offer</button></td>' +
                        '</tr>');
                }

                var table = $('#tbData'+i).DataTable({
                    'iDisplayLength' : 5
                });
            }
        });
    }



</script>