<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
class MessageController extends Controller
{
  

    /**
     * Messages list;
     */
    public function index(Request $request)
    {
        try {

            $validate=request()->validate([
                "id"=> ['nullable','integer', 'min:1'],
                "name"=> ['nullable','string'],
                "phone"=>  ['nullable','string'],
                "email"=>  ['nullable','string'],
                "subject"=>  ['nullable','string'],
                "created_at_min"=>  ['nullable','date'],
                "created_at_max"=>  ['nullable','date'],
            ]);
            if(empty($validate)){
                $messages = Message::paginate(15)->withQueryString();
                return view('pages.dashboard.messages', compact('messages'));
            }
            $messages = Message::query()
                        ->when(isset($validate['id']),function($query) use ($validate){
                            $query->where('id' , $validate['id']) ;
                        })
                        ->when(isset($validate['name']),function($query) use ($validate){
                            $query->where('name' ,  'like', "%".$validate['name']."%") ;
                        })
                        ->when(isset($validate['phone']),function($query) use ($validate){
                            $query->where('phone' ,  'like', "%".$validate['phone']."%") ;
                        })
                        ->when(isset($validate['email']),function($query) use ($validate){
                            $query->where('email' ,  'like', "%".$validate['email']."%") ;
                        })
                        ->when(isset($validate['subject']),function($query) use ($validate){
                            $query->where('subject' ,  'like', "%".$validate['subject']."%") ;
                        })
                        ->when(isset($validate['created_at_min']),function($query) use ($validate){
                            $query->whereDate('created_at' ,  '>=', $validate['created_at_min']) ;
                        })
                        ->when(isset($validate['created_at_max']),function($query) use ($validate){
                            $query->whereDate('created_at' ,  '<=', $validate['created_at_max']) ;
                        });
                        

            $messages = $messages->paginate(15)->withQueryString();
            return view('pages.dashboard.messages', compact('messages'));
        } catch (\Throwable $th) {
            return view('pages.dashboard.messages')->withErrors("quelque chose s'est mal passé!");
        }
    }

    /**
     * Messages list;
     */
    public function store(Request $request)
    {
        try {
            $validate=request()->validate([
                "name"=> ['required','string'],
                "email"=>  ['required','string'],
                "phone"=>  ['nullable','string'],
                "subject"=>  ['nullable','string'],
                "content"=>  ['required','string'],
            ]);
            Message::create($validate);
            return redirect()->back()->with('success', 'Votre Message a été envoyé!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $message = Message::withTrashed()-> whereId($id)->first();
            return view('pages.dashboard.message', compact('message'));

        } catch (\Throwable $th) {
            return view('pages.dashboard.message')->withErrors("quelque chose s'est mal passé!");
        }
    }



    /**
     * Show the list of soft deleted resources.
     */
    public function archived()
    {
        try {

            $validate=request()->validate([
                "id"=> ['nullable','integer', 'min:1'],
                "name"=> ['nullable','string'],
                "phone"=>  ['nullable','string'],
                "email"=>  ['nullable','string'],
                "subject"=>  ['nullable','string'],
                "created_at_min"=>  ['nullable','date'],
                "created_at_max"=>  ['nullable','date'],
            ]);
            if(empty($validate)){
                $messages = Message::onlyTrashed()->paginate(15)->withQueryString();
                return view('pages.dashboard.messages_archives', compact('messages'));
            }
            $messages = Message::query()
                         ->when(isset($validate['id']),function($query) use ($validate){
                            $query->where('id' ,  $validate['id']) ;
                        })
                        ->when(isset($validate['name']),function($query) use ($validate){
                            $query->where('name' ,  'like', "%".$validate['name']."%") ;
                        })
                        ->when(isset($validate['phone']),function($query) use ($validate){
                            $query->where('phone' ,  'like', "%".$validate['phone']."%") ;
                        })
                        ->when(isset($validate['email']),function($query) use ($validate){
                            $query->where('email' ,  'like', "%".$validate['email']."%") ;
                        })
                        ->when(isset($validate['subject']),function($query) use ($validate){
                            $query->where('subject' ,  'like', "%".$validate['subject']."%") ;
                        })
                        ->when(isset($validate['created_at_min']),function($query) use ($validate){
                            $query->whereDate('created_at' ,  '>=', $validate['created_at_min']) ;
                        })
                        ->when(isset($validate['created_at_max']),function($query) use ($validate){
                            $query->whereDate('created_at' ,  '<=', $validate['created_at_max']) ;
                        });

            $messages = $messages->onlyTrashed()->paginate(15)->withQueryString();
            return view('pages.dashboard.messages_archives', compact('messages'));
        } catch (\Throwable $th) {
            return view('pages.dashboard.messages_archives')->withErrors("quelque chose s'est mal passé!");
        }
    }

    /**
     * soft delete the specified resource.
     */
    public function archive(string $id)
    {
        try {
            Message::destroy($id);
            return response('le message a été archivé avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec l'archivation de message",500);
        }
    }

    /**
     * soft delete the specified resources.
     */
    public function bulkArchive(Request $request)
    {
        try {
            $validate=request()->validate([
                "ids"=> ['required','array'],
            ]);
            //if request is empty return false
            if(!$validate['ids']){
                return response(false);
            }
            Message::whereIn('id', $request->input('ids'))->delete();
            return response('les messages sélectionnées ont été archivées avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec l'archivation des messages!",500);
        }
    }

    /**
     * restore the specified resource.
     */
    public function restore(string $id)
    {
        try {
            Message::onlyTrashed()->whereid($id)->restore();
            return response('le message a été restoreée avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la restoration de message",500);
        }
    }

    /**
     * restore the specified resources.
     */
    public function bulkRestore(Request $request)
    {
        try {
            $validate=request()->validate([
                "ids"=> ['required','array'],
            ]);
            //if request is empty return false
            if(!$validate['ids']){
                return response(false);
            }
            //get selected cars
            $messages = Message::onlyTrashed()->whereIn('id', $request->input('ids'))->get();
            //delete the cars
            $messages->each->restore();
            return response('les messages sélectionnées ont été restorés avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la restoration des messages!",500);
        }
    }



    /**
     * soft delete the specified resources.
     */
    public function bulkDelete(Request $request)
    {
        try {
            $validate=request()->validate([
                "ids"=> ['required','array'],
            ]);
            //if request is empty return false
            if(!$validate['ids']){
                return response(false);
            }
            //get selected messages
            $messages = Message::withTrashed()->whereIn('id', $request->input('ids'))->get();
            //delete the messages
            $messages->each->forceDelete();
            return response('les messages sélectionnées ont été supprimées avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la suppression des messages!",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        try {
            //get the message
            $message = Message::withTrashed()->whereId($id)->first()->forceDelete();
            return response('la message a été supprimée avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la suppression de message", 500);
        }
    }

}
