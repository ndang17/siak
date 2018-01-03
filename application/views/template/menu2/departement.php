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

      <!-- AKTIF -->
      <li class="current">
        <a href="javascript:void(0);">
          <span class="image"><i class="fa fa-id-card-o"></i></span>
          <span class="title">Akademik Cuy</span>
        </a>
      </li>

    </ul>
  </div> <!-- /#frame -->
</div> <!-- /#project-switcher -->

<script type="text/javascript">
  $('.departement').click(function () {
    var id_departement = $(this).attr('data-id');
    $('.departement').removeClass('current');
    $(this).addClass('current');
    localStorage.setItem('departement',id_departement);
  })
</script>
