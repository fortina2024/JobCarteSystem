<?php

namespace App\Filament\Resources\JobCartes\Pages;

use App\Filament\Resources\JobCartes\JobCarteResource;
use App\Models\ComposantDefecteuxRemplace;
use App\Models\CoutPrestation;
use App\Models\CoutPrestation as ModelsCoutPrestation;
use App\Models\InfosSupplementaire;
use App\Models\Inspection;
use App\Models\Intervention;
use App\Models\JobCarte;
use App\Models\TempsSupplementaire;
use App\Models\TempsSupplementaire as ModelsTempsSupplementaire;
use App\Models\Vehicule;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateJobCarte extends CreateRecord
{
    protected static string $resource = JobCarteResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        unset(
            $data['nouv_installation'],
            $data['reinstallation'],
            $data['maintenance'],
            $data['panne'], 
            $data['desinstallation'],
            $data['version_dors_chargee'],
            $data['gprs_gsm_verifie'],
            $data['arret_vehicule_verifie'],
            $data['fm_terminal_verifie'],
            $data['voice_kif_verifie'],
            $data['rf_reader_verifie'],
            $data['proximite_verifie'],
            $data['temps_debut_gprs_gsm_verifie'],
            $data['temps_fin_gprs_gsm_verifie'],
            $data['duree_test_arret_vehicule_verifie'],
            $data['distance_arret_vehicule_verifie'],
            $data['vitesse_max_fm_terminal_verifie'],
            $data['rpm_max_fm_terminal_verifie'],
            $data['odo_hrs_moteur_fixe'],
            $data['plage_bande_verte_de'],
            $data['plage_bande_verte_a'],
            $data['sur_regime'],
            $data['calibration_vitesse'],
            $data['par_distance_fixe'],
            $data['par_tableau'],
            $data['vitesse_gps'],
            $data['can'],
            $data['observation']
        );
        unset(
            $data['dealer_nom'],
            $data['dealer_prenom'],
            $data['dealer_contact'],
            $data['dealer_email']
        );

        unset(
            $data['nom_composant'],
            $data['ancien_num_serie'],
            $data['nouveau_num_serie']
        );

        unset(
            $data['distance_parcourue_km'],
            $data['materiel'],
            $data['main_oeuvre'],
            $data['tps_attente'],
            $data['deplacement']
        );

        unset(
            $data['debut_heure_suppl'],
            $data['fin_heure_suppl'],
            $data['temps_attente_pour'],
            $data['debut_attente'],
            $data['fin_attente']
        );

        unset(
            $this->data['debut_heure_suppl'],
            $this->data['fin_heure_suppl'],
            $this->data['temps_attente_pour'],
            $this->data['debut_attente'],
            $this->data['fin_attente'],
            $this->data['observation'],
            $this->data['ancien_num_serie_sim'],
            $this->data['nouveau_num_serie_sim'],
            $this->data['ancien_num_serie_boitier_fm'],
            $this->data['nouveau_num_serie_boitier_fm'],
            $this->data['ancien_num_serie_fm_terminal'],
            $this->data['nouveau_num_serie_fm_terminal'],
            $this->data['ancien_num_serie_boitier_voice_kit'],
            $this->data['nouveau_num_serie_boitier_voice_kit'],
            $this->data['ancien_num_serie_boitier_rf_tag_id'],
            $this->data['nouveau_num_serie_boitier_rf_tag_id']
        );

        unset(
            $data['peinture_etat_ext_avant'],
            $data['peinture_etat_ext_apres'],

            $data['panneaux_inter_avant'],
            $data['panneaux_inter_apres'],

            $data['demarrage_vehicule_avant'],
            $data['demarrage_vehicule_apres'],

            $data['instruments_avant'],
            $data['instruments_apres'],

            $data['radio_avant'],
            $data['radio_apres'],

            $data['affichage_code_defaut_tab_avant'],
            $data['affichage_code_defaut_tab_apres'],

            $data['eclairage_ext_avant'],
            $data['eclairage_ext_apres'],

            $data['feux_avant'],
            $data['feux_apres'],

            $data['detresse_avant'],
            $data['detresse_apres'],

            $data['peinture_etat_ext'],
            $data['panneaux_inter'],
            $data['demarrage_vehicule'],
            $data['instruments'],
            $data['radio'],
            $data['affichage_code_defaut_tab'],
            $data['eclairage_ext'],
            $data['feux'],
            $data['detresse'],

            $data['autre_commentaire']
        );

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {

            $jobCarte = JobCarte::create([
                'num_job_carte' => $data['num_job_carte'],
                'date' => $data['date'],
                'client_id' => $data['client_id'],
                'site_id' => $data['site_id'],
                'user_id' => $data['user_id'],
                'num_commande' => $data['num_commande'],
                'signature_token' => Str::random(64),
            ]);

            Vehicule::create([
                'client_id' => $this->data['client_id'],
                'job_carte_id' => $jobCarte->id,
                'identifiant_vehicule' => $this->data['vehicule']['identifiant_vehicule'] ?? null,
                'imsi_sim' => $this->data['imsi_sim'] ?? null,
                'type_boitier' => $this->data['type_boitier'] ?? null,
                'num_data' => $this->data['num_data'] ?? null,
                'numero_flote' => $this->data['numero_flote'] ?? null,
                'marque' => $this->data['marque'] ?? null,
                'num_immobilisation' => $this->data['num_immobilisation'] ?? null,
                'nom_ref' => $this->data['nom_ref'] ?? null,
                'num_ref' => $this->data['num_ref'] ?? null,
                'num_voix' => $this->data['num_voix'] ?? null,
                'num_serie' => $this->data['num_serie'] ?? null,
                'num_flotte' => $this->data['num_flotte'] ?? null,
                'date_mise_en_disposition' => $this->data['date_mise_en_disposition'] ?? null,
                'heure_mise_en_disposition' => $this->data['heure_mise_en_disposition'] ?? null,
                'nouv_num_appel' => $this->data['nouv_num_appel'] ?? null,
                'pin' => $this->data['pin'] ?? null,
                'num_chassis' => $this->data['num_chassis'] ?? null,
                'immatriculation' => $this->data['immatriculation'] ?? null,
            ]);

            Inspection::create([
                'job_carte_id' => $jobCarte->id,

                'peinture_etat_ext_avant' => $this->data['peinture_etat_ext_avant'] ?? null,
                'peinture_etat_ext_apres' => $this->data['peinture_etat_ext_apres'] ?? null,

                'panneaux_inter_avant' => $this->data['panneaux_inter_avant'] ?? null,
                'panneaux_inter_apres' => $this->data['panneaux_inter_apres'] ?? null,

                'demarrage_vehicule_avant' => $this->data['demarrage_vehicule_avant'] ?? null,
                'demarrage_vehicule_apres' => $this->data['demarrage_vehicule_apres'] ?? null,

                'instruments_avant' => $this->data['instruments_avant'] ?? null,
                'instruments_apres' => $this->data['instruments_apres'] ?? null,

                'radio_avant' => $this->data['radio_avant'] ?? null,
                'radio_apres' => $this->data['radio_apres'] ?? null,

                'affichage_code_defaut_tab_avant' => $this->data['affichage_code_defaut_tab_avant'] ?? null,
                'affichage_code_defaut_tab_apres' => $this->data['affichage_code_defaut_tab_apres'] ?? null,

                'eclairage_ext_avant' => $this->data['eclairage_ext_avant'] ?? null,
                'eclairage_ext_apres' => $this->data['eclairage_ext_apres'] ?? null,

                'feux_avant' => $this->data['feux_avant'] ?? null,
                'feux_apres' => $this->data['feux_apres'] ?? null,

                'detresse_avant' => $this->data['detresse_avant'] ?? null,
                'detresse_apres' => $this->data['detresse_apres'] ?? null,
                'peinture_etat_ext' => $this->data['peinture_etat_ext'] ?? null,
                'panneaux_inter' => $this->data['panneaux_inter'] ?? null,
                'demarrage_vehicule' => $this->data['demarrage_vehicule'] ?? null,
                'instruments' => $this->data['instruments'] ?? null,
                'radio' => $this->data['radio'] ?? null,
                'affichage_code_defaut_tab' => $this->data['affichage_code_defaut_tab'] ?? null,
                'eclairage_ext' => $this->data['eclairage_ext'] ?? null,
                'feux' => $this->data['feux'] ?? null,
                'detresse' => $this->data['detresse'] ?? null,
                'autre_commentaire' => $this->data['autre_commentaire'] ?? null,
            ]);

            Intervention::create([
                'job_carte_id' => $jobCarte->id,
                'nouv_installation' => $this->data['nouv_installation'] ?? false,
                'reinstallation' => $this->data['reinstallation'] ?? false,
                'maintenance' => $this->data['maintenance'] ?? false,
                'panne' => $this->data['panne'] ?? false,
                'desinstallation' => $this->data['desinstallation'] ?? false,
                'version_dors_chargee' => $this->data['version_dors_chargee'] ?? null,
                'gprs_gsm_verifie' => $this->data['gprs_gsm_verifie'] ?? false,
                'arret_vehicule_verifie' => $this->data['arret_vehicule_verifie'] ?? false,
                'fm_terminal_verifie' => $this->data['fm_terminal_verifie'] ?? false,
                'voice_kif_verifie' => $this->data['voice_kif_verifie'] ?? false,
                'rf_reader_verifie' => $this->data['rf_reader_verifie'] ?? false,
                'proximite_verifie' => $this->data['proximite_verifie'] ?? false,

                'temps_debut_gprs_gsm_verifie' => $this->data['temps_debut_gprs_gsm_verifie'] ?? null,
                'temps_fin_gprs_gsm_verifie' => $this->data['temps_fin_gprs_gsm_verifie'] ?? null,

                'duree_test_arret_vehicule_verifie' => $this->data['duree_test_arret_vehicule_verifie'] ?? null,
                'distance_arret_vehicule_verifie' => $this->data['distance_arret_vehicule_verifie'] ?? null,

                'vitesse_max_fm_terminal_verifie' => $this->data['vitesse_max_fm_terminal_verifie'] ?? null,
                'rpm_max_fm_terminal_verifie' => $this->data['rpm_max_fm_terminal_verifie'] ?? null,

                'odo_hrs_moteur_fixe' => $this->data['odo_hrs_moteur_fixe'] ?? null,

                'plage_bande_verte_de' => $this->data['plage_bande_verte_de'] ?? null,
                'plage_bande_verte_a' => $this->data['plage_bande_verte_a'] ?? null,

                'sur_regime' => $this->data['sur_regime'] ?? null,

                'calibration_vitesse' => $this->data['calibration_vitesse'] ?? false,
                'par_distance_fixe' => $this->data['par_distance_fixe'] ?? false,
                'par_tableau' => $this->data['par_tableau'] ?? false,
                'vitesse_gps' => $this->data['vitesse_gps'] ?? false,
                'can' => $this->data['can'] ?? false,

                'observation' => $this->data['observation'] ?? null,
            ]);

            CoutPrestation::create([
                'job_carte_id' => $jobCarte->id,
                'distance_parcourue_km' => $this->data['distance_parcourue_km'] ?? null,
                'materiel' => $this->data['materiel'] ?? null,
                'main_oeuvre' => $this->data['main_oeuvre'] ?? null,
                'tps_attente' => $this->data['tps_attente'] ?? null,
                'deplacement' => $this->data['deplacement'] ?? null,
            ]);

            TempsSupplementaire::create([
                'job_carte_id' => $jobCarte->id,
                'debut_heure_suppl' => $this->data['debut_heure_suppl'] ?? null,
                'fin_heure_suppl' => $this->data['fin_heure_suppl'] ?? null,
                'temps_attente_pour' => $this->data['temps_attente_pour'] ?? null,
                'debut_attente' => $this->data['debut_attente'] ?? null,
                'fin_attente' => $this->data['fin_attente'] ?? null,
                'observation' => $this->data['observation'] ?? null,
                'ancien_num_serie_sim' => $this->data['ancien_num_serie_sim'] ?? null,
                'nouveau_num_serie_sim' => $this->data['nouveau_num_serie_sim'] ?? null,
                'ancien_num_serie_boitier_fm' => $this->data['ancien_num_serie_boitier_fm'] ?? null,
                'nouveau_num_serie_boitier_fm' => $this->data['nouveau_num_serie_boitier_fm'] ?? null,
                'ancien_num_serie_fm_terminal' => $this->data['ancien_num_serie_fm_terminal'] ?? null,
                'nouveau_num_serie_fm_terminal' => $this->data['nouveau_num_serie_fm_terminal'] ?? null,
                'ancien_num_serie_boitier_voice_kit' => $this->data['ancien_num_serie_boitier_voice_kit'] ?? null,
                'nouveau_num_serie_boitier_voice_kit' => $this->data['nouveau_num_serie_boitier_voice_kit'] ?? null,
                'ancien_num_serie_boitier_rf_tag_id' => $this->data['ancien_num_serie_boitier_rf_tag_id'] ?? null,
                'nouveau_num_serie_boitier_rf_tag_id' => $this->data['nouveau_num_serie_boitier_rf_tag_id'] ?? null,
            ]);

              return $jobCarte;
        });
                
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->submit(null)
            ->requiresConfirmation()
            ->modalHeading('Confirmer l’enregistrement')
            ->modalDescription(
                'Êtes-vous sûr de vouloir enregistrer cette Job Carte ?'
            )
            ->modalSubmitActionLabel('Oui, enregistrer')
            ->modalCancelActionLabel('Annuler')
            ->action(function (): void {
                $this->create();
            });
    }

}
