

<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Semester Antara</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs btn-action" data-action="add" id="btn_addTahunAkademik">
                            <i class="icon-plus"></i> Add Semester Antara
                        </span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>No</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

    });

    $('.btn-action').click(function () {
        var action = $(this).attr('data-action');
        $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">Semester Antara</h4>');
        $('#GlobalModal .modal-body').html('<table class="table">' +
            '<tr>' +
            '<td style="width: 25%;">Program</td>' +
            '<td><select class="form-control" id="formProgram"></select></td>' +
            '</tr>' +
            '<tr>' +
            '<td>Semester</td>' +
            '<td><select class="form-control" id="formSemester"></select></td>' +
            '</tr>' +
            '</table>');
        loadSelectOptionProgramCampus('#formProgram','');
        loadSelectOptionSemester('#formSemester','Name','');
        $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '<button type="button" id="btnSave" data-action="'+action+'" class="btn btn-success">'+ucwords(action)+'</button>');

        $('#GlobalModal').modal({
            'show' : true,
            'backdrop' : 'static'
        });

    });
    
    $(document).on('click','#btnSave',function () {
        var dataID = $(this).attr('data-id');
        var action = $(this).attr('data-action');
        var ProgramCampusID = $('#formProgram').val();
        var Semester = $('#formSemester').val();

        if(ProgramCampusID!='' && Semester!=''){
            var s = Semester.split('/');
            var Year = s[0];
            var smt = s[1].split(' ')[1].trim();

            var YearCode = (smt=='Ganjil') ? Year+'3' : Year+'4';
            var Name = Semester+' - Antara';

            var ID = (action=='edit') ? dataID : '';

            var data = {
                action : action,
                ID : ID,
                dataForm {
                    ProgramCampusID : ProgramCampusID,
                    YearCode : YearCode,
                    Name : Name,
                    Status : 0,
                    UpdateBy : sessionNIP,
                    UpdateAt : dateTimeNow()

                }
            };
            
            var token = jwt_encode(data,'UAP)(*');
            var url = base_url_js+'api/__crudTahunAkademik';

            loading_buttonSm('#btnSave');
            $.post(url,{token:token},function (jsonResult) {
                setTimeout(function () {
                    $('#GlobalModal').modal('hide');
                },500);
            });
        }
    });
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