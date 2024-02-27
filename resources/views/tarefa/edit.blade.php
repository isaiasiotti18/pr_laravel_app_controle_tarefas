@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            {{ __('Editar Tarefa') }}
            <a href="{{ url()->previous() }}" class="float-end">Voltar</a>
          </div>

          <div class="card-body">
            <form method="post" action="{{ route('tarefa.update', $tarefa->id) }}">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="tarefa" class="form-label">Tarefa</label>
                <input name="tarefa" type="text" class="form-control" id="tarefa" value="{{ $tarefa->tarefa }}">
                <div id="" class="form-text"></div>
              </div>

              <div class="mb-3">
                <label for="data_limite" class="form-label">Data Limite</label>
                <input name="data_limite" type="date" class="form-control" id="data_limite" value="{{ $tarefa->data_limite }}">
                <div id="" class="form-text"></div>
              </div>

              <button type="submit" class="btn btn-primary">Editar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
