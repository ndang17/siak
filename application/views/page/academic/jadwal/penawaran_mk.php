
<style>
    .left-box, .right-box {
        width: 46% !important;
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
                            <button id="allTo2" type="button" class="btn btn-default btn-default-success"><i class="fa fa-fast-forward" aria-hidden="true"></i></button>
                            <hr/>
                            <button id="to1" type="button" class="btn btn-default btn-default-danger"><i class="fa fa-step-backward" aria-hidden="true"></i></button>
                            <button id="allTo1" type="button" class="btn btn-default btn-default-danger"><i class="fa fa-fast-backward" aria-hidden="true"></i></button>
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
        var box2Storage = $('#box2View').find('option').map(function() { return this.value }).get().join(",");
        console.log(box2Storage);
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
                $('#box1View').append('<option value="'+Courses.MKID+'.'+Courses.MKCode+'">Smt '+Courses.Semester+' - '+Courses.ProdiCode+' | '+Courses.MKNameEng+' (Credit : '+Courses.TotalSKS+')</option>');
            }

        });
    }


</script>