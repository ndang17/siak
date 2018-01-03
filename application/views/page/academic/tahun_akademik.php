

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
    <div class="col-md-2">
        <div class="widget box">
            <div class="widget-header">
                <h4 class=""><i class="icon-reorder"></i> Tahun Akademik</h4>
            </div>
            <div class="widget-content">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        20171 | 2017 Ganjil <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <hr/>
                        <div class="">
                            Program : <strong>Reguler</strong>
                        </div>

                    </a>

                    <a href="#" class="list-group-item">
                        20162 | 2016 Genap
                        <hr/>
                        <div class="">
                            Program : <strong>Reguler</strong>
                        </div>

                    </a>
                </div>

                <button class="btn btn-success btn-block">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Tahun Akademik
                </button>
            </div>
        </div>

    </div>

    <div class="col-md-10">
        <div class="widget box" style="display: block;">
            <div class="widget-header">
                <h4 class="header"><i class="fa fa-arrow-right" aria-hidden="true"></i> Detail <?php echo ucwords(str_replace("-"," ",$this->uri->segment(2))); ?></h4>

                <div class="toolbar no-padding">

                    <div class="btn-group">
                        <span class="btn btn-xs" id="setActive" style="color: #51A351;">Set Active</span>
                        <span class="btn btn-xs" id="editFormTahunAkademik"><i class="icon-pencil"></i> Edit</span>
                        <span class="btn btn-success btn-xs hide" id="saveFormTahunAkademik"><i class="icon-check"></i> Save</span>
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>

                </div>


            </div>
            <div class="widget-content" id="detail_tahun_akademik">
            </div>
        </div>



    </div>

</div>

<script>
    $(document).ready(function () {
        //var year = (window.location.hash!='') ? window.location.hash.replace('#','') : <?php //echo $last_kurikulum; ?>//;
        window.editDataTahunAkademik = true;
        var year = 20171;
        page_tahun_akademik(parseInt(year));
    });

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

    $(document).on('click','.item-kurikulum',function () {
        $('.item-kurikulum').removeClass('active');
        $(this).addClass('active');
        var year = $(this).attr('data-year');
        page_kurikulum(year);
    });
    function page_tahun_akademik(year) {
        loading_page('#detail_tahun_akademik');
        var url = base_url_js+"academic/tahun-akademik-detail";
        var data = 123;
        $.post(url,{data_json:data},function (html) {

            setTimeout(function(){
                $('#detail_tahun_akademik').html(html);
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