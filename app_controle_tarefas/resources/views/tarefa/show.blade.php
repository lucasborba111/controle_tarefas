@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefa: {{$tarefa->tarefa}}</div>
                       
                <div class="card-body">
                      {{$tarefa->tarefa}} {{$tarefa->data_limite_conclusao}}
                      <a href="{{url()->previous()}}">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
