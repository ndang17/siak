
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

            <li class="departement <?php if($departement=='admission'){echo 'current';} ?>" data-dpt="admission">
                <a href="javascript:void(0);">
                    <span class="image"><img src="<?php echo base_url('assets/icon/admission.png'); ?>"></span>
                    <span class="title">Admission</span>
                </a>
            </li>
            <li class="departement <?php if($departement=='academic'){echo 'current';} ?>" data-dpt="academic">
                <a href="javascript:void(0);">
                    <span class="image"><img src="<?php echo base_url('assets/icon/academic.png'); ?>"></span>
                    <span class="title">Academic</span>
                </a>
            </li>
            <li class="departement <?php if($departement=='finance'){echo 'current';} ?>" data-dpt="finance">
                <a href="javascript:void(0);">
                    <span class="image"><img src="<?php echo base_url('assets/icon/finance.png'); ?>"></span>
                    <span class="title">Finance</span>
                </a>
            </li>
            <li class="departement1 <?php if($departement=='human-resources'){echo 'current';} ?>" data-dpt="human-resources">
                <a href="javascript:void(0);">
                    <span class="image"><img src="<?php echo base_url('assets/icon/hr.png'); ?>"></span>
                    <span class="title">Human Resources</span>
                </a>
            </li>
            <li class="departement1 <?php if($departement=='general-affair'){echo 'current';} ?>" data-dpt="general-affair">
                <a href="javascript:void(0);">
                    <span class="image"><img src="<?php echo base_url('assets/icon/ga.png'); ?>"></span>
                    <span class="title">General Affair</span>
                </a>
            </li>
            <li class="departement1 <?php if($departement=='cooperation'){echo 'current';} ?>" data-dpt="cooperation">
                <a href="javascript:void(0);">
                    <span class="image"><img src="<?php echo base_url('assets/icon/cooperation.png'); ?>"></span>
                    <span class="title">Cooperation</span>
                </a>
            </li>
            <li class="departement1 <?php if($departement=='settings'){echo 'current';} ?>" data-dpt="settings">
                <a href="javascript:void(0);">
                    <span class="image"><img src="<?php echo base_url('assets/icon/settings.png'); ?>"></span>
                    <span class="title">Settings</span>
                </a>
            </li>

        </ul>
    </div> <!-- /#frame -->
</div> <!-- /#project-switcher -->
