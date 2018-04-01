
<style>
    .span-sesi {
        font-size: 1.3em;
        font-weight: bold;
    }
    .td-center {
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    .form-sesiawal[readonly] {
        background-color: #ffffff;
        color: #333333;
        cursor: text;
    }
</style>

<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-8 col-md-offset-2">
        <button data-page="jadwal" class="btn btn-warning btn-action"><i class="fa fa-arrow-left right-margin" aria-hidden="true"></i> Back Schedule</button>
        <hr/>
        <div class="thumbnail" style="border: none;">
            <table class="table">
                <tr>
                    <th style="width: 180px;">Tahun Akademik</th>
                    <th style="width: 1px;">:</th>
                    <td>
                        <div id="dataTA"></div>
                    </td>
                </tr>
                <tr>
                    <th>Program Kuliah</th>
                    <th>:</th>
                    <td>
                        <div id="dataProgramCampus"></div>
                    </td>
                </tr>
                <tr>
                    <th>Course</th>
                    <th>:</th>
                    <td>
                        <div id="dataCourse"></div>
                    </td>
                </tr>
                <tr>
                    <th>Group</th>
                    <th>:</th>
                    <td>
                        <div id="dataGroup"></div>
                    </td>
                </tr>

                <tr>
                    <th>Lecturers</th>
                    <th>:</th>
                    <td>
                        <div id="dataLecturers"></div>
                        <div id="dataTeamTeaching"></div>
                    </td>
                </tr>

                <tr>
                    <th>Day, Time, Room</th>
                    <th>:</th>
                    <td></td>
                </tr>

            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        console.log('<?php echo $ScheduleID; ?>');
        getDetailScedule();
    });

    function getDetailScedule() {
        var data = {
            action : 'readDetail',
            ScheduleID : <?php echo $ScheduleID; ?>
        };
        var token = jwt_encode(data,'UAP)(*');
        var url = base_url_js+'api/__crudSchedule';
        $.post(url,{token:token},function (jsonResult) {
            console.log(jsonResult);
            $('#dataTA').html('<b>'+jsonResult.DataCurriculum.Name+'</b>');
            $('#dataProgramCampus').html('<b>'+jsonResult.ProgramCampus+'</b>');

            $('#dataCourse').html('<ul id="listCourse" style="padding-left:0px;list-style-type: none;"></ul>');

            var ls = $('#listCourse');
            var lscss = (jsonResult.DetailCourse.length>1) ? 'style="margin-bottom: 15px;"' : '';
            for(var i=0;i<jsonResult.DetailCourse.length;i++){
                var course = jsonResult.DetailCourse[i];
                ls.append('<li '+lscss+'><b>'+course.MKNameEng+'</b>' +
                    '<br/><i>'+course.MKName+'</i>' +
                    '<br/><span class="label label-default">'+course.MKCode+'</span> | <span class="label label-success-inline"><b>'+course.ProdiEng+'</b></span></li>');
            }

            $('#dataGroup').html('<b style="color: blue;">'+jsonResult.ClassGroup+'</b>');

            $('#dataLecturers').html('<b style="color: #427b44;">'+jsonResult.CoordinatorName+'</b>');

            if(jsonResult.DetailTeamTeaching.length>0){
                for(var t=0;t<jsonResult.DetailTeamTeaching.length;t++){
                    var tcm = jsonResult.DetailTeamTeaching[t];
                    $('#dataTeamTeaching').append('<div style="margin-bottom: 7px;"><span class="label label-info-inline"><b>'+tcm.Lecturer+'</b></span></div>')
                }
            }


        });
    }
</script>

