
<style>
    .left-box, .right-box {
        width: 47% !important;
    }
</style>

<div class="row" style="margin-top: 30px;">
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
                            <input type="text" id="box1Filter" class="form-control box-filter" placeholder="Filter entries..."><button type="button" id="box1Clear" class="filter">x</button>
                            <select id="box1View" multiple="multiple" class="multiple">
                            </select>
                            <span id="box1Counter" class="count-label"></span>
                            <select id="box1Storage"></select>
                        </div>
                        <!--left-box -->

                        <!-- Control buttons -->
                        <div class="dual-control">
                            <button id="to2" type="button" class="btn btn-default btn-default-success"><i class="fa fa-step-forward" aria-hidden="true"></i></button>
<!--                            <button id="allTo2" type="button" class="btn btn-default btn-default-success"><i class="fa fa-fast-forward" aria-hidden="true"></i></button>-->
                            <hr/>
                            <button id="to1" type="button" class="btn btn-default btn-default-danger"><i class="fa fa-step-backward" aria-hidden="true"></i></button>
<!--                            <button id="allTo1" type="button" class="btn btn-default btn-default-danger"><i class="fa fa-fast-backward" aria-hidden="true"></i></button>-->
                        </div>
                        <!--control buttons -->

                        <!-- Right box -->
                        <div class="right-box">
                            <input type="text" id="box2Filter" class="form-control box-filter" placeholder="Filter entries..."><button type="button" id="box2Clear" class="filter">x</button>
                            <select id="box2View" multiple="multiple" class="multiple"></select>
                            <span id="box2Counter" class="count-label"></span>
                            <select id="box2Storage"></select>
                        </div>
                        <!--right box -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4" style="text-align: right;">
                        <hr/>
                        <div class="row">
                            <div class="col-xs-8">
                                <select class="form-control" id="formProdi">
                                    <option value="" disabled selected>--- Select Program Study ---</option>
                                    <option disabled>------------------------------------------</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-success btn-block" id="btnSaveMK">Save</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12" style="margin-bottom: 30px;">
        <hr/>
        <h3>List Course Offerings</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="th-center" style="width: 1%;">No</th>
                <th class="th-center" style="width: 15%;">Prodi</th>
                <th class="th-center">Course</th>
                <th class="th-center" style="width: 5%;">Smt</th>
                <th class="th-center" style="width: 5%;">Cdt</th>
                <th class="th-center" style="width: 15%;">Action</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        App.init(); // Init layout and core plugins
        Plugins.init(); // Init all plugins
        FormComponents.init(); // Init all form-specific plugins

        getSemesterActive();
        loadSelectOptionBaseProdi('#formProdi','');
    });

    $('#btnSaveMK').click(function () {
        var dataID = $('#box2View').find('option').map(function() { return this.value }).get().join(",");
        var arrID = dataID.split(',');
        var SemesterID = $('#formSemesterID').val();
        var ProdiID = $('#formProdi').val();

        if(ProdiID!=null && arrID.length>0){
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
            });
        } else {
            toastr.error('Form Required','Error!');
        }





    });


    function getSemesterActive() {
        var url = base_url_js+'api/__crudSemester';
        var token = jwt_encode({action:'ReadSemesterActiove'},'UAP)(*');
        $.post(url,{token:token},function (jsonResult) {
            var SemesterActive = jsonResult.SemesterActive;
            $('#textSemester').text(SemesterActive.Name);
            $('#formSemesterID').val(SemesterActive.ID);

            for(var i=0;i<jsonResult.DetailCourses.length;i++){
                var Courses = jsonResult.DetailCourses[i];
                $('#box1View').append('<option value="'+Courses.CurriculumDetailID+'">Smt '+Courses.Semester+' - '+Courses.ProdiCode+' | '+Courses.MKNameEng+' (Credit : '+Courses.TotalSKS+')</option>');
            }

        });
    }


</script>