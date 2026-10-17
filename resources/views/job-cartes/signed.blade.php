<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Job Carte Signée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .success-box {
            background-color: #ecfdf5;
            border: 1px solid #10b981;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2 style="color: #047857; margin-top: 0;">Job Carte signée avec succès</h2>

    <p>
        <strong>N° Job Carte :</strong> {{ $jobCarte->num_job_carte }}
    </p>

    <p>
        <strong>Client :</strong> {{ $jobCarte->client?->nom }}
    </p>

    <hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 20px 0;">

    <div class="success-box">
        <p style="color: #065f46; margin: 0; font-weight: bold;">
            ✓ Cette Job Carte a été signée et validée le {{ \Carbon\Carbon::parse($jobCarte->signed_at)->format('d/m/Y à H:i') }}.
        </p>
        <p style="color: #047857; margin: 10px 0 0 0;">
            Vous trouverez le <strong>PDF officiel de la Job Carte signé</strong> en pièce jointe de cet e-mail.
        </p>
    </div>

</div>

</body>
</html>