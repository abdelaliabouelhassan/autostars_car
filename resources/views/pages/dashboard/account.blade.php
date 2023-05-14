@extends('layouts.dashboard')

@section('title','dashboard - mon compte')


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
    <h3><strong>Mon Compte</strong></h3>
    <div class="dashboard-block">
        <div class="tabs profile-tabs">
            <ul class="nav nav-tabs">
                <li class="active"> <a data-toggle="tab" href="#personalinfo" aria-controls="personalinfo" role="tab">informations personnelles </a></li>
                <li> <a data-toggle="tab" href="#changepassword" aria-controls="changepassword" role="tab">Changer le mot de passe</a></li>
            </ul>
                <div class="tab-content">
                    <!-- ACCOUNT PERSONAL INFO -->
                    <div id="personalinfo" class="tab-pane fade active in">
                        <div class="row">
                            <form method="POST" action="{{route('admins.update_personal_info')}}" class="col-md-8">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nom</label>
                                        <input type="text" name="name" value="{{$user['name']}}"  class="form-control" placeholder="" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" name="email"  value="{{$user['email']}}" class="form-control" placeholder="mail@example.com" >
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Changer</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- PROFIE CHANGE PASSWORD -->
                    <div id="changepassword" class="tab-pane fade">
                        <div class="row">
                            <form method="POST" action="{{route('password.update')}}" class="col-md-8">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Ancien mot de passe</label>
                                        <input type="password" name="current_password" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nouveau mot de passe</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirmer le Nouveau mot de passe</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Changer</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection