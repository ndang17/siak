<div class="crumbs">
    <ul id="breadcrumbs" class="breadcrumb">
        <li>
            <i class="icon-home"></i>
<!--            <a href="index.html"> --><?php //echo ucwords('Dashboard '.$crumbs_departement); ?><!--</a>-->
            <a href="<?php echo base_url(); ?>">Dashboard</a>
        </li>
        <?php for($i=1;$i<=count($segment);$i++){
            if($i!=1) { ?>
            <li class="current">
                <a href="javascript:void(0);" title=""><?php echo ucwords(str_replace("-"," ",$segment[$i])); ?></a>
            </li>
        <?php }
        } ?>

    </ul>

    <ul class="crumb-buttons">
<!--        <li><a href="javascript:void(0);" title=""><i id="current_time_update"></i><span></span></a></li>-->
        <li><a href="javascript:void(0);" title="">Department : <span style="color:#ff1100;"><?php echo ucwords($departement); ?></span><span></span></a></li>
    </ul>

<!--    <ul class="crumb-buttons">-->
<!--        <li><a href="charts.html" title=""><i class="icon-signal"></i><span>Statistics</span></a></li>-->
<!--        <li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-tasks"></i><span>Users <strong>(+3)</strong></span><i class="icon-angle-down left-padding"></i></a>-->
<!--            <ul class="dropdown-menu pull-right">-->
<!--                <li><a href="form_components.html" title=""><i class="icon-plus"></i>Add new User</a></li>-->
<!--                <li><a href="tables_dynamic.html" title=""><i class="icon-reorder"></i>Overview</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li class="range"><a href="#">-->
<!--                <i class="icon-calendar"></i>-->
<!--                <span></span>-->
<!--                <i class="icon-angle-down"></i>-->
<!--            </a></li>-->
<!--    </ul>-->
</div>

<script>
    $(document).ready(function () {



        // setInterval(function () {
        //     $('#current_time_update').html(moment().format('dddd, Do MMM YYYY h:mm:ss A'));
        // }, 1000);


    });
</script>


<!--<div class="page-header">-->
<!--    <div class="page-title">-->
<!--        <h3>Dashboard</h3>-->
<!--        <span>Good morning, John!</span>-->
<!--    </div>-->

    <!-- Page Stats -->

<!--    <ul class="page-stats">-->
<!--        <li>-->
<!--            <div class="summary">-->
<!--                <span>New orders</span>-->
<!--                <h3>17,561</h3>-->
<!--            </div>-->
<!--            <div id="sparkline-bar" class="graph sparkline hidden-xs">20,15,8,50,20,40,20,30,20,15,30,20,25,20</div>-->
<!--            Use instead of sparkline e.g. this:-->
<!--            <div class="graph circular-chart" data-percent="73">73%</div>-->
<!---->
<!--        </li>-->
<!--        <li>-->
<!--            <div class="summary">-->
<!--                <span>My balance</span>-->
<!--                <h3>$21,561.21</h3>-->
<!--            </div>-->
<!--            <div id="sparkline-bar2" class="graph sparkline hidden-xs">20,15,8,50,20,40,20,30,20,15,30,20,25,20</div>-->
<!--        </li>-->
<!--    </ul>-->
<!--    -->
    <!-- /Page Stats -->
<!--</div>-->