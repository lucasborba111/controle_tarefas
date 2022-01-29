@component('mail::message')
# Introdução

O corpo da mensagem

@component('mail::button', ['url' => ''])
Botão de texto Url
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
