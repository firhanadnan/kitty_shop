					<?php 
						
						$b = $bahan->row_array();
					?>
					<table>
						<tr>
		                    <th style="width:200px;"></th>
		                    <th>Jenis</th>
		                    <th>Merk</th>
		                    <th>Ukuran</th>
		                    <th>Warna</th>
		                    <th>Harga Beli</th>
		                    <th>Harga Jual</th>
		                    <th>Jumlah</th>
		                </tr>
						<tr>
							<td style="width:200px;"></th>
							<td><input type="text" name="nabar" value="<?php echo $b['nama_satuan'];?>" style="width:200px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="kategori" value="<?php echo $b['nama_kategori'];?>" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><select name="ukuran" id="ukuran" class="form-control">
		                    	<option value="">Pilih</option>
		                    	<?php
		                    		$kobar = $this->input->post('kode_brg');
		                    		$query = $this->db->query("SELECT DISTINCT ukuran FROM tb_ukuran WHERE kd_barang = '$kobar' ORDER BY ukuran DESC")->result_array();
		                    		foreach($query as $qu) :
		                    	?>
		                    	<option value="<?= $qu['ukuran']?>"><?= $qu['ukuran']?></option>
		                    	<?php endforeach;?>
		                    </select></td>
		                    <td>
		                    	<select name="warna" id="warna" class="form-control" >
		                    		<option value="">Pilih</option>		                    	
		                    	</select>
								<div id="loading" style="margin-top: 15px;">
						           <small>Loading...</small>
						        </div>
		                	</td>
		                    <td>     	
		                    	<input type="number" name="harpok" id="harga_beli" style="width:80px;margin-right:5px;" class="form-control input-sm" readonly>
		                    </td>
		                    <td>   	
		                    	<input type="number" name="harjul" id="harga_jual" style="width:80px;margin-right:5px;" class="form-control input-sm" readonly>
		                    </td>
		                   
		                    <td><input type="number" name="jumlah" id="jumlah"  class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
		                    <td><button type="submit" class="btn btn-xs btn-warning">OK</button></td>
						</tr>
					</table>

					<script>
						$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
							// Kita sembunyikan dulu untuk loadingnya
							$("#loading").hide();
							
							$("#ukuran").change(function(){ // Ketika user mengganti atau memilih data provinsi
								$("#warna").hide(); // Sembunyikan dulu combobox kota nya
								$("#loading").show(); // Tampilkan loadingnya
							
								$.ajax({
									type: "POST", // Method pengiriman data bisa dengan GET atau POST
									url: "<?php echo base_url("penjualan/get_warna"); ?>", // Isi dengan url/path file php yang dituju
									data: { ukuran : $("#ukuran").val(),
											kode_brg : $("#kode_brg").val()
									}, // data yang akan dikirim ke file yang dituju
									dataType: "json",
									beforeSend: function(e) {
										if(e && e.overrideMimeType) {
											e.overrideMimeType("application/json;charset=UTF-8");
										}
									},
									success: function(response){ // Ketika proses pengiriman berhasil
										$("#loading").hide(); // Sembunyikan loadingnya
										$("#warna").html(response.list_warna).show();
									},
									error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
										alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
									}
								});
							});
						});
						</script>

						<script>
						$(document).ready(function(){ 							
							$("#warna").change(function(){ // Ketika user mengganti atau memilih data provinsi
								
								$.ajax({
									type: "POST", // Method pengiriman data bisa dengan GET atau POST
									url: "<?php echo base_url("penjualan/get_qty"); ?>", // Isi dengan url/path file php yang dituju
									data: { ukuran : $("#ukuran").val(),
											warna : $("#warna").val(),
											kode_brg : $("#kode_brg").val()
									}, // data yang akan dikirim ke file yang dituju
									dataType: "json",
									success: function(response){ // Ketika proses pengiriman berhasil
										$('#harga_beli').val(response.qty);
										$('#harga_jual').val(response.harga_jual);
									},
									error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
										alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
									}
								});
							});
						});
						</script>

						<script>
							var elX = document.getElementById("harga_beli");
							var elY = document.getElementById("jumlah");

							function limit() {
								elY.value=Math.min(Math.round(elX.value),elY.value);
							}

							elX.onchange=limit;
							elY.onchange=limit;
						</script>

						