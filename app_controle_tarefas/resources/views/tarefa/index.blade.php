@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Tarefa <a href="{{route('tarefa.create')}}" class="float-right">Novo</a></div>
                       
                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Titulo</th>
                            <th scope="col">Data limite de conclusão</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($tarefa as $item => $t)
                          <tr>
                            <td>{{$t->tarefa}}</td>
                            <td>{{date('d/m/Y', strtotime($t->data_limite_conclusao))}}</td>
                            <td><a href="{{route('tarefa.edit', $t->id)}}">Editar</a></td>
                            <td>
                                <form id="form_{{$t['id']}}" method="post" action="{{route('tarefa.destroy', ['tarefa'=>$t['id']])}}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <a href="#" onclick="document.getElementById('form_{{$t['id']}}').submit()">Excluir</a>

                            </td>

                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item"><a class="page-link" href="{{$tarefa->previousPageUrl()}}">Previous</a></li>
                          @for($i = 1; $i<=$tarefa->lastPage();$i++)
                          <li class="page-item {{$tarefa->currentPage()==$i ? 'active' : ''}}"><a class="page-link" href="{{$tarefa->url($i)}}">{{$i}}</a></li> 
                          @endfor
                          <li class="page-item"><a class="page-link" href="{{$tarefa->nextPageUrl()}}">Next</a></li>
                        </ul>
                      </nav>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
