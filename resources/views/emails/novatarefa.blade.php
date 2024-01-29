<x-mail::message>
# Nova Tarefa {{ $tarefa }}

<br>

## Uma nova tarefa foi registrada.

<br>

### Acesse a mesma através do link abaixo

<br>

Data para finaliza-la: {{ $data_limite }}

<br>

<x-mail::button :url="$url">
Conferir Tarefa
</x-mail::button>

Obrigado,<br>

<br>

Email Automático de Tarefas Digitais.

</x-mail::message>
