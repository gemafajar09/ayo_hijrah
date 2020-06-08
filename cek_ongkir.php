<?php
$asal = '318';
$id_kabupaten = $_POST['tujuan'];
$kurir = $_POST['kurir'];
$berat = $_POST['berat'];
//$url_api = "http://api.rajaongkir.com/starter/cost";
//$key_api = "9d5dfc29026612d5563df0fb3840bf96";

$url_api = "https://pro.rajaongkir.com/api/cost";
$key_api = "80ebd4a124cc35bd4322a8105e34c20f";

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => $url_api,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "origin=" . $asal . "&originType=city&destination=" . $id_kabupaten . "&destinationType=city&weight=" . $berat . "&courier=" . $kurir . "",
	CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded",
		"key: $key_api"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

//var_dump ($response);
if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$data = json_decode($response, TRUE);

	if (!empty($data['rajaongkir']['results'])) {
		// hitung paket yang tersedia
		if (count($data['rajaongkir']['results'][0]['costs']) == 0) {
			// tampilkan paket tidak tersedia jika paketnya memang tidak ada
			echo "Paket Tidak Tersedia";
		} else {
			$i = 0;
			foreach ($data['rajaongkir']['results'][0]['costs'] as $row) {
				$i += 1;
				$tarif = $row['cost'][0]['value'];
				$service = $row['service'];
				$deskripsi = $row['description'];
				$waktu = $row['cost'][0]['etd'] ? $row['cost'][0]['etd'] : "-";


?>
				<div class="form-group col-lg-4">
					<div class="radio" style='margin: 0px;'>
						<label>
							<input type="radio" name="service" class="service" data-id="<?php echo $i; ?>" value="<?php echo $service; ?>" /> <?php echo $deskripsi; ?>
						</label>
					</div>
					<input type="hidden" name="tarif" id="tarif<?php echo $i; ?>" value="<?php echo $tarif; ?>" />
					<p>
						Tarif <b>Rp <?php echo number_format($tarif, 0); ?></b><br />
						Estimasi sampai <b><?php echo $waktu; ?> hari</b>
					</p>
				</div>
<?php
			}
		}
	} else {
		echo "Paket Tidak Tersedia";
	}
}

?>
<script>
	$(document).ready(function() {
		$(".service").each(function(o_index, o_val) {
			$(this).on("change", function() {
				var did = $(this).attr('data-id');
				var tarif = $("#tarif" + did).val();
				$("#ongkir").val(tarif);
				hitung();
			});
		});
	});
</script>