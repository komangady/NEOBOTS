<?php 
	$DATENOW = date("Y-m-d H:i:s");
	$id_penarikantunai = MyDecrypt($_GET["var"]);
	$sql = "SELECT * FROM tb_penarikantunai WHERE id_penarikantunai = '".$id_penarikantunai."'";
	$result = customQuery($sql);
	if(mysql_num_rows($result) > 0)
	{
	
		$sql = "SELECT a.*, b.ang_nama, c.jnssimp_nama FROM tb_penarikantunai a 
				INNER JOIN tb_anggota b ON a.id_anggota = b.id_anggota
				INNER JOIN master_jenissimpanan c ON a.id_jenissimpanan = c.id_jenissimpanan
				WHERE a.id_penarikantunai = '".$id_penarikantunai."'";
		$result = customQuery($sql);
		$hasil = mysql_fetch_assoc($result);
		
		$sql_identitas = "SELECT * FROM master_identitaskoperasi";
		$result_identitas = customQuery($sql_identitas);
		$row_identitas = mysql_fetch_array($result_identitas);
?>

<style>
	.tulisan { 
		font-family: Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace; 
	}
</style>

<!-- ============================================ BAGIAN ========================== -->
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
	
	<div style="width: 100%;" class="tulisan"> 
		<table cellspacing="0">
			<tbody>				
				<tr>
					<td border="0" align="right" width="510"> 
						<p>
							<strong>
							<?php echo $row_identitas["idk_namakoperasi"]; ?>
							<br>
							</strong>
							<?php echo $row_identitas["idk_alamat"]; ?>						
						</p>
						
					</td>
				</tr>
				<tr>
					<td border="0"> 
						<p>
							<strong>								
								<u>BUKTI PENARIKAN TUNAI</u>								
							</strong>					
						</p>
					</td>
				</tr>		
				
			</tbody>
		</table>	
		<br>
		<table cellspacing="0" style="font-size:11px">
			<tbody>				
				<tr>
					<td border="0" width="120"> 
						Tanggal Transaksi 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="185"> 
						 <?php echo $hasil["pt_tglpenarikan"]; ?>
					</td>
					
					<!-- SEBELAH KANAN -->
					<td border="0" width="100"> 
						Tanggal Cetak :
					</td>
					
					
				</tr>
				<tr>
					<td border="0" width="120"> 
						Nomor Transaksi 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="140"> 
						 <?php echo $hasil["id_penarikantunai"]; ?>
					</td>
					
					<!-- SEBELAH KANAN -->
					<td border="0" width="240"> 
						<?php echo $DATENOW; ?>
					</td>
					
				</tr>
				<tr>
					<td border="0" width="120"> 
						ID Anggota 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="140"> 
						 <?php echo $hasil["id_anggota"]; ?>
					</td>
					
					<!-- SEBELAH KANAN -->
					<td border="0" width="240"> 
						User Akun :
					</td>
				</tr>
				<tr>
					<td border="0" width="120"> 
						Nama Anggota 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="150"> 
						 <?php echo $hasil["ang_nama"]; ?>
					</td>
					
					<!-- SEBELAH KANAN -->
					<td border="0" width="240"> 
						<?php echo $_SESSION["user"]; ?>
					</td>
				</tr>
				<tr>
					<td border="0" width="120">						
					</td>
					<td border="0" width="10"> 
					</td>
					<td border="0" width="150"> 
					</td>
				</tr>
				<tr>
					<td border="0" width="120"> 
						Identitas Kuasa 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="150"> 
						  <?php echo ($hasil["pt_noidentitaskuasa"] == null ? "-": $hasil["pt_noidentitaskuasa"]); ?>
					</td>
					
					<!-- SEBELAH KANAN -->
					<td border="0" width="240"> 
						Paraf,  
					</td>
				</tr>
				<tr>
					<td border="0" width="120"> 
						Nama Kuasa 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="150"> 
						 <?php echo ($hasil["pt_namakuasa"] == null ? "-": $hasil["pt_namakuasa"]); ?>
					</td>
				</tr>
				<tr>
					<td border="0" width="120"> 
						Alamat Kuasa 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="150"> 
						  <?php echo ($hasil["pt_alamatkuasa"] == null ? "-": $hasil["pt_alamatkuasa"]); ?>
					</td>
				</tr>
				<tr>
					<td border="0" width="120"> 
						Jenis Simpanan 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="150"> 
						 <?php echo $hasil["jnssimp_nama"]; ?>
					</td>
				</tr>
				<tr>
					<td border="0" width="120"> 
						Jumlah Penarikan 
					</td>
					<td border="0" width="10"> 
						:
					</td>
					<td border="0" width="150"> 
						Rp. <?php echo $hasil["pt_jmlpenarikan"]; ?>
					</td>
					
					<!-- SEBELAH KANAN -->
					<td border="0" width="240"> 
						<u><?php echo $_SESSION["nama"] ?></u>
					</td>
				</tr>
			</tbody>
		</table>

		<br>
		<br>
		<br>
		<!-- KETERANGAN AKHIR -->
		<table cellspacing="0" style="font-size:8px">
			<tbody>				
				<tr>
					<td border="0" align="center" width="510"> 
						Informasi Hubungi Call Center (WA): <?php echo $row_identitas["idk_nohp"]; ?>						
					</td>
				</tr>
				<tr>
					<td border="0" align="center" width="510"> 
						atau dapat diakses melalui : <?php echo $row_identitas["idk_website"]; ?>						
					</td>
				</tr>
				<tr>
					<td border="0" align="center" width="510"> 
						Email : <?php echo $row_identitas["idk_email"]; ?>						
					</td>
				</tr>
				
				<tr>
					<td border="0" align="center" width="510"> 
						<br>
						** Tanda terima ini sah jika dibubuhi cap dan tangan oleh Admin						
					</td>
				</tr>
			</tbody>
		</table>	
		
	</div>
</page>
<?php
	}
	else
	{
		header("location:./");
	}
?>
<!-- ============================================ BAGIAN END ========================== -->



