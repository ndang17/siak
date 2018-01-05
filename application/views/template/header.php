
<style>
    .navbar .nav > li.current > a {
        background: #0f1f4b85;
    }
</style>

<!-- Header -->
<header class="header navbar navbar-fixed-top" role="banner">
    <!-- Top Navigation Bar -->
    <div class="container">

        <!-- Only visible on smartphones, menu toggle -->
        <ul class="nav navbar-nav">
            <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="fa fa-reorder"></i></a></li>
        </ul>

        <!-- Logo -->
        <a class="navbar-brand" href="index.html">
            <!-- <img src="<?php echo base_url('images/logo-hitam-putih.png'); ?>" alt="Podomoro University" style="width:130px;" /> -->
            <img src="<?php echo base_url('images/logo-header-color.png'); ?>" alt="Podomoro University" style="width:150px;" />
            <!-- <strong>Podomoro</strong> University -->
        </a>
        <!-- /logo -->

        <!-- Sidebar Toggler -->
        <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
            <i class="fa fa-reorder"></i>
        </a>
        <!-- /Sidebar Toggler -->

        <!-- Top Left Menu -->
        <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
            <li class="<?php if($this->uri->segment(1)=='dashboard'){echo 'current';} ?>">
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="icon-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-bullhorn" aria-hidden="true"></i>
                    <span>Announcement</span>
                </a>
            </li>
        </ul>
        <!-- /Top Left Menu -->

        <!-- Top Right Menu -->
        <ul class="nav navbar-nav navbar-right">

            <li>
                <a href="javascript:void(0);">
                    Dept : <span style="color:yellow;"><?php echo ucwords($departement); ?></span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-database"></i>
                    <span>Database</span>
<!--                    <i class="icon-caret-down small"></i>-->
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Dosen</a></li>
                    <li><a href="#">Mahasiswa</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Karyawan</a></li>
                </ul>
            </li>

            <!-- Project Switcher Button -->
            <li class="dropdown">
                <a href="#" class="project-switcher-btn dropdown-toggle">
                    <i class="fa fa-folder-open"></i>
                    <span>Departement</span>
                </a>
            </li>

            <!-- Messages -->
            <li class="dropdown hidden-xs hidden-sm">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope"></i>
                    <span class="badge">1</span>
                </a>
                <ul class="dropdown-menu extended notification">
                    <li class="title">
                        <p>You have 3 new messages</p>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="photo"><img src="<?php echo base_url('assets/template/'); ?>img/demo/avatar-1.jpg" alt="" /></span>
                            <span class="subject">
                <span class="from">Bob Carter</span>
                <span class="time">Just Now</span>
              </span>
                            <span class="text">
                Consetetur sadipscing elitr...
              </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="photo"><img src="<?php echo base_url('assets/template/'); ?>img/demo/avatar-2.jpg" alt="" /></span>
                            <span class="subject">
                <span class="from">Jane Doe</span>
                <span class="time">45 mins</span>
              </span>
                            <span class="text">
                Sed diam nonumy...
              </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="photo"><img src="<?php echo base_url('assets/template/'); ?>img/demo/avatar-3.jpg" alt="" /></span>
                            <span class="subject">
                <span class="from">Patrick Nilson</span>
                <span class="time">6 hours</span>
              </span>
                            <span class="text">
                No sea takimata sanctus...
              </span>
                        </a>
                    </li>
                    <li class="footer">
                        <a href="javascript:void(0);">View all messages</a>
                    </li>
                </ul>
            </li>

            <!-- User Login Dropdown -->
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
                    <i class="fa fa-male"></i>
                    <span class="username">John Doe</span>
                    <i class="fa fa-caret-down small"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="pages_user_profile.html"><i class="fa fa-user"></i> My Profile</a></li>
<!--                    <li><a href="pages_calendar.html"><i class="fa fa-calendar"></i> My Calendar</a></li>-->
<!--                    <li><a href="#"><i class="fa fa-tasks"></i> My Tasks</a></li>-->
                    <li class="divider"></li>
                    <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- /user login dropdown -->
        </ul>
        <!-- /Top Right Menu -->
    </div>
    <!-- /top navigation bar -->

    <?php echo $page_departement; ?>

</header> <!-- /.header -->

<!-- Modal -->
<div class="modal fade" id="modalLoadDepartement" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog animated jackInTheBox" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <center>
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                    <br/>
                    Loading departement . . .
                </center>
            </div>

        </div>
    </div>
</div>
