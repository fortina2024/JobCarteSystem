
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Signature envoyée avec succès</title>

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

        .check {
            width: 75px;
            height: 75px;
            background: #dcfce7;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin: 0 auto 20px;
        }

        h1 {
            color: #166534;
            font-size: 24px;
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

        <div class="check">&#10003;</div>

        <h1>Signature envoyée avec succès !</h1>

        <p>
            Votre signature a bien été enregistrée.
            Merci d'avoir signé la Job Carte.
        </p>

        <p>Vous pouvez maintenant fermer cette page.</p>

        <button type="button" onclick="window.close()">
            Fermer la page
        </button>

    </div>

</body>
</html>
