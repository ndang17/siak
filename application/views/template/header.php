
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
                <a href="javascript:void(0);" id="btn_announcement">
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
            <li class="dropdown <?php if($this->uri->segment(1)=='database'){echo 'current';} ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-database"></i>
                    <span>Database</span>
<!--                    <i class="icon-caret-down small"></i>-->
                </a>
                <ul class="dropdown-menu">
                    <li class="<?php if($this->uri->segment(2)=='lecturers'){echo 'active';} ?>"><a href="<?php echo base_url('database/lecturers'); ?>">Dosen</a></li>
                    <li class="<?php if($this->uri->segment(2)=='students'){echo 'active';} ?>"><a href="<?php echo base_url('database/students'); ?>">Mahasiswa</a></li>
                    <li class="divider"></li>
                    <li class="<?php if($this->uri->segment(2)=='employees'){echo 'active';} ?>"><a href="<?php echo base_url('database/employees'); ?>">Karyawan</a></li>
                </ul>
            </li>

            <!-- Project Switcher Button -->
            <li class="dropdown <?php if($this->session->userdata('menuDepartement')){echo 'hide';} ?>">
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 8px;padding-bottom: 5px;">
                    <!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
<!--                    <i class="fa fa-male"></i>-->
                    <img src="<?php echo base_url('images/avatar.png'); ?>" class="img-circle" style="max-width: 35px;border: 3px solid #0f1f4b;"/>
                    <span class="username"><?php echo $name; ?></span>
                    <i class="fa fa-caret-down small"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('profile/Nandang-Mulyadi'); ?>">
                            <i class="fa fa-user"></i>
                            My Profile</a></li>
<!--                    <li><a href="pages_calendar.html"><i class="fa fa-calendar"></i> My Calendar</a></li>-->
<!--                    <li><a href="#"><i class="fa fa-tasks"></i> My Tasks</a></li>-->
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)" id="useLogOut"><i class="fa fa-power-off"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- /user login dropdown -->
        </ul>
        <!-- /Top Right Menu -->
    </div>
    <!-- /top navigation bar -->

    <?php echo $page_departement; ?>

</header> <!-- /.header -->

<!-- Global Modal -->
<div class="modal fade" id="GlobalModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated jackInTheBox">
            <div class="modal-header"></div>
            <div class="modal-body"></div>
            <div class="modal-footer"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Notification -->
<div class="modal fade" id="NotificationModal" role="dialog" style="top: 100px;">
    <div class="modal-dialog" style="width: 400px;" role="document">
        <div class="modal-content animated flipInX">
<!--            <div class="modal-header"></div>-->
            <div class="modal-body"></div>
<!--            <div class="modal-footer"></div>-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    $(document).ready(function () {
        $('.departement ,.departement1').addClass('hide');
        loadAllowDivision();
    });

    $(document).on('click','#btn_announcement',function () {
        $('#GlobalModal .modal-header').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title">Announcement</h4>');
        $('#GlobalModal .modal-body').html('Announcement');
        $('#GlobalModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                                                '<button type="button" class="btn btn-primary"><i class="fa fa-paper-plane-o right-margin" aria-hidden="true"></i> Publish</button>');
        $('#GlobalModal').modal({
            'show' : true,
            'backdrop' : 'static'
        });
    });

    $(document).on('click','#useLogOut',function () {
        $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Log Me Out ?? </b> ' +
            '<button type="button" id="btnActionLogOut" class="btn btn-primary" style="margin-right: 5px;">Ya</button>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>' +
            '</div>');
        $('#NotificationModal').modal('show');
    });

    $(document).on('click','#btnActionLogOut',function () {
        var url = base_url_js+"auth/logMeOut";
        loading_page('#NotificationModal .modal-body');
        $.post(url,function (result) {
            setTimeout(function () {
                window.location.href = base_url_js;
            },2000);
        });
    });

    $('.departement').click(function () {
        var url = base_url_js+'change-departement';
        var departement = $(this).attr('data-dpt');
        $.post(url,{departement:departement},function () {

            $('#GlobalModal .modal-header').addClass('hide');
            $('#GlobalModal .modal-body').html('<center>' +
                '                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>' +
                '                    <br/>' +
                '                    Loading departement . . .' +
                '                </center>');
            $('#GlobalModal .modal-footer').addClass('hide');
            $('#GlobalModal').modal({
                'backdrop' : 'static',
                'show' : true
            });

            setTimeout(function () {
                $('#GlobalModal').modal('hide');
                window.location.href = base_url_js+'dashboard';
            },3000);
        });



    });

    function loadAllowDivision() {

        <?php
        $div = $this->session->userdata('ruleUser');
        foreach ($div as $item){ ?>
        allowDepartementNavigation.push(<?php echo $item['IDDivision']; ?>);
        <?php }
        ?>

        for(var i=0;i<allowDepartementNavigation.length;i++){
            $('li[division='+allowDepartementNavigation[i]+']').removeClass('hide');
        }
    };
</script>
