@extends('layouts.dashboard')

@section('title','dashboard - Éditer voiture')

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
        <h3><strong>Éditer la voiture</strong></h3>
        <form method="post" action="{{route('voitures.update', ['voiture'=>$voiture->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="accordion">
                {{-- Informations de publication --}}
                <div class="accordion-group">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseOne">Informations de publication<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseOne" class="accordion-body collapse">
                        <div class="row">
                            {{-- titre --}}
                            <div class="col-md-6">
                                <label>Titre</label>
                                <input type="text" name="titre" value="{{$voiture->titre}}"  class="form-control" required>
                            </div>
                            {{-- Prix --}}
                            <div class="col-md-6">
                                <label >Prix (€)</label>
                                <input type="number" min="0"  name="prix" value="{{$voiture->prix}}"  class="form-control" required>
                            </div>
                            {{-- description --}}
                            <div class="col-md-12">
                                <label >description</label>
                                <textarea name="description" style="width: 100%; display:block; padding:10px;"  rows="5" required>{{$voiture->description}}</textarea>
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
                                <input type="text" name="marque" value="{{$voiture->marque}}" class="form-control">
                                    
                            </div>
                            {{-- Modèle --}}
                            <div class="col-md-6">
                                <label>Modèle </label>
                                <input type="text" name="modele" value="{{$voiture->modele}}"  class="form-control selectpicker">
                            </div>
                            {{-- Année  --}}
                            <div class="col-md-6">
                                <label>Année de manufacturation </label>
                                <select name="annee" class="form-control" value="{{$voiture->annee}}">
                                    @for ($i = 2000; $i <= (int) date("Y"); $i++)
                                        <option value="{{$i}}" {{$voiture->annee == $i ? 'selected' : ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            {{-- Type --}}
                            <div class="col-md-6">
                                <label>Type</label>
                                <select name="type" class="form-control selectpicker">
                                    <option value="sedan" {{$voiture->type == 'sedan' ? 'selected' : ''}}>Sedan</option> {{-- Sedan--}}
                                    <option value="suv" {{$voiture->type == 'suv' ? 'selected' : ''}}>SUV</option> {{-- SUV--}}
                                    <option value="coupe" {{$voiture->type == 'coupe' ? 'selected' : ''}}>Coupé </option> {{-- Coupe--}}
                                    <option value="crossover" {{$voiture->type == 'crossover' ? 'selected' : ''}}>Crossover</option> {{-- Crossover--}}
                                    <option value="break" {{$voiture->type == 'break' ? 'selected' : ''}}>Break </option> {{-- wagon--}}
                                    <option value="van" {{$voiture->type == 'van' ? 'selected' : ''}}>Van</option> {{-- Van--}}
                                    <option value="citadine" {{$voiture->type == 'citadine' ? 'selected' : ''}}>Citadine</option> {{-- Minicar--}}
                                    <option value="monospace" {{$voiture->type == 'monospace' ? 'selected' : ''}}>Monospace </option> {{-- Minivan--}}
                                </select>
                            </div>
                            {{-- kilométrage --}}
                            <div class="col-md-6">
                                <label>kilométrage (km)</label>
                                <input type="number" min="0" value="{{$voiture->kilometrage}}" name="kilometrage"  class="form-control">
                            </div>
                            {{--ètat --}}
                            <div class="col-md-6">
                                <label>État</label>
                                <select name="etat" class="form-control" >
                                    <option value="neuf" {{$voiture->etat == 'neuf' ? 'selected' : ''}}>Neuf</option>
                                    <option value="occasion" {{$voiture->etat == 'occasion' ? 'selected' : ''}}>Occasion</option>
                                </select>
                            </div>
                            {{-- Transmission --}}
                            <div class="col-md-6">
                                <label>Transmission</label>
                                <select name="transmission" class="form-control selectpicker">
                                    <option value="5 vitesses manuelles" {{$voiture->transmission == '5 vitesses manuelles' ? 'selected' : ''}}>5 vitesses Manuelles</option>
                                    <option value="5 vitesses automatique" {{$voiture->transmission == '6 vitesses automatique' ? 'selected' : ''}}>5 vitesses Automatique</option>
                                    <option value="6 vitesses manuelles" {{$voiture->transmission == '6 vitesses manuelles' ? 'selected' : ''}}>6 vitesses Manuelles</option>
                                    <option value="6 vitesses automatique" {{$voiture->transmission == '6 vitesses automatique' ? 'selected' : ''}}>6 vitesses Automatique</option>
                                    <option value="7 vitesses manuelles" {{$voiture->transmission == '7 vitesses manuelles' ? 'selected' : ''}}>7 vitesses Manuelles</option>
                                    <option value="7 vitesses automatique" {{$voiture->transmission == '7 vitesses automatique' ? 'selected' : ''}}>7 vitesses Automatique</option>
                                    <option value="8 vitesses manuelles" {{$voiture->transmission == '8 vitesses manuelles' ? 'selected' : ''}}>8 vitesses Manuelles</option>
                                    <option value="8 vitesses automatique" {{$voiture->transmission == '8 vitesses automatique' ? 'selected' : ''}}>8 vitesses Automatique</option>
                                </select>
                            </div>
                            {{-- Carburant --}}
                            <div class="col-md-6">
                                <label>Carburant</label>
                                <select name="carburant" class="form-control selectpicker">
                                    <option value="essence" {{$voiture->carburant == 'essence' ? 'selected' : ''}}>Essence</option>
                                    <option value="diesel" {{$voiture->carburant == 'diesel' ? 'selected' : ''}}>Diesel</option>
                                    <option value="electricite" {{$voiture->carburant == 'electricite' ? 'selected' : ''}}>Électricité </option>
                                </select>
                            </div>
                            {{-- Couleur --}}
                            <div class="col-md-6">
                                <label>Couleur</label>
                                <select name="couleur" class="form-control selectpicker">
                                    <option value="noir" {{$voiture->couleur == 'noir' ? 'selected' : ''}}>Noir</option>
                                    <option value="rouge" {{$voiture->couleur == 'rouge' ? 'selected' : ''}}>Rouge</option>
                                    <option value="blanc" {{$voiture->couleur == 'blanc' ? 'selected' : ''}}>Blanc</option>
                                    <option value="jaune" {{$voiture->couleur == 'jaune' ? 'selected' : ''}}>Jaune</option>
                                    <option value="marron" {{$voiture->couleur == 'marron' ? 'selected' : ''}}>Marron</option>
                                    <option value="gris" {{$voiture->couleur == 'gris' ? 'selected' : ''}}>Gris</option>
                                    <option value="argent" {{$voiture->couleur == 'argent' ? 'selected' : ''}}>Argent</option>
                                    <option value="or" {{$voiture->couleur == 'or' ? 'selected' : ''}}>Or</option>
                                </select>
                            </div>
                            {{-- nombre_portes --}}
                            <div class="col-md-6">
                                <label>Nombre de portes </label>
                                <input type="number" min="0" value="{{$voiture->nombre_portes}}" name="nombre_portes"  class="form-control">
                            </div>
                            {{-- nombre_places --}}
                            <div class="col-md-6">
                                <label>Nombre de places (km)</label>
                                <input type="number" min="0" value="{{$voiture->nombre_places}}" name="nombre_places"  class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- specifications_moteur  --}}
                <div class="accordion-group" id="specifications_moteur">
                    <div class="accordion-heading togglize"> <a class="accordion-toggle " data-toggle="collapse" data-parent="#" href="#collapseTree">Spécifications de moteur<i class="fa fa-angle-down"></i> </a> </div>
                    <div id="collapseTree" class="accordion-body collapse">
                        <div class="row">
                            
                            @foreach (json_decode($voiture->specifications_moteur) as $key=>$value)
                                <div class="col-md-6">
                                    <label>{{$key}}</label>
                                    <input type="text" name="specifications_moteur[{{$key}}]" value="{{$value}}"  class="form-control">
                                </div>
                            @endforeach
                        
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
                            @foreach (json_decode($voiture->specifications_exterieures) as $key=>$value)
                                <div class="col-md-6">
                                    <label>{{$key}}</label>
                                    <input type="text" name="specifications_exterieures[{{$key}}]" value="{{$value}}"  class="form-control">
                                </div>
                            @endforeach
                            
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
                            @foreach (json_decode($voiture->specifications_interieures) as $key=>$value)
                                <div class="col-md-6">
                                    <label>{{$key}}</label>
                                    <input type="text" name="specifications_interieures[{{$key}}]" value="{{$value}}"  class="form-control">
                                </div>
                            @endforeach
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
                            @foreach (json_decode($voiture->specifications_capacites) as $key=>$value)
                                <div class="col-md-6">
                                    <label>{{$key}}</label>
                                    <input type="text" name="specifications_capacites[{{$key}}]" value="{{$value}}"  class="form-control">
                                </div>
                            @endforeach
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
                            @foreach (json_decode($voiture->options_additionnelles) as $value)
                                <li class="checkbox"><label><input type="checkbox" name="options_additionnelles[]" value="{{$value}}" checked>{{$value}}</label></li>
                            @endforeach
                            
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
                        <div class="alert alert-info fade in"> <a class="close" data-dismiss="alert">&times;</a> lorsque les images sont téléchargées, les anciennes images seront remplacées. </div>
                        <div class="row">
                            {{-- Image Principale --}}
                            <div class="imgs_section">
                                <h5>Image Principale</h5>
                                <div class="images">
                                    @foreach ($voiture->images as $image)
                                        @if($image->main)
                                        <div>
                                            <img src="{{'/images/'.$image->path}}" alt="" srcset="">
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div>
                                    <label>Le remplacement de l'image Principale</label>
                                    <input type="file" name="main_image" class="form-control">
                                </div>
                            </div>
                            
                            {{-- Autres images --}}
                            <div class="imgs_section">
                                <h5>Autres images</h5>
                                <div class="images">
                                    @foreach ($voiture->images as $image)
                                        @if(!$image->main)
                                            <img src="{{'/images/'.$image->path}}" alt="" srcset="">
                                        @endif
                                    @endforeach
                                </div>
                                <div>
                                    <label>Les remplacements des autres images</label>
                                    <input type="file"  name="images[]" multiple class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <button style="margin: 20px 0;" type="submit" class="btn btn-info pull-right">Save</button>
            

        </form>
        
    </div>

@endsection

@section('scripts')
    <script src="{{asset('assets/js/dashboard/cree_voiture.js')}}"></script>
@endsection
