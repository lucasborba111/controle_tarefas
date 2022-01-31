@extends('layouts.app')

@section('content')
    @auth
    <h5 style="text-align: center">Bem vindo novamente, vamos nos organizar?</h5>
    @endauth

    @guest 
        <h5 style="text-align: center">Bem vindo visitante, para acessar aos recursos da aplicação você pode se cadastrar!</h5>
    @endguest
@endsection