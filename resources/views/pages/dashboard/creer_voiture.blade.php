@extends('layouts.dashboard')

@section('title','dashboard - Creer Voiture')

@section('header')
    <link href="{{asset('assets/css/dashboard/cree_voiture.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="col-md-9 col-sm-8">
                <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert">&times;</a> <strong>Oh snap!</strong> {{ $error }} </div>
            </div>
        @endforeach
    @endif
    @if (session('success'))
        <div class="col-md-9 col-sm-8">
            <div class="alert alert-success fade in"> <a class="close" data-dismiss="alert" >&times;</a>{{session('success')}} </div>
        </div>
    @endif

    <div class="col-md-9 col-sm-8">
        <h3><strong>Créer une nouvelle voiture</strong></h3>
        <form method="post" action="{{route('voitures.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="accordion">
                {{-- Informations de publication --}}
                <div class="accordion-group">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseOne">Informations de publication<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseOne" class="accordion-body collapse">
                        <div class="row">
                            {{-- titre --}}
                            <div class="col-md-6">
                                <label>Titre</label>
                                <input type="text" name="titre"  class="form-control" required>
                            </div>
                            {{-- Prix --}}
                            <div class="col-md-6">
                                <label >Prix (€)</label>
                                <input type="number" min="0"  name="prix"  class="form-control" required>
                            </div>
                            {{-- description --}}
                            <div class="col-md-12">
                                <label >description</label>
                                <textarea name="description" style="width: 100%; display:block; padding:10px;"  rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Spécifications génerals --}}
                <div class="accordion-group">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseTwo">Spécifications génerals<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseTwo" class="accordion-body collapse">
                        <div class="row">
                            {{-- Marque --}}
                            <div class="col-md-6">
                                <label>Marque </label>
                                <input type="text" name="marque" class="form-control">
                                    
                            </div>
                            {{-- Modèle --}}
                            <div class="col-md-6">
                                <label>Modèle </label>
                                <input type="text" name="modele"  class="form-control selectpicker">
                            </div>
                            {{-- Année  --}}
                            <div class="col-md-6">
                                <label>Année de manufacturation </label>
                                <select name="annee" class="form-control">
                                    @for ($i = 2000; $i <= (int) date("Y"); $i++)
                                        <option value="{{$i}}" >{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            {{-- Type --}}
                            <div class="col-md-6">
                                <label>Type</label>
                                <select name="type" class="form-control selectpicker">
                                    <option value="sedan" >Sedan</option> {{-- Sedan--}}
                                    <option value="suv" >SUV</option> {{-- SUV--}}
                                    <option value="coupe" >Coupé </option> {{-- Coupe--}}
                                    <option value="crossover" >Crossover</option> {{-- Crossover--}}
                                    <option value="break" >Break </option> {{-- wagon--}}
                                    <option value="van" >Van</option> {{-- Van--}}
                                    <option value="citadine" >Citadine</option> {{-- Minicar--}}
                                    <option value="monospace" >Monospace </option> {{-- Minivan--}}
                                </select>
                            </div>
                            {{-- kilométrage --}}
                            <div class="col-md-6">
                                <label>kilométrage (km)</label>
                                <input type="number" min="0" name="kilometrage"  class="form-control">
                            </div>
                            {{--ètat --}}
                            <div class="col-md-6">
                                <label>État</label>
                                <select name="etat" class="form-control" >
                                    <option value="neuf" >Neuf</option>
                                    <option value="occasion" >Occasion</option>
                                </select>
                            </div>
                            {{-- Transmission --}}
                            <div class="col-md-6">
                                <label>Transmission</label>
                                <select name="transmission" class="form-control selectpicker">
                                    <option value="5 vitesses manuelles" >5 vitesses Manuelles</option>
                                    <option value="5 vitesses automatique" >5 vitesses Automatique</option>
                                    <option value="6 vitesses manuelles" >6 vitesses Manuelles</option>
                                    <option value="6 vitesses automatique" >6 vitesses Automatique</option>
                                    <option value="7 vitesses manuelles" >7 vitesses Manuelles</option>
                                    <option value="7 vitesses automatique">7 vitesses Automatique</option>
                                    <option value="8 vitesses manuelles" >8 vitesses Manuelles</option>
                                    <option value="8 vitesses automatique" >8 vitesses Automatique</option>
                                </select>
                            </div>
                            {{-- Carburant --}}
                            <div class="col-md-6">
                                <label>Carburant</label>
                                <select name="carburant" class="form-control selectpicker">
                                    <option value="essence" >Essence</option>
                                    <option value="diesel" >Diesel</option>
                                    <option value="electricite" >Électricité </option>
                                </select>
                            </div>
                            {{-- Couleur --}}
                            <div class="col-md-6">
                                <label>Couleur</label>
                                <select name="couleur" class="form-control selectpicker">
                                    <option value="noir" >Noir</option>
                                    <option value="rouge" >Rouge</option>
                                    <option value="blanc" >Blanc</option>
                                    <option value="jaune" >Jaune</option>
                                    <option value="marron" >Marron</option>
                                    <option value="gris">Gris</option>
                                    <option value="argent">Argent</option>
                                    <option value="or" >Or</option>
                                </select>
                            </div>
                            {{-- nombre_portes --}}
                            <div class="col-md-6">
                                <label>Nombre de portes </label>
                                <input type="number" min="0" name="nombre_portes"  class="form-control">
                            </div>
                            {{-- nombre_places --}}
                            <div class="col-md-6">
                                <label>Nombre de places (km)</label>
                                <input type="number" min="0" name="nombre_places"  class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- specifications_moteur  --}}
                <div class="accordion-group" id="specifications_moteur">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle " data-toggle="collapse" data-parent="#" href="#collapseTree">Spécifications de moteur<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseTree" class="accordion-body collapse">
                        <div class="row">
                            {{-- Type de moteur' --}}
                            <div class="col-md-6">
                                <label>Type de moteur</label>
                                <input type="text" name="specifications_moteur[Type de moteur]" placeholder="ex: Essence"  class="form-control">
                            </div>
                            {{-- Cylindrée (cc) --}}
                            <div class="col-md-6">
                                <label>Cylindrée (cc)</label>
                                <input type="number" min="0" name="specifications_moteur[Cylindrée (cc)]" placeholder="ex: 1332"  class="form-control">
                            </div>
                            {{-- Puissance maximale (CV) --}}
                            <div class="col-md-6">
                                <label>Puissance maximale (CV)</label>
                                <input type="number" min="0" name="specifications_moteur[Puissance maximale (CV)]" placeholder="ex: 140"  class="form-control">
                            </div>
                            {{-- Couple maximal (Nm) --}}
                            <div class="col-md-6">
                                <label>Couple maximal (Nm)</label>
                                <input type="number" min="0" name="specifications_moteur[Couple maximal (Nm)]" placeholder="ex: 240"  class="form-control">
                            </div>
                            {{-- Consommation de carburant combinée (L/100km) --}}
                            <div class="col-md-6">
                                <label>Consommation de carburant combinée (L/100km)</label>
                                <input type="number" min="0" name="specifications_moteur[Consommation de carburant combinée (L/100km)]" placeholder="ex: 5.9"  class="form-control">
                            </div>
                            {{-- Émissions de CO2 (g/km) --}}
                            <div class="col-md-6">
                                <label>Émissions de CO2 (g/km)</label>
                                <input type="number" min="0" name="specifications_moteur[Émissions de CO2 (g/km)]" placeholder="ex: 133"  class="form-control">
                            </div>
                        
                        </div>
                        <div class="accordion add_new_field_accordion">
                            <div class="accordion-group">
                            <div class="accordion-heading togglize"> 
                                <a class="accordion-toggle add_new_field_accordion_header" data-toggle="collapse" data-parent="#" href="#collapseMoteurSpecification">Ajouter une nouvelle spécification<i class="fa fa-angle-down"></i>                             </a> 
                            </div>

                            <div id="collapseMoteurSpecification" class="accordion-body collapse add_new_field">
                                <label>Nom</label>
                                <input type="text"  id="new_name_specifications_moteur" placeholder="specification (unité)"  class="form-control">
                                
                                <label>Valeur</label>
                                <input type="text"  id="new_value_specifications_moteur" placeholder="valeur"  class="form-control">
                                <button type="button" class="btn btn-success" onclick="addField('specifications_moteur')">ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- specifications_exterieures --}}
                <div class="accordion-group" id="specifications_exterieures">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle " data-toggle="collapse" data-parent="#" href="#collapseFour">Spécifications d'exterieures<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseFour" class="accordion-body collapse">
                        <div class="row">
                            {{-- Longueur (mm) --}}
                            <div class="col-md-6">
                                <label>Longueur (mm)</label>
                                <input type="number" min="0" name="specifications_exterieures[Longueur (mm)]" placeholder="ex: 1332"  class="form-control">
                            </div>
                            
                            {{-- Largeur (mm) --}}
                            <div class="col-md-6">
                                <label>Largeur (mm)</label>
                                <input type="number" min="0" name="specifications_exterieures[Largeur (mm)]" placeholder="ex: 1332"  class="form-control">
                            </div>
                            {{-- Hauteur (mm) --}}
                            <div class="col-md-6">
                                <label>Hauteur (mm)</label>
                                <input type="number" min="0" name="specifications_exterieures[Hauteur (mm)]" placeholder="ex: 1332"  class="form-control">
                            </div>
                            {{-- Empattement (mm) --}}
                            <div class="col-md-6">
                                <label>Empattement (mm)</label>
                                <input type="number" min="0" name="specifications_exterieures[Empattement (mm)]" placeholder="ex: 1332"  class="form-control">
                            </div>
                            {{-- Poids (kg) --}}
                            <div class="col-md-6">
                                <label>Poids (kg)</label>
                                <input type="number" min="0" name="specifications_exterieures[Poids (kg)]" placeholder="ex: 1332"  class="form-control">
                            </div>
                        </div>
                        <div class="accordion add_new_field_accordion">
                            <div class="accordion-group">
                                <div class="accordion-heading togglize"> 
                                    <a class="accordion-toggle add_new_field_accordion_header" data-toggle="collapse" data-parent="#" href="#collapseExterieuresSpecification">Ajouter une nouvelle spécification<i class="fa fa-angle-down"></i>                             </a> 
                                </div>

                                <div id="collapseExterieuresSpecification" class="accordion-body collapse add_new_field">
                                    <label>Nom</label>
                                    <input type="text"  id="new_name_specifications_exterieures" placeholder="specification (unité)"  class="form-control">
                                    
                                    <label>Valeur</label>
                                    <input type="text"  id="new_value_specifications_exterieures" placeholder="valeur"  class="form-control">
                                    <button type="button" class="btn btn-success" onclick="addField('specifications_exterieures')">ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- specifications_interieures --}}
                <div class="accordion-group" id="specifications_interieures">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle " data-toggle="collapse" data-parent="#" href="#collapseFive">Spécifications d'interieures<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseFive" class="accordion-body collapse">
                        <div class="row">
                            {{-- Hauteur sous plafond (av/ar) --}}
                            <div class="col-md-6">
                                <label>Hauteur sous plafond (av/ar)</label>
                                <input type="text" name="specifications_interieures[Hauteur sous plafond (av/ar)]" placeholder="ex: 133/665"  class="form-control">
                            </div>
                            {{-- Volume passager (litres) --}}
                            <div class="col-md-6">
                                <label>Espace pour les jambes (av/ar)</label>
                                <input type="text" name="specifications_interieures[Espace pour les jambes (av/ar)]" placeholder="ex: 133/665"  class="form-control">
                            </div>
                            {{-- Espace pour les épaules (av/ar) --}}
                            <div class="col-md-6">
                                <label>Espace pour les épaules (av/ar)</label>
                                <input type="text" name="specifications_interieures[Espace pour les épaules (av/ar)]" placeholder="ex: 133/665"  class="form-control">
                            </div>
                            {{-- Système audio --}}
                            <div class="col-md-6">
                                <label>Système audio</label>
                                <input type="text" name="specifications_interieures[Système audio]" placeholder="ex: 133/665"  class="form-control">
                            </div>
                        </div>
                        <div class="accordion add_new_field_accordion">
                            <div class="accordion-group">
                                <div class="accordion-heading togglize"> 
                                    <a class="accordion-toggle add_new_field_accordion_header" data-toggle="collapse" data-parent="#" href="#collapseInterieuresSpecification">Ajouter une nouvelle spécification<i class="fa fa-angle-down"></i>                             </a> 
                                </div>

                                <div id="collapseInterieuresSpecification" class="accordion-body collapse add_new_field">
                                    <label>Nom</label>
                                    <input type="text"  id="new_name_specifications_interieures" placeholder="specification (unité)"  class="form-control">
                                    
                                    <label>Valeur</label>
                                    <input type="text"  id="new_value_specifications_interieures" placeholder="valeur"  class="form-control">
                                    <button type="button" class="btn btn-success" onclick="addField('specifications_interieures')">ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- specifications_capacites --}}
                <div class="accordion-group" id="specifications_capacites">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle " data-toggle="collapse" data-parent="#" href="#collapseSix">Spécifications de Capacitées<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseSix" class="accordion-body collapse">
                        <div class="row">
                            {{-- Volume de chargement (litres) --}}
                            <div class="col-md-6">
                                <label>Volume de chargement (litres)</label>
                                <input type="number" min="0" name="specifications_capacites[Volume de chargement (litres)]" placeholder="ex: 133"  class="form-control">
                            </div>
                            {{-- Espace pour les jambes (av/ar) --}}
                            <div class="col-md-6">
                                <label>Volume passager (litres)</label>
                                <input type="number" min="0" name="specifications_capacites[Volume passager (litres)]" placeholder="ex: 133"  class="form-control">
                            </div>
                            {{-- Volume intérieur total (litres) --}}
                            <div class="col-md-6">
                                <label>Volume intérieur total (litres)</label>
                                <input type="number" min="0" name="specifications_capacites[Volume intérieur total (litres)]" placeholder="ex: 133"  class="form-control">
                            </div>
                            {{-- Réservoir de carburant (litres) --}}
                            <div class="col-md-6">
                                <label>Réservoir de carburant (litres)</label>
                                <input type="number" min="0" name="specifications_capacites[Réservoir de carburant (litres)]" placeholder="ex: 133"  class="form-control">
                            </div>
                        </div>
                        <div class="accordion add_new_field_accordion">
                            <div class="accordion-group">
                                <div class="accordion-heading togglize"> 
                                    <a class="accordion-toggle add_new_field_accordion_header" data-toggle="collapse" data-parent="#" href="#collapseCapaciteSpecification">Ajouter une nouvelle spécification<i class="fa fa-angle-down"></i>                             </a> 
                                </div>

                                <div id="collapseCapaciteSpecification" class="accordion-body collapse add_new_field">
                                    <label>Nom</label>
                                    <input type="text"  id="new_name_specifications_capacites" placeholder="specification (unité)"  class="form-control">
                                    
                                    <label>Valeur</label>
                                    <input type="text"  id="new_value_specifications_capacites" placeholder="valeur"  class="form-control">
                                    <button type="button" class="btn btn-success" onclick="addField('specifications_capacites')">ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- options_additionnelles --}}
                <div class="accordion-group" id="options_additionnelles">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle " data-toggle="collapse" data-parent="#" href="#collapseSeven">Options additionnelles<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseSeven" class="accordion-body collapse">
                        <ul class="optional-features-list row">
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Jantes en alliage de 14 pouces"> Jantes en alliage de 14 pouces</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Jantes en alliage de 15 pouces"> Jantes en alliage de 15 pouces</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Jantes en alliage de 16 pouces"> Jantes en alliage de 16 pouces</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Jantes en alliage de 17 pouces"> Jantes en alliage de 17 pouces</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Jantes en alliage de 18 pouces"> Jantes en alliage de 18 pouces</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Jantes en alliage de 19 pouces"> Jantes en alliage de 19 pouces</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Jantes en alliage de 20 pouces"> Jantes en alliage de 20 pouces</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Jantes en alliage de 22 pouces"> Jantes en alliage de 22 pouces</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Alarme"> Alarme</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Décodeur audio MP3"> Décodeur audio MP3</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Kit carrosserie"> Kit carrosserie</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Protège-capot"> Protège-capot</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Barre de taureau"> Barre de taureau</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Barrière de chargement"> Barrière de chargement</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Tapis de sol en moquette"> Tapis de sol en moquette</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Lecteur CD"> Lecteur CD</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Verrouillage centralisé"> Verrouillage centralisé</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Régulateur de vitesse"> Régulateur de vitesse</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Phares de conduite"> Phares de conduite</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Lecteur DVD"> Lecteur DVD</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Immobilisateur de moteur"> Immobilisateur de moteur</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Phares antibrouillard avant"> Phares antibrouillard avant</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="GPS (Navigation par satellite)"> GPS (Navigation par satellite)</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Couvre-phare"> Couvre-phare</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Sièges en cuir"> Sièges en cuir</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Garniture en cuir"> Garniture en cuir</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="GPL (Bi-carburation)"> GPL (Bi-carburation)</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Déflecteur de toit"> Déflecteur de toit</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Spoiler - arrière"> Spoiler - arrière</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Toit ouvrant"> Toit ouvrant</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Toit ouvrant - électrique"> Toit ouvrant - électrique</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Vitres teintées"> Vitres teintées</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Barre de remorquage"> Barre de remorquage</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Déflecteurs d'air"> Déflecteurs d'air</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Accès pour fauteuil roulant"> Accès pour fauteuil roulant</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Sac à ski"> Sac à ski</label></li>
                            <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="Sièges avant électriques"> Sièges avant électriques</label></li>
                            
                        </ul>
                        <div class="accordion add_new_field_accordion">
                            <div class="accordion-group">
                                <div class="accordion-heading togglize"> 
                                    <a class="accordion-toggle add_new_field_accordion_header" data-toggle="collapse" data-parent="#" href="#collapseOptionsAdditionnelles">Ajouter une nouvelle option<i class="fa fa-angle-down"></i>                             </a> 
                                </div>

                                <div id="collapseOptionsAdditionnelles" class="accordion-body collapse add_new_field">
                                    <label>option</label>
                                    <input type="text"  id="new_name_options_additionnelles" placeholder="option"  class="form-control">
                                    
                                    <button type="button" class="btn btn-success" onclick="addCheckbox('options_additionnelles')">ajouter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- images --}}
                <div class="accordion-group" id="voiture_images">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle " data-toggle="collapse" data-parent="#" href="#collapseEight">Les Images<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseEight" class="accordion-body collapse">
                        <div class="alert alert-info fade in"> <a class="close" data-dismiss="alert">&times;</a> Les images ne doivent pas dépasser 5 Mo. </div>
                        <div class="alert alert-info fade in"> <a class="close" data-dismiss="alert">&times;</a> Vous pouvez ajouter une image principale et trois autres. </div>
                        <div class="row">
                            {{-- Image Principale --}}
                            <div class="col-md-6">
                                <label>L'image Principale</label>
                                <input type="file" name="main_image" class="form-control" required>
                            </div>
                            {{-- Autres images --}}
                            <div class="col-md-6">
                                <label>Les autres images</label>
                                <input type="file"  name="images[]" multiple class="form-control">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <button style="margin: 20px 0;" type="submit" class="btn btn-info pull-right">Creer</button>
            

        </form>
        
    </div>
        
@endsection

@section('scripts')
    <script src="{{asset('assets/js/dashboard/cree_voiture.js')}}"></script>
@endsection