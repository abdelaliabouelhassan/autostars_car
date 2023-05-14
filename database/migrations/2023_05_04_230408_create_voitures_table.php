<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->unsignedBigInteger('prix');

            $table->string('marque');
            $table->string('modele');
            $table->string('type');//suv, sedan, ...
            $table->string('annee');// 2002, 2017
            $table->unsignedBigInteger('kilometrage');//200000 km
            $table->string('transmission');//5 vitesses manuelles, 5 vitesses automatique , 6 .....
            $table->string('carburant'); //essence , diesel
            $table->string('etat');//  , ['neuf', 'occasion']
            $table->string('couleur');
            $table->unsignedInteger('nombre_portes');
            $table->unsignedInteger('nombre_places');

            $table->text('description');

            $table->json('specifications_moteur'); 
            // Type de moteur
            // Cylindrée (cc)
            // Puissance maximale (CV)
            // Couple maximal (Nm)
            // Consommation de carburant combinée (L/100km)
            // Émissions de CO2 (g/km)
            $table->json('specifications_exterieures'); 
            // Longueur (mm)
            // Largeur (mm)
            // Hauteur (mm)
            // Empattement (mm)
            // poids (kg)
            // Jantes en alliage
            $table->json('specifications_interieures'); 
            // Hauteur sous plafond (av/ar)
            // Espace pour les jambes (av/ar)
            // Espace pour les épaules (av/ar)
            $table->json('specifications_capacites'); 
            // Volume de chargement (litres)
            // Volume passager (litres)
            // Volume intérieur total (litres)
            // Réservoir de carburant (litres)
            $table->json('options_additionnelles'); 
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};
