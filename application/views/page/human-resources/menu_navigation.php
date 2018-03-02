<div id="sidebar" class="sidebar-fixed">
    <div id="sidebar-content">

        <!--=== Navigation ===-->

        <ul id="nav">



            <li class="<?php if($this->uri->segment(2)=='human-resources'){echo"current";}?>">
                <a href="<?php echo base_url('human-resources/employees');?>">
                    <i class="fa fa-user-circle"></i>
                    Master Karyawan
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2)=='human-resources'){echo"current";}?>">
                <a href="<?php echo base_url('human-resources/lecturers');?>">
                    <i class="fa fa-download"></i>
                    Master Dosen
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-download"></i>
                    Presensi Dosen
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-money"></i>
                    Honor Dosen PartTime
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
