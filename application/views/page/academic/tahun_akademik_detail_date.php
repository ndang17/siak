

<style>
    .dt .thumbnail {
        min-height: 150px;
        border-radius: 0px;
    }

    .dt .panel-detail {
        margin-bottom: 10px;
    }

    .dt .row {
        padding: 10px;
    }

    .dt .form-group {
        margin-bottom: 0px;
    }

    .dt legend {
        margin-bottom: 5px;
    }

    .dt .form-tahun-akademik {
        color: #030303;
    }

    .form-tahun-akademik[readonly] {
        background-color : #ffffff;
        cursor: cell !important;
    }


</style>

<div class="widget box" style="display: block;">
    <div class="widget-header">
        <h4 class="header"><i class="fa fa-arrow-right" aria-hidden="true"></i> Date</h4>

        <div class="toolbar no-padding">

            <div class="btn-group">
                <span class="btn btn-xs" id="setActive" style="color: #51A351;">Set Active</span>
                <span class="btn btn-xs" id="editFormTahunAkademik"><i class="icon-pencil"></i> Edit</span>
                <span class="btn btn-success btn-xs hide" id="saveFormTahunAkademik"><i class="icon-check"></i> Save</span>
            </div>

        </div>


    </div>
    <div class="widget-content" >
        <div class="row dt">



            <!-- ==== KRS ==== -->
            <div class="col-md-6 panel-detail">
                <div class="thumbnail">
                    <legend>KRS</legend>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">Start</label>
                            <div class="col-md-9">
                                <input type="text" id="krs_start" nextElement="krs_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">End</label>
                            <div class="col-md-9">
                                <input type="text" id="krs_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0);" data-head="KRS" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
                </div>
            </div>

            <!-- ==== BAYAR ==== -->
            <div class="col-md-6 panel-detail">
                <div class="thumbnail">
                    <legend>Bayar</legend>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">Start</label>
                            <div class="col-md-9">
                                <input type="text" id="bayar_start" nextelement="bayar_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">End</label>
                            <div class="col-md-9">
                                <input type="text" id="bayar_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0);" data-head="Bayar" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
                </div>
            </div>

        </div>
        <div class="row dt">
            <!-- ==== KULIAH ==== -->
            <div class="col-md-6 panel-detail">
                <div class="thumbnail">
                    <legend>Kuliah</legend>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">Start</label>
                            <div class="col-md-9">
                                <input type="text" id="kuliah_start" nextelement="kuliah_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">End</label>
                            <div class="col-md-9">
                                <input type="text" id="kuliah_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0);" data-head="Kuliah" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
                </div>
            </div>
            <!-- ==== EDOM ==== -->
            <div class="col-md-6 panel-detail">
                <div class="thumbnail">
                    <legend>EDOM</legend>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">Start</label>
                            <div class="col-md-9">
                                <input type="text" id="edom_start" nextelement="edom_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">End</label>
                            <div class="col-md-9">
                                <input type="text" id="edom_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0);" data-head="EDOM" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
                </div>
            </div>
        </div>

        <div class="row dt">
            <!-- ==== UTS ==== -->
            <div class="col-md-6 panel-detail">
                <div class="thumbnail">
                    <legend>UTS</legend>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">Start</label>
                            <div class="col-md-9">
                                <input type="text" id="uts_start" nextelement="uts_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">End</label>
                            <div class="col-md-9">
                                <input type="text" id="uts_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0);" data-head="UTS" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
                </div>
            </div>
            <!-- ==== Nilai UTS ==== -->
            <div class="col-md-6 panel-detail">
                <div class="thumbnail">
                    <legend>Input Nilai UTS</legend>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">Start</label>
                            <div class="col-md-9">
                                <input type="text" id="nilaiuts_start" nextelement="nilaiuts_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">End</label>
                            <div class="col-md-9">
                                <input type="text" id="nilaiuts_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0);" data-head="Input Nilai UTS" data-load="lecturer" class="btn btn-sm btn-info btn-block more_details">More details</a>
                </div>
            </div>

        </div>

        <div class="row dt">
            <!-- ==== UAS ==== -->
            <div class="col-md-6 panel-detail">
                <div class="thumbnail">
                    <legend>UAS</legend>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">Start</label>
                            <div class="col-md-9">
                                <input type="text" id="uas_start" nextelement="uas_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">End</label>
                            <div class="col-md-9">
                                <input type="text" id="uas_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0);" data-head="UAS" data-load="prodi" class="btn btn-sm btn-info btn-block more_details">More details</a>
                </div>
            </div>
            <!-- ==== Nilai UAS ==== -->
            <div class="col-md-6 panel-detail">
                <div class="thumbnail">
                    <legend>Input Nilai UAS</legend>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">Start</label>
                            <div class="col-md-9">
                                <input type="text" id="nilaiuas_start" nextelement="nilaiuas_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-3 control-label">End</label>
                            <div class="col-md-9">
                                <input type="text" id="nilaiuas_end" name="regular" class="form-control form-tahun-akademik">
                            </div>
                        </div>
                    </div>

                    <a href="javascript:void(0);" data-head="Input Nilai UAS" data-load="lecturer" class="btn btn-sm btn-info btn-block more_details">More details</a>
                </div>
            </div>
        </div>
    </div>
</div>







<!-- ====== Modal ======= -->
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog animated jackInTheBox" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="LabelModalDetail">Modal title</h4>
            </div>
            <div id="BodyModalDetail" class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('.form-tahun-akademik').prop('disabled',true);



        $( "#krs_start ,#bayar_start,#kuliah_start,#edom_start,#uts_start,#nilaiuts_start,#uas_start,#nilaiuas_start" ).datepicker({
            showOtherMonths:true,
            autoSize: true,
            dateFormat: 'dd MM yy',
            minDate: new Date(moment().year(),moment().month(),moment().date()),
            onSelect : function () {
                var data_date = $(this).val().split(' ');
                var nextelement = $(this).attr('nextelement')
                nextDatePick(data_date,nextelement);
            }
        });


    });

    $(document).on('click','.more_details',function () {
        var label = $(this).attr("data-head");
        var dataLoad = $(this).attr("data-load");
        var url = base_url_js+'academic/modal-tahun-akademik-detail-'+dataLoad;
        $.post(url,function (html) {

            $('#LabelModalDetail').text(''+label);
            $('#BodyModalDetail').html(html);
            $('.form-tahun-akademik').prop('disabled',editDataTahunAkademik);
            $('#ModalDetail').modal({
                'show' : true,
                'backdrop' : 'static'
            });
        });
    });



    function nextDatePick(value,nextElement) {
        var data_date = value;
        var CustomMoment = moment(data_date[2]+'-'+(parseInt(convertDateMMtomm(data_date[1])) + 1)+'-'+data_date[0]).add(1,'days');
        var CustomMomentYear = CustomMoment.year();
        var CustomMomentMonth = CustomMoment.month();
        var CustomMomentDate = CustomMoment.date();

        $( "#"+nextElement ).val('');
        $( "#"+nextElement ).datepicker( "destroy" );
        $( "#"+nextElement ).datepicker({
            showOtherMonths:true,
            autoSize: true,
            dateFormat: 'dd MM yy',
            minDate: new Date(CustomMomentYear,CustomMomentMonth,CustomMomentDate)
        });
    }

    $(document).on('click','#editFormTahunAkademik',function () {
        $('.form-tahun-akademik').prop('disabled',false);
        $('.form-tahun-akademik').prop('readonly',true);
        $(this).addClass('hide');
        $('#saveFormTahunAkademik').removeClass('hide');
        editDataTahunAkademik = false;

    });

    $(document).on('click','#saveFormTahunAkademik',function () {
        $('.form-tahun-akademik').prop('readonly',false);
        $('.form-tahun-akademik').prop('disabled',true);
        $(this).addClass('hide');
        $('#editFormTahunAkademik').removeClass('hide');
        editDataTahunAkademik = true;
    });

</script>