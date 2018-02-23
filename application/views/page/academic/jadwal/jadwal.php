

<div class="thumbnail" style="padding: 5px;">
    <label class="checkbox-inline">
        <input type="checkbox" class="filterDay" value="0" checked> All Day
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
        }
    });



    function filterSchedule() {

        var ProgramCampusID = $('#filterProgramCampus').find(':selected').val();
        var SemesterID = $('#filterSemester').find(':selected').val().split('.');
        var BaseProdi = $('#filterBaseProdi').find(':selected').val().split('.');
        var CombinedClasses = $('#filterCombine').find(':selected').val().split('.');

        var data = {
            action : 'read',
            dataWhere  : {
                ProgramCampusID : ProgramCampusID,
                SemesterID : SemesterID[0],
                BaseProdi : BaseProdi,
                CombinedClasses : CombinedClasses,
                Days : checkedDay,
                DaysName : {
                    Eng : daysEng,
                    Ind : daysInd
                }
            }
        };

        var url = base_url_js+'api/__crudSchedule';
        var token = jwt_encode(data,'UAP)(*');

        $.post(url,{token:token},function (data_result) {
            var div = $('#dataScedule');

            if(data_result.length>0){
                div.empty();
                for(var i=0;i<data_result.length;i++){

                    var classDay = (i>4) ? 'label-danger' : 'label-info';

                    div.append('' +
                        '<div class="widget box">' +
                        '    <div class="widget-header">' +
                        '        <h4 class=""><span class="'+classDay+'" style="color: #ffffff;padding: 5px;padding-left:10px;padding-right:10px;font-weight: bold;">'+data_result[i].Day.Eng+'</span></h4>' +
                        '    </div>' +
                        '    <div class="widget-content no-padding">' +
                        '<table class="table table-bordered table-striped" id="scTable'+i+'">' +
                        '    <thead>' +
                        '    <tr>' +
                        '        <th style="width:5px;" class="th-center">No</th>' +
                        '        <th class="th-center">Course</th>' +
                        '        <th style="width:20px;" class="th-center">Group</th>' +
                        '        <th class="th-center">Lecturers</th>' +
                        '        <th style="width:15px;" class="th-center">Cmbn</th>' +
                        '        <th class="th-center">Room</th>' +
                        '        <th style="width:150px;" class="th-center">Time</th>' +
                        '        <th class="th-center">Action</th>' +
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
                                teamTeaching = teamTeaching +'<br/><span><i>'+tcm[t].Lecturer+'</i></span>';
                            }
                        }

                        table.append('<tr>' +
                            '<td class="td-center">'+no+'</td>' +
                            '<td><b>'+sc[r].MKName+'</b><br/><i>'+sc[r].MKNameEng+'</i></td>' +
                            '<td class="td-center">'+sc[r].ClassGroup+'</td>' +
                            '<td>' +
                            '<span style="color: #427b44;font-size: 15px;"><b>'+sc[r].Lecturer+'</b></span>'+teamTeaching+
                            '</td>' +
                            '<td class="td-center">'+gabungan+'</td>' +
                            '<td class="td-center">'+sc[r].Room+'</td>' +
                            '<td class="td-center">'+StartSessions+' - '+EndSessions+'</td>' +
                            '<td class="td-center"><button class="btn btn-default btn-default-primary">Action</button></td>' +
                            '</tr>');

                        no += 1;
                    }

                    var table = $('#scTable'+i).DataTable({
                        'iDisplayLength' : 10,
                        "sDom": "<'row'<'dataTables_header clearfix'<'col-md-3'l><'col-md-9'Tf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>", // T is new
                        "oTableTools": {
                            "aButtons": [
                                {
                                    "sExtends" : "xls",
                                    "sButtonText" : '<i class="fa fa-download" aria-hidden="true"></i> Excel',
                                },
                                {
                                    "sExtends" : "pdf",
                                    "sButtonText" : '<i class="fa fa-download" aria-hidden="true"></i> PDF',
                                    "sPdfOrientation" : "landscape",
                                    "sPdfMessage" : ""+data_result[i].Day.Eng
                                }

                            ],
                            "sSwfPath": "../assets/template/plugins/datatables/tabletools/swf/copy_csv_xls_pdf.swf"
                        }


                    });
                }
            } else {
                div.append('<h1>Data Kosong</h1>');
            }

        });

    }
</script>