<div id="sidebar" class="sidebar-fixed">
    <div id="sidebar-content">

        <!--=== Navigation ===-->

        <ul id="nav">



            <li class="<?php if($this->uri->segment(2)=='penerimaan-pembayaran'){echo "current open";} ?>">
                <a href="javascript:void(0);">
                    <i class="fa fa-download"></i>
                    Penerimaan Pembayaran
                </a>
                <ul class="sub-menu">
                    <li class="<?php if($this->uri->segment(2)=='penerimaan-pembayaran' && $this->uri->segment(3) == "verifikasi-pembayaran" ){echo "open-default";} ?>">
                        <a href="javascript:void(0);">
                            <i class="icon-angle-right"></i>
                            Verifikasi Pembayaran
                        </a>
                        <ul class="sub-menu">
                            <li class="<?php if($this->uri->segment(2)=='penerimaan-pembayaran' && $this->uri->segment(3) == "verifikasi-pembayaran" && $this->uri->segment(4) == "registration_online"){echo "current";} ?>">
                                <a href="<?php echo base_url('finance/penerimaan-pembayaran/verifikasi-pembayaran/registration_online'); ?>">
                                    <i class="icon-angle-right"></i>
                                    Registration Online
                                </a>
                            </li>
                            <li class="">
                                <a href="">
                                    <i class="icon-angle-right"></i>
                                    Mahasiswa
                                </a>
                            </li>
                        </ul>    
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Tagihan Mahasiswa
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    Tanggal Cair
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-refresh"></i>
                    Deposit Mahasiswa
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-user-secret"></i>
                    Mr. X
                </a>
            </li>




        </ul>



        <div class="sidebar-widget align-center">
            <div class="btn-group" data-toggle="buttons" id="theme-switcher">
                <label class="btn active">
                    <input type="radio" name="theme-switcher" data-theme="bright"><i class="fa fa-sun-o"></i> Bright
                </label>
                <label class="btn">
                    <input type="radio" name="theme-switcher" data-theme="dark"><i class="fa fa-moon-o"></i> Dark
                </label>
            </div>
        </div>

    </div>
    <div id="divider" class="resizeable"></div>
</div>
<!-- /Sidebar -->


