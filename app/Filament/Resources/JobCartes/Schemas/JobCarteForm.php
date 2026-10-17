<?php

namespace App\Filament\Resources\JobCartes\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\DB;
use Saade\FilamentAutograph\Forms\Components\SignaturePad;


class JobCarteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Wizard::make([
                    Step::make('INITIAL')
                        ->schema([
  
                            Select::make('client_id')
                                ->label('Client')
                                ->relationship('client', 'nom')
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    
                                    if (! $state) {
                                        $set('num_job_carte', null);
                                        return;
                                    }

                                    $annee = now()->format('y');

                                    $nombre = str_pad(
                                        \App\Models\JobCarte::count() + 1,
                                        4,
                                        '0',
                                        STR_PAD_LEFT
                                    );

                                    $clientCode = str_pad($state, 2, '0', STR_PAD_LEFT);

                                    $set(
                                        'num_job_carte',
                                        "J-{$annee}{$clientCode}{$nombre}"
                                    );
                                }),

                            Hidden::make('site_id')
                                ->dehydrated(),

                            DatePicker::make('date')
                                ->required()
                                ->default(now()),

                            TextInput::make('num_job_carte')
                                ->label('N° Job carte')
                                ->required()
                                ->readOnly(),

                            TextInput::make('num_commande')
                                ->label('N° commande')
                                ->default(null),

                            TextInput::make('user_id')
                                ->hidden()
                                ->required()
                                ->numeric(),

                        ])->columns(4),

                    Step::make('DESCRIPTION VEHICULE')
                            ->schema([
                                Grid::make(1)
                                    ->schema([
                                        Select::make('vehicule.identifiant_vehicule')
                                            ->label('Véhicule')
                                            ->options(function (callable $get) {
                                                $clientId = $get('client_id');

                                                if (! $clientId) {
                                                    return [];
                                                }

                                                $client = \App\Models\Client::find($clientId);

                                                if (! $client || ! $client->group_id) {
                                                    return [];
                                                }

                                                // On va chercher tous les assets des sites qui ont ce group_id via SQL direct
                                                $assets = DB::select('
                                                    SELECT a.fmvehicleid, a.Description, s.nom as site_name
                                                    FROM assets a
                                                    JOIN sites s ON a.siteid = s.subgroup_id
                                                    WHERE s.group_id = ?
                                                ', [$client->group_id]);

                                                // On transforme en tableau [fmvehicleid => "Description (Nom du site)"]
                                                $options = [];
                                                foreach ($assets as $asset) {
                                                    $options[$asset->fmvehicleid] = "{$asset->Description} ({$asset->site_name})";
                                                }

                                                return $options;
                                            })
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                if (! $state) {
                                                    $set('vehicule.imsi_sim', null);
                                                    $set('vehicule.numero_data', null);
                                                    $set('vehicule.type_boitier', null);
                                                    $set('vehicule.num_immobilisation', null);
                                                    $set('site_id', null);
                                                    return;
                                                }

                                                $asset = \App\Models\Asset::where('fmvehicleid', $state)->first();

                                                if (! $asset) {
                                                    return;
                                                }
                                                
                                                $site = \App\Models\Site::where('subgroup_id', $asset->SiteId)->first();
                                                
                                                $set('vehicule.imsi_sim', $asset->FmVehicleId);
                                                $set('vehicule.numero_data', $asset->Description);
                                                $set('vehicule.type_boitier', $asset->FleetNumber);
                                                $set('vehicule.num_immobilisation', $asset->RegistrationNumber);
                                                $set('site_id', $site?->id);
                                            })
                                            ->searchable()
                                            ->preload()
                                            ->required(),

                                        TextInput::make('vehicule.imsi_sim')
                                            ->label('N° IMSI SIM'),

                                        TextInput::make('vehicule.numero_data')
                                            ->label('N° Data'),

                                        TextInput::make('vehicule.type_boitier')
                                            ->label('Type boîtier'),

                                        TextInput::make('vehicule.num_immobilisation')
                                            ->label('Immobilisation'),

                                        TextInput::make('vehicule.num_serie')
                                            ->label('N° Série'),
                                        TextInput::make('vehicule.num_flotte')
                                            ->label('N° Flotte'),  
                                        TextInput::make('vehicule.num_chassis')
                                            ->label('N° Chassis'),  
                                        TextInput::make('vehicule.immatriculation')
                                            ->label('N° Maricule'),
                                        TextInput::make('vehicule.nom_ref')
                                            ->label('Nom Réf'),
                                        TextInput::make('vehicule.num_ref')
                                            ->label('N° Ref'),
                                        TextInput::make('vehicule.num_voix')
                                            ->label('N° Voix'),
                                        TextInput::make('vehicule.date_mise_en_disposition')
                                            ->label('Date mise a disposition'),
                                        TextInput::make('vehicule.heure_mise_en_disposition')
                                            ->label('Heure mise_en_disposition'),
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('vehicule.nouv_num_appel')
                                                    ->label('Nouv N° Appel'),

                                                TextInput::make('vehicule.pin')
                                                    ->label('PIN'),
                                            ]),
  
                                    ])->columns(4),
                            ]),
                    Step::make('PRE/POST INSPECTION VEHICULE')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('')
                                            ->schema([
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('_________________')
                                                            ->label('')
                                                            ->columnSpan(6),
                                                        Placeholder::make('peinture_etat_ext')
                                                            ->label('Avant')
                                                            ->columnSpan(3),
                                                        Placeholder::make('peinture_etat_ext')
                                                            ->label('Après')
                                                            ->columnSpan(3),
                                                     ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('peinture_etat_ext')
                                                            ->label('Peinture / Etat exterieur')
                                                            ->columnSpan(6),
                                                        Checkbox::make('peinture_etat_ext_avant')
                                                            ->label(fn ($get) => $get('peinture_etat_ext_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('peinture_etat_ext_apres')
                                                            ->label(fn ($get) => $get('peinture_etat_ext_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('panneaux_inter')
                                                            ->label('Panneaux interieurs (Tableau)')
                                                            ->columnSpan(6),
                                                        Checkbox::make('panneaux_inter_avant')
                                                            ->label(fn ($get) => $get('panneaux_inter_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('panneaux_inter_apres')
                                                            ->label(fn ($get) => $get('panneaux_inter_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('demarrage_vehicule')
                                                            ->label('Demarrage véhicule')
                                                            ->columnSpan(6),
                                                        Checkbox::make('demarrage_vehicule_avant')
                                                            ->label(fn ($get) => $get('demarrage_vehicule_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('demarrage_vehicule_apres')
                                                            ->label(fn ($get) => $get('demarrage_vehicule_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('instruments')
                                                            ->label('Instruments')
                                                            ->columnSpan(6),
                                                        Checkbox::make('instruments_avant')
                                                            ->label(fn ($get) => $get('instruments_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('instruments_apres')
                                                            ->label(fn ($get) => $get('instruments_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('radio')
                                                            ->label('Radio')
                                                            ->columnSpan(6),
                                                        Checkbox::make('radio_avant')
                                                            ->label(fn ($get) => $get('radio_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('radio_apres')
                                                            ->label(fn ($get) => $get('radio_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),                                              
                                            ]),

                                        Section::make('')
                                            ->schema([
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('_________________')
                                                            ->label('')
                                                            ->columnSpan(6),
                                                        Placeholder::make('peinture_etat_ext')
                                                            ->label('Avant')
                                                            ->columnSpan(3),
                                                        Placeholder::make('peinture_etat_ext')
                                                            ->label('Après')
                                                            ->columnSpan(3),
                                                     ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('affichage_code_defaut_tab')
                                                            ->label('Affichage codes defaut au tableau.')
                                                            ->columnSpan(6),
                                                        Checkbox::make('affichage_code_defaut_tab_avant')
                                                            ->label(fn ($get) => $get('affichage_code_defaut_tab_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('affichage_code_defaut_tab_apres')
                                                            ->label(fn ($get) => $get('affichage_code_defaut_tab_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('eclairage_ext')
                                                            ->label('Eclairage exterieur')
                                                            ->columnSpan(6),
                                                        Checkbox::make('eclairage_ext_avant')
                                                            ->label(fn ($get) => $get('eclairage_ext_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('eclairage_ext_apres')
                                                            ->label(fn ($get) => $get('eclairage_ext_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('feux')
                                                            ->label('Feux (Avant / arrière)')
                                                            ->columnSpan(6),
                                                        Checkbox::make('feux_avant')
                                                            ->label(fn ($get) => $get('feux_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('feux_apres')
                                                            ->label(fn ($get) => $get('feux_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),
                                                Grid::make(12)
                                                    ->schema([
                                                        Placeholder::make('detresse')
                                                            ->label('Detresse')
                                                            ->columnSpan(6),
                                                        Checkbox::make('detresse_avant')
                                                            ->label(fn ($get) => $get('detresse_avant') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                        Checkbox::make('detresse_apres')
                                                            ->label(fn ($get) => $get('detresse_apres') ? 'Bon' : 'Mauvais')
                                                            ->default(true)
                                                            ->live()
                                                            ->columnSpan(3),
                                                    ]),                                                
                                            ]),
                                    ]),
                            ]),
                            Grid::make(1)
                                ->schema([
                                    Textarea::make('autre_commentaire')
                                        ->label('Autres commentaires')
                                        ->rows(5)
                                        ->cols(12)
                                        ->maxLength(200)
                                        ->helperText('Maximum 500 caractères.'),
                                    ]),
                        Step::make('DETAILS DE L\'INTERVENTION')
                            ->schema([
                                Grid::make(12)
                                    ->schema([
                                        Section::make('')
                                            ->columnSpan(3)
                                            ->schema([
                                                Checkbox::make('nouv_installation')
                                                    ->label('Nouvelle installation'),
                                                Checkbox::make('reinstallation')
                                                    ->label('Réinstallation'),
                                                Checkbox::make('maintenance')
                                                    ->label('Maintenance'),
                                                Checkbox::make('panne')
                                                    ->label('Panne'),                                                    
                                                Checkbox::make('desinstallation')
                                                    ->label('Désinstallation'),
                                                TextInput::make('version_dors_chargee')
                                                    ->label('Version DDR\'s chargée'),  
                                            ]),

                                        Section::make('')
                                            ->columnSpan(3)
                                            ->schema([
                                                Checkbox::make('gprs_gsm_verifie')
                                                ->label('GPS/GSM vérifié'),
                                                Checkbox::make('arret_vehicule_verifie')
                                                ->label('Arrêt véhicule vérifié'),
                                                Checkbox::make('fm_terminal_verifie')
                                                ->label('FM terminal vérifié'),
                                                Checkbox::make('voice_kif_verifie')
                                                ->label('Voice Kit vérifié'),
                                                Checkbox::make('rf_reader_verifie')
                                                ->label('RF reader vérifié'),
                                                Checkbox::make('proximite_verifie')
                                                ->label('Proximité vérifiée'),
                                            ]),

                                        Section::make('')
                                            ->columnSpan(6)
                                            ->schema([
                                                Grid::make(2)
                                                    ->schema([
                                                        TimePicker::make('temps_debut')
                                                            ->label('Temps debut')
                                                            ->inlineLabel(),
                                                        TimePicker::make('temps_fin')
                                                            ->label('Temps fin')
                                                            ->inlineLabel(),
                                                     ]),
                                                Grid::make(2)
                                                    ->schema([
                                                        TimePicker::make('duree_test')
                                                            ->label('Durée test')
                                                            ->inlineLabel(),
                                                        TextInput::make('distance_test')
                                                            ->label('Distance test')
                                                            ->inlineLabel(),
                                                     ]), 

                                                TextInput::make('odo_hrs_moteur_fixe')
                                                    ->label('ODO/Hrs moteur fixe à ')
                                                    ->inlineLabel(),
                                                Grid::make(12)
                                                    ->schema([
                                                        TextInput::make('plage_bande_verte_de')
                                                            ->label('Plage bande verte de')
                                                            ->inlineLabel()
                                                            ->columnSpan(8),
                                                        TextInput::make('plage_bande_verte_a')
                                                            ->label('à')
                                                            ->inlineLabel()
                                                            ->columnSpan(4),
                                                     ]),   
                                                TextInput::make('sur_regime')
                                                    ->label('Sur regime')
                                                    ->inlineLabel(),                                              
                                            ]),
                                    ]),
                                    Grid::make(12)
                                        ->schema([
                                            TextInput::make('calibration_vitesse')
                                                ->label('Calibration vitese :')
                                                ->inlineLabel()
                                                ->columnSpan(4),
                                            Checkbox::make('par_distance_fixe')
                                                ->label('Par distance fixe')
                                                ->columnSpan(2),
                                            Checkbox::make('par_tableau')
                                                ->label('Par tableau')
                                                ->columnSpan(2),
                                            Checkbox::make('vitesse_gps')
                                                ->label('Vitesse GPS')
                                                ->columnSpan(2), 
                                            Checkbox::make('can')
                                                ->label('Can')
                                                 ->columnSpan(2), 
                                        ])->columnSpanFull(), 
                                    
                                        Grid::make(2)
                                            ->schema([
                                                Section::make('Informations supplémentaires')
                                                    ->schema([
                                                        TimePicker::make('debut_heure_suppl')
                                                            ->live()
                                                            ->inlineLabel(),

                                                        TimePicker::make('fin_heure_suppl')
                                                            ->live()
                                                            ->inlineLabel(),

                                                        Placeholder::make('total_heure_suppl')
                                                            ->label('Total Hrs suppl.')
                                                            ->content(function ($get) {
                                                                $debut = $get('debut_heure_suppl');
                                                                $fin = $get('fin_heure_suppl');

                                                                if (! $debut || ! $fin) {
                                                                    return '-';
                                                                }

                                                                return \Carbon\Carbon::parse($debut)
                                                                    ->diff(\Carbon\Carbon::parse($fin))
                                                                    ->format('%H : %I');
                                                            })
                                                            ->inlineLabel(),

                                                        TimePicker::make('temps_attente_pour')
                                                            ->live()
                                                            ->inlineLabel(),

                                                        TimePicker::make('debut_attente')
                                                            ->live()
                                                            ->inlineLabel(),

                                                        TimePicker::make('fin_attente')
                                                            ->live()
                                                            ->inlineLabel(),
                                                        Textarea::make('observation')
                                                            ->label('Observation')
                                                            ->columnSpanFull()
                                                            ->rows(6),
                                                            
                                                    ])
                                                    ->columns(3),

                                            Section::make('')
                                                ->schema([

                                                    TextInput::make('ancien_num_serie_sim')
                                                        ->label('Ancien N° série SIM'),

                                                    TextInput::make('nouveau_num_serie_sim')
                                                        ->label('Nouveau N° série SIM'),

                                                    TextInput::make('ancien_num_serie_boitier_fm')
                                                        ->label('Ancien N° série boîtier FM'),

                                                    TextInput::make('nouveau_num_serie_boitier_fm')
                                                        ->label('Nouveau N° série boîtier FM'),

                                                    TextInput::make('ancien_num_serie_fm_terminal')
                                                        ->label('Ancien N° série FM Terminal'),

                                                    TextInput::make('nouveau_num_serie_fm_terminal')
                                                        ->label('Nouveau N° série FM Terminal'),

                                                    TextInput::make('ancien_num_serie_boitier_voice_kit')
                                                        ->label('Ancien N° série boîtier Voice Kit'),

                                                    TextInput::make('nouveau_num_serie_boitier_voice_kit')
                                                        ->label('Nouveau N° série boîtier Voice Kit'),

                                                    TextInput::make('ancien_num_serie_boitier_rf_tag_id')
                                                        ->label('Ancien N° série boîtier RF Tag ID'),

                                                    TextInput::make('nouveau_num_serie_boitier_rf_tag_id')
                                                        ->label('Nouveau N° série boîtier RF Tag ID'),
                                                ])
                                                ->columns(2),
                                        ])->columnSpanFull(),                                   
                            ]),

                    ])->columnSpanFull()
                    
            ]);
    }

    public static function genererCode(int $clientId): string
    {
        $annee = now()->format('y'); // 26

        $compteur = str_pad(
            self::count() + 1,
            5,
            '0',
            STR_PAD_LEFT
        );

        return sprintf(
            'J-%s-%02d%s',
            $annee,
            $clientId,
            $compteur
        );
    }
}
