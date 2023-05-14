<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoitureController;
use App\Models\Message;
use App\Models\User;
use App\Models\Voiture;
use Illuminate\Support\Facades\Route;
use App\Models\Test;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    try {
        $voitures = VoitureController::getRecentlyPosted();
        return view('pages.guest.accueil', compact('voitures'));
    } catch (\Throwable $th) {
        return view('pages.guest.accueil')->withErrors('something went wrong!');
    }
})->name('accueil');



// show the car listings page
Route::get('voitures',[VoitureController::class, 'index'] )->name('voitures.index');
//show the car details page
Route::get('voitures/{voiture}',[VoitureController::class, 'show'] )->name('voitures.show');
// show about page
Route::get('/apropos', function(){
    return view('pages.guest.apropos');
})->name('apropos');
// show contact page
Route::get('/contact', function(){
    return view('pages.guest.contact');
})->name('contact');
Route::get('/mentions_legales', function(){
    return view('pages.guest.mentions_legales');
})->name('mentions_legales');

//store message from contact page
Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');

//get image files
Route::get('images/voitures/{path}',[ImageController::class ,'getCarImage'] )->name('voiture_image');

Route::post('test',  function (Request $request) {
    return response( $request->input());
});


//all these route are protected by the auth middlware
Route::middleware('auth')->group(function () {

    //all these routes begin with admins/ , and their names begin with admins 
    Route::prefix('admins')->name('admins.')->group(function () {
        //update the personal info of this auth user (this admin)
        Route::patch('/update_personal_info', [UserController::class, 'updatePersonalInfo'])->name('update_personal_info');
        
        //update the personal info of this auth user (this admin)
        Route::patch('/update', [UserController::class, 'updatePersonalInfo'])->name('update_personal_info');
        

        //these routes are only accessible by super admins
        Route::middleware('super_admin')->group(function () {
            //create new any admin
            Route::post('/store', [UserController::class, 'store'])->name('store');

            //update the personal info of this auth user
            Route::post('make_super_admin/{admin}', [UserController::class, 'makeSuperAdmin'])->name('make_super_admin');

            //delete admin
            Route::delete('/{admin}', [UserController::class, 'delete'])->name('delete');
        });

    });

    //all these routes begin with voitures/ , and their names begin with voitures 
    Route::prefix('voitures')->name('voitures.')->group(function () {
        //create car
        Route::post('/',[VoitureController::class, 'store'] )->name('store');


        // bulk archive cars
        Route::post('/bulk_archive',[VoitureController::class, 'bulkArchive'] )->name('bulk_archive');
        // bulk restore cars
        Route::post('/bulk_restore',[VoitureController::class, 'bulkRestore'] )->name('bulk_restore');
        // bulk delete cars
        Route::post('/bulk_delete',[VoitureController::class, 'bulkDelete'] )->name('bulk_delete');

        //create car
        Route::put('/{voiture}',[VoitureController::class, 'update'] )->name('update');
        // archive car
        Route::post('/{voiture}',[VoitureController::class, 'archive'] )->name('archive');
        // restore car
        Route::post('/{voiture}/restore',[VoitureController::class, 'restore'] )->name('restore');
        // delete car
        Route::delete('/{voiture}',[VoitureController::class, 'delete'] )->name('delete');
    });

    //all these routes begin with messages/ , and their names begin with messages 
    Route::prefix('messages')->name('messages.')->group(function () {
        //create message
        Route::post('/',[MessageController::class, 'store'] )->name('store');

        // bulk archive messages
        Route::post('/bulk_archive',[MessageController::class, 'bulkArchive'] )->name('bulk_archive');
        // bulk restore messages
        Route::post('/bulk_restore',[MessageController::class, 'bulkRestore'] )->name('bulk_restore');
        // bulk delete messages
        Route::post('/bulk_delete',[MessageController::class, 'bulkDelete'] )->name('bulk_delete');


        // archive message
        Route::post('/{message}',[MessageController::class, 'archive'] )->name('archive');
        // restore message
        Route::post('/{message}/restore',[MessageController::class, 'restore'] )->name('restore');
        // delete message
        Route::delete('/{message}',[MessageController::class, 'delete'] )->name('delete');
    });

    //all these routes begin with dashboard/ , and their names begin with dashboard 
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        //get dashboard index page, route:  /dashboard
        Route::get('/', function () {
            try {
                $voitures_count = Voiture::all()->count();
                $messages_count = Message::all()->count();
                $admins_count = User::all()->count();
                return view('pages.dashboard.index', compact('voitures_count','messages_count','admins_count'));
            } catch (\Throwable $th) {
                return view('pages.dashboard.index')->withErrors("quelque chose s'est mal passé!");
            }
        })->name('index');
    
        //get dashboard cars page, route:  /dashboard/voitures
        //full route name: dashboard.voitures
        Route::get('/voitures', [VoitureController::class , 'getDashboardCars'])->name('voitures');
        
        //get dashboard archived cars page, route:  /dashboard/voitures/archive
        //full route name: dashboard.voitures.archived
        Route::get('/voitures/archived', [VoitureController::class , 'archived'])->name('voitures.archived');
    
        //get dashboard car creation page, route: /dashboard/voitures/create
        //full route name: dashboard.voitures.create
        Route::get('/voitures/create', [VoitureController::class , 'create'])->name('voitures.create'); 

        //get dashboard car edit page, route: /dashboard/voitures/$voiture_id/edit
        //full route name: dashboard.voitures.edit
        Route::get('/voitures/{voiture}/edit',  [VoitureController::class , 'edit'])->name('voitures.edit'); 


        //get dashboard my account page, route:  /dashboard/account
        //full route name: dashboard.account
        Route::get('/account', [UserController::class, 'index'])->name('account');

        //get dashboard messages list page, route:  /dashboard/messages
        //full route name: dashboard.messages
        Route::get('/messages', [MessageController::class, 'index'])->name('messages');

        //get dashboard my account page, route:  /dashboard/messages/archived
        //full route name: dashboard.messages.archived
        Route::get('/messages/archived', [MessageController::class, 'archived'])->name('messages.archived');

         //get dashboard message show page, route:  /dashboard/messages
        //full route name: dashboard.messages.show
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');

        //these routes are only accessible by super admins
        Route::middleware('super_admin')->group(function () {
            //get dashboard  admins list page, route:  /dashboard/admins
            //full route name: dashboard.admins
            Route::get('/admins', [UserController::class, 'getList'])->name('admins');

            
            //get dashboard admins create page, route:  /dashboard/admins/create
            //full route name: dashboard.admins.create
            Route::get('/admins/create', [UserController::class, 'create'])->name('admins.create');

        });
        
    });

    
});








Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
