<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class UserController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function index()
    {
        try {
            $user = auth()->user()->only(['email', 'name']);
            return view('pages.dashboard.account', compact('user'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé avec la modification des infos");
        }
    }

    /**
     * Update the user's profile information.
     */
    public function updatePersonalInfo(ProfileUpdateRequest $request)
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            return redirect()->back()->with('success','les informations ont été modifiées avec succès!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé avec la modification des infos");
        }
    }


    /**
     * Display the list of admins.
     */
    public function getList()
    {
        try {
            $admins = User::get();
            return view('pages.dashboard.admins' ,compact('admins'));
        } catch (\Throwable $th) {
            return view('pages.dashboard.admins')->withErrors("quelque chose s'est mal passé!");
        }
    }

    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('pages.dashboard.cree_admin');
        
    }

     /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            // return $request->input();
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'is_super_admin'=>['nullable', 'boolean'],
            ]);
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_super_admin'=> $request->is_super_admin,
            ]);
    
            return redirect()->back()->with('success',"l'admin a été crée avec succès!");
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("quelque chose s'est mal passé avec la creation d'admin!");
        }
        
    }


    /**
     * Display the edit page for this admin.
     */
    public function edit(string $id)
    {
        try {
            $admin = User::find($id);
            return view('pages.dashboard.modifier_admin' ,compact('admin'));
        } catch (\Throwable $th) {
            return view('pages.dashboard.modifier_admin')->withErrors("quelque chose s'est mal passé!");
        }
    }


    /**
     * Handle an incoming update request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function makeSuperAdmin(string $id)
    {
        try {
            
            $user = User::find($id);
            // if this admins is super admin throw and error
            if($user->is_super_admin){
                throw new Exception("Can't modify this admin");
            }
            $user->is_super_admin = true;
            
            $user->save();
            return response("l'admin a été transformée a super admin avec succès!");
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la transformation a super admin!",500);
        }
        
    }   


    /**
     * Remove the specified resource from database.
     */
    public function delete(string $id)
    {
        try {
            $user = User::find($id);
            // if this admins is super admin throw and error
            if($user->is_super_admin){
                throw new Exception("Can't delete this admin");
            }
            //if not super admin then delete 
            $user->delete();
            return response("l'admin a été supprimée avec success!");
        } catch (\Throwable $th) {
            return response("quelque chose s'est mal passé avec la suppression de l'admin", 500);
        }
    }








}
