
@extends('layouts.dashboard')

@section('title','dashboard - Voitures archivées')

@section('header')
    <link href="{{asset('assets/css/dashboard/dashboard.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @if ($errors->any())
        <div class="col-md-9 col-sm-8">
            <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert" href="#">&times;</a> <strong>Oh snap!</strong> {{ $errors->first() }} </div>
        </div>
    @else
        {{-- alert messages container --}}
        <div class="col-md-9 col-sm-8" id="alerts_container">
        </div>

        <div class="col-md-9 col-sm-8 search-form-container">
            <a href="#" class="search-trigger"><i class="fa fa-search"></i></a>
            <!-- Search Form -->
            <div class="search-form">
                <div class="search-form-inner">
                    <form>
                        <h4>Chercher</h4>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    {{-- type --}}
                                    <div class="col-md-6">
                                        <label>Type</label>
                                        <select name="type" class="form-control selectpicker">
                                            <option selected value="">Tout</option>
                                            <option value="sedan" {{ request()->type === 'sedan' ? 'selected' : '' }}>Sedan</option> {{-- Sedan--}}
                                            <option value="suv" {{ request()->type === 'suv' ? 'selected' : '' }}>SUV</option> {{-- SUV--}}
                                            <option value="coupe" {{ request()->type === 'coupe' ? 'selected' : '' }}>Coupé </option> {{-- Coupe--}}
                                            <option value="crossover" {{ request()->type === 'crossover' ? 'selected' : '' }}>Crossover</option> {{-- Crossover--}}
                                            <option value="break" {{ request()->type === 'break' ? 'selected' : '' }}>Break </option> {{-- wagon--}}
                                            <option value="van" {{ request()->type === 'van' ? 'selected' : '' }}>Van</option> {{-- Van--}}
                                            <option value="citadine" {{ request()->type === 'citadine' ? 'selected' : '' }}>Citadine</option> {{-- Minicar--}}
                                            <option value="monospace" {{ request()->type === 'monospace' ? 'selected' : '' }}>Monospace </option> {{-- Minivan--}}
                                        </select>
                                    </div>
                                    {{-- Transmission --}}
                                    <div class="col-md-6">
                                        <label>Transmission</label>
                                        <select value="{{request()->transmission}}" name="transmission" class="form-control selectpicker">
                                            <option value="" {{ request()->transmission === '' ? 'selected' : '' }}>Tout</option>
                                            <option value="5 vitesses manuelles" {{ request()->transmission === '5 vitesses manuelles' ? 'selected' : '' }}>5 vitesses Manuelles</option>
                                            <option value="5 vitesses automatique" {{ request()->transmission === '5 vitesses automatique' ? 'selected' : '' }}>5 vitesses Automatique</option>
                                            <option value="6 vitesses manuelles" {{ request()->transmission === '6 vitesses manuelles' ? 'selected' : '' }}>6 vitesses Manuelles</option>
                                            <option value="6 vitesses automatique" {{ request()->transmission === '6 vitesses automatique' ? 'selected' : '' }}>6 vitesses Automatique</option>
                                            <option value="7 vitesses manuelles" {{ request()->transmission === '7 vitesses manuelles' ? 'selected' : '' }}>7 vitesses Manuelles</option>
                                            <option value="7 vitesses automatique" {{ request()->transmission === '7 vitesses automatique' ? 'selected' : '' }}>7 vitesses Automatique</option>
                                            <option value="8 vitesses manuelles" {{ request()->transmission === '8 vitesses manuelles' ? 'selected' : '' }}>8 vitesses Manuelles</option>
                                            <option value="8 vitesses automatique" {{ request()->transmission === '8 vitesses automatique' ? 'selected' : '' }}>8 vitesses Automatique</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- Marque --}}
                                    <div class="col-md-6">
                                        <label>Marque </label>
                                        <input type="text" name="marque" value="{{request()->marque}}" class="form-control">
                                            
                                    </div>
                                    {{-- Modèle --}}
                                    <div class="col-md-6">
                                        <label>Modèle </label>
                                        <input type="text" name="model" value="{{request()->model}}" class="form-control selectpicker">
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- Prix Min --}}
                                    <div class="col-md-6">
                                        <label >Prix Min</label>
                                        <select name="prix_min" class="form-control">
                                            <option selected value="">Tout</option>
                                            @for ($i = 10000; $i <= 500000; $i+=10000)
                                                <option value="{{$i}}" {{ request()->prix_min == $i ? 'selected' : '' }}>{{$i}}€</option>
                                            @endfor
                                        </select>
                                    </div>
                                    {{-- Prix Max --}}
                                    <div class="col-md-6">
                                        <label >Prix Max</label>
                                        <select name="prix_max" class="form-control">
                                            <option selected value="">Tout</option>
                                            @for ($i = 10000; $i <= 500000; $i+=10000)
                                                <option value="{{$i}}" {{ request()->prix_max == $i ? 'selected' : '' }}>{{$i}}€</option>
                                            @endfor
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- etat --}}
                                    <div class="col-md-12">
                                        <label class="checkbox-inline">
                                            <input type="radio" name="etat" checked value=""> Tout
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="radio" name="etat" value="neuf" {{ request()->etat === 'neuf' ? 'checked' : '' }}> seulement Neuf
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="radio" name="etat" value="occasion" {{ request()->etat === 'occasion' ? 'checked' : '' }}> seulement Occasion
                                        </label>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="row">
                                    {{-- Année Min --}}
                                    <div class="col-md-6">
                                        <label>Année Min </label>
                                        <select name="annee_min" class="form-control" value="{{request()->annee_min}}">
                                            <option selected value="">Tout</option>
                                            @for ($i = 2000; $i <= (int) date("Y"); $i++)
                                                <option value="{{$i}}" {{ request()->annee_min == $i ? 'selected' : '' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                        
                                    </div>
                                    {{-- Année Max --}}
                                    <div class="col-md-6">
                                        <label>Année Max </label>
                                        <select name="annee_max" class="form-control" value="{{request()->annee_max}}">
                                            <option selected value="">Tout</option>
                                            @for ($i = 2000; $i <= (int) date("Y"); $i++)
                                                <option value="{{$i}}" {{ request()->annee_max == $i ? 'selected' : '' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- kilométrage Min --}}
                                    <div class="col-md-6">
                                        <label>kilométrage Min </label>
                                        <select name="kilometrage_min" class="form-control"ç>
                                            <option selected value="">Tout</option>
                                            @for ($i = 0; $i <= 500000; $i+=10000)
                                                <option value="{{$i}}" {{ request()->kilometrage_min == $i ? 'selected' : '' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    {{-- kilométrage Max --}}
                                    <div class="col-md-6">
                                        <label>kilométrage Max</label>
                                        <select name="kilometrage_max" class="form-control"ç>
                                            <option selected value="">Tout</option>
                                            @for ($i = 10000; $i <= 500000; $i+=10000)
                                                <option value="{{$i}}" {{ request()->kilometrage_max == $i ? 'selected' : '' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- Couleur --}}
                                    <div class="col-md-6">
                                        <label>Couleur</label>
                                        <select name="couleur" class="form-control selectpicker">
                                            <option selected value="">Tout</option>
                                            <option value="rouge" {{ request()->couleur === 'rouge' ? 'selected' : '' }}>Rouge</option>
                                            <option value="noir" {{ request()->couleur === 'noir' ? 'selected' : '' }}>Noir</option>
                                            <option value="blanc" {{ request()->couleur === 'blanc' ? 'selected' : '' }}>Blanc</option>
                                            <option value="jaune" {{ request()->couleur === 'jaune' ? 'selected' : '' }}>Jaune</option>
                                            <option value="marron" {{ request()->couleur === 'marron' ? 'selected' : '' }}>Marron</option>
                                            <option value="gris" {{ request()->couleur === 'gris' ? 'selected' : '' }}>Gris</option>
                                            <option value="argent" {{ request()->couleur === 'argent' ? 'selected' : '' }}>Argent</option>
                                            <option value="or" {{ request()->couleur === 'or' ? 'selected' : '' }}>Or</option>
                                        </select>
                                    </div>
                                    {{-- Carburant --}}
                                    <div class="col-md-6">
                                        <label>Carburant</label>
                                        <select name="carburant" class="form-control selectpicker">
                                            <option selected value="">Tout</option>
                                            <option value="essence" {{ request()->carburant === 'essence' ? 'selected' : '' }}>Essence</option>
                                            <option value="diesel" {{ request()->carburant === 'diesel' ? 'selected' : '' }}>Diesel</option>
                                            <option value="electricite" {{ request()->carburant === 'electricite' ? 'selected' : '' }}>Électricité </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a>
                                            <button type="submit" class="btn btn-block btn-info btn-lg" >Trouvez</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-8">
            <h3><strong>Voitures archivées</strong></h3>
            <div class="dashboard-block">
                <div class="table-responsive">
                    <table class="table table-bordered dashboard-tables saved-cars-table">
                        <thead>
                            <tr>
                                <td>&nbsp;</td>
                                <td>ID</td>
                                <td>Informations Genarals</td>
                                <td>Prix/État</td>
                                <td>Timestamp</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($voitures as $voiture)
                                <tr id="{{'table_row_'.$voiture->id}}">
                                    <td valign="middle"><input type="checkbox" value="{{$voiture->id}}" name="ids[]"></td>
                                    {{-- id --}}
                                    <td valign="middle">{{$voiture->id}}</td>
                                    {{-- info general --}}
                                    <td>
                                        <!-- Result -->
                                        <a href="#" class="car-image"><img src="{{'/images/'.$voiture->images[0]->path}}" alt=""></a>
                                        <div class="search-find-results">
                                            <h5><a href="vehicle-details.html">{{$voiture->titre}}</a></h5>
                                            <ul class="inline">
                                                <li>{{$voiture->type}}, {{$voiture->nombre_places}} place</li>
                                                <li>{{$voiture->transmission}}</li>
                                                <li>{{$voiture->kilometrage}}km</li>
                                                <li>{{$voiture->carburant}}</li>
                                                <li>{{$voiture->couleur}}</li>
                                            </ul>
                                        </div>
                                    </td>
                                    {{-- prix/etat --}}
                                    <td>
                                        <div class="price">{{$voiture->prix}}€</div> 
                                        <div class="{{$voiture->etat === 'neuf' ? 'label-success' : 'label-primary'}} label">{{$voiture->etat}}</div>
                                    </td>
                                    {{-- timestamps --}}
                                    <td>
                                        <div class="text-success">crée à {{$voiture->created_at}}</div> 
                                        <div class="text-success">modifié à {{$voiture->updated_at}}</div> 
                                        <div class="text-success">archivée à {{$voiture->deleted_at}}</div>
                                    </td>
                                    {{-- actions buttons --}}
                                    <td align="center">
                                        
                                        {{-- rebublish btn --}}
                                        <a data-toggle="modal" data-target="{{'#restoreModal_'.$voiture->id}}" class="btn action-btn restore">Republier</a>
                                        {{-- rebublish modal --}}
                                        <div class="modal fade" id="{{'restoreModal_'.$voiture->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="text-center">Confirmer la republication de:</h4>
                                                        <h5 class="text-center">{{$voiture->titre}}</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <button type="button" data-id="{{$voiture->id}}" data-toggle-modal="{{'#restoreModal_'.$voiture->id}}"  class="btn action-btn restore">Confirmer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- update btn --}}
                                        <a type="button" href="{{route('dashboard.voitures.edit', ['voiture'=>$voiture->id])}}" class="btn action-btn update">Modifier</a>

                                        {{-- delete btn --}}
                                        <a data-toggle="modal" data-target="{{'#deleteModal_'.$voiture->id}}" class="btn action-btn delete">Supprimer</a>
                                        
                                        {{-- delete modal --}}
                                        <div class="modal fade" id="{{'deleteModal_'.$voiture->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="text-center">Confirmer la suppression de:</h4>
                                                        <h5 class="text-center">{{$voiture->titre}}</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <button type="button" data-id="{{$voiture->id}}" data-toggle-modal="{{'#deleteModal_'.$voiture->id}}" class="btn action-btn delete">Confirmer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <a role="button" data-toggle="modal" data-target="#bulkRestoreModal" class="btn btn-success btn-sm" >Rebublier la sélection</a>
                {{-- bulk restore modal --}}
                <div class="modal fade" id="bulkRestoreModal" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4  class="text-center">Confirmer la republication des voiture selectionées</h4>
                            </div>
                            <div class="modal-body">
                                <button type="button" id="bulk_restore" data-toggle-modal="#bulkRestoreModal" class="btn action-btn bulk_restore">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a role="button" data-toggle="modal" data-target="#bulkDeleteModal" class="btn btn-danger btn-sm" >Supprimer la sélection</a>
                {{-- bulk delete modal --}}
                <div class="modal fade" id="bulkDeleteModal" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="text-center">Confirmer la suppression des voiture selectionées</h4>
                            </div>
                            <div class="modal-body">
                                <button type="button" id="bulk_delete" data-toggle-modal="bulkDeleteModal" class="btn action-btn bulk_delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pagination_container">
                {{$voitures->onEachSide(5)->links()}}
            </div>
        </div>
    @endif
@endsection


@section('scripts')
    <script src="{{asset('assets/js/dashboard/voitures_crud.js')}}" ></script>
@endsection









































































