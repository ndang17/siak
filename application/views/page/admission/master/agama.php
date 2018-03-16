<style type="text/css">
  .setfont
  {
    font-size: 12px;
  }
  
</style>
<div class="row" style="margin-top: 30px;">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder"></i>Data Agama</h4>
            </div>
            <div class="widget-content">
                <!--  -->
                  <div id = "pageData"></div>
                <!-- end widget -->
            </div>
            <hr/>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    loadTable();
  }); // exit document Function

  function loadTable()
  {
    $("#pageData").empty();
    loading_page('#pageData');
    var url = base_url_js+'admission/master-global/loadTableMasterAgama';
    $.post(url,function (data_json) {
        setTimeout(function () {
            $("#pageData").html(data_json);
        },2000);
    });
  }

</script>