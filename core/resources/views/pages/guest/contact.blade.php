@extends('layouts.guest')

@section('title','Autostars - Contact')

@section('header')
    {{-- <link href="{{asset('assets/css/guest/home.css')}}" rel="stylesheet" type="text/css"> --}}
@endsection

@section('content')
    <!-- Start Page header -->
    <div class="page-header parallax" style="background-image:url(/assets/images/contact_page/contact_page_heading.jpg); background-size : cover; background-position-y:center;">
    	<div class="container">
        	<h1 class="page-title"><strong>Contact</strong></h1>
       	</div>
    </div>
    <!-- Utiity Bar -->
    <div class="utility-bar">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-8 col-sm-6 col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="{{route('accueil')}}">Accueil</a></li>
                        <li class="active">Contact</li>
                    </ol>
            	</div>
                <div class="col-md-4 col-sm-6 col-xs-4">
                </div>
            </div>
      	</div>
    </div>
    <!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
      		<div class="container">
            	<div class="listing-header margin-40">
                	<h2>Contact Us</h2>
                </div>
            	<div class="row">
                	<div class="col-md-3 col-sm-4">
                    	<i class="fa fa-home"></i></span> <b>AutoStars Inc.</b><br>
                            123 Rue de Rivoli, <br>
							75001 Paris, France<br><br>
							<i class="fa fa-phone"></i> <b>1800-989-990</b><br>
							<i class="fa fa-fax"></i> <b>1800-989-991</b><br>
							<i class="fa fa-envelope"></i> <a href="mailto:example@info.com">info@autostars.com</a><br><br>
							<i class="fa fa-home"></i> <b>Lun - Sam : 06h00 - 20h00</b><br>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="col-md-9 col-sm-8">
                                    <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert">&times;</a> <strong>Oh snap!</strong> {{ $error }} </div>
                                </div>
                            @endforeach
                        @endif
                        @if (session('success'))
                            <div class="col-md-9 col-sm-8">
                                <div class="alert alert-success fade in"> <a class="close" data-dismiss="alert">&times;</a>  {{ session('success') }} </div>
                            </div>
                        @endif
                       	<form method="post"  action="{{route('messages.store')}}">
                            @csrf
                        	<div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" id="name" name="name"  class="form-control input-lg" placeholder="Nom Complet*" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="email" id="email" name="email"  class="form-control input-lg" placeholder="Email*" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="phone" name="phone" class="form-control input-lg" placeholder="Téléphone">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" id="subject" name="subject"  class="form-control input-lg" placeholder="Sujet">
                                    </div>
                                    <div class="form-group">
                                        <textarea cols="6" rows="4" id="content" name="content" class="form-control input-lg" placeholder="Message*" required></textarea>
                                    </div>
                                    <button id="submit"  type="submit" class="btn btn-primary btn-lg pull-right">Envoyer!</button>
                              	</div>
                           	</div>
                		</form>
                        {{-- <div class="clearfix"></div>
                        <div id="message"></div> --}}
                    </div>
              	</div>
        	</div>
      	</div>
 	</div>
    <!-- End Body Content -->


@endsection