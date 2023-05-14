@extends('layouts.guest')

@section('title','Autostars - À propos')

@section('header')
    <link href="{{asset('assets/css/guest/voitures.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <!-- Start Page header -->
    <div class="page-header parallax" style="background-image:url(/assets/images/apropos_page/apropos_heading.jpg);">
    	<div class="container">
        	<h1 class="page-title"><strong>À propos</strong></h1>
       	</div>
    </div>
    <!-- Utiity Bar -->
    <div class="utility-bar">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-8 col-sm-6 col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="{{route('accueil')}}">Accueil</a></li>
                        <li class="active">À propos</li>
                    </ol>
            	</div>
                
            </div>
      	</div>
    </div>
    <!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
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

                <hr class="fw">
                <div class="text-align-center"><h2 class="uppercase">Notre équipe</h2></div>
                <div class="spacer-20"></div>
            	<div class="row">
                <ul class="sort-destination gallery-grid" data-sort-id="gallery">
                    <!-- team member -->
                    <li class="col-md-4 col-sm-4 grid-item format-image">
                        <div class="grid-item-inner">
                            <a href="{{asset('assets/images/apropos_page/team_03.jpg')}}" data-rel="prettyPhoto" class="media-box"> <img src="{{asset('assets/images/apropos_page/team_03.jpg')}}" alt=""> </a>

                            <div class="grid-content">
                                <h3 class="post-title">Jean-Pierre</h3>
                                <p>Jean-Pierre, notre expert en automobiles, saura vous surprendre par sa connaissance approfondie des véhicules. Avec son expérience solide et son sens aigu du service client, il vous guidera avec professionnalisme vers la voiture parfaite. Faites confiance à Jean-Pierre pour réaliser vos rêves automobiles en toute simplicité.</p>
                                <ul class="social-icons social-icons-colored">
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- team member -->
                    <li class="col-md-4 col-sm-4 grid-item format-image">
                        <div class="grid-item-inner">
                            <a href="{{asset('assets/images/apropos_page/team_02.jpg')}}" data-rel="prettyPhoto" class="media-box"> <img src="{{asset('assets/images/apropos_page/team_02.jpg')}}" alt=""> </a>
                            <div class="grid-content">
                                <h3 class="post-title">Marie-Claire</h3>
                                <p>Marie-Claire, passionnée de l'automobile, mettra à profit son expertise pour vous conseiller au mieux. À l'écoute de vos préférences, elle vous orientera vers les meilleures options correspondant à vos besoins. Avec Marie-Claire, vous bénéficierez d'un accompagnement personnalisé et d'une expérience d'achat exceptionnelle.</p>
                                <ul class="social-icons social-icons-colored">
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- team member -->
                    <li class="col-md-4 col-sm-4 grid-item format-image">
                        <div class="grid-item-inner">
                            <a href="{{asset('assets/images/apropos_page/team_01.jpg')}}" data-rel="prettyPhoto" class="media-box"> <img src="{{asset('assets/images/apropos_page/team_01.jpg')}}" alt=""> </a>

                            <div class="grid-content">
                                <h3 class="post-title">Vincent Dupont</h3>
                                <p>Vincent, notre spécialiste des véhicules haut de gamme, vous garantit une expérience luxueuse et sur mesure. Son savoir-faire en matière de voitures de prestige vous permettra de trouver la perle rare. Vincent saura répondre à toutes vos exigences et vous offrir une satisfaction totale.</p>
                                <ul class="social-icons social-icons-colored">
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
        	</div>
      	</div>
 	</div>
    <!-- End Body Content -->


@endsection