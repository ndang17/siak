<div id="sidebar" class="sidebar-fixed">
    <div id="sidebar-content">

        <!--=== Navigation ===-->

        <ul id="nav">
            <!--      --><?php //foreach ($navigation as $item) { ?>
<!--                    <li class="current">-->
<!--                      <a href="index.html">-->
<!--                        <i class="--><?php //echo $item['icon']; ?><!--"></i>-->
<!--                        --><?php //echo $item['name']; ?>
<!--            -->
<!--                      </a>-->
<!--                    </li>-->
            <!--      --><?php //} ?>

            <li>
                <a href="javascript:void(0);">
                    <i class="fa fa-database"></i>
                    Kurikulum
<!--                    <span class="label label-info pull-right">6</span>-->
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="fa fa-angle-right"></i>
                            Kurikulum
                        </a>
                    </li>
                    <li>
                        <a href="ui_grid.html">
                            <i class="fa fa-angle-right"></i>
                            Matakuliah
                        </a>
                    </li>
                </ul>
            </li>
<!--            <li class="current">-->
<!--                <a href="index.html">-->
<!--                    <i class="fa fa-database"></i>-->
<!---->
<!---->
<!--                </a>-->
<!--            </li>-->
            <li class="">
                <a href="index.html">
                    <i class="fa fa-desktop"></i>
                    Input Jadwal

                </a>
            </li>
            <li class="">
                <a href="index.html">
                    <i class="fa fa-desktop"></i>
                    Input Jadwal

                </a>
            </li>
            <li class="">
                <a href="index.html">
                    <i class="fa fa-desktop"></i>
                    Input Jadwal

                </a>
            </li>

            <!-- DROPDOWN -->


            <!-- MENU LEVEL -->
<!--            <li>-->
<!--                <a href="javascript:void(0);">-->
<!--                    <i class="fa fa-list-ol"></i>-->
<!--                    4 Level Menu-->
<!--                </a>-->
<!--                <ul class="sub-menu">-->
<!--                    <li class="open-default">-->
<!--                        <a href="javascript:void(0);">-->
<!--                            <i class="fa fa-cogs"></i>-->
<!--                            Item 1-->
<!--                            <span class="arrow"></span>-->
<!--                        </a>-->
<!--                        <ul class="sub-menu">-->
<!--                            <li class="open-default">-->
<!--                                <a href="javascript:void(0);">-->
<!--                                    <i class="fa fa-user"></i>-->
<!--                                    Sample Link 1-->
<!--                                    <span class="arrow"></span>-->
<!--                                </a>-->
<!--                                <ul class="sub-menu">-->
<!--                                    <li class="current"><a href="javascript:void(0);"><i class="fa fa-remove"></i> Sample Link 1</a></li>-->
<!--                                    <li><a href="javascript:void(0);"><i class="fa fa-pencil"></i> Sample Link 1</a></li>-->
<!--                                    <li><a href="javascript:void(0);"><i class="fa fa-edit"></i> Sample Link 1</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                            <li><a href="javascript:void(0);"><i class="fa fa-user"></i>  Sample Link 1</a></li>-->
<!--                            <li><a href="javascript:void(0);"><i class="fa fa-external-link"></i>  Sample Link 2</a></li>-->
<!--                            <li><a href="javascript:void(0);"><i class="fa fa-bell"></i>  Sample Link 3</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="javascript:void(0);">-->
<!--                            <i class="fa fa-globe"></i>-->
<!--                            Item 2-->
<!--                            <span class="arrow"></span>-->
<!--                        </a>-->
<!--                        <ul class="sub-menu">-->
<!--                            <li><a href="javascript:void(0);"><i class="fa fa-user"></i>  Sample Link 1</a></li>-->
<!--                            <li><a href="javascript:void(0);"><i class="fa fa-external-link"></i>  Sample Link 1</a></li>-->
<!--                            <li><a href="javascript:void(0);"><i class="fa fa-bell"></i>  Sample Link 1</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="javascript:void(0);">-->
<!--                            <i class="fa fa-folder-open"></i>-->
<!--                            Item 3-->
<!--                        </a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
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

<script type="text/javascript">
    $(document).ready(function() {
        console.log(localStorage.getItem('departement'));
    });

    function load_navigation() {

    }
</script>
