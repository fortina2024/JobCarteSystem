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

            .clear:hover {
                background: #D1D5DB;
            }

            .sign {
                background: #6B7280;
                color: white;
            }
            
            .sign:hover {
                background: #111827;
                color: white;
            }
            .quit,  .quitter {
                background: #ef4444;
                color: white;
            }
            .quitter:hover {
                background: #dc2626;
                color: white;
            }

            .modal-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.55);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                box-sizing: border-box;
                z-index: 1000;
            }

            .modal-overlay[hidden] {
                display: none;
            }

            .modal-box {
                background: white;
                width: 100%;
                max-width: 450px;
                padding: 25px;
                border-radius: 12px;
                box-sizing: border-box;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            .modal-box h3 {
                margin-top: 0;
                margin-bottom: 15px;
                color: #111827;
                font-size: 22px;
            }

            .modal-box p {
                color: #4b5563;
                line-height: 1.6;
                margin-bottom: 15px;
            }

            .modal-actions {
                display: flex;
                justify-content: flex-end;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 25px;
            }

            .modal-actions button {
                padding: 12px 25px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 15px;
                margin-top: 0;
            }

            .modal-actions .clear {
                background: #e5e7eb;
                color: #111827;
            }

            .modal-actions .clear:hover {
                background: #d1d5db;
            }

            .modal-actions .sign {
                background: #111827;
                color: white;
            }

            .modal-actions .sign:hover {
                background: #374151;
            }

            @media (max-width: 480px) {
                .modal-box {
                    padding: 20px;
                }

                .modal-actions {
                    flex-direction: column-reverse;
                }

                .modal-actions button {
                    width: 100%;
                }
            }
        </style>
    </head>

    <body>

    <div class="container">

        <h2>Signature du Job carte</h2>

        <p>
            <strong>N° Job carte :</strong>
            {{ $jobCarte->num_job_carte }}
        </p>

        <p>
            <strong>Client :</strong>
            {{ $jobCarte->client?->nom }}
        </p>

        <hr>

        <p>
            Signez avec votre doigt sur téléphone
            ou avec votre souris sur ordinateur.
        </p>

        <form method="POST" action="{{ route('job-carte.signature.sign', $jobCarte->signature_token) }}">
            @csrf

            <div>

                <canvas
                    id="signature-pad"
                    width="300"
                    height="150"
                    style="
                        border:1px solid #ccc;
                        border-radius:8px;
                        width:100%;
                        max-width:300px;
                        background:white;
                        touch-action:none;
                    "
                ></canvas>
            </div>

            <input
                type="hidden"
                name="signature"
                id="signature"
            >

            <div style="margin-top:15px;">

                <input
                    type="text"
                    id="signed_by_name"
                    name="signed_by_name"
                    hidden
                    style="
                        width:100%;
                        padding:10px;
                        border:1px solid #ccc;
                        border-radius:6px;
                        box-sizing:border-box;
                    "
                    value="{{ $jobCarte->client?->nom }}"
                >
            </div>

            <div style="margin-top:15px;">
                <button type="button" id="clear-signature" class="clear">
                    Effacer
                </button>

                <button type="button" id="open-confirmation" class="sign">
                    Envoyer
                </button>

                <button type="button" onclick="window.close()" class="quitter">
                    Fermer
                </button>
            </div>
        
            <div id="signature-modal" class="modal-overlay" hidden>
                <div class="modal-box" role="dialog"
                    aria-modal="true"
                    aria-labelledby="modal-title">

                    <h3 id="modal-title">Confirmer votre signature</h3>

                    <p>
                        Êtes-vous sûr de vouloir signer cette Job Carte ?
                    </p>

                    <p>
                        <strong>Nom :</strong>
                        <span id="confirmation-name"></span>
                    </p>

                    <p>
                        En confirmant, vous validez votre signature.
                        Cette action ne pourra pas être annulée depuis ce formulaire.
                    </p>

                    <div class="modal-actions">

                        <button type="button" id="cancel-confirmation" class="clear">
                            Annuler
                        </button>

                        <button type="submit" id="confirm-signature" class="sign">
                            Confirmer et envoyer
                        </button>

                    </div>
                </div>
            </div>

        </form>
    </div>

        <script>
            const canvas = document.getElementById('signature-pad');
            const ctx = canvas.getContext('2d');

            let drawing = false;

            ctx.strokeStyle = '#000';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';

            function getPosition(event) {
                const rect = canvas.getBoundingClientRect();

                const clientX = event.touches
                    ? event.touches[0].clientX
                    : event.clientX;

                const clientY = event.touches
                    ? event.touches[0].clientY
                    : event.clientY;

                return {
                    x: (clientX - rect.left) * (canvas.width / rect.width),
                    y: (clientY - rect.top) * (canvas.height / rect.height)
                };
            }

            function startDrawing(event) {
                event.preventDefault();

                drawing = true;

                const position = getPosition(event);

                ctx.beginPath();
                ctx.moveTo(position.x, position.y);
            }

            function draw(event) {
                if (!drawing) {
                    return;
                }

                event.preventDefault();

                const position = getPosition(event);

                ctx.lineTo(position.x, position.y);
                ctx.stroke();
            }

            function stopDrawing() {
                drawing = false;
            }

            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseleave', stopDrawing);

            canvas.addEventListener('touchstart', startDrawing, {
                passive: false
            });

            canvas.addEventListener('touchmove', draw, {
                passive: false
            });

            canvas.addEventListener('touchend', stopDrawing);

            document
                .getElementById('clear-signature')
                .addEventListener('click', function () {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                });

            document.querySelector('form').addEventListener('submit', function (event) {

                const imageData = canvas.toDataURL('image/png');

                document.getElementById('signature').value = imageData;
            });

            const form = document.querySelector('form');
            const modal = document.getElementById('signature-modal');
            const openConfirmation = document.getElementById('open-confirmation');
            const cancelConfirmation = document.getElementById('cancel-confirmation');
            const confirmSignature = document.getElementById('confirm-signature');
            const nameInput = document.getElementById('signed_by_name');
            const signatureInput = document.getElementById('signature');

            openConfirmation.addEventListener('click', function () {
                if (!nameInput.value.trim()) {
                    nameInput.reportValidity();
                    return;
                }

                // Vérifier que le client a dessiné une signature.
                const pixels = ctx.getImageData(
                    0, 0, canvas.width, canvas.height
                ).data;

                let hasSignature = false;

                for (let i = 3; i < pixels.length; i += 4) {
                    if (pixels[i] !== 0) {
                        hasSignature = true;
                        break;
                    }
                }

                if (!hasSignature) {
                    alert('Veuillez dessiner votre signature avant de continuer.');
                    return;
                }

                document.getElementById('confirmation-name').textContent =
                    nameInput.value.trim();

                modal.hidden = false;
            });

            cancelConfirmation.addEventListener('click', function () {
                modal.hidden = true;
            });

            form.addEventListener('submit', function (event) {
                if (modal.hidden) {
                    event.preventDefault();
                    return;
                }

                // Préparer l'image uniquement après confirmation.
                signatureInput.value = canvas.toDataURL('image/png');

                confirmSignature.disabled = true;
                confirmSignature.textContent = 'Envoi en cours...';
            });
        </script>
    </body>
</html>