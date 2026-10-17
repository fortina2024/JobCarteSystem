<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">

        <meta name="viewport"
            content="width=device-width, initial-scale=1.0">

        <title>Signature Job Carte</title>

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

            .signature-container {
                margin-top: 20px;
            }

            #signatureCanvas {
                width: 100%;
                height: 220px;
                border: 2px solid #d1d5db;
                border-radius: 8px;
                background: white;
                touch-action: none;
            }

            button {
                padding: 10px 20px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                margin-top: 10px;
            }

            .clear {
                background: #e5e7eb;
            }

            .sign {
                background-color: blue;
                color: white;
                text-decoration: none;
                padding: 8px 15px;
                border-radius: 5px;
                display: inline-block;
            }

            .sign:hover {
                background-color: darkblue;
            }

        </style>
    </head>

    <body>

    <div class="container">

        <h2></h2>

        <p>
            <strong>N° Job Carte :</strong>
            {{ $jobCarte->num_job_carte }}
        </p>

        <p>
            <strong>Client :</strong>
            {{ $jobCarte->client?->nom }}
        </p>

        <hr>

        <h3>Signature du client</h3>

        <p>
            Vous serez dirigé vers une page pour marquer votre signer numérique la Job carte.
        </p>

        <div style="margin-top:15px;">
            @if($jobCarte->signature_status == 'pending' ) {{-- Remplacez 'signature' par le nom exact de votre colonne en BDD si besoin --}}
                <a href="{{ route('job-carte.signature', ['token' => $jobCarte->signature_token]) }}" class="sign" style="color: white; padding: 10px 15px; text-decoration: none; display: inline-block; border-radius: 5px;">
                    Ouvrir la page pour signer cette Job carte
                </a>
            @else
                <span style="color: #10B981; font-weight: bold; display: inline-block; padding: 5px 0;">
                    ✓ Job carte déjà signée et validée
                </span>
            @endif
        </div>

    </div>

    </body>
</html>