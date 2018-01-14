

<style>
    .fa-check-circle {
        color: #51A351;
        margin-left: 5px;
    }
    .list-group-item hr {
        margin: 3px;

    }



</style>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-4">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Tahun Akademik</h4>
            </div>
            <div class="widget-content no-padding">

                <div class="list-group" style="margin: 0px;">
                    <?php foreach ($semester as $item_smt) { ?>
                    <a href="#" class="list-group-item">
                        <?php
                            echo $item_smt['YearCode'].' | '.$item_smt['Name'];
                            if($item_smt['Status']==1){
                                echo '<i class="fa fa-check-circle" aria-hidden="true"></i>';
                            }
                            ?>
                       <br/>
                        Program : <strong>Reguler</strong>
                        <hr/>
                        <div style="text-align: right;">
                        <?php echo $item_smt['NameEmployee']; ?>
                        | <?php echo date("d F Y h:m", strtotime($item_smt['UpdateAt'])); ?></div>

                    </a>

                    <?php } ?>
                </div>
            </div>
        </div>

        <div id="tahun_akademik_detail"></div>
    </div>

    <div class="col-md-8">
        <div id="tahun_akademik_detail_date"></div>
    </div>

</div>

<script>
    $(document).ready(function () {
        //var year = (window.location.hash!='') ? window.location.hash.replace('#','') : <?php //echo $last_kurikulum; ?>//;
        window.editDataTahunAkademik = true;
        var year = 20171;
        page_tahun_akademik(parseInt(year));
    });



    $(document).on('click','.item-kurikulum',function () {
        $('.item-kurikulum').removeClass('active');
        $(this).addClass('active');
        var year = $(this).attr('data-year');
        page_kurikulum(year);
    });
    function page_tahun_akademik(year) {

        loading_page('#tahun_akademik_detail');
        loading_page('#tahun_akademik_detail_date');

        var url = base_url_js+"academic/tahun-akademik-detail";
        var data = 123;
        $.post(url,{data_json:data},function (html) {

            setTimeout(function(){
                $('#tahun_akademik_detail').html(html);
            }, 2000);
        });

        var url_date = base_url_js+"academic/tahun-akademik-detail-date";
        $.post(url_date,{data_json:data},function (html) {

            setTimeout(function(){
                $('#tahun_akademik_detail_date').html(html);
            }, 2000);
        });

        // var url = base_url_js+"api/__getKurikulumByYear";
        // loading_page('#detail_kurikulum');
        // $.get(url,{year:year},function (data) {
        //     // console.log(data);
        //     if(data!=null){
        //         var url = base_url_js+"akademik/tahun-akademik-detail";
        //         $.post(url,{data_json:data},function (html) {
        //
        //             setTimeout(function(){
        //                 $('#detail_kurikulum').html(html);
        //             }, 2000);
        //         });
        //         // console.log(window.location);
        //
        //     } else {
        //         setTimeout(function(){
        //             $('#detail_kurikulum').html('<div class="row">' +
        //                 '<div class="col-md-12" style="text-align: center;"><h4>. : : Data Not Found : : .</h4></div>' +
        //                 '</div>');
        //         }, 2000);
        //     }
        // });
    }

</script>