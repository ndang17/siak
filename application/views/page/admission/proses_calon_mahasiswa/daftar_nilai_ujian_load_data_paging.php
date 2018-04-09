<style type="text/css">
	.btn-Hitung {
		background-color: #e20f0f;
	}
	.btn-Save{
		background-color: #1ace37;
	}

	hr.style-eight {
		height: 10px;
		border: 1;
		box-shadow: inset 0 9px 9px -3px rgba(11, 99, 184, 0.8);
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		-ms-border-radius: 5px;
		-o-border-radius: 5px;
		border-radius: 5px;
	}
</style>
<?php if (count($datadb) > 0 ): ?>
	<div id = "tblData" class="table-responsive">
		<table class="table table-striped table-bordered table-hover table-checkable tableData">
			<!-- <caption><strong>List Dokumen</strong></caption> -->
			<thead>
				<tr>
					<th style="width: 10px;">No</th>
					<th style="width: 200px;">Nama</th>
					<?php for ($i = 0; $i < count($mataujian); $i++): ?>
						<?php 
							$NamaUjian = (strlen($mataujian[$i]['NamaUjian']) > 15) ? substr($mataujian[$i]['NamaUjian'], 0,15).'...' : $mataujian[$i]['NamaUjian'] ;
						 ?>
						<th style="width: 100px;"><?php echo $NamaUjian.'('.$mataujian[$i]['Bobot'].')' ?></th>
					<?php endfor; ?>
					<th style="width: 40px;">Jml Bobot</th>
					<th style="width: 100px;">Jml Bobot * Nilai</th>
					<th style="width: 40px;">Indeks</th>
					<th style="width: 40px;" class = 'autohide hide'>Kelulusan</th>
				</tr>
			</thead>
			<tbody> 
				<?php for ($i = 0; $i < count($datadb); $i++): ?>
					<?php $jml_bobot = 0 ?>
						<tr class = 'ID_ujian_perprody<?php echo $datadb[$i]['ID_register_formulir'] ?>'>
							<td><?php echo $no++ ?></td>
							<td><?php echo $datadb[$i]['NameCandidate'] ?></td>
							<?php for ($j = 0; $j < count($mataujian); $j++): ?>
								<td>
									<select class="ID_ujian_perprody select2-select-00 col-md-4 full-width-fix" id-mataujian ='<?php echo $mataujian[$j]['ID'] ?>' bobot = '<?php echo $mataujian[$j]['Bobot'] ?>' id-formulir = '<?php echo $datadb[$i]['ID_register_formulir'] ?>'>
										<?php for ($k = 0; $k <= 100; $k++): ?>
										<?php $selected = ($k == 80) ? 'selected' : '' ?>	
									    <option value="<?php echo $k ?>" <?php echo $selected ?>><?php echo $k ?></option>
									    <?php endfor; ?>
									</select>
								</td>	
								<?php $jml_bobot = $jml_bobot + $datadb[$i]['Bobot'] ?>
							<?php endfor; ?>	
							<td><input type="text" class = 'jml_bobot form-control' value="<?php echo $jml_bobot ?>" readonly></td>
							<td><input type="text" class = 'bobot_nilai form-control' id = 'bobot_nilai<?php echo $datadb[$i]['ID_register_formulir'] ?>' readonly></td>
							<td><input type="text" class = 'indeks form-control' id = 'indeks<?php echo $datadb[$i]['ID_register_formulir'] ?>' readonly></td>
							<td class = 'autohide hide'>
								<select id='kelulusan<?php echo $datadb[$i]['ID_register_formulir'] ?>' class="kelulusan select2-select-00 col-md-4 full-width-fix">
									<option value ='Lulus;<?php echo $datadb[$i]['ID_register_formulir'] ?>' selected>Lulus</option>
									<option value ='Tidak Lulus;<?php echo $datadb[$i]['ID_register_formulir'] ?>'>Tidak Lulus</option>
								</select>
							</td>
						</tr>	
				<?php endfor; ?>
			</tbody>
		</table>
	</div>
	<div class="col-xs-12" align = "right">
	   <button class="btn btn-inverse btn-notification btn-Hitung" id="btn-Hitung">Hitung</button>
	   <button class="btn btn-inverse btn-notification btn-Save hide" id="btn-Save">Save</button>
	</div>			
<?php else: ?>
<div align = 'center'>No Result Data...</div>		
<?php endif ?>

<script type="text/javascript">
	window.grade = <?php echo $grade ?>;
	$(document).ready(function () {
		$('.ID_ujian_perprody').select2({
		   //allowClear: true
		});

		$('.kelulusan').select2({
		   //allowClear: true
		});
		// console.log(grade);
	});

</script>

