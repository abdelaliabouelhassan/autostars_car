@extends('layouts.guest')

@section('title','Autostars - Details')

@section('header')
    <link href="{{asset('assets/css/guest/voiture_details.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    
   
    @if ($errors->any())
                <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert" href="#">&times;</a> <strong>Oh snap!</strong> {{ $errors->first() }} </div>
    @else
        <!-- Start Body Content -->
        <div class="main" role="main">
            <div id="content" class="content full">
                <div class="container">
                    <!-- Vehicle Details -->
                    <article class="single-vehicle-details">
                        <div class="single-vehicle-title">
                            <h2 class="post-title">Nissan Terrano single hand driven</h2>
                        </div>
                        <div class="single-listing-actions">
                            <div class="btn btn-info price">{{$voiture->prix}}€</div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="single-listing-images">
                                    <div class="featured-image format-image">
                                        @foreach($voiture->images as $image)
                                            @if ($image->main)
                                                <a href="{{'/images/'.$image->path}}" data-rel="prettyPhoto[gallery]" class="media-box"><img src="{{'/images/'.$image->path}}" alt=""></a>
                                                <?php break ; ?>
                                            @endif
                                        @endforeach
                                       
                                    </div>
                                    <div class="additional-images">
                                            <ul class="owl-carousel" data-columns="4" data-pagination="no" data-arrows="yes" data-single-item="no" data-items-desktop="4" data-items-desktop-small="4" data-items-tablet="3" data-items-mobile="3">
                                                @foreach($voiture->images as $image)
                                                    <li class="item format-image"> <a href="{{'/images/'.$image->path}}" data-rel="prettyPhoto[gallery]" class="media-box"><img src="{{'/images/'.$image->path}}" alt=""></a></li>
                                                @endforeach
                                            </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="sidebar-widget widget">
                                    <ul class="list-group">
                                        <li class="list-group-item" ><div class="specification-value" >{{$voiture->annee}}</div> <div class="badge">Annee</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->marque}}</div> <div class="badge">Marque</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->modele}}</div> <div class="badge">Modele</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->type}}</div> <div class="badge">Type</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->carburant}}</div> <div class="badge">Carburant</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->etat}}</div> <div class="badge">État</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->kilometrage}}</div> <div class="badge">kilometrage</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->transmission}}</div> <div class="badge">Transmission</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->nombre_places}}</div> <div class="badge">Nombre de places</div> </li>
                                        <li class="list-group-item"><div class="specification-value" > {{$voiture->nombre_portes}}</div> <div class="badge">Nombre de portes</div> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="spacer-50"></div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="tabs vehicle-details-tabs">
                                    <ul class="nav nav-tabs">
                                        <li class="active"> <a data-toggle="tab" href="#vehicle-overview">Description</a></li>
                                        <li> <a data-toggle="tab" href="#vehicle-specs">Specifications</a></li>
                                        <li> <a data-toggle="tab" href="#vehicle-add-features">OptionsAdditionelles</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="vehicle-overview" class="tab-pane fade in active">
                                            <p>{{$voiture->description}}</p>
                                        </div>
                                        <div id="vehicle-specs" class="tab-pane fade">
                                            <div class="accordion" id="toggleArea">
                                                <div class="accordion-group panel">
                                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseOne"> Moteur <i class="fa fa-plus-circle"></i> <i class="fa fa-minus-circle"></i> </a> </div>
                                                    <div id="collapseOne" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table-specifications table table-striped table-hover">
                                                                <tbody>
                                                                    @foreach(json_decode($voiture->specifications_moteur) as $key=>$value)
                                                                        <tr>
                                                                            <td>{{$key}}</td>
                                                                            <td>{{$value}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-group panel">
                                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseTwo"> Exterieure <i class="fa fa-plus-circle"></i> <i class="fa fa-minus-circle"></i> </a> </div>
                                                    <div id="collapseTwo" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table-specifications table table-striped table-hover">
                                                                <tbody>
                                                                    @foreach(json_decode($voiture->specifications_exterieures) as $key=>$value)
                                                                        <tr>
                                                                            <td>{{$key}}</td>
                                                                            <td>{{$value}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-group panel">
                                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseThird"> Interieure <i class="fa fa-plus-circle"></i> <i class="fa fa-minus-circle"></i> </a> </div>
                                                    <div id="collapseThird" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table-specifications table table-striped table-hover">
                                                                <tbody>
                                                                    @foreach(json_decode($voiture->specifications_interieures) as $key=>$value)
                                                                        <tr>
                                                                            <td>{{$key}}</td>
                                                                            <td>{{$value}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-group panel">
                                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseForth"> Capacité <i class="fa fa-plus-circle"></i> <i class="fa fa-minus-circle"></i> </a> </div>
                                                    <div id="collapseForth" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table-specifications table table-striped table-hover">
                                                                <tbody>
                                                                    @foreach(json_decode($voiture->specifications_capacites) as $key=>$value)
                                                                        <tr>
                                                                            <td>{{$key}}</td>
                                                                            <td>{{$value}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Toggle --> 
                                        </div>
                                        <div id="vehicle-add-features" class="tab-pane fade">
                                            <ul class="add-features-list">
                                                @foreach(json_decode($voiture->options_additionnelles) as $value)
                                                <li>{{$value}}</li>
                                                @endforeach
                                                
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="spacer-50"></div>
                                <!-- Recently Listed Vehicles -->
                                <section class="listing-block recent-vehicles">
                                    <div class="listing-header">
                                        <h3>Voitures de Nouveautés</h3>
                                    </div>
                                    <div class="listing-container">
                                        <div class="carousel-wrapper">
                                            <div class="row">
                                                <ul class="owl-carousel carousel-fw" id="vehicle-slider" data-columns="3" data-autoplay="" data-pagination="yes" data-arrows="no" data-single-item="no" data-items-desktop="3" data-items-desktop-small="3" data-items-tablet="2" data-items-mobile="1">
                                                    @foreach ($autre_voitures as $voiture)
                                                        {{-- recently-listed-item --}}
                                                        <li class="item">
                                                            <div class="vehicle-block format-standard">
                                                                <a href="{{route('voitures.show',['voiture'=>$voiture->id])}}" class="media-box"><img src="{{'/images/'.$voiture->images[0]->path}}" alt=""></a>
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
                            </div>
                            <!-- Vehicle Details Sidebar -->
                            <div class="col-md-4 vehicle-details-sidebar sidebar">
                                
                                <!-- Vehicle Enquiry -->
                                <div class="sidebar-widget widget seller-contact-widget">
                                    <h4 class="widgettitle">Envoyer in message</h4>
                                    <div class="vehicle-enquiry-in">
                                        @if (session('success'))
                                            <div class="alert alert-success fade in"> <a class="close" data-dismiss="alert">&times;</a>  {{ session('success') }} </div>
                                        @endif
                                        <form method="POST" action="{{route('messages.store')}}">
                                            @csrf
                                            <input type="text" name="name" placeholder="Nom*" class="form-control" required>
                                            <input type="email" name="email" placeholder="Email*" class="form-control" required>
                                            <input type="text" name="phone" placeholder="Téléphone" class="form-control">
                                            <input type="text" name="subject" placeholder="Suject" class="form-control">
                                            
                                            <textarea name="content" class="form-control" placeholder="Message*"></textarea>
                                            
                                            <button type="submit" class="btn btn-primary" value="Submit">Envoyer</button>
                                        </form>
                                    </div>
                                    <div class="call-card-car-details text-primary">
                                        <div class=""><i class="fa fa-phone"></i></div>
                                        <div class=""><strong>1800 011 2211</strong></div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </article>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- End Body Content -->

        <!-- REQUEST MORE INFO POPUP -->
        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Request more info</h4>
                    </div>
                    <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.</p>
                        <form>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary pull-right" value="Request Info">
                            <label class="btn-block">Preferred Contact</label>
                            <label class="checkbox-inline"><input type="checkbox"> Email</label>
                            <label class="checkbox-inline"><input type="checkbox"> Phone</label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- BOOK TEST DRIVE POPUP -->
        <div class="modal fade" id="testdriveModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Book a test drive</h4>
                    </div>
                    <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.</p>
                        <form>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" id="datepicker" class="form-control" placeholder="Preferred Date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-append bootstrap-timepicker">
                                        <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" id="timepicker" class="form-control" placeholder="Preferred time">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary pull-right" value="Schedule Now">
                            <label class="btn-block">Preferred Contact</label>
                            <label class="checkbox-inline"><input type="checkbox"> Email</label>
                            <label class="checkbox-inline"><input type="checkbox"> Phone</label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MAKE AN OFFER POPUP -->
        <div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Make an offer</h4>
                    </div>
                    <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.</p>
                        <form>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                        <input type="text" class="form-control" placeholder="Offered Price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        <select type="text" class="form-control selectpicker">
                                            <option selected>Financing required?</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <textarea class="form-control" placeholder="Additional comments"></textarea>
                            <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection