@extends('layouts.guest')

@section('title','Autostars - Accueil')

@section('header')
    <link href="{{asset('assets/css/guest/home.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
{{-- hero section --}}
<div class="hero-area">
    <!-- Start Hero Carousel -->
    <ul class="owl-carousel carousel-alt" data-columns="1" data-autoplay="" data-pagination="no" data-arrows="yes" data-single-item="no" data-items-desktop="1" data-items-desktop-small="1" data-items-mobile="1" data-items-tablet="1">
        {{-- <li class="item" > <img  src="{{Vite::asset('resources/assets/images/home/carousel_car.jpg')}}" alt=""></li> --}}
        <li class="item item1" >
            <h1>Trouvez la voiture idéale pour vous</h1> 
        </li>
           
        <li class="item item2" >
            <h1>Déverrouillez votre voiture de rêve aujourd'hui</h1> 
        </li>
    </ul>
    <!-- End Hero Carousel -->
</div>

<!-- Search Form -->
<div class="search-form">
    <div class="search-form-inner">
        <form action="{{route('voitures.index')}}" class="container">
            <h3>Find a Car with our Quick Search</h3>
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

<!-- Start Body Content -->
<div class="main" role="main">
    <div id="content" class="content full padding-b0">

        <div class="container">
            <!-- Welcome Content and Services overview -->
            <div class="row">
                <div class="col-md-6">
                    <h1 class="uppercase strong">BIENVENUE CHEZ AUTOSTARS<br>GARAGE</h1>
                    <p class="lead">Trouvez la voiture de vos rêves chez Autostars Concessionnaire. Nous proposons une large sélection de véhicules de haute qualité pour répondre à tous les besoins et budgets.</p>
                </div>
                <div class="col-md-6">
                    <p>Au Garage Autostars, notre objectif est de fournir une expérience d'achat exceptionnelle à tous nos clients. Notre équipe de vente professionnelle est là pour vous aider à trouver la voiture parfaite qui correspond à vos besoins, à votre budget et à votre style de vie. Nous sommes fiers de notre réputation de qualité et d'excellence dans le domaine de la vente de voitures.</p>
                    <p>Chez Autostars, nous croyons en la transparence et l'honnêteté dans toutes nos transactions. Nous sommes impatients de vous aider à trouver la voiture de vos rêves, que ce soit une petite citadine ou une voiture de luxe. Venez nous rendre visite et découvrez pourquoi Autostars est le garage de confiance pour l'achat de votre prochaine voiture.</p>
                </div>
            </div>
            <div class="spacer-75"></div>

            
            <!-- Recently Listed Vehicles -->
            
            @if ($errors->any())
                <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert" href="#">&times;</a> <strong>Oh snap!</strong> {{ $errors->first() }} </div>
            @else
                <section class="listing-block recent-vehicles">
                    <div class="listing-header">
                        <h3>Voitures de Nouveautés</h3>
                    </div>
                    <div class="listing-container">
                        <div class="carousel-wrapper">
                            <div class="row">
                                <ul class="owl-carousel carousel-fw" id="vehicle-slider" data-columns="4" data-autoplay="" data-pagination="yes" data-arrows="no" data-single-item="no" data-items-desktop="4" data-items-desktop-small="3" data-items-tablet="2" data-items-mobile="1">
                                    @foreach ($voitures as $voiture)
                                        {{-- recently-listed-item --}}
                                        <li class="item">
                                            <div class="vehicle-block format-standard">
                                                <a href="{{route('voitures.show',['voiture'=>$voiture->id])}}" class="media-box"><img src="{{'images/'.$voiture->images[0]->path}}" alt=""></a>
                                                <div class="vehicle-block-content">
                                                    <span class="label label-default vehicle-age">{{$voiture->annee}}</span>
                                                    <span class="label premium-listing {{$voiture->etat === 'neuf' ? 'label-success' : 'label-primary'}}">{{$voiture->etat}}</span>
                                                    <h5 class="vehicle-title"><a href="{{route('voitures.show',['voiture'=>$voiture->id])}}">{{$voiture->titre}}</a></h5>
                                                    <span class="vehicle-meta">{{$voiture->marque}}, <span class="vehicle-type">{{$voiture->type}}</span> , Couleur {{$voiture->couleur}}</span>
                                                    <span class="vehicle-cost">{{$voiture->prix}}€</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            
        </div>
        <div class="spacer-50"></div>
        <!-- Search by make -->
        <div  class="lgray-bg make-slider">
            <div class="container">
                
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <h3>Recherche par marque </h3>
                        <a href="{{route('voitures.index')}}" class="btn btn-default btn-lg">Toutes marques</a>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <div class="row">
                            <ul class="owl-carousel" id="make-carousel" data-columns="5" data-autoplay="6000" data-pagination="no" data-arrows="no" data-single-item="no" data-items-desktop="5" data-items-desktop-small="4" data-items-tablet="3" data-items-mobile="3">
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'renault'])}}"><img src="{{asset('assets/images/home/renault_logo.png')}}" alt="renault_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'peugeot'])}}"><img src="{{asset('assets/images/home/peugeot_logo.png')}}" alt=""></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'volkswagen'])}}"><img src="{{asset('assets/images/home/volkswagen_logo.png')}}" alt="volkswagen_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'mercedes'])}}"><img src="{{asset('assets/images/home/mercedes_logo.png')}}" alt="mercedes_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'fiat'])}}"><img src="{{asset('assets/images/home/fiat_logo.png')}}" alt="fiat_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'ford'])}}"><img src="{{asset('assets/images/home/ford_logo.png')}}" alt="ford_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'citroen'])}}"><img src="{{asset('assets/images/home/citroen_logo.png')}}" alt="citroen_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'toyota'])}}"><img src="{{asset('assets/images/home/toyota_logo.png')}}" alt="toyota_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'nissan'])}}"><img src="{{asset('assets/images/home/nissan_logo.png')}}" alt="nissan_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'bmw'])}}"><img src="{{asset('assets/images/home/bmw_logo.png')}}" alt="bmw_logo"></a></li>
                                <li class="item marque_item"> <a href="{{route('voitures.index',['marque'=>'opel'])}}"><img src="{{asset('assets/images/home/opel_logo.png')}}" alt="opel_logo"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
<!-- End Body Content -->


@endsection