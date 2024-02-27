@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Tarefas
            <a href="{{ route('tarefa.create') }}" class="float-end text-decoration-none">
              &nbsp;&nbsp;Novo&nbsp;&nbsp;
            </a>

            <a href="{{ route('tarefa.export', 'xlsx') }}" class="float-end text-decoration-none">
              &nbsp;&nbsp;Gerar XLSX&nbsp;&nbsp;|
            </a>

            <a href="{{ route('tarefa.export', 'csv') }}" class="float-end text-decoration-none">
              &nbsp;&nbsp;Gerar CSV&nbsp;&nbsp;|
            </a>

            <a href="{{ route('tarefa.export', 'pdf') }}" class="float-end text-decoration-none">
              &nbsp;&nbsp;Gerar PDF&nbsp;&nbsp;|
            </a>

            <a href="{{ route('tarefa.exportPDF') }}" class="float-end text-decoration-none" target="_blank">
              &nbsp;&nbsp;PDF V2&nbsp;&nbsp;|
            </a>

          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tarefa</th>
                  <th scope="col">Limite</th>
                  <th colspan="2" class="mx-auto">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tarefas as $tarefa)
                  <tr>
                    <td>{{ $tarefa->id }}</td>
                    <td>{{ $tarefa->tarefa }}</td>
                    <td>{{ date('d/m/Y', strtotime($tarefa->data_limite)) }}</td>
                    <td>
                      <a href="{{ route('tarefa.edit', $tarefa->id) }}">
                        Editar
                      </a>
                    </td>
                    <td>
                      <form id="form_{{$tarefa->id}}" method="POST" action="{{ route('tarefa.destroy', $tarefa->id) }}">
                        @csrf
                        @method('DELETE')
                      </form>
                      <a
                        href="#"
                        onclick="document.getElementById('form_{{$tarefa->id}}').submit()"
                      >
                        Excluir
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <nav class="mx-auto" aria-label="Paginação das Tarefas.">
              <ul class="pagination">

                <li class="page-item"><a class="page-link" href="{{ $tarefas->previousPageUrl() }}">
                  Voltar
                </a></li>

                @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                  <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $tarefas->url($i) }}">
                      {{ $i }}
                    </a>
                  </li>
                @endfor

                <li class="page-item"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">
                  Avançar
                </a></li>

              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
