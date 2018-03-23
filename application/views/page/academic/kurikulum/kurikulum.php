

<div class="row" style="margin-top: 30px;">
    <div class="col-md-10 col-md-offset-1">
        <div class="thumbnail">
            <div class="row">
                <div class="col-xs-3" style="">
                    <select class="form-control" id="selectKurikulum">
                        <option value="" disabled selected>--- Select Curriculum ---</option>
                    </select>
                </div>
                <div class="col-xs-3">
                    <select class="form-control" id="selectProdi">
                        <option value="">--- All Prodi ---</option>
                    </select>
                </div>
                <div class="col-xs-6" style="text-align: right;">
                    <div class="btn-group">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Add Kurikulum
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="yearAddKurikulum">
                        </ul>
                    </div>

                    <div class="btn-group">
                        <button class="btn btn-default btn-default-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Add Semester
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="addSmt">
                        </ul>
                    </div>

                    <div class="btn-group">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="javascript:void(0)" data-action="ConfProgram" data-header="Program Kampus" class="btn-conf">Program Kuliah</a></li>
                            <li><a href="javascript:void(0)" data-action="ConfJenisKurikulum" data-header="Jenis Kurikulum" class="btn-conf">Jenis Kurikulum</a></li>
                            <li><a href="javascript:void(0)" data-action="ConfJenisKelompok" data-header="Kelompok Mata Kuliah" class="btn-conf">Kelompok</a></li>
<!--                            <li><a href="javascript:void(0)" data-action="ClassGroup" data-header="Group Kelas" class="btn-conf">Group Kelas</a></li>-->
                        </ul>
                    </div>

                </div>
            </div>


        </div>


    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr/>
        <div id="pageKurikulum"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        loadSelectOptionCurriculum('#selectKurikulum','');
        loadSelectOptionBaseProdi('#selectProdi','');
        loaddataAddKurikulum();
        $('.btn-addsmt').prop('disabled',true);
    });

    $(document).on('change','#selectKurikulum, #selectProdi',function () {
        $('.btn-addsmt').prop('disabled',true);
        pageKurikulum();
    });

    $(document).on('click','.btn-add-mksmt', function () {
       var semester = $(this).attr('data-smt');
       modal_add_mk(semester,'add');
    });

    $(document).on('click','.btn-conf',function () {
        var action = $(this).attr('data-action');
        var header = $(this).attr('data-header');
        if(action == 'ConfJenisKurikulum' || action == 'ConfJenisKelompok' || action=='ConfProgram'){
            modal_dataConf(action,header);
        }
        // else if(action=='ClassGroup'){
        //     modal_dataClassGroup(action,header);
        // }
    });

    $(document).on('click','.btn-control',function () {

        var action = $(this).attr('data-action');
        if(action=='add-kurikulum') {
            var year = $(this).attr('data-year');
            modal_add_kurikulum(year);
        } else if(action=='add-semester'){
            var semester = $(this).attr('data-smt');
            modal_add_mk(semester,'add');
        }


    });

    $(document).on('click','.detailMataKuliah',function () {
        var semester = $(this).attr('data-smt');
        var CDID = $(this).attr('data-id');
        modal_add_mk(semester,'edit',CDID);
    });


    function pageKurikulum() {

        var kurikulum = $('#selectKurikulum').find(':selected').val().split('.');
        var year = kurikulum[1].trim();
        var prodi = $('#selectProdi').find(':selected').val().split('.');
        var prodiID = prodi[0];
        loading_page('#pageKurikulum');
        var url = base_url_js+'academic/kurikulum-detail';
        var data = {
            SemesterSearch : '',
            year : year,
            ProdiID : prodiID
        };

        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{token:token},function (page) {
            setTimeout(function () {
                $('#pageKurikulum').html(page);
            },500);
        });

    }

    function loaddataAddKurikulum() {
        for(var i=0;i<2;i++){
            $('#yearAddKurikulum').append('<li>' +
                '<a href="javascript:void(0)" data-year="'+moment().add(i,'years').year()+'" data-action="add-kurikulum" class="btn-control">' +
                'Kurikulum '+moment().add(i,'years').year()+'' +
                '</a></li>');
        }
    }
    function modal_add_kurikulum(year) {
        var url = base_url_js+"academic/kurikulum/add-kurikulum";
        var data = {
            Year : year,
            Name : 'Kurikulum '+year,
            NameEng : 'Curriculum '+year,
            CreateAt : dateTimeNow(),
            CreateBy : '2017090',
            UpdateAt : dateTimeNow(),
            UpdateBy : '2017090'
        };
        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{token:token},function (html) {
            $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                '<h4 class="modal-title">Add Kurikulum</h4>');
            $('#GlobalModal .modal-body').html(html);
            $('#GlobalModal .modal-footer').html(' ');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        })
    }
    function modal_add_mk(semester,action,ID='') {
        var url = base_url_js+"academic/kurikulum/loadPageDetailMataKuliah";
        var curriculum = $('#selectKurikulum').find(':selected').val().split('.');
        var curriculumYear = curriculum[1];
        var data = {
            Action : action,
            CDID : ID,
            Semester : semester,
            curriculumYear : curriculumYear
        };
        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{ token:token }, function (html) {
            $('#GlobalModal .modal-header').html('<h4 class="modal-title">Add MK Semester '+semester+' - Kurikulum '+curriculumYear+'</h4>');
            $('#GlobalModal .modal-body').html(html);
            $('#GlobalModal .modal-footer').html(' ');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        })
    }
    function modal_dataConf(action,header) {
        var url = base_url_js+'academic/kurikulum/data-conf';

       var data = {
            action : action
        };

        var token = jwt_encode(data,'UAP)(*');
        $.post(url,{token:token}, function (html) {
            $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span></button>' +
                '<h4 class="modal-title">'+header+'</h4>');
            $('#GlobalModal .modal-body').html(html);
            $('#GlobalModal .modal-footer').html(' ');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        });
    }
    



</script>