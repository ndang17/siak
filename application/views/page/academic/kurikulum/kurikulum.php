

<div class="row" style="margin-top: 30px;">
    <div class="col-md-6 col-md-offset-3">
        <div class="thumbnail">
            <div class="row">
                <div class="col-xs-4" style="">
                    <select class="form-control" id="selectKurikulum">
                        <?php $no=1; foreach ($kurikulum as $item){ ?>
                            <option value="<?php echo $item['Year']; ?>"><?php echo $item['Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-8" style="text-align: right;">
                    <button data-page="inputjadwal" class="btn btn-success btn-action control-jadwal"><i class="fa fa-plus-circle right-margin" aria-hidden="true"></i> Add Kerikulum</button>
                    <button data-page="ruangan" class="btn btn-primary btn-action control-jadwal"><i class="fa fa-eye right-margin" aria-hidden="true"></i> All Mata Kuliah</button>
                    <button class="btn btn-default control-jadwal"><i class="fa fa-download right-margin" aria-hidden="true"></i> PDF</button>
                    <button class="btn btn-default control-jadwal"><i class="fa fa-download right-margin" aria-hidden="true"></i> CSV</button>
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

        // pageKurikulum();

    });

    $(document).on('change','#selectKurikulum',function () {
        pageKurikulum();
    });

    function pageKurikulum() {
        var url = base_url_js+'academic/kurikulum-detail';
        $.get(url,function (page) {
            $('#pageKurikulum').html(page);
        });

    }
</script>