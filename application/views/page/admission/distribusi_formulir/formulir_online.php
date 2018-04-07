<div class="row" style="margin-top: 30px;">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>List Formulir Online</h4>
			</div>
			<div class="widget-content">
				<div class = "row">	
					<div class="col-xs-2" style="">
						Tahun
						<select class="select2-select-00 col-md-4 full-width-fix" id="selectTahun">
						    <option></option>
						</select>
					</div>
					<div class="col-xs-2" style="">
						Nomor Formulir
						<input class="form-control" id="NomorFormulir" placeholder="All..." "="">
					</div>
					<div class="col-xs-2" style="">
						Status Activated by Candidate
						<select class="select2-select-00 col-md-4 full-width-fix" id="selectStatus">
						    <option value= "%" selected>All</option>
						    <option value= "0">No</option>
						    <option value= "1">Yes</option>
						</select>
					</div>
					<div  class="col-xs-4" align="right" id="pagination_link"></div>	
					<!-- <div class = "table-responsive" id= "register_document_table"></div> -->
				</div>
				<br>	
				<div id= "formulir_online_table"></div>
			</div>
		</div>
	</div> <!-- /.col-md-6 -->
</div>

<script type="text/javascript">
	$(document).ready(function () {
		loadTahun();
	    loadData(1);
	});

	$(document).on('change','#selectStatus', function () {
    	loadData(1);
    });

    $(document).on('change','#selectTahun', function () {
    	loadData(1);
    });

    $(document).on("keyup", "#NomorFormulir", function(event){
    	var nama = $('#NomorFormulir').val();
    	var n = nama.length;
    	console.log(n);
    	if( this.value.length < 3 && this.value.length != 0 ) return;
    	   /* code to run below */
    	 loadData(1);
	  
	 });

	function loadData(page)
	{
		loading_page('#formulir_online_table');
		var url = base_url_js+'admission/distribusi-formulir/formulir-online/pagination/'+page;
		var selectTahun = $("#selectTahun").find(':selected').val();
		var NomorFormulir = $("#NomorFormulir").val();
		if (NomorFormulir == '') {NomorFormulir = '%'};
		var NamaStaffAdmisi = $("#NamaStaffAdmisi").val();
		if (NamaStaffAdmisi == '') {NamaStaffAdmisi = '%'};
		var selectStatus = $("#selectStatus").find(':selected').val();
		var data = {
					selectTahun : selectTahun,
					NomorFormulir : NomorFormulir,
					NamaStaffAdmisi : NamaStaffAdmisi,
					selectStatus : selectStatus,					
					};
		var token = jwt_encode(data,"UAP)(*");			
		$.post(url,{token:token},function (data_json) {
		    // jsonData = data_json;
		    var obj = JSON.parse(data_json); 
		    // console.log(obj);
		    setTimeout(function () {
	       	    $("#formulir_online_table").html(obj.tabel_formulir_online);
	            $("#pagination_link").html(obj.pagination_link);
		    },500);
		}).done(function() {
	      
	    }).fail(function() {
	      toastr.error('The Database connection error, please try again', 'Failed!!');;
	    }).always(function() {
	      // $('#btn-dwnformulir').prop('disabled',false).html('Formulir');
	    });
	}

	$(document).on("click", ".pagination li a", function(event){
	  event.preventDefault();
	  var page = $(this).data("ci-pagination-page");
	  loadData(page)
	  // loadData_register_document(page);
	 });

	function loadTahun()
    {
        var startTahun = 2018;
        var thisYear = (new Date()).getFullYear();
        var selisih = parseInt(thisYear) - parseInt(startTahun);
        for (var i = 0; i <= selisih; i++) {
            var selected = (i==0) ? 'selected' : '';
            $('#selectTahun').append('<option value="'+ ( parseInt(startTahun) + parseInt(i) ) +'" '+selected+'>'+( parseInt(startTahun) + parseInt(i) )+'</option>');
        }
        $('#selectTahun').select2({
          // allowClear: true
        });

        $('#selectStatus').select2({
          // allowClear: true
        });
    }
</script>
