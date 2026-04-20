<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
include('../vendor/autoload.php');
$key = "JSPHPWORKS4everandever!";
@$correoGet = $_GET['email'];
if (isset($correoGet)) {
    if ($correoGet == "") { header("Location: index.php"); }
    if (getEmail($correoGet) == "uts.edu.co") {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.16.7.85/api/v1/production/soyuteista/carnet2?email=$correoGet",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-WebServiceUTSAPI-Key: f910fd9b70mshc4e59787d044bc3p10ea5ejsnbd1f4b7fe6f7',
                'Host: webservice.uts.edu.co'
            ),
        ));
        $data = curl_exec($curl);
        curl_close($curl);
        $data = mb_convert_encoding($data, 'UTF-8', mb_detect_encoding($data, 'UTF-8, ISO-8859-1, ISO-8859-15', true));
        $json = json_decode($data, true);
        $rta = $json["data"];
        $found = false;
        if (isset($rta[0]) && count($rta[0]) >= 17) {
            $row = $rta[0];
            $sede      = $row['C_UNID_NOMBRE'];
            $carrera   = $row['C_PROG_NOMBRE'];
            $myMail    = $row['C_PENG_EMAILINSTITUCIONAL'];
            $firstname = trim($row['C_PENG_PRIMERNOMBRE'] . " " . $row['C_PENG_SEGUNDONOMBRE']);
            $lastname  = trim($row['C_PENG_PRIMERAPELLIDO'] . " " . $row['C_PENG_SEGUNDOAPELLIDO']);
            $fullname  = $firstname . " " . $lastname;
            $cedula    = $row['C_PEGE_DOCUMENTOIDENTIDAD'];
            if ($myMail == $correoGet) { $found = true; }
        }
    } else {
        $errorMsg = "El correo consultado no pertenece al dominio uts.edu.co";
    }
} else {
    header("Location: index.php");
}
function getEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $explode = explode('@', $email);
        $domain = array_pop($explode);
    }
    return $domain ?? '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet Estudiantil - UTS</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: #1a1f16;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            font-family: 'Nunito', sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(139,165,30,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 80% at 80% 90%, rgba(90,110,20,0.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .page-wrapper {
            width: 100%;
            max-width: 560px;
            position: relative;
            z-index: 1;
        }

        .certificate {
            background: #fafaf7;
            border-radius: 4px;
            overflow: hidden;
            box-shadow:
                0 0 0 1px rgba(139,165,30,0.3),
                0 32px 64px rgba(0,0,0,0.5),
                0 8px 24px rgba(0,0,0,0.3);
            position: relative;
        }

        .cert-accent-top {
            height: 6px;
            background: linear-gradient(90deg, #8ba51e 0%, #b8d432 50%, #6b8015 100%);
        }

        .cert-inner {
            padding: 2.5rem 2.5rem 2rem;
            position: relative;
        }

        .cert-inner::before {
            content: '';
            position: absolute;
            top: 1.5rem; right: 1.5rem; bottom: 1.5rem; left: 1.5rem;
            border: 1px solid rgba(139,165,30,0.15);
            border-radius: 2px;
            pointer-events: none;
        }

        .cert-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(139,165,30,0.2);
            gap: 1rem;
        }

        .cert-logo img {
            height: 80px;
            width: auto;
            flex-shrink: 0;
        }

        .cert-label { text-align: right; }

        .cert-label-title {
            font-family: 'Nunito', sans-serif;
            font-size: clamp(1.05rem, 3.5vw, 1.3rem);
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #8ba51e;
            line-height: 1.3;
        }

        .cert-label-subtitle {
            font-size: clamp(0.9rem, 2.8vw, 1.1rem);
            color: #999;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-top: 4px;
            font-weight: 400;
            line-height: 1.4;
        }

        .cert-body { position: relative; z-index: 1; }

        .cert-type-tag {
            display: inline-block;
            background: rgba(139,165,30,0.1);
            border: 1px solid rgba(139,165,30,0.3);
            color: #6b8015;
            font-size: 0.9rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 7px 18px;
            border-radius: 20px;
            margin-bottom: 1.25rem;
            font-weight: 700;
        }

        .cert-name {
            font-family: 'Nunito', sans-serif;
            font-size: clamp(1.3rem, 5vw, 1.8rem);
            font-weight: 700;
            color: #1a1f16;
            line-height: 1.2;
            margin-bottom: 0.3rem;
        }

        .cert-id {
            font-size: clamp(0.95rem, 2.5vw, 1.1rem);
            color: #888;
            letter-spacing: 0.05em;
            margin-bottom: 1.75rem;
            font-weight: 400;
        }

        .cert-id span {
            color: #555;
            font-weight: 700;
        }

        .cert-divider {
            width: 40px;
            height: 2px;
            background: #8ba51e;
            margin-bottom: 1.75rem;
            border-radius: 2px;
        }

        .cert-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem 1.5rem;
            margin-bottom: 1.75rem;
        }

        .cert-field-label {
            font-size: 0.85rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #aaa;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .cert-field-value {
            font-size: clamp(0.95rem, 2.5vw, 1.1rem);
            color: #2a2a2a;
            font-weight: 600;
            line-height: 1.3;
        }

        .cert-accent-bottom {
            height: 3px;
            background: linear-gradient(90deg, #6b8015 0%, #8ba51e 50%, #b8d432 100%);
            opacity: 0.5;
        }

        .cert-error {
            text-align: center;
            padding: 1rem 0 0.5rem;
        }

        .cert-error-icon {
            width: 58px;
            height: 58px;
            border: 2px solid rgba(180,50,50,0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: #b43232;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .cert-error-title {
            font-family: 'Nunito', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #2a2a2a;
            margin-bottom: 0.5rem;
        }

        .cert-error-msg {
            font-size: 1rem;
            color: #888;
            line-height: 1.6;
        }

        @media (max-width: 480px) {
            .cert-inner { padding: 1.75rem 1.25rem 1.5rem; }
            .cert-inner::before { display: none; }
            .cert-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
            .cert-label { text-align: left; }
            .cert-details { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="certificate">
        <div class="cert-accent-top"></div>
        <div class="cert-inner">

            <div class="cert-header">
                <div class="cert-logo">
                    <img src="images/uts.png" alt="UTS">
                </div>
                <div class="cert-label">
                    <div class="cert-label-title">Verificaci&oacute;n carnet estudiantil</div>
                    <div class="cert-label-subtitle">Unidades Tecnol&oacute;gicas de Santander</div>
                </div>
            </div>

            <div class="cert-body">
                <?php if (isset($found) && $found): ?>

                    <div class="cert-type-tag">Estudiante matriculado</div>

                    <div class="cert-name"><?= htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8') ?></div>
                    <div class="cert-id">C.C. <span><?= htmlspecialchars($cedula, ENT_QUOTES, 'UTF-8') ?></span></div>

                    <div class="cert-divider"></div>

                    <div class="cert-details">
                        <div class="cert-field">
                            <div class="cert-field-label">Programa</div>
                            <div class="cert-field-value"><?= htmlspecialchars($carrera, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                        <div class="cert-field">
                            <div class="cert-field-label">Sede</div>
                            <div class="cert-field-value"><?= htmlspecialchars($sede, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    </div>

                <?php else: ?>

                    <div class="cert-error">
                        <div class="cert-error-icon">!</div>
                        <div class="cert-error-title">Sin matr&iacute;cula vigente</div>
                        <div class="cert-error-msg">
                            <?php if (isset($errorMsg)): ?>
                                <?= htmlspecialchars($errorMsg, ENT_QUOTES, 'UTF-8') ?>
                            <?php else: ?>
                                El usuario <strong><?= htmlspecialchars($correoGet ?? '', ENT_QUOTES, 'UTF-8') ?></strong><br>
                                no tiene una matr&iacute;cula activa en el per&iacute;odo actual.
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
        </div>
        <div class="cert-accent-bottom"></div>
    </div>
</div>
</body>
</html>