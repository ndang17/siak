

<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">

<!--        <ul class="nav nav-tabs">-->
<!--            <li class="active"><a href="#tab_overview" data-toggle="tab">Overview</a></li>-->
<!--            <li><a href="#tab_edit_account" data-toggle="tab">Edit Account</a></li>-->
<!--        </ul>-->

        <div class="tabbable tabbable-custom tabbable-full-width">
            <ul class="nav nav-tabs">
                <li class="<?php if($this->uri->segment(3)=='jadwal'){echo 'active';} ?>"><a href="<?php echo base_url('academic/jadwal/jadwal'); ?>">Jadwal</a></li>
                <li class="<?php if($this->uri->segment(3)=='group-kelas'){echo 'active';} ?>"><a href="<?php echo base_url('academic/jadwal/group-kelas'); ?>">Group Kelas</a></li>
<!--                <li><a href="#tab_1_3" data-toggle="tab">Section 3</a></li>-->
            </ul>
            <div class="tab-content" style="border:none; border-top:1px solid #ddd;">
                <?php echo $contenttabs; ?>
            </div>
        </div>

    </div>
</div>