<?php

use App\Http\Controllers\CandidatConcoursController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//     return view('welcome');
// });

Auth::routes();


Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/vote/{candidat}', [VoteController::class, 'create'])->name('vote.create');
Route::post('/vote/{candidat}', [VoteController::class, 'store'])->name('vote.store');

Route::get('/vote/{id}', [VoteController::class, 'create'])->name('vote');
Route::post('/vote/{id}', [VoteController::class, 'store']);


Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
// Route::get('/candidats/create', [CandidatController::class, 'create'])->name('candidats.create');
Route::get('/candidat', [App\Http\Controllers\CandidatsController::class, 'index'])->name('candidat.index');
Route::get('/candidat/create', [App\Http\Controllers\CandidatsController::class, 'create'])->name('candidat.create');
Route::get('/video/{id}', [CandidatsController::class, 'video'])->name('video');
Route::post('/candidat', [CandidatsController::class, 'store'])->name('candidats.store');
Route::post('/candidat', [CandidatsController::class, 'create'])->name('candidats.create');
Route::post('/etablissement', [EtablissementController::class, 'store'])->name('etablissements.store');
Route::post('/voter/{id}', [App\Http\Controllers\CandidatsController::class, 'voter'])->name('voter');

Route::get('/transactions', [App\Http\Controllers\TransactionsController::class, 'index'])->name('transactions.index');
Route::get('/transactions/store', [App\Http\Controllers\TransactionsController::class, 'store'])->name('transactions.store');
Route::get('/transactions/create', [App\Http\Controllers\TransactionsController::class, 'create'])->name('transactions.create');

Route::get('/candidat/filter', 'CandidatsController@filter')->name('candidat.filter');

Route::get('/results', 'ResultsController@index')->name('results');

Route::get('candidat/retry', 'CandidatsController@retry')->name('candidat.retry');



Route::resource('election', 'App\Http\Controllers\ElectionsController');
Route::get('/election', [App\Http\Controllers\ElectionsController::class, 'index'])->name('election.index');
Route::get('/election/create', [App\Http\Controllers\ElectionsController::class, 'create'])->name('election.create');
Route::get('/election/store', [App\Http\Controllers\ElectionsController::class, 'store'])->name('election.store');
Route::get('/election/{id}/edit', [App\Http\Controllers\ElectionsController::class, 'edit'])->name('election.edit');

Route::get('/etablissement', [EtablissementController::class, 'index'])->name('etablissement.index');
Route::get('/etablissement/create', [App\Http\Controllers\EtablissementController::class, 'create'])->name('etablissement.create');
Route::get('/etablissement/{id}/edit', [App\Http\Controllers\EtablissementController::class, 'edit'])->name('etablissement.edit');

Route::get('/candidat_concours', [CandidatConcoursController::class, 'index'])->name('candidat_concours.index');
Route::get('/candidat_concours/create', [CandidatConcoursController::class, 'create'])->name('candidat_concours.create');
Route::get('/candidat_concours/filtre', [CandidatConcoursController::class, 'filtre'])->name('candidat_concours.filtre');
Route::get('/candidat_concours/export/excel', [CandidatConcoursController::class, 'exportExcel'])->name('candidat_concours.export.excel');
Route::get('/candidat_concours/export/pdf', [CandidatConcoursController::class, 'exportPdf'])->name('candidat_concours.export.pdf');

Route::get('/candidat/{id}/edit', [App\Http\Controllers\CandidatsController::class, 'edit'])->name('candidat.edit');


Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about.index');
Route::post('/about', [App\Http\Controllers\AboutController::class, 'update'])->name('about.update');

Route::post('/candidat/store', [App\Http\Controllers\CandidatsController::class, 'store'])->name('candidat.store');

Route::get('/candidat_examen', [App\Http\Controllers\CandidatExamenController::class, 'index'])->name('candidat_examen.index');
Route::post('/candidat-examen/submit', [App\Http\Controllers\CandidatExamenController::class, 'submit'])->name('candidatExamentController.submit');
Route::post('/candidat-examen/store', [App\Http\Controllers\CandidatExamenController::class, 'store'])->name('candidatExamentController.store');
Route::post('/candidat-exament/ticket', [App\Http\Controllers\CandidatExamenController::class, 'ticket'])->name('candidatExamentController.ticket');

Route::post('/candidat_payment/store', [App\Http\Controllers\PaiementsController::class, 'store'])->name('PaiementsController.store');
// Route::get('/qrcode', [QrCodeController::class, 'index']);

// Route::get('/about', function () {
//     return view('about');
// })->name('about');

Route::get('/candidat_exament', function () {
    return view('candidat_exament');
})->name('candidat_exament');

Route::get('/ticket', function () {
    return view('ticket');
})->name('ticket');

Route::get('/ticket_egcim', function () {
    return view('ticket_egcim');
})->name('ticket_egcim');



