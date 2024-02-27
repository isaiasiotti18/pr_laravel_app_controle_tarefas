<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Mail\NovaTarefa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\TarefaExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel as Exc;

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
      ->paginate(5);

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
    return view('tarefa.edit', [
      "tarefa" => $tarefa
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Tarefa $tarefa)
  {
    $user_id = auth()->user()->id;

    Tarefa::where('user_id', $user_id)
      ->where('id', $tarefa->id)
      ->update($request->only('tarefa', 'data_limite'));

    return to_route('tarefa.show', $tarefa->id);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tarefa $tarefa)
  {
    $user_id = auth()->user()->id;

    Tarefa::where('user_id', $user_id)
      ->where('id', $tarefa->id)
      ->delete();

    return to_route('tarefa.index')->with('success', 'Tarefa excluida.');
  }

  public function export($extensao) {
    $now = time();
    if(in_array($extensao, ['xlsx', 'csv', 'pdf'])) {
      return Exc::download(new TarefaExport(), "lista_tarefas_$now.$extensao");

    }

    return redirect()->route('tarefa.index');
  }

  public function exportPDF() {
    $now = time();

    $tarefas = auth()->user()->tarefas()->get();

    $pdf = PDF::loadView('tarefa.pdf', [
      "tarefas" => $tarefas
    ]);

    $pdf->setPaper('a4', 'landscape');

    return $pdf->stream("lista_tarefas_$now.pdf");
  }
}
