
<style>
    .updater-kurikulum {
        color: #607D8B;
        font-size: 0.7em;
        padding-top: 5px;
    }
    a.list-group-item.active .updater-kurikulum {
        color: #FFFFFF;
    }
</style>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-2">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Daftar Kurikulum</h4>
            </div>
            <div class="widget-content">
                <div class="list-group">
                    <?php $no=1; foreach ($kurikulum as $item){ ?>
                    <a href="#<?php echo $item['Year']; ?>" data-year="<?php echo $item['Year']; ?>" class="item-kurikulum list-group-item <?php if($no==1) { echo  'active' ;} ?>">
                        <?php echo $item['Name']; ?>
                        <div class="updater-kurikulum">
                            Update By : <strong><i class="fa fa-user" aria-hidden="true"></i> <?php echo $item['UpdateByName']; ?></strong>
                            <br/>
                            <?php echo date("d F Y H:i:s", strtotime($item['UpdateAt'])); ?>
                        </div>
                    </a>
                    <?php $no+= 1;} ?>

                </div>

                <button class="btn btn-success btn-block"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Kurikulum</button>
            </div>
        </div>

    </div>

    <div class="col-md-10">
        <div class="widget box" style="display: block;">
            <div class="widget-header">
                <h4 class="header"><i class="fa fa-arrow-right" aria-hidden="true"></i> Detail Kurikulum</h4>
                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content" id="detail_kurikulum">



            </div>
        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        var year = (window.location.hash!='') ? window.location.hash.replace('#','') : <?php echo $last_kurikulum; ?>;
        page_kurikulum(parseInt(year));
    });

    $(document).on('click','.item-kurikulum',function () {
        $('.item-kurikulum').removeClass('active');
        $(this).addClass('active');
        var year = $(this).attr('data-year');
        page_kurikulum(year);
    });
    function page_kurikulum(year) {

        var url = base_url_js+"api/__getKurikulumByYear";
        loading_page('#detail_kurikulum');
        $.get(url,{year:year},function (data) {
            // console.log(data);
            if(data!=null){
                var url = base_url_js+"academic/kurikulum-detail";
                $.post(url,{data_json:data},function (html) {

                    setTimeout(function(){
                        $('#detail_kurikulum').html(html);
                    }, 2000);
                });
                // console.log(window.location);

            } else {
                setTimeout(function(){
                    $('#detail_kurikulum').html('<div class="row">' +
                        '<div class="col-md-12" style="text-align: center;"><h4>. : : Data Not Found : : .</h4></div>' +
                        '</div>');
                }, 2000);
            }
        });
    }



</script>