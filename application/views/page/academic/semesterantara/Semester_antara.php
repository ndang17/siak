

<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Semester Antara</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs btn-action" data-action="addSemesterAntara" id="btn_addTahunAkademik">
                            <i class="icon-plus"></i> Add Semester Antara
                        </span>
                    </div>
                </div>

            </div>
            <div class="widget-content">
                <div id="loadPage"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        loadDataSemesterAntara();
    });

    $('.btn-action').click(function () {
        var action = $(this).attr('data-action');
        var btnSave = (action=='addSemesterAntara') ? 'add' : 'edit';
        $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">Semester Antara</h4>');
        $('#GlobalModal .modal-body').html('<table class="table">' +
            // '<tr>' +
            // '<td style="width: 25%;">Program</td>' +
            // '<td><select class="form-control" id="formProgram"></select></td>' +
            // '</tr>' +
            '<tr>' +
            '<td style="width: 25%;">Semester</td>' +
            '<td><select class="form-control" id="formSemester"></select></td>' +
            '</tr>' +
            '</table>');
        // loadSelectOptionProgramCampus('#formProgram','');
        loadSelectOptionSemester('#formSemester','');
        $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" id="btnSave" data-id="0" data-action="'+action+'" class="btn btn-success">'+ucwords(btnSave)+'</button>');

        $('#GlobalModal').modal({
            'show' : true,
            'backdrop' : 'static'
        });

    });

    $(document).on('click','#btnSave',function () {
        var dataID = $(this).attr('data-id');
        var action = $(this).attr('data-action');
        // var SemesterID = $('#formProgram').val();
        var DataSemester = $('#formSemester').val();

        if(DataSemester!=''){
            var sp = DataSemester.split('.');

            var Semester = sp[1];

            var SemesterID = sp[0];

            var s = Semester.split('/');
            var Year = s[0];
            var smt = s[1].split(' ')[1].trim();

            var Code = (smt=='Ganjil') ? 3 : 4;
            var Name = Semester+' - Antara';

            var ID = (action=='edit') ? dataID : '';

            var data = {
                action : action,
                ID : ID,
                dataForm : {
                    SemesterID : SemesterID,
                    Year : Year,
                    Code : Code,
                    Name : Name,
                    Status : '0',
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()

                }
            };

            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+'api/__crudTahunAkademik';

            loading_buttonSm('#btnSave');
            $.post(url,{token:token},function (jsonResult) {

                if(jsonResult!=0){
                    toastr.success('Saved','Success');
                } else {
                    toastr.warning('Data Already Axist','Data Exist!');
                }

                setTimeout(function () {
                    $('#GlobalModal').modal('hide');
                },500);
            });
        }
    });
    
    $(document).on('click','.btnDetails',function () {
        var SA_ID = $(this).attr('data-id');
        loadDetails(SA_ID);
    });

    function loadDataSemesterAntara() {

        $('#loadPage').html('<table class="table table-bordered table-striped">' +
            '                    <thead class="head-center">' +
            '                    <tr>' +
            '                        <th style="width: 1%;">No</th>' +
            '                        <th style="width: 10%;">YearCode</th>' +
            '                        <th>Name</th>' +
            '                        <th style="width: 10%;">Status</th>' +
            '                    </tr>' +
            '                    </thead>' +
            '                    <tbody id="trSmtAntara">' +
            '                    </tbody>' +
            '                </table>');

        var url = base_url_js+'api/__crudTahunAkademik';
        var token = jwt_encode({action:'readSemesterAntara'},'UAP)(*');
        $.post(url,{token:token},function (jsonResult) {

            if(jsonResult.length>0){
                var no=1;
                for(var i=0;i<jsonResult.length;i++){
                    var data = jsonResult[i];
                    var status = (data.Status==1) ? '<span class="label label-success">Publish</span>' : '<span class="label label-danger">Unpublish</span>';
                    $('#trSmtAntara').append('<tr>' +
                        '<td class="td-center">'+no+'</td>' +
                        '<td class="td-center">'+data.Year+''+data.Code+'</td>' +
                        '<td><a href="javascipt:void(0);" data-id="'+data.ID+'" class="btnDetails">'+data.Name+'</a></td>' +
                        '<td class="td-center">'+status+'</td>' +
                        '</tr>');
                    no += 1;


                }


            }
        });
    }

    function loadDetails(SA_ID) {
        var url = base_url_js+'academic/semester-antara/details/'+SA_ID;
        $.get(url,function (html) {
            $('#loadPage').html(html);
        })
    }

</script>

<!--<div class="tabbable tabbable-custom tabbable-full-width">-->
<!--    <ul class="nav nav-tabs">-->
<!--        <li class="active"><a href="#tab_mata_kuliah" data-toggle="tab">Kurikulum Semester Antara</a></li>-->
<!--    </ul>-->
<!--    <div class="tab-content row">-->

<!--        <div class="tab-pane active" id="tab_mata_kulia">-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->