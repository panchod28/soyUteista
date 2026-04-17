<?php
include('../vendor/autoload.php');
$key = "JSPHPWORKS4everandever!";
@$correoGet = $_GET['email'];
if (isset($correoGet)) {
	if ($correoGet == "") {
		header("Location: index.php");
	}
	if (getEmail($correoGet) == "uts.edu.co") {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://172.16.7.85:9091/api/v1/production/soyuteista/carnet/?key=$key&email=$correoGet",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'X-WebServiceUTSAPI-Key: f910fd9b70mshc4e59787d044bc3p10ea5ejsnbd1f4b7fe6f7'
			),
		));

		$data = curl_exec($curl);
		curl_close($curl);
		$json = json_decode($data, true);
		$rta = $json["data"];

		if (count($rta) >= 17) {
			$sede = $rta['C_UNID_NOMBRE'];
			$carrera = $rta['C_PROG_NOMBRE'];
			$myMail = $rta['C_PENG_EMAILINSTITUCIONAL'];
			$firstname = $rta['C_PENG_PRIMERNOMBRE'] . " " . $rta['C_PENG_SEGUNDONOMBRE'];
			$lastname = $rta['C_PENG_PRIMERAPELLIDO'] . " " . $rta['C_PENG_SEGUNDOAPELLIDO'];
			$fullname = $firstname . " " . $lastname;
			$cedula = $rta['C_PEGE_DOCUMENTOIDENTIDAD'];
			if ($myMail == $correoGet) {
				$ans = "{$fullname} identificado con {$cedula} se encuentra cursando {$carrera} en {$sede}";
			}
		} else {
			$ans = "El usuario con {$correoGet} no tiene una matricula vigente";
		}
	} else {
		$ans = "El usuario consultado no está en este dominio";
	}
} else {
	header("Location: index.php");
}
function getEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$explode = explode('@', $email);
		$domain = array_pop($explode);
	}
	return $domain;
}
?>
<!DOCTYPE html>
<html lang="en">

<head> <?php include("header.php"); ?> </head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" id="form_container">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/uts.png" alt="IMG">
				</div>
				<!-- Form -->
				<?php echo $ans; ?>
			</div>
		</div>
	</div>
	<!--===============================================================================================-->
	<script src="imp/jquery/jquery-3.2.1.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!--===============================================================================================-->
	<script src="imp/bootstrap/js/popper.js"></script>
	<script src="imp/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="imp/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>

</html>