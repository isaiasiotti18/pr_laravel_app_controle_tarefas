<?php

use App\Mail\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefaController;

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

Route::get('/', function () {
  return view('welcome');
});

Auth::routes(['verify' => true]);

Route::prefix('/')->group(function () {

  Route::get('tarefa/export/{extensao}', [TarefaController::class, 'export'])->name('tarefa.export');

  Route::get('tarefa/exportPDF', [TarefaController::class, 'exportPDF'])->name('tarefa.exportPDF');

  Route::resource('tarefa', TarefaController::class);

  Route::get('mail-message', function () {
    Mail::to('contatocomercial@isaiassantosdev.com.br')
      ->send(new MailMessage());
    return 'E-mail enviado com sucesso';
  });
});
