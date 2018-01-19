

<div class="row" style="margin-top: 30px;">
    <div class="col-md-10 col-md-offset-1">
        <div class="thumbnail">
            <div class="row">
                <div class="col-xs-3" style="">
                    <select class="form-control" id="selectKurikulum"></select>
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
                            Conf.
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="javascript:void(0)" data-action="ConfJenisKurikulum" class="btn-conf">Jenis Kurikulum</a></li>
                            <li><a href="javascript:void(0)" data-action="ConfJenisKelompok" class="btn-conf">Kelompok</a></li>
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
        loadSelectOptionKurikulum();
        loadSelectOptionBaseProdi('#selectProdi');
        loaddataAddKurikulum();
        $('.btn-addsmt').prop('disabled',true);
    });

    $(document).on('change','#selectKurikulum, #selectProdi',function () {
        $('.btn-addsmt').prop('disabled',true);
        pageKurikulum();
    });

    $(document).on('click','.btn-add-mksmt', function () {
       var semester = $(this).attr('data-smt');
       modal_add_mk(semester);
    });

    $(document).on('click','.btn-conf',function () {
        var action = $(this).attr('data-action');
        if(action == 'ConfJenisKurikulum' || action == 'ConfJenisKelompok'){
            modal_dataConf(action);
        }
    });

    $(document).on('click','.btn-control',function () {

        var action = $(this).attr('data-action');
        if(action=='add-kurikulum') {
            var year = $(this).attr('data-year');
            modal_add_kurikulum(year);
        } else if(action=='add-semester'){
            var semester = $(this).attr('data-smt');
            modal_add_mk(semester);
        }


    });


    function pageKurikulum() {
        var year = $('#selectKurikulum').find(':selected').val();
        var prodiID = $('#selectProdi').find(':selected').val();
        loading_page('#pageKurikulum');
        var url = base_url_js+'academic/kurikulum-detail';
        var data = {
            year : year,
            ProdiID : prodiID
        };

        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{token:token},function (page) {
            setTimeout(function () {
                $('#pageKurikulum').html(page);
            },2000);
        });

    }
    function loadSelectOptionKurikulum() {
        var url = base_url_js+"api/__getKurikulumSelectOption";
        $.get(url,function (data_json) {
            for(var i=0;i<data_json.length;i++){
                var selected = (i==0) ? 'selected' : '';
                $('#selectKurikulum').append('<option value="'+data_json[i].Year+'" '+selected+'>'+data_json[i].Name+'</option>');
            }
        }).done(function () {
            pageKurikulum();
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
    function modal_add_mk(semester) {
        var url = base_url_js+"academic/kurikulum/add-semester";
        var curriculumYear = $('#selectKurikulum').find(':selected').val();
        var data = {
            Semester : semester,
            curriculumYear : curriculumYear
        };
        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{ token:token }, function (html) {
            $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span></button>' +
                '<h4 class="modal-title">Add MK Semester '+semester+' - Kurikulum '+curriculumYear+'</h4>');
            $('#GlobalModal .modal-body').html(html);
            $('#GlobalModal .modal-footer').html(' ');
            $('#GlobalModal').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        })
    }
    function modal_dataConf(action) {
        var url = base_url_js+'academic/kurikulum/data-conf';

        var header = 'Kelompok';
        if(action=='ConfJenisKurikulum'){
            header = 'Jenis Kurikulum';
        }

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