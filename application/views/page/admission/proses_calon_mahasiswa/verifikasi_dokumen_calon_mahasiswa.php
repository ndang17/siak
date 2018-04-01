<div class="row" style="margin-top: 30px;">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>Verifikasi Dokument Calon Mahasiswa</h4>
			</div>
			<div class="widget-content">
				<div  align="right" id="pagination_link"></div>	
				<div class = "table-responsive" id= "register_document_table"></div>
			</div>
		</div>
	</div> <!-- /.col-md-6 -->
</div>

<script type="text/javascript">
	window.jsonData;
	$(document).ready(function () {
	    loadData_register_document(1);
	});

	function loadData_register_document(page)
	{
		// $("#register_document_table").empty();
		loading_page('#register_document_table');
		var url = base_url_js+'admission/proses-calon-mahasiswa/verifikasi-dokument/register_document_table/pagination/'+page;
		$.post(url,function (data_json) {
		    // jsonData = data_json;
		    var obj = JSON.parse(data_json); 
		    // console.log(obj);
		    $("#register_document_table").html(obj.register_document_table);
	      $("#pagination_link").html(obj.pagination_link);
		}).done(function() {
	      // $("#register_document_table").html(jsonData.register_document_table);
	      // $("#pagination_link").html(jsonData.pagination_link);
	    }).fail(function() {
	      toastr.error('The Database connection error, please try again', 'Failed!!');;
	    }).always(function() {
	      // $('#btn-dwnformulir').prop('disabled',false).html('Formulir');
	    });
	}

	$(document).on("click", ".pagination li a", function(event){
	  event.preventDefault();
	  var page = $(this).data("ci-pagination-page");
	  loadData_register_document(page);
	 });
</script>
