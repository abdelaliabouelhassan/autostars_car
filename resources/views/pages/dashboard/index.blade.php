
@extends('layouts.dashboard')

@section('title','dashboard')

@section('header')
    <link href="{{asset('assets/css/dashboard/dashboard.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @if ($errors->any())
        <div class="col-md-9 col-sm-8">
            <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert" href="#">&times;</a> <strong>Oh snap!</strong> {{ $errors->first() }} </div>
        </div>
    @else

        <div class="col-md-9 col-sm-8">
            <h3> <strong>Dashboard</strong></h3>
            <div class="dashboard-block">
                <div class="statistics-card-list">
                    <div class="statistics-card">
                        <h3>Voitures</h3>
                        <div>
                            <strong>{{$voitures_count}}</strong>
                        </div>
                    </div>

                    <div class="statistics-card">
                        <h3>Messages</h3>
                        <div>
                            <strong>{{$messages_count}}</strong>
                        </div>
                    </div>

                    <div class="statistics-card">
                        <h3>Admins</h3>
                        <div>
                            <strong>{{$admins_count}}</strong>
                        </div>
                    </div>

                </div>
                


            </div>

            
        </div>
    @endif

    
@endsection
@section('scripts')
    <script src="{{asset('assets/js/dashboard/voitures_crud.js')}}" ></script>
@endsection













































































