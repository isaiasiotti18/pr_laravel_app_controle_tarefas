<?php

namespace App\Http\Controllers;

use App\Mail\NovaTarefa;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TarefaController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {

    $user_id = auth()->user()->id;

    $tarefas = Tarefa::where('user_id', $user_id)
      ->get();

    return view('tarefa.index', [
      "tarefas" => $tarefas
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('tarefa.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    $user = auth()->user();

    $tarefaDados = array_merge(
      $request->only("tarefa", "data_limite"),
      ["user_id" => $user->id]
    );

    $tarefa = Tarefa::create($tarefaDados);

    Mail::to($user->email)->send(new NovaTarefa($tarefa));

    return to_route('tarefa.show', [
      "tarefa" => $tarefa
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Tarefa $tarefa)
  {
    return view('tarefa.show', [
      "tarefa" => $tarefa
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Tarefa $tarefa)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Tarefa $tarefa)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tarefa $tarefa)
  {
    //
  }
}
