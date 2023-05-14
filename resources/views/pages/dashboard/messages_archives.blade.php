
@extends('layouts.dashboard')

@section('title','dashboard - Messages archivés')

@section('header')
    <link href="{{asset('assets/css/dashboard/messages_list.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @if ($errors->any())
        <div class="col-md-9 col-sm-8">
            <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert" href="#">&times;</a> <strong>Oh snap!</strong> {{ $errors->first() }} </div>
        </div>
    @endif
    {{-- alert messages container --}}
    <div class="col-md-9 col-sm-8" id="alerts_container">
    </div>

    {{-- Search form container --}}
    <div class="col-md-9 col-sm-8 search-form-container">
        <a href="#" class="search-trigger"><i class="fa fa-search"></i></a>
        <!-- Search Form -->
        <div class="search-form">
            <div class="search-form-inner">
                <form action="{{route('dashboard.messages.archived')}}">
                    <h4>Chercher</h4>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                          
                            <div class="row">

                                {{-- id --}}
                                <div class="col-md-6">
                                    <label>Id </label>
                                    <input type="number" min="1" name="id" value="{{request()->id}}" class="form-control">
                                </div>
                                {{-- name --}}
                                <div class="col-md-6">
                                    <label>Nom </label>
                                    <input type="text" name="name" value="{{request()->name}}" class="form-control">
                                </div>
                                
                            </div>
                            <div class="row">
                                {{-- Email --}}
                                <div class="col-md-6">
                                    <label>Email </label>
                                    <input type="text" name="email" value="{{request()->email}}" class="form-control selectpicker">
                                </div>
                                {{-- numero de telephone --}}
                                <div class="col-md-6">
                                    <label>Numero de telephone </label>
                                    <input type="phone" name="phone" value="{{request()->phone}}" class="form-control selectpicker">
                                </div>
                                
                            </div>
                            
                            
                            
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="row">
                               {{-- Date d'envoi min --}}
                               <div class="col-md-6">
                                    <label>Date d'envoi (min) </label>
                                    <input type="date" name="created_at_min" value="{{request()->created_at_min}}" class="form-control selectpicker">
                                </div>
                                {{-- Sujet --}}
                                <div class="col-md-6">
                                    <label>Date d'envoi (max) </label>
                                    <input type="date" name="created_at_max" value="{{request()->created_at_max}}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                {{-- Sujet --}}
                                <div class="col-md-12">
                                    <label>Sujet </label>
                                    <input type="text" name="subject" value="{{request()->subject}}" class="form-control">
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
    {{-- Archived Messages list container --}}
    <div class="col-md-9 col-sm-8">
        <h3><strong>Les Messages Archivés<strong></h3>
        <div class="messages-list">
            @foreach ($messages as $message)
                {{-- message item --}}
                <div class="message-item" id="{{'message_item_'.$message->id}}">
                    <div class="checkbox_container">
                        <input type="checkbox" value="{{$message->id}}" name="ids[]">
                    </div>
                    <div class="message-item-id">
                        {{$message->id}} 
                    </div>
                    <div class="message-item-subject">
                        <a href="{{route('dashboard.messages.show', ['message'=>$message->id])}}"> {{$message->subject}}</a>
                    </div>
                    <div class="message-item-see">
                        <a href="{{route('dashboard.messages.show', ['message'=>$message->id])}}"><i class="fa fa-eye"></i></a>
                   </div>
                    <div class="message-item-date">
                        {{date('d-m-Y', strtotime($message->created_at))}}
                    </div>
                    <div class="dropdown">
                        <button id="message_item_dropdown_" class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="message_item_dropdown_">
                            {{-- restore btn --}}
                            <li class="restore"><a data-toggle="modal" data-target="{{'#restoreModal_'.$message->id}}">Restorer</a></li>
                            {{-- delete btn --}}
                            <li class="delete"><a data-toggle="modal" data-target="{{'#deleteModal_'.$message->id}}">Suprimmer</a></li>
                        </ul>
                    </div>
                </div>
                {{-- restore modal --}}
                <div class="modal fade" id="{{'restoreModal_'.$message->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="text-center">Confirmer la restoration de message</h4>
                                <h4 class="text-center">id: {{$message->id}}</h4>
                            </div>
                            <div class="modal-body">
                                <button type="button" data-id="{{$message->id}}" data-toggle-modal="{{'#restoreModal_'.$message->id}}" class="btn btn-success restore">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- delete modal --}}
                <div class="modal fade" id="{{'deleteModal_'.$message->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="text-center">Confirmer la suppression de message </h4>
                                <h4 class="text-center">id: {{$message->id}}</h4>
                            </div>
                            <div class="modal-body">
                                <button type="button" data-id="{{$message->id}}" data-toggle-modal="{{'#deleteModal_'.$message->id}}" class="btn btn-danger delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="bulk_btns_container">
                <a role="button" data-toggle="modal" data-target="#bulkRestoreModal" class="btn btn-success btn-sm" >Restorer la sélection</a>
                {{-- bulk restore modal --}}
                <div class="modal fade" id="bulkRestoreModal"  role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="text-center">Confirmer l'archivation des messages selectionées</h4>
                            </div>
                            <div class="modal-body">
                                <button type="button" id="bulk_restore" class="btn btn-success bulk_restore">Confirmer</button>
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
                                <h4  class="text-center">Confirmer la suppression des messages selectionées</h4>
                            </div>
                            <div class="modal-body">
                                <button type="button" id="bulk_delete"  class="btn btn-danger bulk_delete">Confirmer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination_container">
                {{$messages->onEachSide(5)->links()}}
            </div>
        </div>
        
        
    </div>


    
@endsection
@section('scripts')
    <script src="{{asset('assets/js/dashboard/messages_crud.js')}}" ></script>
@endsection

