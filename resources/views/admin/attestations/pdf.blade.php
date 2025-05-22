<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attestation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .content {
            margin: 40px 0;
            text-align: justify;
        }
        .footer {
            margin-top: 60px;
            text-align: right;
        }
        .signature {
            margin-top: 40px;
            text-align: right;
        }
        .attestation-number {
            text-align: right;
            margin-bottom: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="attestation-number">
        N° {{ $attestation->numero_attestation }}
    </div>

    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
        <h1>ATTESTATION DE {{ strtoupper($attestation->type_attestation) }}</h1>
    </div>

    <div class="content">
        {!! str_replace(
            ['{nom}', '{prenom}', '{classe}'],
            [$attestation->student->nom, $attestation->student->prenom, $attestation->student->classe],
            $attestation->contenu
        ) !!}
    </div>

    <div class="signature">
        <p>Fait à ................................., le {{ $attestation->date_emission->format('d/m/Y') }}</p>
        <p>Le Directeur</p>
        <br><br><br>
        <p>.................................</p>
    </div>

    <div class="footer">
        <p>Cachet de l'établissement</p>
    </div>
</body>
</html> 