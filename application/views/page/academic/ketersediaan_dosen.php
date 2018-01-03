
<style>
    .row-kesediaan {
        padding-top: 5px;
        padding-bottom: 5px;
    }


    .form-time {
        padding-left: 0px;
    }
    .row-kesediaan .fa-plus-circle {
        color: green;
    }
    .row-kesediaan .fa-minus-circle {
        color: red;
    }
    .btn-action {

        text-align: right;
    }
</style>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-5">
        <div class="thumbnail" style="padding: 15px;margin-bottom: 15px;background: lightyellow;">
            <div class="row">
                <label class="col-xs-3 control-label">
                    Tahun Akademik
                </label>
                <div class="col-xs-9">
                    <select class="form-control"></select>
                </div>
            </div>
        </div>
        <div class="widget box">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder"></i> Tambah Data</h4>
            </div>
            <div class="widget-content">
                <!-- Nama Dosen -->
                <div class="row row-kesediaan">
                    <label class="col-xs-3 control-label">Name</label>
                    <div class="col-xs-9">
                        <select class="form-control"></select>
                    </div>
                </div>

                <!-- Kesediaan Hari dan Jam -->
                <div class="row row-kesediaan">
                    <label class="col-xs-3 control-label">Day</label>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-4 form-day">
                                <select class="form-control"></select>
                            </div>
                            <div class="col-xs-3 form-time">
                                <input type="time" class="form-control">
                            </div>
                            <div class="col-xs-3 form-time">
                                <input type="time" class="form-control">
                            </div>
                            <div class="col-xs-2 btn-action">
                                <button class="btn btn-default btn-sm" id="addDays1"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div id="MultyDay"></div>
                    </div>

                </div>

                <!-- Kesediaan Mata Kuliah -->
                <div class="row row-kesediaan">
                    <label class="col-xs-3 control-label">Mata Kuliah</label>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-10">
                                <select class="form-control"></select>
                            </div>
                            <div class="col-xs-2 btn-action">
                                <button class="btn btn-default btn-sm" id="addMK"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div id="MultyMK"></div>
                    </div>
                </div>

                <div style="text-align: right;">
                    <hr/>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-7">
        <div class="widget box" style="display: block;">
            <div class="widget-header">
                <h4 class="header"><i class="fa fa-arrow-right" aria-hidden="true"></i> Detail Kesediaan Dosen Mengajar</h4>

                <div class="toolbar no-padding">

                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>

                </div>


            </div>
            <div class="widget-content" id="kesediaan_dosen">

                <div class="row">

                    <div class="col-md-7">
                        <div class="thumbnail" style="min-height: 100px;">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<script>
    var noElement=1;
    $(document).on('click','#addDays1',function () {
        noElement +=1;
        var rwElement = "rwDays"+noElement;
        $('#MultyDay').append('<div id="'+rwElement+'" class="row" style="margin-top: 10px;">' +
            '<div class="col-xs-4 form-day">' +
            '<select class="form-control"></select>' +
            '</div>' +
            '<div class="col-xs-3 form-time">' +
            '<input type="time" class="form-control">' +
            '</div>' +
            '<div class="col-xs-3 form-time">' +
            '<input type="time" class="form-control">' +
            '</div>' +
            '<div class="col-xs-2 btn-action">' +
            '<button class="btn btn-default btn-sm remove-days" data-element="'+rwElement+'"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>' +
            '</div></div>');
        $('#'+rwElement).animateCss('slideInDown');
    });

    $(document).on('click','.remove-days',function () {
        var rwElement = $(this).attr('data-element');
        $('#'+rwElement).animateCss('flipOutY',function () {
            $('#'+rwElement).remove();
        });

    });

    var noElementMK=1;
    $(document).on('click','#addMK',function () {
        noElementMK +=1;
        var rwElementMK = "rwMk"+noElementMK;
        $('#MultyMK').append('<div class="row" id="'+rwElementMK+'" style="margin-top: 10px;">' +
            '<div class="col-xs-10">' +
            '<select class="form-control"></select>' +
            '</div>' +
            '<div class="col-xs-2 btn-action">' +
            '<button class="btn btn-default btn-sm remove-mk" data-element="'+rwElementMK+'"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>' +
            '</div>' +
            '</div>');
        $('#'+rwElementMK).animateCss('slideInDown');
    });

    $(document).on('click','.remove-mk',function () {
        var rwElementMK = $(this).attr('data-element');
        $('#'+rwElementMK).animateCss('flipOutY',function () {
            $('#'+rwElementMK).remove();
        });
    });
</script>