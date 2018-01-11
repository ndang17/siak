
<style>
    .project-switcher .project-list li.current a {
        background-color : rgb(8, 63, 136);
    }
</style>

<!--=== Project Switcher ===-->
<div id="project-switcher" class="container project-switcher">
    <div id="scrollbar">
        <div class="handle"></div>
    </div>

    <div id="frame">
        <ul class="project-list">
            <!--      --><?php
            //        foreach ($departement as $item) {
            //      ?>
            <!--      <li class="departement" data-id="--><?php //echo $item['id_departement']; ?><!--">-->
            <!--        <a href="javascript:void(0);">-->
            <!--          <span class="image"><i class="--><?php //echo $item['icon']; ?><!--"></i></span>-->
            <!--          <span class="title">--><?php //echo $item['name']; ?><!--</span>-->
            <!--        </a>-->
            <!--      </li>-->
            <!---->
            <!--      --><?php //}
            //
            //       ?>


            <li class="departement <?php if($departement=='admission'){echo 'current';} ?>" data-dpt="admission">
                <a href="javascript:void(0);">
                    <span class="image"><i class="fa fa-users"></i></span>
                    <span class="title">Admission</span>
                </a>
            </li>
            <li class="departement <?php if($departement=='academic'){echo 'current';} ?>" data-dpt="academic">
                <a href="javascript:void(0);">
                    <span class="image"><i class="fa fa-graduation-cap"></i></span>
                    <span class="title">Academic</span>
                </a>
            </li>
            <li class="departement <?php if($departement=='finance'){echo 'current';} ?>" data-dpt="finance">
                <a href="javascript:void(0);">
                    <span class="image"><img src="<?php echo base_url('assets/icon/money.png'); ?>"></span>
                    <span class="title">Finance</span>
                </a>
            </li>

        </ul>
    </div> <!-- /#frame -->
</div> <!-- /#project-switcher -->
