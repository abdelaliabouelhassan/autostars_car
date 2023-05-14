<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiture;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $voitures = $this->search($request);
            return view('pages.guest.voitures', compact('voitures'));
        } catch (\Throwable $th) {
            // return ['error'=>$th->getMessage(), 'line'=>$th->getLine()];
            return view('pages.guest.voitures')->withErrors("quelque chose s'est mal passé!");
        }
    }
    /**
     * Display a listing of the resource for dashboard.
     */
    public function getDashboardCars(Request $request){
        try {
            $voitures = $this->search($request);
            return view('pages.dashboard.voitures', compact('voitures'));
        } catch (\Throwable $th) {
            return view('pages.dashboard.voitures')->withErrors("quelque chose s'est mal passé!");
        }
    }

    /**
     * Car search;
     */
    public function search(Request $request)
    {
        try {

            $validate=request()->validate([
                "type"=> ['nullable','string'],
                "transmission"=>  ['nullable','string'],
                "marque"=>  ['nullable','string'],
                "model"=>  ['nullable','string'],
                "prix_min"=>  ['nullable','integer','min:0'],
                "prix_max"=> ['nullable','integer','min:0'],
                "etat"=> ['nullable','string'],
                "annee_min"=> ['nullable','integer','min:2000', 'max:2050'],
                "annee_max"=> ['nullable','integer','min:2000' , 'max:2050'],
                "kilometrage_min"=> ['nullable','integer','min:0'],
                "kilometrage_max"=> ['nullable','integer','min:0'],
                "couleur"=> ['nullable','string'],
                "carburant"=> ['nullable','string'],

                "etat_array"=> ['nullable','array'],
                "marque_array"=> ['nullable','array'],
                "type_array"=> ['nullable','array'],
                "couleur_array"=> ['nullable','array'],
                "transmission_array"=> ['nullable','array'],
                "carburant_array"=> ['nullable','array'],
                "ordre"=>['nullable','string'],
            ]);
            if(empty($validate)){
                $voitures = Voiture::with(['images' => function ($query) {
                                $query->where('main', true);
                            }])
                            ->paginate(6)
                            ->withQueryString();
                return $voitures;
            }
            $voitures = Voiture::query()
                        ->when(isset($validate['type']),function($query) use ($validate){
                            $query->where('type' , $validate['type']) ;
                        })
                        ->when(isset($validate['transmission']),function($query) use ($validate){
                            $query->where('transmission' , $validate['transmission']) ;
                        })
                        ->when(isset($validate['marque']),function($query) use ($validate){
                            $query->where('marque' , $validate['marque']) ;
                        })
                        ->when(isset($validate['prix_min']),function($query) use ($validate){
                            $query->where('prix','>=' , $validate['prix_min']) ;
                        })
                        ->when(isset($validate['prix_max']),function($query) use ($validate){
                            $query->where('prix' ,'<=' , $validate['prix_max']) ;
                        })

                        ->when(isset($validate['etat']),function($query) use ($validate){
                            $query->where('etat' , $validate['etat']) ;
                        })
                        ->when(isset($validate['annee_min']),function($query) use ($validate){
                            $query->where('annee','>=' , $validate['annee_min']) ;
                        })
                        ->when(isset($validate['annee_max']),function($query) use ($validate){
                            $query->where('annee','<=' , $validate['annee_max']) ;
                        })
                        ->when(isset($validate['kilometrage_min']),function($query) use ($validate){
                            $query->where('kilometrage','>=' , $validate['kilometrage_min']) ;
                        })
                        ->when(isset($validate['kilometrage_max']),function($query) use ($validate){
                            $query->where('kilometrage' ,'<=', $validate['kilometrage_max']) ;
                        })
                        ->when(isset($validate['couleur']),function($query) use ($validate){
                            $query->where('couleur' , $validate['couleur']) ;
                        })
                        ->when(isset($validate['carburant']),function($query) use ($validate){
                            $query->where('carburant' , $validate['carburant']) ;
                        });


            foreach ($validate as $input_key => $input_value) {
                if(isset($validate[$input_key]) && gettype($validate[$input_key]) === 'array'){
                    $column_name =str_replace("_array", "",$input_key);
                    $voitures->where(function ($query) use ($validate , $input_key , $column_name){
                        $count = 0;
                        foreach ($validate[$input_key] as $value) {
                            if($count>0){
                                $query->orWhere($column_name,  'like', "%".$value."%");
                            }else{
                                $query->where($column_name,  'like', "%".$value."%");
                            }
                            $count++;
                        }

                    });
                }
            }

            // ordering
            $voitures->when(isset($validate['ordre']),function($query) use ($validate){
                if(str_contains($validate['ordre'] , 'asc')){
                    $column_name = str_replace("_asc", "",$validate['ordre']);
                    $query->orderBy($column_name , 'asc');
                }else{
                    $column_name = str_replace("_desc", "",$validate['ordre']);
                    $query->orderBy($column_name , 'desc');
                }
            });

            $voitures = $voitures->with(['images' => function ($query) {
                            $query->where('main', true);
                        }])->paginate(6)->withQueryString();
            return $voitures;
        } catch (\Throwable $th) {
            throw $th;
        }




    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.creer_voiture');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validate=request()->validate([
                "type"=> ['required','string'],
                "titre"=> ['required','string'],
                "description"=> ['required','string'],
                "transmission"=>  ['required','string'],
                "marque"=>  ['required','string'],
                "modele"=>  ['required','string'],
                "prix"=>  ['required','integer','min:0'],
                "nombre_places"=>  ['required','integer','min:0'],
                "nombre_portes"=>  ['required','integer','min:0'],
                "etat"=> ['required','string'],
                "annee"=> ['required','integer','min:1970', 'max:2050'],
                "kilometrage"=> ['required','integer','min:0'],
                "couleur"=> ['required','string'],
                "carburant"=> ['required','string'],

                "specifications_moteur"=> ['required','array'],
                "specifications_exterieures"=> ['required','array'],
                "specifications_interieures"=> ['required','array'],
                "specifications_capacites"=> ['required','array'],
                "options_additionnelles"=> ['nullable','array'],

                "main_image"=>['required', 'image','max:5000'],
                "images"=>['nullable', 'array' ,'max:3'],
                "images.*"=>['nullable', 'image' ,'max:5000'],
            ]);

            $inputs = [];
            foreach ($validate as $input_key => $input_value) {
                if(isset($validate[$input_key]) && gettype($validate[$input_key]) === 'array'){
                    $inputs[$input_key] = json_encode($validate[$input_key]);
                }else if(isset($validate[$input_key])){
                    $inputs[$input_key] = $validate[$input_key];
                }
            }

            $voiture =  Voiture::create($inputs);
            if(isset($validate['main_image'])){
                $path = Storage::putFile("voitures", $request->file('main_image'));
                $voiture->images()->save(new Image(['path'=>$path , 'main'=>true]));
            }
            if(isset($validate['images'])){
                foreach($request->file('images') as $image){
                    $path = Storage::putFile("voitures", $image);
                    $voiture->images()->save(new Image(['path'=>$path]));
                }
            }
            DB::commit();
            return redirect()->back()->with('success','la voiture a été créée avec succès!!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé avec la création de la voiture");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $voiture = Voiture::where('id', $id)
                                ->with(['images' => function ($query) {
                                    $query->orderBy('main', 'desc');
                                }])
                                ->first();
            $autre_voitures = Voiture::latest()
                                    ->take(8)
                                    ->with(['images' => function ($query) {
                                        $query->where('main', true);
                                    }])
                                    ->get(['id','titre','prix', 'marque', 'annee', 'couleur', 'etat', 'type']);
            return view('pages.guest.voiture_details', compact('voiture','autre_voitures'));

        } catch (\Throwable $th) {
            return view('pages.guest.voiture_details')->withErrors("quelque chose s'est mal passé!");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            //voiture not exist error should be handeled
            $voiture = Voiture::withTrashed()->whereId($id)->with('images')->first();
            return view('pages.dashboard.modifier_voiture',compact('voiture'));
        } catch (\Throwable $th) {
            return view('pages.guest.voiture_details')->withErrors("quelque chose s'est mal passé!");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $validate=request()->validate([
                "type"=> ['required','string'],
                "titre"=> ['required','string'],
                "description"=> ['required','string'],
                "transmission"=>  ['required','string'],
                "marque"=>  ['required','string'],
                "modele"=>  ['required','string'],
                "prix"=>  ['required','integer','min:0'],
                "nombre_places"=>  ['required','integer','min:0'],
                "nombre_portes"=>  ['required','integer','min:0'],
                "etat"=> ['required','string'],
                "annee"=> ['required','integer','min:1970', 'max:2050'],
                "kilometrage"=> ['required','integer','min:0'],
                "couleur"=> ['required','string'],
                "carburant"=> ['required','string'],

                "specifications_moteur"=> ['required','array'],
                "specifications_exterieures"=> ['required','array'],
                "specifications_interieures"=> ['required','array'],
                "specifications_capacites"=> ['required','array'],
                "options_additionnelles"=> ['nullable','array'],

                "main_image"=>['nullable', 'image','max:5000'],
                "images"=>['nullable', 'array' ,'max:3'],
                "images.*"=>['nullable', 'image' ,'max:5000'],
            ]);

            $voiture = Voiture::withTrashed()->whereId($id)->first();
            $inputs = [];
            foreach ($validate as $input_key => $input_value) {
                if(isset($validate[$input_key]) && gettype($validate[$input_key]) === 'array'){
                    //filter empty or null values for each item in this input array
                    //['k'=>'v' , 'a' => null ] -----> 'k' will pass  but 'a' will not
                    $filtered_array = array_filter($validate[$input_key], function ($value) {
                        return $value !== '' && $value !== null;
                    }); 
                    
                    $inputs[$input_key] = json_encode($filtered_array);
                }else if(isset($validate[$input_key])){
                    $inputs[$input_key] = $validate[$input_key];
                }
            }

            $voiture->update($inputs);
            if(isset($validate['main_image'])){
                $old_main_image = $voiture->images()->where('main',true)->first();
                //delete old main image
                if($old_main_image){
                    Storage::delete($old_main_image->path);
                    $old_main_image->delete();
                }
                //save new main image
                $path = Storage::putFile("voitures", $request->file('main_image'));
                $voiture->images()->save(new Image(['path'=>$path , 'main'=>true]));
            }
            if(isset($validate['images'])){
                $old_images = $voiture->images()->where('main',false)->get();
                //delete old other images
                if($old_images->isNotEmpty()){
                    foreach ($old_images as $old_image) {
                        Storage::delete($old_image->path);
                        $old_image->delete();
                    }
                }
                //save new images
                foreach($request->file('images') as $image){
                    $path = Storage::putFile("voitures", $image);
                    $voiture->images()->save(new Image(['path'=>$path]));
                }
            }

            DB::commit();
            return redirect()->back()->with('success','la voiture a été modifiée avec succès!!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé avec la modification de la voiture");
        }
    }

    /**
     * Show the list of soft deleted resources.
     */
    public function archived()
    {
        try {
            $validate=request()->validate([
                "type"=> ['nullable','string'],
                "transmission"=>  ['nullable','string'],
                "marque"=>  ['nullable','string'],
                "model"=>  ['nullable','string'],
                "prix_min"=>  ['nullable','integer','min:0'],
                "prix_max"=> ['nullable','integer','min:0'],
                "etat"=> ['nullable','string'],
                "annee_min"=> ['nullable','integer','min:2000', 'max:2050'],
                "annee_max"=> ['nullable','integer','min:2000' , 'max:2050'],
                "kilometrage_min"=> ['nullable','integer','min:0'],
                "kilometrage_max"=> ['nullable','integer','min:0'],
                "couleur"=> ['nullable','string'],
                "carburant"=> ['nullable','string'],
            ]);

            if(empty($validate)){
                $voitures = Voiture::onlyTrashed()
                            ->with(['images' => function ($query) {
                                $query->where('main', true);
                            }])
                            ->paginate(6)->withQueryString();
                return view('pages.dashboard.voitures_archivees',compact('voitures'));
            }

            $voitures = Voiture::query()
                        ->when(isset($validate['type']),function($query) use ($validate){
                            $query->where('type' , $validate['type']) ;
                        })
                        ->when(isset($validate['transmission']),function($query) use ($validate){
                            $query->where('transmission' , $validate['transmission']) ;
                        })
                        ->when(isset($validate['marque']),function($query) use ($validate){
                            $query->where('marque' , $validate['marque']) ;
                        })
                        ->when(isset($validate['prix_min']),function($query) use ($validate){
                            $query->where('prix','>=' , $validate['prix_min']) ;
                        })
                        ->when(isset($validate['prix_max']),function($query) use ($validate){
                            $query->where('prix' ,'<=' , $validate['prix_max']) ;
                        })

                        ->when(isset($validate['etat']),function($query) use ($validate){
                            $query->where('etat' , $validate['etat']) ;
                        })
                        ->when(isset($validate['annee_min']),function($query) use ($validate){
                            $query->where('annee','>=' , $validate['annee_min']) ;
                        })
                        ->when(isset($validate['annee_max']),function($query) use ($validate){
                            $query->where('annee','<=' , $validate['annee_max']) ;
                        })
                        ->when(isset($validate['kilometrage_min']),function($query) use ($validate){
                            $query->where('kilometrage','>=' , $validate['kilometrage_min']) ;
                        })
                        ->when(isset($validate['kilometrage_max']),function($query) use ($validate){
                            $query->where('kilometrage' ,'<=', $validate['kilometrage_max']) ;
                        })
                        ->when(isset($validate['couleur']),function($query) use ($validate){
                            $query->where('couleur' , $validate['couleur']) ;
                        })
                        ->when(isset($validate['carburant']),function($query) use ($validate){
                            $query->where('carburant' , $validate['carburant']) ;
                        });
            $voitures = $voitures->onlyTrashed()
                        ->with(['images' => function ($query) {
                            $query->where('main', true);
                        }])
                        ->paginate(6)->withQueryString();
            return view('pages.dashboard.voitures_archivees',compact('voitures'));

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé");
        }
    }

    /**
     * soft delete the specified resource.
     */
    public function archive(string $id)
    {
        try {
            Voiture::destroy($id);
            return response('la voiture a été archivée avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec l'archivation de la voiture",500);
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
            Voiture::whereIn('id', $request->input('ids'))->delete();
            return response('les voitures sélectionnées ont été archivées avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec l'archivation des voitures!",500);
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
            $voitures = Voiture::onlyTrashed()->whereIn('id', $request->input('ids'))->get();
            //delete the cars
            $voitures->each->restore();
            return response('les voitures sélectionnées ont été republiées avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la republications des voitures!",500);
        }
    }

    /**
     * restore the specified resource.
     */
    public function restore(string $id)
    {
        try {
            Voiture::onlyTrashed()->whereid($id)->restore();
            return response('la voiture a été republiée avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la republication de la voiture",500);
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
            //get selected cars
            $voitures = Voiture::withTrashed()->whereIn('id', $request->input('ids'))->get();
            //delete the images files from the storage 
            foreach ($voitures as $voiture) {
                foreach ($voiture->images as $image) {
                    if(Storage::exists($image->path)){
                        Storage::delete($image->path);
                    }
                }
            }
            //delete the cars
            $voitures->each->forceDelete();
            return response('les voitures sélectionnées ont été supprimées avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la suppression des voitures!",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        try {
            //get the car
            $voiture = Voiture::withTrashed()->whereId($id)->first();
            //delete the images files from the storage 
            foreach ($voiture->images as $image) {
                if(Storage::exists($image->path)){
                    Storage::delete($image->path);
                }
            }
            
            //delete the car
            $voiture->forceDelete();
            return response('la voiture a été supprimée avec success!');
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la suppression de la voiture", 500);
        }
    }


    /**
     * get recently created resources.
     */
    public static function getRecentlyPosted(){
        try {
            return Voiture::latest()->take(8)
                                    ->with(['images' => function ($query) {
                                        $query->where('main', true);
                                    }])
                                    ->get(['id','titre','prix', 'marque', 'annee', 'couleur', 'etat', 'type']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * get all the resources.
     */
    public static function getAll(){
        try {
            return Voiture::latest()->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}