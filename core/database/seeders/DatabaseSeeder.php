<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Database\Seeder;
use App\Models\Voiture;
use App\Models\Image;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(2)->create();
        Message::factory()->count(40)->create();
        
        
        $cars=[
                [
                    'titre'=>"Peugeot 3008 d'occasion",
                    'prix'=>18000,
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                    'couleur'=>'gris',
                    'marque' => 'Peugeot',
                    'modele' => '3008',
                    'type' => 'suv',
                    'annee' => '2019',
                    'kilometrage' => 50000,
                    'transmission' => '6 vitesses manuelles',
                    'carburant' => 'diesel',
                    'etat' => 'occasion',
                    'nombre_portes' => 5,
                    'nombre_places' => 5,
                    'specifications_moteur' => [
                        'Type de moteur' => 'Diesel',
                        'Cylindrée (cc)' => 1560,
                        'Puissance maximale (CV)' => 120,
                        'Couple maximal (Nm)' => 300,
                        'Consommation de carburant combinée (L/100km)' => 4.8,
                        'Émissions de CO2 (g/km)' => 125,
                    ],
                    'specifications_exterieures' => [
                        'Longueur (mm)' => 4447,
                        'Largeur (mm)' => 1841,
                        'Hauteur (mm)' => 1624,
                        'Empattement (mm)' => 2675,
                        'Poids (kg)' => 1310,
                        
                    ],
                    'specifications_interieures' => [
                        'Hauteur sous plafond (av/ar)' => '1025/975',
                        'Espace pour les jambes (av/ar)' => '620/640',
                        'Espace pour les épaules (av/ar)' => '1450/1420',
                        'Système audio' => 'Écran tactile 8 pouces',
                    ],
                    'specifications_capacites' => [
                        'Volume de chargement (litres)' => 520,
                        'Volume passager (litres)' => 1598,
                        'Volume intérieur total (litres)' => 2118,
                        'Réservoir de carburant (litres)' => 53,
                    ],
                    'options_additionnelles' => [
                        'Toit ouvrant panoramique' ,
                        'Climatisation automatique' ,
                        'Sièges en cuir' ,
                        'Phares LED' ,
                    ],
                ],
                [
                'titre'=>"Renault Clio Neuf",
                'prix'=>35000,
                'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                'couleur'=>'gris',
                'marque' => 'Renault',
                'modele' => 'Clio',
                'type' => 'Citadine',
                'annee' => '2021',
                'kilometrage' => 0,
                'transmission' => '5 vitesses manuelle',
                'carburant' => 'Essence',
                'etat' => 'Neuf',
                'nombre_portes' => 5,
                'nombre_places' => 5,
                'specifications_moteur' => [
                    'Type de moteur' => 'Essence',
                    'Cylindrée (cc)' => 999,
                    'Puissance maximale (CV)' => 90,
                    'Couple maximal (Nm)' => 160,
                    'Consommation de carburant combinée (L/100km)' => 4.7,
                    'Émissions de CO2 (g/km)' => 107,
                ],
                'specifications_exterieures' => [
                    'Longueur (mm)' => 4050,
                    'Largeur (mm)' => 1798,
                    'Hauteur (mm)' => 1440,
                    'Empattement (mm)' => 2589,
                    'Poids (kg)' => 1176,
                    
                ],
                'specifications_interieures' => [
                    'Hauteur sous plafond (av/ar)' => '882/852',
                    'Espace pour les jambes (av/ar)' => '665/645',
                    'Espace pour les épaules (av/ar)' => '1368/1340',
                    'Système audio' => 'Écran tactile 7 pouces',
                    'Bluetooth' ,
                    
                ],
                'specifications_capacites' => [
                    'Volume de chargement (litres)' => 391,
                    'Volume passager (litres)' => 1180,
                    'Volume intérieur total (litres)' => 1571,
                    'Réservoir de carburant (litres)' => 42,
                ],
                'options_additionnelles' => [
                    'Toit ouvrant' ,
                    'Phares LED' ,
                    'Régulateur de vitesse adaptatif' ,
                    'Aide au stationnement avant et arrière' ,
                    'Climatisation automatique' ,
                    'Sièges sport',
                    'Système de navigation' ,
                    'Rétroviseurs rabattables électriquement' ,
                    'Système de démarrage sans clé' ,
                ]
                ],
                [
                    'titre'=>"Renault Talisman d'occasion",
                    'prix'=>22000,
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                    'couleur'=>'gris',
                    'marque' => 'Renault',
                    'modele' => 'Talisman',
                    'type' => 'Sedan',
                    'annee' => '2020',
                    'kilometrage' => 25000,
                    'transmission' => '7 vitesses automatique',
                    'carburant' => 'essence',
                    'etat' => 'occasion',
                    'nombre_portes' => 5,
                    'nombre_places' => 5,
                    'specifications_moteur' => [
                        'Type de moteur' => 'Essence',
                        'Cylindrée (cc)' => 1332,
                        'Puissance maximale (CV)' => 160,
                        'Couple maximal (Nm)' => 260,
                        'Consommation de carburant combinée (L/100km)' => 6.4,
                        'Émissions de CO2 (g/km)' => 144,
                    ],
                    'specifications_exterieures' => [
                        'Longueur (mm)' => 4892,
                        'Largeur (mm)' => 2071,
                        'Hauteur (mm)' => 1463,
                        'Empattement (mm)' => 2830,
                        'Poids (kg)' => 1430,
                        
                    ],
                    'specifications_interieures' => [
                        'Hauteur sous plafond (av/ar)' => '926/878',
                        'Espace pour les jambes (av/ar)' => '1458/884',
                        'Espace pour les épaules (av/ar)' => '1453/1410',
                        'Système audio' => 'Système multimédia avec écran tactile 7 pouces',
                        
                    ],
                    'specifications_capacites' => [
                        'Volume de chargement (litres)' => 608,
                        'Volume passager (litres)' => 1029,
                        'Volume intérieur total (litres)' => 1637,
                        'Réservoir de carburant (litres)' => 47,
                    ],
                    'options_additionnelles' => [
                        'Toit ouvrant panoramique' ,
                        'Système de navigation GPS' ,
                        'Système de son Bose' ,
                        'Sièges électriques à mémoire de position' ,
                        'Jantes en alliage 18 pouces' ,
                    ],
                ],
                [
                    'titre'=>"Renault Megane neuf",
                    'prix'=>22000,
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                    'couleur'=>'gris',
                    'marque' => 'Renault',
                    'modele' => 'Megane',
                    'type' => 'Sedan',
                    'annee' => '2021',
                    'kilometrage' => 10000,
                    'transmission' => '5 vitesses manuelle',
                    'carburant' => 'essence',
                    'etat' => 'neuf',
                    'nombre_portes' => 5,
                    'nombre_places' => 5,
                    'specifications_moteur' => [
                        'Type de moteur' => 'Essence',
                        'Cylindrée (cc)' => 1332,
                        'Puissance maximale (CV)' => 140,
                        'Couple maximal (Nm)' => 240,
                        'Consommation de carburant combinée (L/100km)' => 5.9,
                        'Émissions de CO2 (g/km)' => 133,
                    ],
                    'specifications_exterieures' => [
                        'Longueur (mm)' => 4630,
                        'Largeur (mm)' => 1814,
                        'Hauteur (mm)' => 1448,
                        'Empattement (mm)' => 2670,
                        'Poids (kg)' => 1224,
                    ],
                    'specifications_interieures' => [
                        'Hauteur sous plafond (av/ar)' => '913/874',
                        'Espace pour les jambes (av/ar)' => '580/150',
                        'Espace pour les épaules (av/ar)' => '1439/1391',
                        'Système audio' => 'Radio RDS avec écran tactile 7 pouces',
                        'Bluetooth' ,
                        'Caméra de recul' ,
                        'Sièges en cuir' ,
                        'Sièges chauffants' ,
                        'Sièges ventilés' ,
                        'Volant chauffant' ,
                    ],
                    'specifications_capacites' => [
                        'Volume de chargement (litres)' => 503,
                        'Volume passager (litres)' => 1629,
                        'Volume intérieur total (litres)' => 2132,
                        'Réservoir de carburant (litres)' => 50,
                    ],
                    'options_additionnelles' => [
                        'Climatisation automatique' ,
                        'Système de navigation GPS' ,
                        'Toit ouvrant panoramique' ,
                        'Démarrage sans clé' ,
                        'Régulateur de vitesse adaptatif' ,
                        'Phares LED' ,
                    ],
                ],
                [
                    'titre'=>"Volkswagen Passat neuf",
                    'prix'=>45000,
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                    'couleur'=>'gris',
                    'marque' => 'Volkswagen',
                    'modele' => 'Passat',
                    'type' => 'Sedan',
                    'annee' => '2022',
                    'kilometrage' => 0,
                    'transmission' => '7 vitesses automatiques',
                    'carburant' => 'essence',
                    'etat' => 'neuf',
                    'nombre_portes' => 4,
                    'nombre_places' => 5,
                    'specifications_moteur' => [
                        'Type de moteur' => 'Essence',
                        'Cylindrée (cc)' => 1395,
                        'Puissance maximale (CV)' => 150,
                        'Couple maximal (Nm)' => 250,
                        'Consommation de carburant combinée (L/100km)' => 6.3,
                        'Émissions de CO2 (g/km)' => 144,
                    ],
                    'specifications_exterieures' => [
                        'Longueur (mm)' => 4767,
                        'Largeur (mm)' => 1832,
                        'Hauteur (mm)' => 1462,
                        'Empattement (mm)' => 2791,
                        'Poids (kg)' => 1430,
                        
                    ],
                    'specifications_interieures' => [
                        'Hauteur sous plafond (av/ar)' => '983/953',
                        'Espace pour les jambes (av/ar)' => '1048/973',
                        'Espace pour les épaules (av/ar)' => '1459/1441',
                        'Système audio' => 'Écran tactile 8 pouces',
                        
                    ],
                    'specifications_capacites' => [
                        'Volume de chargement (litres)' => 586,
                        'Volume passager (litres)' => 267,
                        'Volume intérieur total (litres)' => 853,
                        'Réservoir de carburant (litres)' => 66,
                    ],
                    'options_additionnelles' => [
                        'Toit ouvrant',
                        'Système de navigation',
                        'Régulateur de vitesse adaptatif',
                        'Phares LED',
                        'Climatisation automatique',
                    ],
                ],
                [
                    'titre'=>"Peugeot RCZ neuf",
                    'prix'=>14000,
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                    'couleur'=>'gris',
                    'marque' => 'Peugeot',
                    'modele' => 'RCZ',
                    'type' => 'Coupé',
                    'annee' => '2014',
                    'kilometrage' => 80000,
                    'transmission' => '6 vitesses manuelles',
                    'carburant' => 'essence',
                    'etat' => 'occasion',
                    'nombre_portes' => 2,
                    'nombre_places' => 2,
                    'specifications_moteur' => [
                        'Type de moteur' => 'Essence',
                        'Cylindrée (cc)' => 1598,
                        'Puissance maximale (CV)' => 156,
                        'Couple maximal (Nm)' => 240,
                        'Consommation de carburant combinée (L/100km)' => 6.3,
                        'Émissions de CO2 (g/km)' => 145,
                    ],
                    'specifications_exterieures' => [
                        'Longueur (mm)' => 4290,
                        'Largeur (mm)' => 1845,
                        'Hauteur (mm)' => 1352,
                        'Empattement (mm)' => 2612,
                        'Poids (kg)' => 1280,
                        
                    ],
                    'specifications_interieures' => [
                        'Hauteur sous plafond (av/ar)' => '965/884',
                        'Espace pour les jambes (av/ar)' => '1092/--',
                        'Espace pour les épaules (av/ar)' => '1373/--',
                        'Système audio' => 'Radio CD MP3 avec prise auxiliaire et port USB',
                        
                    ],
                    'specifications_capacites' => [
                        'Volume de chargement (litres)' => 321,
                        'Réservoir de carburant (litres)' => 55,
                    ],
                    'options_additionnelles' => [
                        'Caméra de recul',
                        'Toit ouvrant',
                        'Système de navigation',
                        'Détecteur de pluie',
                        'Détecteur de luminosité',
                        'Bluetooth',
                        'Climatisation automatique',
                        'Sièges en cuir',
                    ],
                ],
                [
                    'titre'=>"Dacia Duster neuf",
                    'prix'=>22000,
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                    'couleur'=>'gris',
                    'marque' => 'Dacia',
                    'modele' => 'Duster',
                    'type' => 'SUV',
                    'annee' => '2022',
                    'kilometrage' => 0,
                    'transmission' => '6 vitesses manuelles',
                    'carburant' => 'essence',
                    'etat' => 'neuf',
                    'nombre_portes' => 5,
                    'nombre_places' => 5,
                    'specifications_moteur' => [
                        'Type de moteur' => 'Essence',
                        'Cylindrée (cc)' => 1332,
                        'Puissance maximale (CV)' => 130,
                        'Couple maximal (Nm)' => 240,
                        'Consommation de carburant combinée (L/100km)' => 6.2,
                        'Émissions de CO2 (g/km)' => 140,
                    ],
                    'specifications_exterieures' => [
                        'Longueur (mm)' => 4341,
                        'Largeur (mm)' => 1804,
                        'Hauteur (mm)' => 1693,
                        'Empattement (mm)' => 2673,
                        'Poids (kg)' => 1205,
                        
                    ],
                    'specifications_interieures' => [
                        'Hauteur sous plafond (av/ar)' => '1015/971',
                        'Espace pour les jambes (av/ar)' => '790/785',
                        'Espace pour les épaules (av/ar)' => '1390/1370',
                        'Système audio' => 'Radio MP3 avec Bluetooth',
                        
                    ],
                    'specifications_capacites' => [
                        'Volume de chargement (litres)' => 445,
                        'Volume passager (litres)' => 1636,
                        'Volume intérieur total (litres)' => 2081,
                        'Réservoir de carburant (litres)' => 50,
                    ],
                    'options_additionnelles' => [
                        'Climatisation' ,
                        'Sièges chauffants' ,
                        'Sièges en cuir' ,
                        'Régulateur de vitesse' ,
                        'Volant en cuir' ,
                        'Peinture métallisée' ,
                        'Roue de secours' ,
                        'Capteurs de stationnement' ,
                        'Toit ouvrant panoramique' ,
                        'Système de navigation' ,
                    ],
                ],
                [
                    'titre'=>"Audi A4 d'occasion",
                    'prix'=>12000,
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                    'couleur'=>'gris',
                    'marque' => 'Audi',
                    'modele' => 'A4',
                    'type' => 'Sedan',
                    'annee' => '2020',
                    'kilometrage' => 20000,
                    'transmission' => '7 vitesses automatiques',
                    'carburant' => 'essence',
                    'etat' => 'occasion',
                    'nombre_portes' => 4,
                    'nombre_places' => 5,
                    'specifications_moteur' => [
                        'Type de moteur' => '4 cylindres en ligne, turbocompressé',
                        'Cylindrée (cc)' => 1984,
                        'Puissance maximale (CV)' => 190,
                        'Couple maximal (Nm)' => 320,
                        'Consommation de carburant combinée (L/100km)' => 6.1,
                        'Émissions de CO2 (g/km)' => 141,
                    ],
                    'specifications_exterieures' => [
                        'Longueur (mm)' => 4762,
                        'Largeur (mm)' => 1847,
                        'Hauteur (mm)' => 1427,
                        'Empattement (mm)' => 2820,
                        'Poids (kg)' => 1515,
                        
                    ],
                    'specifications_interieures' => [
                        'Hauteur sous plafond (av/ar)' => '1004/942',
                        'Espace pour les jambes (av/ar)' => '1055/907',
                        'Espace pour les épaules (av/ar)' => '1455/1431',
                        'Système audio' => 'Audi MMI Radio Plus avec écran couleur 7 pouces',
                    ],
                    'specifications_capacites' => [
                        'Volume de chargement (litres)' => 480,
                        'Volume passager (litres)' => 1050,
                        'Volume intérieur total (litres)' => 1530,
                        'Réservoir de carburant (litres)' => 54,
                    ],
                    'options_additionnelles' => [
                        'Climatisation',
                        'Régulateur de vitesse',
                        'Système de navigation',
                        'Caméra de recul',
                        'Démarrage sans clé',
                        'Toit ouvrant',
                        'Sièges chauffants',
                        'Volant en cuir',
                        'Feux de route automatiques',
                        'Capteurs de stationnement avant et arrière',
                        'Phares LED',
                    ],
                ],
                [
                    'titre'=>"Mercedes-Benz C-Class Neuf",
                    'prix'=>53000,
                    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.',
                    'couleur'=>'gris',
                    'marque' => 'Mercedes-Benz',
                    'modele' => 'C-Class',
                    'type' => 'Sedan',
                    'annee' => '2021',
                    'kilometrage' => 5000,
                    'transmission' => '9 vitesses automatiques',
                    'carburant' => 'essence',
                    'etat' => 'neuf',
                    'nombre_portes' => 4,
                    'nombre_places' => 5,
                    'specifications_moteur' => [
                        'Type de moteur' => '4 cylindres en ligne, turbocompressé',
                        'Cylindrée (cc)' => 1991,
                        'Puissance maximale (CV)' => 258,
                        'Couple maximal (Nm)' => 370,
                        'Consommation de carburant combinée (L/100km)' => 6.7,
                        'Émissions de CO2 (g/km)' => 153,
                    ],
                    'specifications_exterieures' => [
                        'Longueur (mm)' => 4751,
                        'Largeur (mm)' => 1839,
                        'Hauteur (mm)' => 1442,
                        'Empattement (mm)' => 2865,
                        'Poids (kg)' => 1620,
                        
                    ],
                    'specifications_interieures' => [
                        'Hauteur sous plafond (av/ar)' => '1045/942',
                        'Espace pour les jambes (av/ar)' => '1065/894',
                        'Espace pour les épaules (av/ar)' => '1445/1419',
                        'Système audio' => 'Système audio haute performance avec écran couleur 10.25 pouces',
                    ],
                    'specifications_capacites' => [
                        'Volume de chargement (litres)' => 455,
                        'Volume passager (litres)' => 970,
                        'Volume intérieur total (litres)' => 1425,
                        'Réservoir de carburant (litres)' => 66,
                    ],
                    'options_additionnelles' => [
                        'Climatisation',
                        'Régulateur de vitesse',
                        'Système de navigation',
                        'Caméra de recul',
                        'Démarrage sans clé',
                        'Sièges chauffants',
                        'Sièges ventilés',
                        'Sièges en cuir',
                        'Volant chauffant',
                        'Feux de route automatiques',
                        'Capteurs de stationnement avant et arrière',
                        'Phares LED',
                    ],
                ]

        ];


        foreach($cars as $car){
            $car['specifications_moteur'] = json_encode($car['specifications_moteur']);
            $car['specifications_exterieures'] = json_encode($car['specifications_exterieures']);
            $car['specifications_interieures'] = json_encode($car['specifications_interieures']);
            $car['specifications_capacites'] = json_encode($car['specifications_capacites']);
            $car['options_additionnelles'] = json_encode($car['options_additionnelles']);
            $cr = Voiture::create($car);
            for ($i=0; $i < 4; $i++) { 
                $img = fake()->image();
                $path = Storage::putFile("voitures", $img );
                if($i>0){
                    $cr->images()->save(new Image(['path'=>$path]));
                }else{
                    $cr->images()->save(new Image(['path'=>$path , 'main'=>true]));
                }
            }
             
        }
        
        


        
        
        
        
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
