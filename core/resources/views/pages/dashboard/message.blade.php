@extends('layouts.dashboard')

@section('title','dashboard')

@section('header')
    <link href="{{asset('assets/css/dashboard/message.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="col-md-9 col-sm-8">
            <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert">&times;</a> <strong>Oh snap!</strong> {{ $error }} </div>
        </div>
    @endforeach
@else
        <div id="message_container" class="col-md-9 col-sm-8 ">
            @if($message->name)
                <div><strong>Nom : </strong> {{$message->name}} </div>
            @endif
            @if($message->email)
                <div><strong>Email : </strong> {{$message->email}} </div>
            @endif
            @if($message->phone)
                <div><strong>Téléphone : </strong> {{$message->phone}} </div>
            @endif
            @if($message->subject)
                <div class="message-subject">
                    <div><strong>Sujet : </strong></div>
                    <div> {{$message->subject}} </div>
                </div>
            @endif
            @if($message->content)
                <div class="message-content">
                    <p> {{$message->content}} </p>
                </div>
            @endif
        </div>


@endif


        
@endsection