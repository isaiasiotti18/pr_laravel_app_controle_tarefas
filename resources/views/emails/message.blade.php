<x-mail::message>
# Olá, tudo bem?

Se você esta recebendo este email, <b>significa que:</b>

você quer ser um dos beta testers que testará nossa aplicação.

Muito simples, basta clicar no link abaixo e preencher o formulário.

<x-mail::button :url="''">
ACESSAR FORMULÁRIO.
</x-mail::button>

Caso o seu acesso seja aprovado,
você receberá um link para acessar nosso sistema.

Obrigado, e até mais!

<br>

{{ config('app.name') }}
</x-mail::message>
