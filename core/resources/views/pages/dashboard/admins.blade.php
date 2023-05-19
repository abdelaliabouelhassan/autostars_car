
@extends('layouts.dashboard')

@section('title','dashboard - admins')

@section('header')
    <link href="{{asset('assets/css/dashboard/dashboard.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @if ($errors->any())
        <div class="col-md-9 col-sm-8">
            <div class="alert alert-error fade in"> <a class="close" data-dismiss="alert" href="#">&times;</a> <strong>Oh snap!</strong> {{ $errors->first() }} </div>
        </div>
    @else
        {{-- alert messages container --}}
        <div class="col-md-9 col-sm-8" id="alerts_container">
        </div>

        <div class="col-md-9 col-sm-8">
            <h3><strong>Les Admins</strong></h3>
            <div class="dashboard-block">
                <div class="table-responsive">
                    <table class="table table-bordered dashboard-tables saved-cars-table">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Nom</td>
                                <td>Email</td>
                                <td>Is Super Admin</td>
                                <td>Timestamp</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr id="{{'table_row_'.$admin->id}}">
                                    {{-- id --}}
                                    <td valign="middle">{{$admin->id}}</td>
                                    {{-- name --}}
                                    <td>
                                        {{$admin->name}}
                                    </td>
                                    {{-- email --}}
                                    <td>
                                        {{$admin->email}}
                                    </td>
                                    {{-- is_super_admin --}}
                                    <td>
                                        {{$admin->is_super_admin}}
                                    </td>
                                    {{-- timestamps --}}
                                    <td>
                                        <div class="text-success">crée à {{$admin->created_at}}</div> 
                                        <div class="text-success">modifié à {{$admin->updated_at}}</div> 
                                    </td>
                                    {{-- actions buttons --}}
                                    <td align="center">
                                        @if (!$admin->is_super_admin)
                                            

                                            {{-- super btn --}}
                                            <a data-toggle="modal"  data-target="{{'#superModal'.$admin->id}}" class="btn action-btn super">Super Amin</a>
                                            
                                            {{-- super modal --}}
                                            <div class="modal fade" id="{{'superModal'.$admin->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4>Confirmer la transformation a Super admin de:</h4>
                                                            <h5>{{$admin->name}}</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <button type="button" data-id="{{$admin->id}}" data-toggle-modal="{{'#superModal'.$admin->id}}" class="btn action-btn super">Confirmer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- delete btn --}}
                                            <a data-toggle="modal" data-target="{{'#deleteModal_'.$admin->id}}" class="btn action-btn delete">Supprimer</a>
                                            
                                            {{-- delete modal --}}
                                            <div class="modal fade" id="{{'deleteModal_'.$admin->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4>Confirmer la suppression de:</h4>
                                                            <h5>{{$admin->name}}</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <button type="button" data-id="{{$admin->id}}" data-toggle-modal="{{'#deleteModal_'.$admin->id}}" class="btn action-btn delete">Confirmer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                           
                                        
                                            
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                
            </div>

            
        </div>
    @endif
@endsection


@section('scripts')
    <script src="{{asset('assets/js/dashboard/admins_crud.js')}}" ></script>
@endsection
