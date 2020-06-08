<?php

$provinsi_id = $_GET['prov_id'];
$curl = curl_init();

//$url_api = "http://api.rajaongkir.com/starter/city?province=$provinsi_id";
//$key_api = "9d5dfc29026612d5563df0fb3840bf96";

$url_api = "https://pro.rajaongkir.com/api/city?province=$provinsi_id";
$key_api = "80ebd4a124cc35bd4322a8105e34c20f";



curl_setopt_array($curl, array(
  CURLOPT_URL => $url_api,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: $key_api"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}

$data = json_decode($response, true);
for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
  echo "<option value='" . $data['rajaongkir']['results'][$i]['city_id'] . "'>" . $data['rajaongkir']['results'][$i]['city_name'] . "</option>";
}
