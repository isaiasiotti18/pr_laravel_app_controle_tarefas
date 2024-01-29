@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Adicionar Tarefa') }}</div>

          <div class="card-body">
            <form method="post" action="{{ route('tarefa.store') }}">
              @csrf
              <div class="mb-3">
                <label for="tarefa" class="form-label">Tarefa</label>
                <input name="tarefa" type="text" class="form-control" id="tarefa">
                <div id="" class="form-text"></div>
              </div>

              <div class="mb-3">
                <label for="data_limite" class="form-label">Data Limite</label>
                <input name="data_limite" type="date" class="form-control" id="data_limite">
                <div id="" class="form-text"></div>
              </div>

              <button type="submit" class="btn btn-primary">Adicionar Nova Tarefa</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
