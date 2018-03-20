<div id="sidebar" class="sidebar-fixed">
    <div id="sidebar-content">

        <!--=== Navigation ===-->

        <ul id="nav">



            <li class="">
                <a href="#">
                    <i class="fa fa-user-circle"></i>
                    Master Calon Mahasiswa
                </a>
            </li>
            <!--<li class="">
                <a href="#">
                    <i class="fa fa-money"></i>
                    Master Uang Daftar
                </a>
            </li>-->
            <li class="<?php if($this->uri->segment(2)=='master-sma'){echo "current open";} ?>">
                <a href="javascript:void(0);">
                    <i class="icon-edit"></i>
                    Master SMA
                </a>
                <ul class="sub-menu">
                    <li class="<?php if($this->uri->segment(2)=='master-sma' && $this->uri->segment(3) == null ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-sma'); ?>">
                        <i class="icon-angle-right"></i>
                        SMA / SMK
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-sma' && $this->uri->segment(3) == "integration" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-sma/integration'); ?>">
                        <i class="icon-angle-right"></i>
                        Integration
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($this->uri->segment(2)=='master-global'){echo "current open";} ?>">
                <a href="javascript:void(0);">
                    <i class="fa fa-globe"></i>
                    Master Global
                </a>
                <ul class="sub-menu">
                    <li class="<?php if($this->uri->segment(2)=='master-global' && $this->uri->segment(3) == "agama" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-global/agama'); ?>">
                        <i class="icon-angle-right"></i>
                        Agama
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-global' && $this->uri->segment(3) == "wilayah" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-global/wilayah'); ?>">
                        <i class="icon-angle-right"></i>
                        Wilayah
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-global' && $this->uri->segment(3) == "set-email" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-global/jenis-tempat-tinggal'); ?>">
                        <i class="icon-angle-right"></i>
                        Jenis Tempat Tinggal
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-global' && $this->uri->segment(3) == "set-email" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-global/pendapatan'); ?>">
                        <i class="icon-angle-right"></i>
                        Pendapatan
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-global' && $this->uri->segment(3) == "set-email" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-global/tipe-sekolah'); ?>">
                        <i class="icon-angle-right"></i>
                        Tipe Sekolah
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($this->uri->segment(2)=='master-config'){echo "current open";} ?>">
                <a href="javascript:void(0);">
                    <i class="fa fa-address-book-o"></i>
                    Master Config
                </a>
                <ul class="sub-menu">
                    <li class="<?php if($this->uri->segment(2)=='master-config' && $this->uri->segment(3) == "set-email" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-config/set-email'); ?>">
                        <i class="icon-angle-right"></i>
                        Set Email
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-config' && $this->uri->segment(3) == "email-to" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-config/email-to'); ?>">
                        <i class="icon-angle-right"></i>
                        Set Email To
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-config' && $this->uri->segment(3) == "total-account" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-config/total-account'); ?>">
                        <i class="icon-angle-right"></i>
                        Total Account
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-config' && $this->uri->segment(3) == "lama-pembayaran" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-config/lama-pembayaran'); ?>">
                        <i class="icon-angle-right"></i>
                        Lama Pembayaran
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($this->uri->segment(2)=='master-registration'){echo "current open";} ?>">
                <a href="javascript:void(0);">
                    <i class="fa fa-address-book-o"></i>
                    Master Registration
                </a>
                <ul class="sub-menu">
                    <li class="<?php if($this->uri->segment(2)=='master-registration' && $this->uri->segment(3) == "number-formulir" ){echo "open-default";} ?>">
                        <a href="javascript:void(0);">
                        <i class="icon-angle-right"></i>
                        Number Formulir
                        </a>
                        <ul class="sub-menu">
                            <li class="<?php if($this->uri->segment(2)=='master-registration' && $this->uri->segment(3) == "number-formulir" && $this->uri->segment(4) == "online"){echo "current";} ?>">
                                <a href="<?php echo base_url('admission/master-registration/number-formulir/online'); ?>">
                                <i class="icon-angle-right"></i>
                                Online
                                </a>
                            </li>
                            <li class="<?php if($this->uri->segment(2)=='master-registration' && $this->uri->segment(3) == "number-formulir" && $this->uri->segment(4) == "offline"){echo "current";} ?>">
                                <a href="<?php echo base_url('admission/master-registration/number-formulir/offline'); ?>">
                                <i class="icon-angle-right"></i>
                                Offline
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-registration' && $this->uri->segment(3) == "sales-koordinator-wilayah" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-sma/integration'); ?>">
                        <i class="icon-angle-right"></i>
                        Sales Koordinator Wilayah
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-registration' && $this->uri->segment(3) == "sales-koordinator-kota" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-sma/integration'); ?>">
                        <i class="icon-angle-right"></i>
                        Sales Koordinator Kota
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-registration' && $this->uri->segment(3) == "jacket-size" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-registration/jacket-size'); ?>">
                        <i class="icon-angle-right"></i>
                        Jacket Size
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-registration' && $this->uri->segment(3) == "document-checklist" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-registration/document-checklist'); ?>">
                        <i class="icon-angle-right"></i>
                        Document Checklist
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=='master-registration' && $this->uri->segment(3) == "harga-formulir" ){echo "current";} ?>">
                        <a href="<?php echo base_url('admission/master-registration/harga-formulir'); ?>">
                        <i class="icon-angle-right"></i>
                        Harga Formulir
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="#">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                    Distribusi Formulir
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Proses Calon Mahasiswa
                </a>
            </li>
            <li class="">
                <a href="#">
                  <i class="fa fa-exchange" aria-hidden="true"></i>
                    Koreksi Calon Mahasiswa
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
