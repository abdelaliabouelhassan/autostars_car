@extends('layouts.dashboard')

@section('title','dashboard - Creer admin')


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
    <h3><strong>Crée un nouveau admin</strong></h3>
    <div class="dashboard-block">
            
        <form method="POST" action="{{route('admins.store')}}" class="col-md-8">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>Nom</label>
                    <input type="text" name="name"   class="form-control" placeholder="" >
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email"   class="form-control" placeholder="mail@example.com" >
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Confirmer le Mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6">
                    <input type="checkbox" name="is_super_admin" value="{{true}}" >
                    <label>Super admin</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-info">Creer</button>
                </div>
            </div>
        </form>
                    
                    
    </div>
</div>

@endsection