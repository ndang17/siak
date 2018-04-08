<style type="text/css">
	.row {
	    margin-right: 0px;
	    margin-left: 0px;
	}
</style>
<div class="row" style="margin-top: 30px;">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>Set Nilai Ujian</h4>
			</div>
			<div class="widget-content">
				<div class = "row">	
					<div class="col-xs-3" style="">
						PilIh Prody
						<select class="select2-select-00 col-md-4 full-width-fix" id="selectPrody">
						    <option></option>
						</select>
					</div>
					<!-- <div  class="col-xs-4" align="right" id="pagination_link"></div>	 -->
					<!-- <div class = "table-responsive" id= "register_document_table"></div> -->
				</div>
				<br>	
				<div class = 'row'>
					<div  class="col-xs-12" align="right" id="pagination_link"></div>
				</div>
				<div class = 'row'>
					<div id='loadTableData' class="col-md-12"></div>
				</div>
			</div>
		</div>
	</div> <!-- /.col-md-6 -->
</div>

<script type="text/javascript">
	window.processs=[];
	window.processs1=[];
	$(document).ready(function () {
		$('#NotificationModal .modal-header').addClass('hide');
		$('#NotificationModal .modal-body').html('<center>' +
		    '                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>' +
		    '                    <br/>' +
		    '                    Loading Data . . .' +
		    '                </center>');
		$('#NotificationModal .modal-footer').addClass('hide');
		$('#NotificationModal').modal({
		    'backdrop' : 'static',
		    'show' : true
		});
	    loadDataPrody();
	});

	$(document).on('change','#selectPrody', function () {
		loadTableData(1);
	});

	$(document).on("click", ".pagination li a", function(event){
	  event.preventDefault();
	  var page = $(this).data("ci-pagination-page");
	  loadTableData(page)
	  // loadData_register_document(page);
	 });

	function loadDataPrody()
	{
	    var url = base_url_js+"api/__getBaseProdiSelectOption";
	    $('#selectPrody').empty()
	    $.post(url,function (data_json) {
	          for(var i=0;i<data_json.length;i++){
	              var selected = (i==0) ? 'selected' : '';
	              //var selected = (data_json[i].RegionName=='Kota Jakarta Pusat') ? 'selected' : '';
	              $('#selectPrody').append('<option value="'+data_json[i].ID+'" '+selected+'>'+data_json[i].Name+'</option>');
	          }
	          $('#selectPrody').select2({
	             //allowClear: true
	          });
	    }).done(function () {
	      loadTableData(1);
	      $('#NotificationModal').modal('hide');
	    });
	}

	function loadTableData(page)
	{
		// $.removeCookie('__tawkuuid', { path: '/' });
		loading_page('#loadTableData');
		var url = base_url_js+'admission/proses-calon-mahasiswa/jadwal-ujian/set-nilai-ujian/pagination/'+page;
		var selectPrody = $("#selectPrody").find(':selected').val();
		var data = {
					selectPrody : selectPrody,
					};
		var token = jwt_encode(data,"UAP)(*");			
		$.post(url,{token:token},function (data_json) {
		    // jsonData = data_json;
		    var obj = JSON.parse(data_json); 
		    // console.log(obj);
		    setTimeout(function () {
	       	    $("#loadTableData").html(obj.loadtable);
	            $("#pagination_link").html(obj.pagination_link);
		    },500);
		}).done(function() {
	      
	    }).fail(function() {
	      toastr.error('The Database connection error, please try again', 'Failed!!');;
	    }).always(function() {
	      // $('#btn-dwnformulir').prop('disabled',false).html('Formulir');
	    });
	}

	$(document).on('click','#btn-Hitung', function () {
		prosesData();
	});

	function prosesData()
	{
			var no = 0;
			var arr = [];
			var arr_pass = [];
				$(".ID_ujian_perprody").each(function(index) {
				    arr[index] = {
				    	value : $(this).val(),
				    	id_mataujian : $(this).attr('id-mataujian'),
				    	id_formulir : $(this).attr('id-formulir'),
				    	bobot :$(this).attr('bobot'),
				    };
				});
			for(var key in arr) {
		       if (arr[key].value != '') {
		       		arr_pass[no] = arr[key]; 
		       		no++;
		       };
		       // console.log(arr[key].value);
			}
			// console.log(processs);

			for(var key in arr_pass) {
				var bobot_nilai = 0;
			   for(var a in arr_pass) {
			   	 if (arr_pass[key].id_formulir == arr_pass[a].id_formulir) {
			   	 	bobot_nilai += parseInt(arr_pass[a].value) * parseInt(arr_pass[a].bobot);
			   	 }
			   }
		       $("#bobot_nilai"+arr_pass[key].id_formulir).val(bobot_nilai);
		       var jml_bobot = $(".jml_bobot").val();
		       var Nilai_Indeks = bobot_nilai / jml_bobot;
		       // console.log(bobot_nilai);
		       var gradeIndeks = '';	
		       for(var b in grade) {
		       	if (Nilai_Indeks >= grade[b].StartRange && Nilai_Indeks <= grade[b].EndRange) {
		       		gradeIndeks = grade[b].Grade;
		       	}
		       }

		       $("#indeks"+arr_pass[key].id_formulir).val(gradeIndeks);
		       var dataPush = {
		       		value : arr_pass[key].value,
		       		id_mataujian : arr_pass[key].id_mataujian,
		       		id_formulir : arr_pass[key].id_formulir,
		       		bobot :arr_pass[key].bobot,
		       		jml_bobot:jml_bobot,
		       		Nilai_Indeks : Nilai_Indeks,
		       		gradeIndeks : gradeIndeks,
		       	}
		       processs.push(dataPush);
			}
			// console.log(processs.length);
			for (var i = 0; i < processs.length; i++) {
				processs1[i] ={
						value : processs[i].value,
			       		id_mataujian : processs[i].id_mataujian,
			       		id_formulir : processs[i].id_formulir,
			       		bobot :processs[i].bobot,
			       		jml_bobot:processs[i].jml_bobot,
			       		Nilai_Indeks : processs[i].Nilai_Indeks,
			       		gradeIndeks : processs[i].gradeIndeks
				}
			}

			$("#btn-Save").removeClass("hide");
		// console.log(bobot_nilai);
	}

	$(document).on('click','#btn-Save', function () {
		loading_button('#btn-Save');
		  var data = processs1;
		  var token = jwt_encode(data,"UAP)(*");
		  var url = base_url_js+'admission/proses-calon-mahasiswa/jadwal-ujian/set-nilai-ujian/save';
		  $.post(url,{token:token},function (data_json) {
	        var response = jQuery.parseJSON(data_json);
	        toastr.success('Data berhasil disimpan', 'Success!');
	        loadTableData(1);
	        $('#btn-Save').prop('disabled',false).html('Save');
	      })
	});
</script>


