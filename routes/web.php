<?php

use App\Http\Controllers\buildingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\EntretienController;
use App\Http\Controllers\EntretienPdfController;
use App\Http\Controllers\MachineImageController;


use Illuminate\Support\Facades\Route;

Route::get("/", [ConnexionController::class, "index"])->name("connexion");


Route::post('/sign-in', [ConnexionController::class, "auth"])->name("log-in");

Route::get("/home", [ClientController::class, "index"])->name("clients.index")->middleware("Auth");

Route::post("/client-store", [ClientController::class, "store"])->name("clients.store")->middleware("Auth");

Route::get("/client-edit/{id}", [ClientController::class, "edit"])->name("clients.edit")->middleware("Auth");

Route::post("/client-update", [ClientController::class, "update"])->name("clients.update")->middleware("Auth");

Route::post("/client-destroy", [ClientController::class, "destroy"])->name("clients.destroy")->middleware("Auth");


Route::get("/{client}/buildings", [buildingController::class, "index"])->name("buildings.index")->middleware("Auth");

Route::post("/buidling-store", [buildingController::class, "store"])->name("buildings.store")->middleware("Auth");

Route::get("/buidling-edit/{id}", [buildingController::class, "edit"])->name("buildings.edit")->middleware("Auth");

Route::post("/buidling-update", [buildingController::class, "update"])->name("buildings.update")->middleware("Auth");

Route::post("/buidling-destroy", [buildingController::class, "destroy"])->name("buildings.destroy")->middleware("Auth");

Route::get("/{buildings}/machine", [MachineController::class, "index"])->name("machines.index")->middleware("Auth");

Route::post("/machine-store", [MachineController::class, "store"])->name("machines.store")->middleware("Auth");

Route::get("/machine-edit/{id}", [MachineController::class, "edit"])->name("machines.edit")->middleware("Auth");

Route::post("/machine-update", [MachineController::class, "update"])->name("machines.update")->middleware("Auth");

Route::post("/machine-destroy", [MachineController::class, "destroy"])->name("machines.destroy")->middleware("Auth");

Route::post("/image-store", [ImageController::class, "store"])->name("images.store")->middleware("Auth");


Route::get("/{buildings}/entretiens", [EntretienController::class, "index"])->name("entretien.index")->middleware("Auth");
Route::get("/{buildings}/create", [EntretienController::class, "create"])->name("entretien.create")->middleware("Auth");
Route::post('/signature', [EntretienController::class, 'store'])->name('entretien.store')->middleware("Auth");


Route::get('/{buildings}/entretiens/edit', [EntretienController::class, 'edit'])->name('entretiens.edit');
Route::put('/{buildings}/entretiens', [EntretienController::class, 'update'])->name('entretiens.update');
Route::delete('/{buildings}/entretiens', [EntretienController::class, 'destroy'])->name('entretiens.destroy');


Route::get('/entretiens/{id}/pdf', [EntretienPdfController::class, 'generate'])->name('entretien.pdf');


// Voir les images
Route::get('/machines/{id}/images', [MachineImageController::class, 'index'])->name('machines.images');

// Ajouter une image
Route::post('/machines/{id}/images', [MachineImageController::class, 'store'])->name('machines.images.store');

// Supprimer une image
Route::delete('/machine-images/{id}', [MachineImageController::class, 'destroy'])->name('machines.images.destroy');

Route::delete('/entretien-images/{id}', [EntretienImageController::class, 'destroy'])->name('entretien.images.destroy');





