@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Tarefa Número: {{ $tarefa->id }}
            <a href="{{ route('tarefa.index') }}" class="float-end">Voltar</a>
          </div>
          <div class="card-body">
            <div class="mb-3">

              <div id="" class="form-text">
                <h2>Tarefa: {{ $tarefa->tarefa }}</h2>
              </div>

              <br>

              <h4>Concluir até: {{ date('d/m/Y', strtotime($tarefa->data_limite)) }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
