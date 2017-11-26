<!--=== Project Switcher ===-->
<div id="project-switcher" class="container project-switcher">
  <div id="scrollbar">
    <div class="handle"></div>
  </div>

  <div id="frame">
    <ul class="project-list">
      <?php
        foreach ($departement as $item) {
      ?>
      <li>
        <a href="<?php echo base_url().$item['url']; ?>">
          <span class="image"><i class="<?php echo $item['icon']; ?>"></i></span>
          <span class="title"><?php echo $item['name']; ?></span>
        </a>
      </li>

      <?php }

       ?>

      <!-- AKTIF
      <li class="current">
        <a href="javascript:void(0);">
          <span class="image"><i class="fa fa-book"></i></span>
          <span class="title">Akademik</span>
        </a>
      </li> -->

    </ul>
  </div> <!-- /#frame -->
</div> <!-- /#project-switcher -->
