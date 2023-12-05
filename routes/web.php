<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\DiffusionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StatistiqueController;

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
//login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/validation', [LoginController::class, 'checkUser'])->name('validation');
//deconnexion
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//
Route::get('/index', [ClientController::class, 'index'])->name('index');
//societe
Route::get('/list_societe', [ClientController::class, 'voirListeSociete'])->name('list_societe');
Route::get('/ajouter_societe', [ClientController::class, 'ajouterSociete'])->name('ajouter_societe');
Route::get('/insert_societe', [ClientController::class, 'insertSociete'])->name('insert_societe');
Route::get('delete_societe/{id}', [ClientController::class, 'deleteSociete'])->name('delete_societe');
//client particulier
Route::get('/list_client', [ClientController::class, 'voirListeClient'])->name('list_client');
Route::get('/ajouter_client', [ClientController::class, 'ajouterClient'])->name('ajouter_client');
Route::get('/insertClient', [ClientController::class, 'insertClient'])->name('insertClient');
Route::get('delete_client/{id}', [ClientController::class, 'deleteClient'])->name('deleteClient');
//facturation
Route::get('ajouter_facture/{id}', [FactureController::class, 'voir_page_facture'])->name('ajouter_facture');
Route::get('/facturation', [FactureController::class, 'PDF_facture'])->name('facturation');
Route::get('/facturation_particulier', [FactureController::class, 'PDF_facture_particulier'])->name('facturation_particulier');
//diffusion
Route::get('/diffusion', [DiffusionController::class, 'index'])->name('diffusion');
Route::get('/ajouter_diffusion', [DiffusionController::class, 'ajouterClient'])->name('ajouter_diffusion');
Route::get('/insertDiffusion', [DiffusionController::class, 'insertDiffusion'])->name('insertDiffusion');
//statistique
Route::get('/statistique', [StatistiqueController::class, 'home'])->name('statistique');
