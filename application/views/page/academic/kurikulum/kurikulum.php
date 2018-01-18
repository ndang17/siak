

<div class="row" style="margin-top: 30px;">
    <div class="col-md-8 col-md-offset-2">
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
<!--                <div class="col-xs-4">-->
<!--                    <button class="btn btn-default"><i class="fa fa-download right-margin" aria-hidden="true"></i> Excel</button>-->
<!--                    <button class="btn btn-default"><i class="fa fa-download right-margin" aria-hidden="true"></i>PDF</button>-->
<!--                </div>-->
                <div class="col-xs-6" style="text-align: right;">
<!--                    <button data-page="inputjadwal" data-action="add-kurikulum" class="btn btn-success btn-action btn-control"><i class="fa fa-plus-circle right-margin" aria-hidden="true"></i> Add Kerikulum</button>-->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-addkuriulum">Add Kurikulum</button>
                        <button type="button" class="btn btn-success btn-addkuriulum dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" id="yearAddKurikulum">
                        </ul>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-default-success btn-addsmt">Add Semester</button>
                        <button type="button" class="btn btn-default btn-default-success btn-addsmt dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" id="addSmt">
                        </ul>
                    </div>
<!--                    <button data-page="ruangan" class="btn btn-primary btn-action control-jadwal"><i class="fa fa-eye right-margin" aria-hidden="true"></i> All Mata Kuliah</button>-->
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
        loadSelectOption();
        loaddataAddKurikulum();
        $('.btn-addsmt').prop('disabled',true);

    });

    $(document).on('change','#selectKurikulum, #selectProdi',function () {
        $('.btn-addsmt').prop('disabled',true);
        pageKurikulum();
    });

    $(document).on('click','.btn-control',function () {

        var action = $(this).attr('data-action');
        if(action=='add-kurikulum') {
            var year = $(this).attr('data-year');
            modal_add_kurikulum(year);
        } else if(action=='add-semester'){
            var semester = $(this).attr('data-smt');
            modal_add_semester(semester);
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
    function loadSelectOption() {
        var url = base_url_js+"api/__getBaseProdiSelectOption";
        $.get(url,function (data) {
            for(var i=0;i<data.length;i++){
                $('#selectProdi').append('<option value="'+data[i].ID+'">'+data[i].Name+'</option>');
            }
        });
    }
    function loaddataAddKurikulum() {
        for(var i=0;i<4;i++){
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
    function modal_add_semester(semester) {
        var url = base_url_js+"academic/kurikulum/add-semester";
    }
</script>