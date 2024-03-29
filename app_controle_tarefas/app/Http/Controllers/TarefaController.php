<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class TarefaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user()->id;
        $tarefas = Tarefa::where('user_id', $usuario)->paginate(10);
        return view('tarefa.index', ['tarefa'=>$tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = auth()->user()->id;
        $tarefa = Tarefa::create($dados);
        $user_email = auth()->user()->email;
        Mail::to($user_email)->send(new NovaTarefaMail($tarefa));
        return redirect()->route('tarefa.show', ['tarefa'=>$tarefa]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa'=>$tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        $usuario = auth()->user()->id;
        if($tarefa->user_id == $usuario){
            return view('tarefa.edit', ['tarefa'=>$tarefa]);
        }
        else{
            return view('acesso-negado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $usuario = auth()->user()->id;
        if($tarefa->user_id == $usuario){
            $tarefa->update($request->all());
        }
        else{
            return view('acesso-negado');
        }
        return redirect()->route('tarefa.show', ['tarefa'=>$tarefa->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        $usuario = auth()->user()->id;
        if($tarefa->user_id == $usuario){
            $tarefa->delete();
            return redirect()->route('tarefa.index');
        }
        else{
            return view('acesso-negado');
        }

    }
    public function export($extensao){
        if(in_array($extensao, ['xlsx','pdf','csv'])){
            return Excel::download(new TarefasExport, 'lista_de_tarefas.'.$extensao);
        }       
            return redirect()->route('tarefa.index');
    }
}
