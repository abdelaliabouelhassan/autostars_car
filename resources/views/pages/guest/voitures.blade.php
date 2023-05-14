@extends('layouts.guest')

@section('title','Autostars - Voitures')

@section('header')
    <link href="{{asset('assets/css/guest/voitures.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <!-- Start Page header -->
    <div class="page-header parallax" style="background-image:url(/assets/images/voitures_page/voitures_page_heading.jpg);">
    	<div class="container">
        	<h1 class="page-title"><strong>Voitures</strong></h1>
       	</div>
    </div>
    <!-- Utiity Bar -->
    <div class="utility-bar">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-8 col-sm-6 col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="{{route('accueil',request()->query())}}">Accueil</a></li>
                        <li class="active"><a href="{{route('voitures.index')}}">Voitures</a></li>
                    </ol>
            	</div>
                <div class="col-md-4 col-sm-6 col-xs-4">
                </div>
            </div>
      	</div>
    </div>
    <!-- Actions bar -->
    <div class="actions-bar tsticky">
     	<div class="container">
        	<div class="row">
            	<div class=" search-actions"></div>
                <div class="col-md-12 col-sm-12">
                    <div class="btn-group pull-right results-sorter">
                        <button type="button" class="btn btn-default listing-sort-btn">Ordre</button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                          	<li><a href="{{request()->fullUrlWithQuery(['ordre' => 'prix_asc'])}}">prix (croissant)</a></li>
                          	<li><a href="{{request()->fullUrlWithQuery(['ordre' => 'prix_desc'])}}">prix (décroissant)</a></li>
                          	<li><a href="{{request()->fullUrlWithQuery(['ordre' => 'kilometrage_asc'])}}">kilométrage (croissant)</a></li>
                          	<li><a href="{{request()->fullUrlWithQuery(['ordre' => 'kilometrage_desc'])}}">kilométrage (kilométrage)</a></li>
                        </ul>
                  	</div>



                    <div class="toggle-view view-format-choice pull-right">
                        <label>View</label>
                        <div class="btn-group">
                            <a href="#" class="btn btn-default active" id="results-list-view"><i class="fa fa-th-list"></i></a>
                            <a href="#" class="btn btn-default" id="results-grid-view"><i class="fa fa-th"></i></a>
                        </div>
                    </div>
                    <!-- Small Screens Filters Toggle Button -->
                    <button class="btn btn-default visible-xs" id="Show-Filters">Search Filters</button>
                </div>
            </div>
      	</div>
    </div>
    {{-- warnings --}}
    
    
    <!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
        	<div class="container">
            	<div class="row">
                    
                    <!-- Search Filters -->
                    <div class="col-md-3 search-filters" id="Search-Filters">
                    	<form action="{{route('voitures.index')}}" class="tbsticky filters-sidebar">
                            <h3>Filtrage</h3>
                            <div class="accordion" id="toggleArea">
                                <!-- Filter by Year -->
                                <div class="accordion-group panel">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseOne">Année<i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseOne" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <div class="form-inline">
  												<div class="form-group">
                                                    <label>Année Min </label>
                                                    <select name="annee_min" class="form-control" value="{{request()->annee_min}}">
                                                        <option value="" {{ request()->annee_min === '' ? 'selected' : '' }}>Tout</option>
                                                        @for ($i = 2000; $i <= (int) date("Y"); $i++)
                                                            <option value="{{$i}}" {{ request()->annee_min == $i ? 'selected' : '' }}>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group last-child">
                                                    <label>Année Max</label>
                                                    <select name="annee_max" class="form-control">
                                                        <option value="" {{ request()->annee_max === '' ? 'selected' : '' }}>Tout</option>
                                                        @for ($i = 2000; $i <= (int) date("Y"); $i++)
                                                            <option value="{{$i}}" {{ request()->annee_max == $i ? 'selected' : '' }}>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Filter by status -->
                                <div class="accordion-group panel">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseNine">Etat<i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseNine" class="accordion-body collapse">
                                        <div class="accordion-inner check_box_list">
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="etat_array[]" class="form" value="neuf" 
                                                    @if(in_array('neuf', request()->input('etat_array', []))) checked @endif
                                                    {{ request()->etat == 'neuf' ? 'checked' : '' }}>
                                                <label>Neuf</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="etat_array[]" class="form" value="occasion"
                                                @if(in_array('occasion', request()->input('etat_array', []))) checked @endif
                                                {{ request()->etat == 'occasion' ? 'checked' : '' }}>
                                                <label>Occasion</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Filter by Make -->
                                <div class="accordion-group panel">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseTwo">Marque<i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseTwo" class="accordion-body collapse">
                                        <div class="accordion-inner check_box_list">
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="renault" @if(in_array('renault', request()->input('marque_array', []))) checked @endif>
                                                <label>Renault</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="peugeot" @if(in_array('peugeot', request()->input('marque_array', []))) checked @endif>
                                                <label>Peugeot</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="citroen" @if(in_array('citroen', request()->input('marque_array', []))) checked @endif>
                                                <label>Citroen</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="volkswagen" @if(in_array('volkswagen', request()->input('marque_array', []))) checked @endif>
                                                <label>Volkswagen</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="mercedes" @if(in_array('mercedes', request()->input('marque_array', []))) checked @endif>
                                                <label>Mercedes</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="ford" @if(in_array('ford', request()->input('marque_array', []))) checked @endif>
                                                <label>Ford</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="nissan" @if(in_array('nissan', request()->input('marque_array', []))) checked @endif>
                                                <label>Nissan</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="fiat" @if(in_array('fiat', request()->input('marque_array', []))) checked @endif>
                                                <label>Fiat</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="toyota" @if(in_array('toyota', request()->input('marque_array', []))) checked @endif>
                                                <label>Toyota</label>
                                            </div>

                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="opel" @if(in_array('opel', request()->input('marque_array', []))) checked @endif>
                                                <label>Opel</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="marque_array[]" class="form" value="bmw" @if(in_array('bmw', request()->input('marque_array', []))) checked @endif>
                                                <label>BMW</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Filter by Body Type -->
                                <div class="accordion-group">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseFour">Type <i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseFour" class="accordion-body collapse">
                                        <div class="accordion-inner check_box_list">
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="type_array[]" class="form" value="sedan" @if(in_array('sedan', request()->input('type_array', []))) checked @endif>
                                                <label>Sedan</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="type_array[]" class="form" value="suv" @if(in_array('suv', request()->input('type_array', []))) checked @endif>
                                                <label>SUV</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="type_array[]" class="form" value="crossover" @if(in_array('crossover', request()->input('type_array', []))) checked @endif>
                                                <label>Crossover</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="type_array[]" class="form" value="citadine" @if(in_array('citadine', request()->input('type_array', []))) checked @endif>
                                                <label>Citadine</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="type_array[]" class="form" value="coupe" @if(in_array('coupe', request()->input('type_array', []))) checked @endif>
                                                <label>Coupé</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="type_array[]" class="form" value="break" @if(in_array('break', request()->input('type_array', []))) checked @endif>
                                                <label>Break</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="type_array[]" class="form" value="van" @if(in_array('van', request()->input('type_array', []))) checked @endif>
                                                <label>Van</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="type_array[]" class="form" value="monospace" @if(in_array('monospace', request()->input('type_array', []))) checked @endif>
                                                <label>Monospace</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Filter by Fuel -->
                                <div class="accordion-group">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseEleven">Carburant <i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseEleven" class="accordion-body collapse">
                                        <div class="accordion-inner check_box_list">
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="carburant_array[]" class="form" value="essence" @if(in_array('essence', request()->input('carburant_array', []))) checked @endif>
                                                <label>Essence</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="carburant_array[]" class="form" value="diesel" @if(in_array('diesel', request()->input('carburant_array', []))) checked @endif>
                                                <label>Diesel</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="carburant_array[]" class="form" value="electricite" @if(in_array('electricite', request()->input('carburant_array', []))) checked @endif>
                                                <label>Electricite</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Filter by Mileage -->
                                <div class="accordion-group">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseFive">kilométrage <i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseFive" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <div class="form-inline">
  												<div class="form-group">
                                                    <label>kilométrage Min </label>
                                                    <select name="kilometrage_min" class="form-control"ç>
                                                        <option selected value="">Tout</option>
                                                        @for ($i = 10000; $i <= 500000; $i+=10000)
                                                            <option value="{{$i}}" {{ request()->kilometrage_min == $i ? 'selected' : '' }}>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group last-child">
                                                    <label>kilométrage Max</label>
                                                    <select name="kilometrage_max" class="form-control"ç>
                                                        <option selected value="">Tout</option>
                                                        @for ($i = 10000; $i <= 500000; $i+=10000)
                                                            <option value="{{$i}}" {{ request()->kilometrage_max == $i ? 'selected' : '' }}>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Filter by Transmission -->
                                <div class="accordion-group">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseSix">Transmission <i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseSix" class="accordion-body collapse">
                                        <div class="accordion-inner check_box_list">
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="transmission_array[]" class="form" value="5 vitesses manuelles" @if(in_array('5 vitesses manuelles', request()->input('transmission_array', []))) checked @endif>
                                                <label>5 vitesses manuelles</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="transmission_array[]" class="form" value="5 vitesses automatique" @if(in_array('5 vitesses automatique', request()->input('transmission_array', []))) checked @endif>
                                                <label>5 vitesses automatique</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="transmission_array[]" class="form" value="6 vitesses manuelles" @if(in_array('6 vitesses manuelles', request()->input('transmission_array', []))) checked @endif>
                                                <label>6 vitesses manuelles</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="transmission_array[]" class="form" value="6 vitesses automatique" @if(in_array('6 vitesses automatique', request()->input('transmission_array', []))) checked @endif>
                                                <label>6 vitesses automatique</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="transmission_array[]" class="form" value="7 vitesses manuelles" @if(in_array('7 vitesses manuelles', request()->input('transmission_array', []))) checked @endif>
                                                <label>7 vitesses manuelles</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="transmission_array[]" class="form" value="7 vitesses automatique" @if(in_array('7 vitesses automatique', request()->input('transmission_array', []))) checked @endif>
                                                <label>7 vitesses automatique</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="transmission_array[]" class="form" value="8 vitesses manuelles" @if(in_array('8 vitesses manuelles', request()->input('transmission_array', []))) checked @endif>
                                                <label>8 vitesses manuelles</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="transmission_array[]" class="form" value="8 vitesses automatique" @if(in_array('8 vitesses automatique', request()->input('transmission_array', []))) checked @endif>
                                                <label>8 vitesses automatic</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter by Price -->
                                <div class="accordion-group">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseEight">Prix <i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseEight" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <div class="form-inline">
  												<div class="form-group">
                                                    <label >Prix Min</label>
                                                    <select name="prix_min" class="form-control">
                                                        <option value="" {{ request()->prix_min === '' ? 'selected' : '' }}>Tout</option>
                                                        @for ($i = 10000; $i <= 500000; $i+=10000)
                                                            <option value="{{$i}}" {{ request()->prix_min == $i ? 'selected' : '' }}>{{$i}}€</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group last-child">
                                                    <label >Prix Max</label>
                                                    <select name="prix_max" class="form-control">
                                                        <option value="" {{ request()->prix_max === '' ? 'selected' : '' }}>Tout</option>
                                                        @for ($i = 10000; $i <= 500000; $i+=10000)
                                                            <option value="{{$i}}" {{ request()->prix_max == $i ? 'selected' : '' }}>{{$i}}€</option>
                                                        @endfor
                                                    </select>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter by Color -->
                                <div class="accordion-group">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseTen">Couleur <i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseTen" class="accordion-body collapse">
                                        <div class="accordion-inner check_box_list">
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="couleur_array[]" class="form" value="rouge" @if(in_array('rouge', request()->input('couleur_array', []))) checked @endif>
                                                <label>rouge</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="couleur_array[]" class="form" value="noir" @if(in_array('noir', request()->input('couleur_array', []))) checked @endif>
                                                <label>noir</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="couleur_array[]" class="form" value="blanc" @if(in_array('blanc', request()->input('couleur_array', []))) checked @endif>
                                                <label>blanc</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="couleur_array[]" class="form" value="jaune" @if(in_array('jaune', request()->input('couleur_array', []))) checked @endif>
                                                <label>jaune</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="couleur_array[]" class="form" value="marron" @if(in_array('marron', request()->input('couleur_array', []))) checked @endif>
                                                <label>marron</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="couleur_array[]" class="form" value="gris" @if(in_array('gris', request()->input('couleur_array', []))) checked @endif>
                                                <label>gris</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="couleur_array[]" class="form" value="argent">
                                                <label>argent</label>
                                            </div>
                                            <div class="check_box_item" >
                                                <input type="checkbox" name="couleur_array[]" class="form" value="or">
                                                <label>or</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Toggle -->
                            <button type="submit" class="btn-primary btn-sm btn">Filtrer</a>
                        </form>
                    </div>
                    
                    <!-- Listing Results -->
                    <div class="col-md-9 results-container">
                        @if ($errors->any())
                            <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert" href="#">&times;</a> <strong>Oh snap!</strong> {{ $errors->first() }} </div>
                        @else
                            <div class="results-container-in">
                                <div class="waiting" style="display:none;">
                                    <div class="spinner">
                                        <div class="rect1"></div>
                                        <div class="rect2"></div>
                                        <div class="rect3"></div>
                                        <div class="rect4"></div>
                                        <div class="rect5"></div>
                                    </div>
                                </div>
                                <div id="results-holder" class="results-list-view">
                                    @foreach ($voitures as $voiture)
                                        <!-- Result Item -->
                                        <div class="result-item format-standard">
                                            <div class="result-item-image">
                                                <a href="{{route('voitures.show',['voiture'=>$voiture->id])}}" class="media-box" ><img src="{{'images/'.$voiture->images[0]->path}}" alt=""></a>
                                                <span class="label label-default vehicle-age">{{$voiture->annee}}</span>
                                                <span class="label premium-listing {{$voiture->etat === 'neuf' ? 'label-success' : 'label-primary'}}">{{$voiture->etat}}</span>

                                                <div class="result-item-view-buttons">
                                                    <a href="{{route('voitures.show',['voiture'=>$voiture->id])}}" style="width: 100%; height:100%;"><i class="fa fa-plus"></i> View details</a>
                                                </div>
                                            </div>
                                            <div class="result-item-in">
                                                <h4 class="result-item-title"><a href="{{route('voitures.show',['voiture'=>$voiture->id])}}">{{$voiture->titre}}</a></h4>
                                                <div class="result-item-cont">
                                                    <div class="result-item-block col1" >
                                                        <p class="block-with-text" >{{$voiture->description}}</p>
                                                        
                                                    </div>
                                                    <div class="result-item-block col2">
                                                        <div class="result-item-pricing">
                                                            <div class="price">{{$voiture->prix}}€</div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="result-item-features">
                                                    <ul class="inline">
                                                        <li>{{$voiture->type}}</li>
                                                        <li>{{$voiture->nombre_places}} place</li>
                                                        <li>{{$voiture->nombre_portes}} porte</li>
                                                        <li>{{$voiture->transmission}}</li>
                                                        <li>{{$voiture->kilometrage}}km</li>
                                                        <li>{{$voiture->carburant}}</li>
                                                        <li>{{$voiture->couleur}}</li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            <div class="pagination_container">
                                {{$voitures->onEachSide(5)->links()}}
                            </div>
                        @endif
                    </div>
               	</div>
            </div>
        </div>
   	</div>
    <!-- End Body Content -->


@endsection