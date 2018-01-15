<div id="sidebar" class="sidebar-fixed">
    <div id="sidebar-content">

        <!--=== Navigation ===-->

        <ul id="nav">

            <li class="<?php if($this->uri->segment(2)=='kurikulum'){echo "current";} ?>">
                <a href="<?php echo base_url('academic/kurikulum'); ?>">
                    <i class="fa fa-university"></i>
                    Kurikulum
                </a>
            </li>

            <li class="<?php if($this->uri->segment(2)=='matakuliah'){echo "current";} ?>">
                <a href="<?php echo base_url('academic/matakuliah'); ?>">
                    <i class="fa fa-th-large"></i>
                    Matakuliah
                </a>
            </li>


            <li class="<?php if($this->uri->segment(2)=='tahun-akademik'){echo "current";} ?>">
                <a href="<?php echo base_url('academic/tahun-akademik'); ?>">
                    <i class="fa fa-calendar-check-o"></i>
                    Tahun Akademik
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='ketersediaan-dosen'){echo "current";} ?>">
                <a href="<?php echo base_url('academic/ketersediaan-dosen'); ?>">
                    <i class="fa fa-pencil-square-o"></i>
                    Ketersediaan Dosen
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='jadwal'){echo "current";} ?>">
                <a href="<?php echo base_url('academic/jadwal'); ?>">
                    <i class="fa fa-calendar"></i>
                    Jadwal
                </a>
            </li>
        </ul>
        <div class="sidebar-title">
            <span>Akademisi</span>
        </div>
        <ul id="nav">

            <li class="">
                <a href="#">
                    <i class="fa fa-tasks"></i>
                    Rencana Studi
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-users"></i>
                    Presensi
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    Jadwal Ujian
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-area-chart"></i>
                    Nilai
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-refresh"></i>
                    Kelas Pengganti
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-flag"></i>
                    Tugas Akhir
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

