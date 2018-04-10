
<style>
    .toggle-group .btn-default {
        z-index: 1000 !important;
    }
    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
    .toggle.ios .toggle-handle { border-radius: 20px; }

    #tableDataStudents tr th,#tableDataStudents tr td {
        text-align: center;
    }
    #tableStd>tbody>tr>td {
        border-top: none;
        padding-top: 3px;
        padding-bottom: 3px;
    }
    .list-scd {
        list-style-type: none;
        padding-left: 0px;
    }
</style>

<div class="row" style="margin-top: 30px;">

    <div class="col-md-3">
        <div class="">
            <label>Semester Antara</label>
            <input type="checkbox" id="formSemesterAntara" data-toggle="toggle" data-style="ios"/>
        </div>
    </div>
    <div class="col-md-9">
        <div class="thumbnail">
            <div class="row">
                <div class="col-xs-3">
                    <select class="form-control" id="filterProgramCampus"></select>
                </div>
                <div class="col-xs-3">
                    <select class="form-control" id="filterSemester"></select>
                </div>
                <div class="col-xs-4">
                    <select class="form-control" id="filterBaseProdi"></select>
                </div>
                <div class="col-xs-2">
                    <select class="form-control" id="filterSemesterSchedule"></select>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <hr/>


        <div id="divPage"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        window.SemesterAntara = 0;

        $('input[type=checkbox][data-toggle=toggle]').bootstrapToggle();
        loadSelectOptionProgramCampus('#filterProgramCampus','');

        $('#filterSemester').append('<option value="" disabled selected>-- Year Academic--</option>' +
            '                <option disabled>-----------------</option>');
        loSelectOptionSemester('#filterSemester','');

        loadSelectOptionBaseProdi('#filterBaseProdi','');
        // loadSelectOPtionAllSemester('#filterSemesterSchedule','');
    });

    $(document).on('change','#filterSemester',function () {
        var Semester = $('#filterSemester').val();
        var SemesterID = (Semester!='' && Semester!= null) ? Semester.split('.')[0] : '';
        $('#filterSemesterSchedule').empty();
        $('#filterSemesterSchedule').append('<option value="" disabled selected>-- Semester --</option>' +
            '                <option disabled>------</option>');
        loadSelectOPtionAllSemester('#filterSemesterSchedule','',SemesterID,SemesterAntara);
        // filterSchedule();

    });

    $(document).on('change','#filterBaseProdi,#filterSemesterSchedule',function () {
        getStudents();
    });
    $(document).on('click','#btnBack',function () {
        getStudents();
    })

    $(document).on('click','.detailStudyPlan',function () {

        var NPM = $(this).attr('data-npm');
        var ta = $(this).attr('data-ta');
        var data = {
            action : 'detailStudent',
            NPM : NPM,
            ta : ta
        };
        var url = base_url_js+'api/__crudStudyPlanning';
        var token = jwt_encode(data,'UAP)(*');
        $.post(url,{token:token},function (jsonResult) {

            console.log(jsonResult);

            var dataStd = jsonResult;

            $('#divPage').html('<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px;">' +
                '            <div class="row">' +
                '<div class="col-md-12" style="margin-bottom: 15px;"><button class="btn btn-warning" id="btnBack"><i class="fa fa-arrow-left right-margin" aria-hidden="true"></i> Back</button></div>' +
                '                <div class="col-xs-2">' +
                '                    <img class="img-thumbnail" style="width: 100%;" src="http://siak.podomorouniversity.ac.id/includes/foto/'+dataStd.Photo+'">' +
                '                </div>' +
                '                <div class="col-xs-9">' +
                '                    <b>'+dataStd.NPM+' - '+dataStd.Name+'</b><br/>' +
                '                    <span>'+dataStd.EmailPU+'</span><br/>' +
                '                    <a style="font-size: 10px;"><i class="fa fa-envelope-o" aria-hidden="true"></i> Send Message</a>' +
                '                    <div class="thumbnail" style="margin-bottom: 10px;margin-top: 10px;">' +
                '                        <table class="table" id="tableStd">' +
                '                            <tr>' +
                '                                <td style="width: 15%;">Mentor</td>' +
                '                                <td style="width: 1%;">:</td>' +
                '                                <td><b>'+dataStd.Mentor+'</b>' +
                '                                    <br/>' + dataStd.MentorEmailPU +
                '                                    <br/><a style="font-size: 10px;"><i class="fa fa-envelope-o" aria-hidden="true"></i> Send Message</a>' +
                '                                </td>' +
                '                            </tr>' +
                '                            <tr>' +
                '                                <td>IPK</td>' +
                '                                <td>:</td>' +
                '                                <td>'+dataStd.DetailSemester.LastIPS.IPK+'</td>' +
                '                            </tr>' +
                '                            <tr>' +
                '                                <td>Last IPS</td>' +
                '                                <td>:</td>' +
                '                                <td>'+dataStd.DetailSemester.LastIPS.IPS+' | '+dataStd.DetailSemester.MaxCredit.Credit+' Credit</td>' +
                '                            </tr>' +
                '                        </table>' +
                '                    </div>' +
                '                    <hr/>' +
                '                </div>' +
                '            </div>' +
                '        </div>' +
                '        <table class="table table-striped table-bordered">' +
                '            <thead>' +
                '            <tr>' +
                '                <th>Code</th>' +
                '                <th>Course</th>' +
                '                <th>Credit</th>' +
                '                <th>Group</th>' +
                '                <th>Schedule</th>' +
                '            </tr>' +
                '            </thead><tbody id="dataSchedule"></tbody>' +
                '        </table><hr/>');

            var tr = $('#dataSchedule');
            for(var i=0;i<dataStd.Schedule.length;i++){
                var dataSc = dataStd.Schedule[i];
                tr.append('<tr>' +
                    '<td>'+dataSc.MKCode+'</td>' +
                    '<td><b>'+dataSc.NameEng+'</b><br/><i>'+dataSc.Name+'</i></td>' +
                    '<td>'+dataSc.Credit+'</td>' +
                    '<td>'+dataSc.ClassGroup+'</td>' +
                    '<td><ul id="sc'+i+'" class="list-scd"></ul></td>' +
                    '</tr>');

                var sc = $('#sc'+i);
                for(var s=0;s<dataSc.DetailSchedule.length;s++){
                    var dataSCD = dataSc.DetailSchedule[s];
                    var st = dataSCD.StartSessions.split(':');
                    var en = dataSCD.EndSessions.split(':');

                    var start = st[0]+':'+st[1];
                    var end = en[0]+':'+en[1];
                    sc.append('<li>R.'+dataSCD.Room+' | <span style="text-align: right;">'+dataSCD.DayNameEng+', '+start+' - '+end+'<span></li>');
                }
            }
        });

    });


    
    function getStudents() {

        var ProgramID = $('#filterProgramCampus').val();
        var ProdiID = $('#filterBaseProdi').val().split('.')[0];
        var filterSemesterSchedule = $('#filterSemesterSchedule').val();
        var ClassOf = (filterSemesterSchedule!='' && filterSemesterSchedule!=null) ? filterSemesterSchedule.split('|')[1].split('.')[1] : '';

        var data = {
            action : 'read',
            dataWhere : {
                ProgramID : ProgramID,
                ProdiID : ProdiID,
                ClassOf : ClassOf
            }
        };

        $('#divPage').html('<table class="table table-striped" id="tableDataStudents">' +
            '            <thead>' +
            '            <tr>' +
            '                <th style="width: 1%;">No</th>' +
            '                <th style="width: 7%;">NPM</th>' +
            '                <th>Student</th>' +
            '                <th style="width: 10%;">Last IPS</th>' +
            '                <th style="width: 10%;">IPK</th>' +
            '                <th style="width: 15%;">Credit</th>' +
            // '                <th style="width: 7%;">Status</th>' +
            // '                <th style="width: 7%;">Action</th>' +
            '            </tr>' +
            '            </thead>' +
            '            <tbody id="dataStudents"></tbody>' +
            '        </table>');

        var token = jwt_encode(data,'UAP)(*');

        var url = base_url_js+'api/__crudStudyPlanning';
        $.post(url,{token:token},function (jsonResult) {
            console.log(jsonResult);



            var tr = $('#dataStudents');
            var no =1;
            for(var i=0;i<jsonResult.length;i++){

                var CreditUnit = 0;
                var StudyPlanning = jsonResult[i].StudyPlanning;
                for(var c=0;c<StudyPlanning.length;c++){
                    var stp = StudyPlanning[c];
                    CreditUnit = CreditUnit + parseInt(stp.Semester);
                }

                var Student = jsonResult[i].Student;
                tr.append('<tr>' +
                    '<td>'+no+'</td>' +
                    '<td>'+Student.NPM+'</td>' +
                    '<td style="text-align: left;"><b><a href="javascript:void(0)" class="detailStudyPlan" data-npm="'+Student.NPM+'" data-ta="'+Student.ClassOf+'">'+Student.Name+'</a></b><br/><a style="color: #03a9f4;">'+Student.EmailPU+'</a></td>' +
                    '<td>'+Student.DetailSemester.LastIPS.IPS+'</td>' +
                    '<td>'+Student.DetailSemester.LastIPS.IPK+'</td>' +
                    '<td>'+CreditUnit+' <span style="color: blue;">of</span> '+Student.DetailSemester.MaxCredit.Credit+'</td>' +

                    // '<td>'+CreditUnit+'</td>' +
                    // '<td>' +
                    // '<div class="btn-group">' +
                    // '  <button type="button" class="btn btn-default btn-default-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                    // '    Action <span class="caret"></span>' +
                    // '  </button>' +
                    // '  <ul class="dropdown-menu">' +
                    // '    <li><a href="#">Action</a></li>' +
                    // '    <li><a href="#">Another action</a></li>' +
                    // '    <li><a href="#">Something else here</a></li>' +
                    // '    <li role="separator" class="divider"></li>' +
                    // '    <li><a href="#">Separated link</a></li>' +
                    // '  </ul>' +
                    // '</div>' +
                    // '</td>' +
                    '</tr>');

                no++;
            }

            $('#tableDataStudents').DataTable({
                'pageLength' : 25
            });
        });



    }
</script>