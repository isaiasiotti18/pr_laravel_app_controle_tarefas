<?php

namespace App\Exports;

use App\Models\Tarefa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TarefaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return auth()->user()->tarefas()->get();
    }

    public function headings(): array {
      return ['id tarefa', 'id usuário', 'tarefa', 'data limite', 'data criação', 'data atualização'];
    }

    public function map($tarefa): array {
      return [
        $tarefa->id,
        $tarefa->user_id,
        $tarefa->tarefa,
        date('d/m/Y', strtotime($tarefa->data_limite)),
        date('d/m/Y', strtotime($tarefa->created_at)),
        date('d/m/Y', strtotime($tarefa->updated_at)),
      ];
    }
}
