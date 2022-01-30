@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Tarefa</div>
                       
                <div class="card-body">
                  @foreach ($tarefa as $item)
                      {{$item->tarefa}} {{$item->data_limite_conclusao}}<br>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
