
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Signature indisponible</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            background: white;
            max-width: 450px;
            width: 100%;
            padding: 35px 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
        }

        .icon {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #fef3c7;
            color: #b45309;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            margin: 0 auto 20px;
        }

        h1 {
            color: #92400e;
            font-size: 23px;
        }

        p {
            color: #4b5563;
            line-height: 1.6;
        }

        button {
            margin-top: 20px;
            padding: 12px 25px;
            background: #111827;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #374151;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon">&#9888;</div>

        <h1>Signature indisponible</h1>

        <p>
            Cette Job Carte a déjà été signée ou le lien de signature
            a expiré.
        </p>

        <p>
            Aucune nouvelle signature n'a été enregistrée.
            Si vous pensez qu'il s'agit d'une erreur, veuillez contacter
            le service concerné.
        </p>

        <button type="button" onclick="window.close()">
            Fermer la page
        </button>
    </div>

</body>
</html>
