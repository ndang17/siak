

<div class="thumbnail" style="margin-bottom: 10px;">
    <div class="row">
        <div class="col-xs-2" style="">
            <select class="form-control form-filter-jadwal" id="filterProgramCampus"></select>
        </div>
        <div class="col-xs-2" style="">
            <select id="filterSemester" class="form-control form-filter-jadwal">
            </select>
        </div>
        <div class="col-xs-3" style="">
            <select id="filterBaseProdi" class="form-control form-filter-jadwal">
                <option value="">--- All Program Study ---</option>
                <option disabled>------------------------------------------</option>
            </select>
        </div>

        <div class="col-xs-2" style="">
            <select class="form-control form-filter-jadwal" id="filterCombine">
                <option value="">--- Show All ---</option>
                <option value="1">Combine Class Yes</option>
                <option value="0">Combine Class No</option>
            </select>
        </div>
        <div class="col-xs-3" style="text-align: right;padding-left: 0px;">


        </div>
        <!--                <div class="col-xs-2">-->
        <!--                    <button class="btn btn-"><i class="fa fa-eye right-margin" aria-hidden="true"></i> Liat </button>-->
        <!--                </div>-->
    </div>


</div>

<div class="thumbnail" style="padding: 5px;">
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="0" checked> All Days
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="1"> Monday
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="2"> Tuesday
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="3"> Wednesday
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="4"> Thrusday
    </label>
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="5"> Friday
    </label>
    <label class="checkbox-inline" style="color: red;">
        <input type="checkbox" class="filterDay" value="6"> Saturday
    </label>
    <label class="checkbox-inline" style="color: red;">
        <input type="checkbox" class="filterDay" value="7"> Sunday
    </label>
</div>

<div id="dataScedule" style="margin-top: 30px;">
</div>

<script>
    $(document).ready(function () {
        $('.form-filter-jadwal').prop("disabled",false);
        window.checkedDay = [];
        loadSelectOptionProgramCampus('#filterProgramCampus','');
        loadSelectOptionBaseProdi('#filterBaseProdi','');
        loSelectOptionSemester('#filterSemester','selectedNow');

        loadAcademicYearOnPublish();

    });


    $(document).on('change','#filterProgramCampus,#filterSemester,#filterBaseProdi,#filterCombine',function () {
        filterSchedule();
    });

    $('input[type=checkbox][class=filterDay]').change(function () {
        var v = $(this).val();

        // console.log($('input[type=checkbox][class=filterDay]:checked').val());

        if(v==0){
            $('input[type=checkbox][class=filterDay]').prop('checked',false);
            $(this).prop('checked',true);
            checkedDay = [];
        } else {

            if($('input[type=checkbox][value='+v+']').is(':checked')){
                checkedDay.push($(this).val());
            } else {
                checkedDay = $.grep(checkedDay, function(value) {
                    return value != v;
                });
            }


            $('input[type=checkbox][value=0]').prop('checked',false);
            // $(this).prop('checked',true);
        }

        if(checkedDay.length==0){
            $('input[type=checkbox][value=0]').prop('checked',true);
            $('.widget-schedule').removeClass('hide');
        } else {
            $('.widget-schedule').addClass('hide');
            if(checkedDay.length>0){
                for(var i=0;i<checkedDay.length;i++){
                    $('#dayWidget'+checkedDay[i]).removeClass('hide');
                }
            }
        }



    });

    function loadAcademicYearOnPublish() {
        var url = base_url_js+"api/__getAcademicYearOnPublish";
        $.getJSON(url,function (data_json) {
            getSchedule(1,data_json.ID,'','');
        });
    }

    function filterSchedule() {
        var ProgramsCampusID = $('#filterProgramCampus').find(':selected').val();
        var SemesterID = $('#filterSemester').find(':selected').val().split('.')[0];
        var Prodi = $('#filterBaseProdi').find(':selected').val();
        var ProdiID = (Prodi!='') ? Prodi.split('.')[0] : '';
        var CombinedClasses = $('#filterCombine').find(':selected').val();

        getSchedule(ProgramsCampusID,SemesterID,ProdiID,CombinedClasses);
    }

    function getSchedule(ProgramsCampusID,SemesterID,ProdiID,CombinedClasses) {

        var data = {
            action : 'read',
            dataWhere  : {
                ProgramsCampusID : ProgramsCampusID,
                SemesterID : SemesterID,
                ProdiID : ProdiID,
                CombinedClasses : CombinedClasses,
                IsSemesterAntara : ''+SemesterAntara
                // Days : checkedDay,
                // DaysName : {
                //     Eng : daysEng,
                //     Ind : daysInd
                // }
            }
        };

        // console.log(data);

        var url = base_url_js+'api/__crudSchedule';
        var token = jwt_encode(data,'UAP)(*');

        $.post(url,{token:token},function (data_result) {
            var div = $('#dataScedule');

            // console.log(data_result);

            if(data_result.length>0){
                div.html('');
                for(var i=0;i<data_result.length;i++){

                    var classDay = (i>4) ? 'label-danger' : 'label-info';

                    div.append('' +
                        '<div class="widget box widget-schedule" id="dayWidget'+data_result[i].Day.ID+'">' +
                        '    <div class="widget-header">' +
                        '        <h4 class=""><span class="'+classDay+'" style="color: #ffffff;padding: 5px;padding-left:10px;padding-right:10px;font-weight: bold;">'+data_result[i].Day.NameEng+'</span></h4>' +
                        '    </div>' +
                        '    <div class="widget-content no-padding">' +
                        '<table class="table table-bordered table-striped" id="scTable'+i+'">' +
                        '    <thead>' +
                        '    <tr>' +
                        '        <th style="width:3px;" class="th-center">No</th>' +
                        '        <th style="width:20px;" class="th-center">Group</th>' +
                        '        <th style="width:200px;" class="th-center">Course</th>' +
                        '        <th style="width:20px;" class="th-center">Credit</th>' +
                        '        <th style="width:150px;" class="th-center">Lecturers</th>' +
                        // '        <th style="width:15px;" class="th-center">Cmbn</th>' +
                        '        <th style="width:130px;" class="th-center">Time</th>' +
                        '        <th style="width:20px;" class="th-center">Room</th>' +

                        // '        <th class="th-center">Action</th>' +
                        '    </tr>' +
                        '    </thead>' +
                        '    <tbody id="trData'+i+'"></tbody>' +
                        '</table>' +
                        '        <div id="">' +
                        '        </div>' +
                        '' +
                        '    </div>' +
                        '</div>');

                    var table = $('#trData'+i);
                    var sc = data_result[i].Details;
                    var no = 1;
                    for(var r=0;r<sc.length;r++){

                        var gabungan = (sc[r].CombinedClasses==0) ? 'No' : 'Yes';

                        var StartSessions = moment()
                            .hours(sc[r].StartSessions.split(':')[0])
                            .minutes(sc[r].StartSessions.split(':')[1])
                            .format('LT');

                        var EndSessions = moment()
                            .hours(sc[r].EndSessions.split(':')[0])
                            .minutes(sc[r].EndSessions.split(':')[1])
                            .format('LT');

                        var teamTeaching = '';
                        if(sc[r].TeamTeaching==1){
                            for(var t=0;t<sc[r].DetailTeamTeaching.length;t++){
                                var tcm = sc[r].DetailTeamTeaching;
                                teamTeaching = teamTeaching +'<div style="margin-bottom: 7px;"><span class="label label-info-inline"><b>'+tcm[t].Lecturer+'</b></span></div>';
                            }
                        }

                        var Subsesi = (sc[r].SubSesi==1)? '<span class="label label-warning">Sub-Sesi</span>' :'';

                        table.append('<tr>' +
                            '<td class="td-center" style="width:1%;">'+no+'</td>' +
                            '<td class="td-center" style="width:5%;"><b><a href="javascript:void(0)" class="btn-action" data-page="editjadwal" data-id="'+sc[r].ID+'">'+sc[r].ClassGroup+'</a></b><br/>'+Subsesi+'</td>' +
                            // '<td>' +
                            // '<a href="javascript:void(0)" class="btn-action" data-page="editjadwal" data-id="'+sc[r].ID+'"><b>'+sc[r].MKName+'</b></a><br/><i>'+sc[r].MKNameEng+'</i>' +
                            // '</td>' +

                            '<td><ul id="listCourse'+i+''+r+'" style="padding-left:0px;list-style-type: none;"></ul></td>' +
                            '<td class="td-center" style="width:5%;">'+sc[r].Credit+'</td>' +

                            '<td style="width:20%;">' +
                            '<div style="color: #427b44;margin-bottom: 10px;"><b>'+sc[r].Lecturer+'</b></div>'+teamTeaching+
                            '</td>' +
                            // '<td class="td-center">'+gabungan+'</td>' +
                            '<td class="td-center" style="width:15%;">'+StartSessions+' - '+EndSessions+'</td>' +
                            '<td class="td-center" style="width:5%;">'+sc[r].Room+'</td>' +

                            // '<td class="td-center"><button class="btn btn-default btn-default-primary">Action</button></td>' +
                            '</tr>');


                        var DetailCourse = sc[r].DetailCourse;
                        var ls = $('#listCourse'+i+''+r);

                        var lscss = (DetailCourse.length>1) ? 'style="margin-bottom: 15px;"' : '';
                        for(var s=0;s<DetailCourse.length;s++){
                            var course = DetailCourse[s];
                            ls.append('<li '+lscss+'><b>'+course.MKNameEng+'</b><br/><i>'+course.MKName+'</i><br/>' +
                                '<span class="label label-default">'+course.MKCode+'</span> | <span class="label label-success-inline"><b>'+course.ProdiEng+'</b></span></li>');
                        }

                        no += 1;
                    }


                    // Untuk Data Table Jadwal
                    // var table = $('#scTable'+i).DataTable({
                    //     'iDisplayLength' : 10,
                    //     "sDom": "<'row'<'dataTables_header clearfix'<'col-md-3'l><'col-md-9'Tf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>", // T is new
                    //     "oTableTools": {
                    //         "aButtons": [
                    //             {
                    //                 "sExtends" : "xls",
                    //                 "sButtonText" : '<i class="fa fa-download" aria-hidden="true"></i> Excel',
                    //             },
                    //             {
                    //                 "sExtends" : "pdf",
                    //                 "sButtonText" : '<i class="fa fa-download" aria-hidden="true"></i> PDF',
                    //                 "sPdfOrientation" : "landscape",
                    //                 "sPdfMessage" : ""+data_result[i].Day.Eng
                    //             }
                    //
                    //         ],
                    //         "sSwfPath": "../assets/template/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf"
                    //     }
                    //
                    //
                    // });
                }
            } else {
                div.append('<h1>Data Kosong</h1>');
            }

        });

    }
</script>