<x-filament-panels::page>
    <div class="job-carte-sheet" style="background: white; padding: 20px; border-radius: 4px; font-family: Arial, sans-serif; color: #111; width: 100%; max-width: 900px; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 10px;">
            <div>
                <h1 style="font-size: 20px; font-weight: bold; margin: 0;">JOB CARTE</h1>
            </div>
            <div style="text-align: right;">
                <p style="margin: 0; font-size: 16px;">N° : <span style="font-weight:600;">{{ $record->num_job_carte ?? 'J-000000' }}</p>
                <p style="margin: 5px 0 0 0; font-size: 14px; color: #555;">Date : <span style="font-weight:600;">{{ $record->created_at?->format('Y-m-d H:i:s') ?? '2026-10-16 00:00:00' }}</p>
            </div>
        </div>

        <!-- INFORMATIONS CLIENT & SITE -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px; font-size: 14px;">
            <tr>
                <td style="padding: 6px 0; width: 50%;">Client : <span style="font-weight:600;">{{ $record->client?->nom ?? 'Swala Logistics' }}</span></td>
                <td style="padding: 6px 0; width: 50%;">Nº Commande : <span style="font-weight:600;">{{ $record->num_commande ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 6px 0;">Site : <span style="font-weight:600;">{{ $record->site?->name ?? 'Swala Logistics' }}</span></td>
                <td style="padding: 6px 0;">Contact : <span style="font-weight:600;">{{ $record->contact ?? '' }}</span></td>
            </tr>
        </table>

        <!-- DESCRIPTION VÉHICULE -->
        <div style="background: #f3f4f6; padding: 8px 12px; font-weight: bold; font-size: 12px; border: 1px solid #d1d5db; margin-bottom: 10px;">
            DESCRIPTION VÉHICULE
        </div>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px;">
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">ID VÉHICULE : <span style="font-weight:600;">{{ $record->vehicule?->identifiant_vehicule ?? '1129' }}</span></td> 
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">NOM REF : <span style="font-weight:600;">{{ $record->vehicule?->nom_ref ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">DATE MISE A DISP. : <span style="font-weight:600;">{{ $record->vehicule?->date_mise_en_disposition ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° SIM IMSI : <span style="font-weight:600;">{{ $record->vehicule?->imsi_sim ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° REF : <span style="font-weight:600;">{{ $record->vehicule?->num_ref ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">HEURE MISE A DISP. : <span style="font-weight:600;">{{ $record->vehicule?->heure_mise_en_disposition ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° DATA : <span style="font-weight:600;">{{ $record->vehicule?->num_data ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° VOIX : <span style="font-weight:600;">{{ $record->vehicule?->num_voix ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">NOUV N° APPEL : <span style="font-weight:600;">{{ $record->vehicule?->nouv_num_appel ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="3">PIN : <span style="font-weight:600;">{{ $record->vehicule?->pin ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="2">TYPE BOITIER : <span style="font-weight:600;">{{ $record->vehicule?->type_boitier ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° SERIE : <span style="font-weight:600;">{{ $record->vehicule?->num_serie ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="2">MARQUE / MODELE : <span style="font-weight:600;">{{ $record->vehicule?->marque ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° CHASSIS : <span style="font-weight:600;">{{ $record->vehicule?->num_chassis ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° IMMOBILISATION : <span style="font-weight:600;">{{ $record->vehicule?->num_immobilisation ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° FLOTTE : <span style="font-weight:600;">{{ $record->vehicule?->num_flotte ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">N° MATRICULE : <span style="font-weight:600;">{{ $record->vehicule?->num_matricule ?? '' }}</span></td>
            </tr>
        </table>

        <!-- PRE / POST INSPECTION VÉHICULE -->
        <div style="background: #f3f4f6; padding: 8px 12px; font-weight: bold; font-size: 12px; border: 1px solid #d1d5db; margin-bottom: 10px;">
            PRE / POST INSPECTION VÉHICULE
        </div>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px; text-align: center;" border="1" bordercolor="#d1d5db">
            <thead>
                <tr style="background: #f9fafb;">
                    <th style="text-align: left; padding: 4px;"></th>
                    <th style="width: 90px;">Avant</th>
                    <th style="width: 90px;">Après</th>
                    <th style="text-align: left; padding: 4px;"></th>
                    <th style="width: 90px;">Avant</th>
                    <th style="width: 90px;">Après</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Petit helper Blade pour générer une case à cocher colorée dynamiquement (true = vert, false = rouge ou vide)
                    // Vous pouvez remplacer true/false par vos variables de $record
                    $renderCheckbox = function($isChecked) {
                        $bg = $isChecked ? '#16a34a' : '#dc2626'; // Vert si true, Rouge si false (ou changez selon vos besoins)
                        $symbol = $isChecked ? '✓' : '✕';
                        return '<span style="display: inline-flex; align-items: center; justify-content: center; width: 16px; height: 16px; background-color: ' . $bg . '; color: white; font-weight: bold; border-radius: 4px; font-size: 14px;">' . $symbol . '</span>';
                    };
                @endphp

                <tr>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">PEINTURE / ÉTAT EXT.</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">AFFICHAGE CODES DEFAUT</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">PANNEAUX / ÉTAT INTER.</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">ECLAIRAGE INTÉRIEUR</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">DEMARRAGE VÉHICULE</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">FEUX (Avant / Arrière)</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">INSTRUMENTS</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">DÉTRESSE</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">RADIO</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!}</td>
                    <td style="text-align: left; padding: 4px; border-bottom: 1px solid #e5e7eb;">-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>

        <!-- COMMENTAIRES -->
        <div style="margin-bottom: 20px; font-size: 13px;">
            COMMENTAIRES :
            <div style="border: 1px solid #d1d5db; min-height: 40px; padding: 4px; margin-top: 5px; border-radius: 4px;"></div>
        </div>

        <!-- DETAILS L'INTERVENTION -->
        <div style="background: #f3f4f6; padding: 8px 12px; font-weight: bold; font-size: 12px; border: 1px solid #d1d5db; margin-bottom: 10px;">
            DETAILS L'INTERVENTION
        </div>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px;" border="1" bordercolor="#d1d5db">
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!} NOUVELLE INSTALLATION</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!} GPRS/GSM VÉRIFIÉ</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">TEMPS DÉBUT :  <span style="font-weight:600;">{{ $record->intervention?->temps_debut_intervention ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">TEMPS FIN : <span style="font-weight:600;">{{ $record->intervention?->temps_fin_intervention ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(false) !!} RÉINSTALLATION</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!} ARRÊT VÉHICULE VÉRIFIÉ</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">DURÉE TEST : <span style="font-weight:600;">{{ $record->intervention?->duree_test_arret_vehicule_verifie ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">DISTANCE TEST : <span style="font-weight:600;">{{ $record->intervention?->distance_arret_vehicule_verifie ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(false) !!} MAINTENANCE</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!} FM TERMINAL VÉRIFIÉ</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">VITESSE MAX : <span style="font-weight:600;">{{ $record->intervention?->vitesse_max_fm_terminal_verifie ?? '' }}</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">RPM MAX : <span style="font-weight:600;">{{ $record->intervention?->rpm_max_fm_terminal_verifie ?? '' }}</td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(false) !!} PANNE</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!} VOICE KIT VÉRIFIÉ</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="2">ODO/HRS MOTEUR FIXE A : <span style="font-weight:600;">{{ $record->intervention?->odo_hrs_moteur_fixe ?? '' }}</td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(false) !!} DÉSINSTALLATION</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!} RF READER VÉRIFIÉ</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="2">PLAGE BANDE VERTE DE : <span style="font-weight:600;">{{ $record->intervention?->	plage_bande_verte_de ?? '' }} A : {{ $record->intervention?->	plage_bande_verte_a ?? '' }}</td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">VERSION DDR'S CHARGEE : <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">{!! $renderCheckbox(true) !!} PROXIMITE VERIFIEE</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="2">SUR REGIME : <span style="font-weight:600;">{{ $record->intervention?->sur_regime ?? '' }} A : {{ $record->intervention?->	plage_bande_verte_a ?? '' }}</td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">CALIBRATION VITESSE : <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">PAR DISTANCE FIXE {!! $renderCheckbox(true) !!}<span style="padding:0 10px;"></span> PAR TABLEAU {!! $renderCheckbox(true) !!}</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="2">VITESSE GPS {!! $renderCheckbox(true) !!}<span style="padding:0 10px;"></span> CAN {!! $renderCheckbox(true) !!}</td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">DEBUT HRS SUPP : <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">FIN HRS SUPP : <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="2">TOTAL HRS SUPP : <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">TEMPS ATTENTE POUR : <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;">DEBUT ATTENTE <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</span></td>
                <td style="padding: 4px; border-bottom: 1px solid #e5e7eb;" colspan="2">FIN ATTENTE <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</span></td>
            </tr>
            <tr>
                <td style="padding: 6px 4px; border: 1px solid #e5e7eb;" colspan="4">OBSERVATION : <span style="font-weight:600;">{{ $record->intervention?->version_dors_chargee ?? '' }}</td>
            </tr>
        </table>

        <!-- SIGNATURE ET VALIDATION -->
        <div style="display: flex; justify-content: space-between; margin-top: 30px; border-top: 2px solid #333; padding-top: 15px;">
            <div>
                <p style="margin: 0; font-size: 13px;">Nom et Signature du client :</p>
                @if($record->signature_path)
                    <img src="{{ asset('storage/' . $record->signature_path) }}" alt="Signature" style="max-width: 200px; margin-top: 10px; border: 1px solid #ccc; padding: 5px;">
                @else
                    <div style="height: 60px; width: 200px; border: 1px dashed #ccc; margin-top: 10px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 12px;">Non signé</div>
                @endif
                <p style="margin: 5px 0 0 0; font-size: 12px; color: #555;">Signé le : <span style="font-weight:600;">{{ $record->updated_at?->format('Y-m-d H:i') ?? '' }}</p>
            </div>
            <div style="text-align: right;">
                <p style="margin: 0; font-size: 13px;">Nom du technicien</p>
                <p style="margin: 0; font-size: 13px; font-weight: bold;">{{ $record->user?->name ?? '' }}</p>
            </div>
        </div>

    </div>

    <!-- Styles CSS pour forcer la largeur maximale dans Filament -->
    @push('styles')
    <style>
        .dark .job-carte-sheet {
            background: #18181b !important;
            color: #f4f4f5 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25) !important;
        }

        .dark .job-carte-sheet [style*="background: #f3f4f6"],
        .dark .job-carte-sheet [style*="background: #f9fafb"] {
            background: #27272a !important;
            border-color: #3f3f46 !important;
            color: #f4f4f5 !important;
        }

        .dark .job-carte-sheet [style*="color: #555"] {
            color: #a1a1aa !important;
        }

        .dark .job-carte-sheet table,
        .dark .job-carte-sheet th,
        .dark .job-carte-sheet td,
        .dark .job-carte-sheet [style*="border-bottom"],
        .dark .job-carte-sheet [style*="border-top"] {
            border-color: #3f3f46 !important;
        }

        @media print {
            body {
                background: white !important;
            }
            aside, header, nav, .fi-topbar, .fi-sidebar, .no-print {
                display: none !important;
            }
            .fi-main {
                padding: 0 !important;
            }
        }
    </style>
    @endpush


    <div style="display: flex; align-items: center; justify-content: center; gap: 1rem;">

        {{-- Bouton pour ouvrir le modal --}}
        @if ($record->signature_status !== 'signed')
            <div>
                <x-filament::button
                    color="primary"
                    icon="heroicon-o-pencil-square"
                    x-on:click="$dispatch('open-modal', { id: 'signature-job-carte' })"
                >
                    Signer sur place
                </x-filament::button>
            </div>
        @else
            <div style="text-align: center;" class="text-sm font-semibold text-success-600">
                ✓ Job Carte signée
            </div>
        @endif

        <x-filament::button
            color="gray"
            outlined
            icon="heroicon-o-printer"
            x-on:click="window.print()"
            class="!bg-transparent !shadow-none"
        >
            Imprimer en PDF
        </x-filament::button>

    </div>

    {{-- Modal de signature --}}
    <x-filament::modal
        id="signature-job-carte"
        heading="Signature de la Job Carte"
        width="xl"
    >
        <div class="space-y-4">

            <div>
                <label for="signedByName" class="text-sm font-medium">
                    Nom du signataire
                </label>

                <input
                    id="signedByName"
                    type="text"
                    class="fi-input w-full"
                    placeholder="Nom complet du signataire"
                >
            </div>

            <div>
                <label class="text-sm font-medium">
                   Signez ici avec votre doigt ou votre souris.
                </label>

                <canvas
                    id="signature_canvas"
                    style="width: 100%; height: 180px; touch-action: none; background-color: #fff; border:1px dashed #808080; border-radius: 4px; margin: 6px 0; "
                ></canvas>

            </div>

        </div>

        <x-slot name="footerActions">
            <x-filament::button
                    color="gray"
                    id="clear_signature"
                >
                    Effacer
            </x-filament::button>

            <x-filament::button
                color="gray"
                id="cancel_signature"
                x-on:click="
                    document.getElementById('clear_signature').click();
                    $dispatch('close-modal', { id: 'signature-job-carte' });
                "
            >
                Annuler
            </x-filament::button>

            <x-filament::button
                color="success"
                id="submitSignature"
            >
                Confirmer
            </x-filament::button>
        </x-slot>
    </x-filament::modal>

    <x-filament::modal
        id="confirmation-signature-job-carte"
        heading="Confirmer la signature"
        width="xl"
    >
        <div class="space-y-4">
            <p>Confirmez-vous que vous souhaitez enregistrer cette signature pour cette Job Carte ?</p>
            <p class="font-medium" id="confirmationSignatureName"></p>
            <img
                id="confirmationSignaturePreview"
                alt="Aperçu de la signature à enregistrer"
                style="display: none; max-width: 100%; height: 120px; object-fit: contain; border: 1px solid #d1d5db; padding: 8px;"
            >
        </div>

        <x-slot name="footerActions">
            <x-filament::button
                color="gray"
                x-on:click="$dispatch('close-modal', { id: 'confirmation-signature-job-carte' }); $dispatch('open-modal', { id: 'signature-job-carte' });"
            >
                Modifier
            </x-filament::button>

            <x-filament::button
                color="success"
                id="confirmSignatureSave"
            >
                Oui, enregistrer la signature
            </x-filament::button>
        </x-slot>
    </x-filament::modal>

    <x-filament::modal
        id="signature-enregistree-job-carte"
        heading="Signature enregistrée"
        width="md"
    >
        <div class="space-y-3">
            <p class="font-medium">La signature de cette Job Carte a bien été enregistrée.</p>
            <p id="signatureSavedMessage" class="text-sm text-gray-600"></p>
        </div>

        <x-slot name="footerActions">
            <x-filament::button
                color="success"
                id="finishSignatureSaved"
            >
                Terminer
            </x-filament::button>
        </x-slot>
    </x-filament::modal>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('signature_canvas');
    const clearButton = document.getElementById('clear_signature');

    if (!canvas || !clearButton) {
        console.error('Canvas ou bouton Effacer introuvable.');
        return;
    }

    const ctx = canvas.getContext('2d');

    let drawing = false;
    let hasSignature = false;
    let lastX = 0;
    let lastY = 0;

    // Préparer correctement la zone de dessin
    function resizeCanvas() {
        const rect = canvas.getBoundingClientRect();

        if (!rect.width || !rect.height) return;

        const ratio = window.devicePixelRatio || 1;

        // Conserver le dessin lors d'un redimensionnement
        let previousImage = null;

        if (hasSignature && canvas.width && canvas.height) {
            previousImage = document.createElement('canvas');
            previousImage.width = canvas.width;
            previousImage.height = canvas.height;
            previousImage.getContext('2d').drawImage(canvas, 0, 0);
        }

        canvas.width = Math.round(rect.width * ratio);
        canvas.height = Math.round(rect.height * ratio);

        ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
        ctx.lineWidth = 2.5;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = '#111827';

        if (previousImage) {
            ctx.drawImage(
                previousImage,
                0, 0, previousImage.width, previousImage.height,
                0, 0, rect.width, rect.height
            );
        }
    }

    function getPosition(event) {
        const rect = canvas.getBoundingClientRect();

        return {
            x: event.clientX - rect.left,
            y: event.clientY - rect.top
        };
    }

    canvas.addEventListener('pointerdown', function (event) {
        event.preventDefault();

        resizeCanvas();

        drawing = true;

        const pos = getPosition(event);
        lastX = pos.x;
        lastY = pos.y;

        canvas.setPointerCapture(event.pointerId);

        // Permet également de signer avec un simple point
        ctx.beginPath();
        ctx.arc(lastX, lastY, 1.2, 0, Math.PI * 2);
        ctx.fill();
        hasSignature = true;
        canvas.dataset.hasSignature = 'true';
    });

    canvas.addEventListener('pointermove', function (event) {
        if (!drawing) return;

        event.preventDefault();

        const pos = getPosition(event);

        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();

        lastX = pos.x;
        lastY = pos.y;

        hasSignature = true;
        canvas.dataset.hasSignature = 'true';
    });

    function stopDrawing() {
        drawing = false;
    }

    canvas.addEventListener('pointerup', stopDrawing);
    canvas.addEventListener('pointercancel', stopDrawing);
    canvas.addEventListener('lostpointercapture', stopDrawing);

    clearButton.addEventListener('click', function () {
        const rect = canvas.getBoundingClientRect();

        ctx.clearRect(0, 0, rect.width, rect.height);

        hasSignature = false;
        canvas.dataset.hasSignature = 'false';
    });

    // Filament ouvre le modal après le chargement initial.
    // Le canvas doit donc être dimensionné quand le modal devient visible.
    const observer = new MutationObserver(function () {
        if (canvas.getBoundingClientRect().width > 0) {
            resizeCanvas();
        }
    });

    observer.observe(canvas, {
        attributes: true,
        attributeFilter: ['style', 'class']
    });

    // Initialisation lorsque le modal est ouvert
    document.addEventListener('click', function () {
        requestAnimationFrame(function () {
            if (canvas.getBoundingClientRect().width > 0) {
                resizeCanvas();
            }
        });
    });

    resizeCanvas();
});

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('signature_canvas');
    const confirmBtn = document.getElementById('submitSignature');
    const saveSignatureBtn = document.getElementById('confirmSignatureSave');
    const nameInput = document.getElementById('signedByName');
    const signaturePreview = document.getElementById('confirmationSignaturePreview');
    const confirmationName = document.getElementById('confirmationSignatureName');
    const savedMessage = document.getElementById('signatureSavedMessage');
    const finishButton = document.getElementById('finishSignatureSaved');

    if (!canvas || !confirmBtn || !saveSignatureBtn || !nameInput) {
        console.error('Un élément de signature est introuvable.');
        return;
    }

    let signatureData = null;

    confirmBtn.addEventListener('click', () => {
        const name = nameInput.value.trim();

        if (!name) {
            alert('Veuillez saisir le nom du signataire.');
            return;
        }

        if (canvas.dataset.hasSignature !== 'true') {
            alert('Veuillez signer dans la zone prévue.');
            return;
        }

        signatureData = canvas.toDataURL('image/png');
        confirmationName.textContent = `Signataire : ${name}`;
        signaturePreview.src = signatureData;
        signaturePreview.style.display = 'block';

        window.dispatchEvent(new CustomEvent('close-modal', {
            detail: { id: 'signature-job-carte' }
        }));
        window.dispatchEvent(new CustomEvent('open-modal', {
            detail: { id: 'confirmation-signature-job-carte' }
        }));
    });

    saveSignatureBtn.addEventListener('click', async () => {
        if (!signatureData) {
            alert('La signature est introuvable. Veuillez signer à nouveau.');
            return;
        }

        saveSignatureBtn.disabled = true;
        saveSignatureBtn.textContent = 'Enregistrement...';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
                ?? @json(csrf_token());

            const response = await fetch(
                @json(route('job-carte.signature.sign', [
                    'token' => $record->signature_token
                ])),
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        signed_by_name: nameInput.value.trim(),
                        signature: signatureData
                    })
                }
            );

            const responseText = await response.text();
            let data;

            try {
                data = JSON.parse(responseText);
            } catch {
                data = { message: responseText.replace(/<[^>]*>/g, ' ').trim() };
            }

            if (!response.ok || !data.success) {
                throw new Error(
                    data.message || Object.values(data.errors || {}).flat()[0] ||
                    'Impossible d’enregistrer la signature.'
                );
            }

            window.dispatchEvent(new CustomEvent('close-modal', {
                detail: { id: 'confirmation-signature-job-carte' }
            }));
            savedMessage.textContent = data.message || 'La signature a bien été enregistrée.';
            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: { id: 'signature-enregistree-job-carte' }
            }));

        } catch (error) {
            alert(error.message);

            console.error(error);
        } finally {
            saveSignatureBtn.disabled = false;
            saveSignatureBtn.textContent = 'Oui, enregistrer la signature';
        }
    });

    finishButton?.addEventListener('click', () => window.location.reload());
});
</script>

</x-filament-panels::page>