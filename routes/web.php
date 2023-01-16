<?php

use Illuminate\Support\Facades\Route;
use App\Models\Car;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return 'halloooo';
// });


Route::resource('cars', CarController::class);

// configure our database
// create a migration
// create a model 


Route::get('/test-create', function () {
   $car =  Car::create([
        'model' => 'Leef',
        'year' => 2020
    ]);

    return $car;
});




// - view all cars
Route::get('/cars', function () {
    $cars = Car::all();
    return view('cars',['cars' => $cars]);
});



//   create a car (show a form)

Route::get('/cars/create', function () {
    return view('car-create');
});



//  create a car (process the form)

Route::post('/cars', function () {
    $data = request()->all();
    $car = Car::create($data);
    return redirect()->route('car', ['car' => $car]);
})->name('cars');




//   view a single car

// Route::get('/cars/{model}', function ($model) {
//     $car = Car::whereModel($model)->firstOrFail();
//     return view('car', compact('car'));
// });

Route::get('/cars/{car:model}', function (Car $car) {
    return view('car', compact('car'));
})->name('car');





//  - edit/update a car (view the form)

//Route::get('/cars/{model}', function ($model) {});


// -  edit/update a car (process the form) 

Route::patch('/cars/{car:model}', function (Car $car) {
    $car->fill(request()->all());
    $car->save();

    return redirect()->route('car', ['car' => $car]);

});

//  - delete a car

Route::delete('/cars/{car:model}', function (Car $car) {
    $car->delete();
    return redirect()->route('cars');
});
