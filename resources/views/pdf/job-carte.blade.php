<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <style>
            @page {
                margin: 10px 20px;
                }

            body {
                font-family: arial;
                font-size: 11px;
                color: black;
                line-height: 1.5;
            }

            .card {
                background: #ffffff;
                border: 1.5px solid #4b5563;
                border-radius: 4px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                margin-bottom: 4px;
                overflow: hidden;
            }

            .card-header {
                background: #f3f4f6;
                /* Noir pâle pour le texte et la bordure basse de l'en-tête */
                color: #1f2937;
                padding: 2px 10px;
                font-weight: bold;
                font-size: 11px;
                border-bottom: 1px solid #4b5563;
                letter-spacing: 0.3px;
            }

            .grid {
                width: 100%;
                border-collapse: collapse;
            }

            .grid td {
                /* Noir pâle pour les bordures de la grille */
                border: 1px solid #6b7280;
                padding: 6px;
            }

            .label {
                color: black;
            }

            .title {
                margin-bottom: 20px;
                /* Ligne de séparation en noir pâle */
                border-bottom: 2px solid #4b5563;
                padding-bottom: 10px;
            }

            .title h1 {
                margin: 0;
                font-size: 20px;
                color: #111827;
                font-weight: 700;
            }

            .signature-box {
                height: 100px;
                background-color: #ffffff;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin: 0;
            }

            td,
            th {
                border: 1px solid #6b7280;
                padding: 0;
                font-size: 10px;
                line-height: 1.1;
            }

            th {
                background-color: #f3f4f6;
                color: #1f2937;
                font-weight: bold;
                border-bottom: 1.5px solid #4b5563;
            }

            tr {
                margin: 0;
                padding: 0;
            }
            tr{
                height: 14px;
            }

            .checkbox-cell {
                width: 5%;
                height: 12px;
                padding: 0 !important;
                text-align: center;
                vertical-align: middle;
            }

            .checkbox {
                width: 100%;
                height: 12px;
                position: relative;
            }

            .checkmark {
                display: inline-block;
                width: 9px;
                height: 5px;
                border-left: 2px solid green;
                border-bottom: 2px solid green;
                transform: rotate(-45deg);
                margin-top: 3px;
            }
            
            .document-header td {
                border: none !important;
                height: auto;
                line-height: 12px;
                padding: 0;
            }
            
        </style>

    </head>

    <body>

        {{-- HEADER --}}
    <img src="{{ public_path('images/kmtl.jpg') }}"
        alt="Logo"
        style="width:20%; height:auto;">
            <table style="width:100%; border:none;">
                <tr>
                    <td style="width:40%; border:none; vertical-align:top;">
                        <strong>N° RCCM :</strong> CD/KIN/RCCM/14-B-04181<br>
                        <strong>N° ID.NAT :</strong> 01-H5300-N42611R<br>
                        <strong>Tél :</strong> +(243) 972 025 500
                    </td>

                    <td style="width:10%; border:none; text-align:center;">

                    </td>
                    <td style="width:25%; border:none;">
                                    5, Kwango<br>
                        Kinshasa Ngaliema<br>
                        R.D. Congo<br><br>
                    </td>

                    <td style="width:25%; border:none; text-align:right;">
                        <strong style="font-size:14px;">JOB CARTE</strong><br>
                        <strong style="font-size:12px;">N° {{ $record->num_job_carte }}</strong><br>
                        <strong>Date :</strong> {{ $record->date }}
                    </td>
                </tr>
            </table>

        {{-- CLIENT --}}

        <div class="card">
            <table class="grid" style="font-weight: bold;">
                <tr>
                    <td class="label">Client : <span class="" > {{ $record->client?->nom }} </span></td>
                    <td class="label">N° Commande : {{ $record->num_commande }}</td>
                </tr>

                <tr>
                    <td class="label">Site : {{ $record->site?->nom }}</td>
                    <td class="label">Contact : {{ $record->telephone }}</td>
                </tr>


            </table>

        </div>

        {{-- VEHICULE --}}

        <div class="card">

            <div class="card-header">
                DESCRIPTION VEHICULE
            </div>

            <table class="grid">

                <tr>
                    <td class="label" style="width:40%;">ID VEHICULE : {{ $record->vehicule?->identifiant_vehicule }}</td>
                    <td class="label">NOM REF : {{ $record->vehicule?->nom_ref }}</td>
                    <td class="label" colspan="2">DATE MISE EN DISPONIBILITE : {{ $record->vehicule?->date_mise_en_disposition }}</td>
                </tr>

                <tr>
                    <td class="label" style="width:40%;">N° IMSI SIM : {{ $record->vehicule?->imsi_sim }}</td>
                    <td class="label">N° REF : {{ $record->vehicule?->num_ref }}</td>
                    <td class="label" colspan="2">HEURE MISE EN DISPONIBILITE : {{ $record->vehicule?->heure_mise_en_disposition }}</td>
                </tr>

                <tr>
                    <td class="label" style="width:40%;">N° DATA : {{ $record->vehicule?->num_data }}</td>
                    <td class="label">N° VOIX : {{ $record->vehicule?->num_voix }}</td>
                    <td class="label">NOUV N° APPEL : {{ $record->vehicule?->nouv_num_appel }}</td>
                    <td class="label">PIN : {{ $record->vehicule?->pin }}</td>
                </tr>

                <tr>
                    <td class="label" style="width:60%;" colspan="2">TYPE BOITIER : {{ $record->vehicule?->type_boitier }}</td>
                    <td class="label" colspan="2">N° SERIE : {{ $record->vehicule?->num_serie }}</td>
                </tr>

                <tr>
                    <td class="label" style="width:40%;" colspan="2">MARQUE/MODELE : {{ $record->vehicule?->marque }}</td>
                    <td class="label" colspan="2">N° CHASSIS : {{ $record->vehicule?->num_chassis }}</td>
                </tr>
                <tr>
                    <td class="label" style="width:40%;">N° IMMOBILISATION : {{ $record->vehicule?->num_immobilisation }}</td>
                    <td class="label">N° FLOTTE : {{ $record->vehicule?->num_flotte }}</td>
                    <td class="label"  colspan="2">N° MATRICULE : {{ $record->vehicule?->immatriculation }}</td>
                </tr>
            </table>

        </div>

        {{-- INSPECTION --}}

        <div class="card">

            <div class="card-header" style="width:100%;">
                <div style="width:38.4%; display:inline-block;">PRE/POST INSPECTION VEHICULE</div>
                <div style="width:5%; display:inline-block; font-size:11px;">Avant</div>
                <div style="width:5%; display:inline-block; font-size:11px;">Après</div>
                <div style="width:38.4%; display:inline-block; font-size:11px;">&nbsp;</div>
                <div style="width:5%; display:inline-block; font-size:11px;">Avant</div>
                <div style="width:5%; display:inline-block; font-size:11px;">Après</div>
            </div>

            <table class="grid">

                <tr>
                    <td class="label" style="width:40%;">PEINTURE / ETAT EXT.</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->peinture_etat_ext_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->peinture_etat_ext_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td class="label" style="width:40%;">AFFICHAGE CODES DEFAUT AU TABLEAU (S'il y en a)</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->affichage_code_defaut_tab_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->affichage_code_defaut_tab_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="label" style="width:36%;">PANNEAUX / ETAT INTER. (Tableau).</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->panneaux_inter_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->panneaux_inter_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td class="label" style="width:36%;">ECLAIRAGE INTERIEUR</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->eclairage_ext_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->eclairage_ext_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="label" style="width:36%;">DEMARRAGE VEHICULE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->demarrage_vehicule_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->demarrage_vehicule_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td class="label" style="width:36%;">FEUX (Avant / Arrière)</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->feux_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->feux_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                </tr>
                
                <tr>
                    <td class="label" style="width:36%;">INSTRUMENTS</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->instruments_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->instruments_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td class="label" style="width:36%;">DETRESSE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->detresse_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->detresse_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                </tr>
                            
                <tr>
                    <td class="label" style="width:36%;">RADIO</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->radio_avant)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->inspection?->radio_apres)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>  
                        @else
                            <div class="checkbox checkbox-no">✕</div>
                        @endif
                    </td>
                    <td class="label" style="width:36%;">&nbsp;</td>
                    <td class="" style="width:5%;">&nbsp;</td>
                    <td class="" style="width:5%;">&nbsp;</td>
                </tr>
                                        
                <tr>
                    <td class="label" colspan="6">COMMENTAIRES : {{ $record->inspection?->autre_commentaire }}</td>
                </tr>

                </tr>
            </table>

        </div>

        {{-- INTERVENTION --}}

        <div class="card">

            <div class="card-header">
                DETAILS L'INTERVENTION
            </div>

            <table class="grid">

                <tr>
                    <td class="label" style="width:23%; height:14px;">NOUVELLE INSTALLATION</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->nouv_installation)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="label" style="width:23%; height:14px;">GPRS/GSM VERIFIE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->gprs_gsm_verifie)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="label" style="width:23%; height:14px;">TEMPS DEBUT: {{ $record->intervention?->temps_debut_gprs_gsm_verifie }}</td>
                    <td class="label" style="width:23%; height:14px;">TEMPS FIN: {{ $record->intervention?->temps_fin_gprs_gsm_verifie }}</td>
                </tr>
                <tr>
                    <td class="" style="width:23%;">REINSTALLATION</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->reinstallation)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="" style="width:23%;">ARRET VEHICULE VERIFIE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->arret_vehicule_verifie)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="" style="width:23%;">DUREE TEST: {{ $record->intervention?->duree_test_arret_vehicule_verifie }}</td>
                    <td class="" style="width:23%;">DISTANCE TEST: {{ $record->intervention?->distance_arret_vehicule_verifie }}</td>
                </tr>
                <tr>
                    <td class="" style="width:23%;">MAINTENANCE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->maintenance)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="" style="width:23%;">FM TERMINAL VERIFIE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->fm_terminal_verifie)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="" style="width:23%;">VITESSE MAX: {{ $record->intervention?->vitesse_max_fm_terminal_verifie }}</td>
                    <td class="" style="width:23%;">RPM MAX: {{ $record->intervention?->rpm_max_fm_terminal_verifie }}</td>
                </tr>
                <tr>
                    <td class="" style="width:23%;">PANNE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->panne)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="" style="width:23%;">VOICE KIT VERIFIE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->voice_kif_verifie)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="" colspan="2">ODO/HRS MOTEUR FIXE A: {{ $record->intervention?->odo_hrs_moteur_fixe }}</td>
                </tr>
                <tr>
                    <td class="label" style="width:23%;">DESINSTALLATION</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->desinstallation)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="label" style="width:23%;">RF READER VERIFIE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->rf_reader_verifie)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="label" colspan="2">TEMPS DEBUT: {{ $record->intervention?->temps_debut_gprs_gsm_verifie }}</td>
                </tr>
                <tr>
                    <td class="" style="width:23%;">VERSION DDR'S CHARGEE:</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->version_dors_chargee)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="" style="width:23%;">PROXIMITE VERIFIE</td>
                    <td style="width:5%; text-align:center; font-size:12px; font-weight:bold;">
                        @if($record->intervention?->proximite_verifie)
                            <div class="checkbox checkbox-ok">
                                <span class="checkmark"></span>
                            </div>
                        @else
                            <span style="color:red;">X</span>
                        @endif
                    </td>
                    <td class="" style="width:23%;">DUREE TEST: {{ $record->intervention?->duree_test_arret_vehicule_verifie }}</td>
                    <td class="" style="width:23%;">DISTANCE TEST: {{ $record->intervention?->distance_arret_vehicule_verifie }}</td>
                </tr>

            </table>

        </div>

        {{-- TEMPS --}}

        <div class="card">

            <table class="grid">

                <tr>
                    <td class="label">DEBUT HRS SUPP : {{ $record->infosSupplementaire?->debut_heure_suppl }}
                    </td>

                    <td class="label">FIN HRS SUPP : {{ $record->infosSupplementaire?->fin_heure_suppl }}
                    </td>
                    
                    <td class="label">TOTAL HRS SUPP : {{ $record->infosSupplementaire?->total_heure_suppl }}
                    </td>
                </tr>

                <tr>
                    <td class="label">TEMPS ATTENTE POUR : {{ $record->infosSupplementaire?->debut_attente }}
                    </td>

                    <td class="label">DEBUT ATTENTE : {{ $record->infosSupplementaire?->debut_attente }}
                    </td>

                    <td class="label">FIN ATTENTE : {{ $record->infosSupplementaire?->fin_attente }}
                    </td>
                </tr>
                <tr>
                    <td class="label" colspan="3">OBSERVATIONS</td>
                </tr>
                <tr>
                    <td colspan="3">
                        {{ $record->intervention?->observation }}
                    </td>
                </tr>

            </table>

        </div>

        {{-- COMPOSANTS DEFECTEUX REMPLACES --}}

        <div class="card">

            <div class="card-header">
                COMPOSANTS DEFECTEUX REMPLACES
            </div>

            <table class="grid">

                <tr>
                    <td>SIM N° série : {{ $record->infosSupplementaire?->ancien_num_serie_sim }}</td>
                    <td>Nouv N° série : {{ $record->infosSupplementaire?->nouveau_num_serie_sim }}</td>
                    <td>Matériels</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>Boîtier FM N° série : {{ $record->infosSupplementaire?->ancien_num_serie_boitier_fm }}</td>
                    <td>Nouv N° série : {{ $record->infosSupplementaire?->nouveau_num_serie_boitier_fm }}</td>
                    <td>Main d'oeuvre</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>FM Terminal N° série : {{ $record->infosSupplementaire?->ancien_num_serie_boitier_fm }}</td>
                    <td>Nouv N° série : {{ $record->infosSupplementaire?->nouveau_num_serie_boitier_fm }}</td>
                    <td>TPS attente</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Voice Kit N° série : {{ $record->infosSupplementaire?->ancien_num_serie_boitier_voice_kit }}</td>
                    <td>Nouv N° série : {{ $record->infosSupplementaire?->nouveau_num_serie_boitier_voice_kit }}</td>
                    <td>Déplacement</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>RF Tag ID N° série : {{ $record->infosSupplementaire?->ancien_num_serie_boitier_fm }}</td>
                    <td>Nouv N° série : {{ $record->infosSupplementaire?->nouveau_num_serie_boitier_fm }}</td>
                    <td>S/TOTAL</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colsapn="2"></td>
                    <td></td>
                    <td>TOTAL : {{ $record->infosSupplementaire?->nouveau_num_serie_boitier_fm }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

        </div>

        <table style="width:100%; border:none;">
            <tr>
                <td style="width:40%; text-align:left; border:none;">
                    <p><strong>Nom et Signature du client</strong></p>

                    @if (!empty($record->signature_path))
                        <img
                            src="{{ storage_path('app/public/' . $record->signature_path) }}"
                            alt="Signature du client"
                            style="width: 200px; height: 60px;"
                        >
                    @endif
                </td>

                <td style="width:20%; text-align:center; border:none;">
                    <p><strong>Signé le</strong></p>
                    {{ $record->signed_at ?? '' }}
                </td>

                <td style="width:20%; text-align:center; border:none;">
                    <p><strong>N° facture</strong></p>
                    {{ $record->num_facture ?? '' }}
                </td>
                <td style="width:20%; text-align:center; border:none;">
                        <img
                            src="{{ public_path('images/mix_telematics.png') }}"
                            alt="Signature technicien"
                            style="width: 140px; height: 40px; "
                        >
                </td>

                <td style="width:40%; text-align:right; border:none;">
                    <p><strong>Nom du technicien</strong></p>
                    <img src="" alt="Signature" style="width: 200px; height: auto;">
                    <span class="" style="font-size:14px;">{{ $record->user?->name ?? '' }}</span>
                </td>
            </tr>
        </table>

    </body>
</html>