<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$res = DB::table('actions')->get();
       //$string = '';
       //foreach($res as $action){
       //    $string .= sprintf('%s: %s <br>', $action->id,$action->name);
       //}
       //return $string;

       $actions = DB::table('actions')->get();
       $subHeading = 'Все действия';

       $route = route('actions.create');

      


       $actions = $actions->map(function ($action){
           $action->routeDelete = route('actions.destroy', $action->id);
           $action->routeEdit = route('actions.edit', $action->id);
          // $action->routeCreate = route('actions.create', $action->name);
           return $action;
     
       } );

       return view('actions.index', [
           'actions' => $actions,
           'route' =>$route,
           'subHeading' => $subHeading,  
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $subHeading = 'Добавление действия';
       $action = route('actions.store');
       return view('actions.create', [ 
           'subHeading' => $subHeading,
           'action' => $action,
       ]);
       
       
        //$name = $request->query('name');
       //$isSucces =DB::insert('insert into actions (name) values(?)',[$name]);
       //return 'Сущность действия '. ($isSucces ? 'создано' : 'не создано');

       // return DB::select('select name from actions where id=?', [$request->query('id')]);

       //$res = DB::table('actions')->get();
       //$string = '';
       //foreach($res as $action){
       //    $string .= sprintf('%s: %s <br>', $action->id,$action->name);
       //}
       //return $string;

       //return DB::table('actions')->where('id', $request->query('id'))->first()->name;
       //return DB::table('actions')->find($request->query('id'));
       //return DB::table('actions')->pluck('name', 'id');
       //$isSucces = DB::table('actions')->where('id',$request->query('id'))->update(['name'=> $request->query('name')]);
       //return $isSucces ? 'Успех' : 'Провал';

       //$isSucces = DB::table('actions')->insert(['name'=> 'Read book']);
       //return $isSucces ? 'Успех' : 'Провал';




    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;

        $isSuccess = DB::table('actions')->insert(['name'=>$name]);
        if($isSuccess)
        {
            //session()->flash('success', 'Действие создано успешно');
            return redirect()
                ->back()
                ->with('success', 'Действие создано успешно');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return sprintf('действия номер: %s', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // return view('action_delete', ['id' => $id]);
       $action = DB::table('actions')->find($id);
       $route = route('actions.update', $id);
       $subHeading = 'Редактирование действия';

       return view('actions.edit',[
           'action' => $action,
           'route' => $route,
           'subHeading' => $subHeading,
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        
        $isSuccess = DB::table('actions')
                   ->where ('id',$id)
                   ->update(['name'=>$name]);
        if($isSuccess)
        {
            return redirect()
                ->back()
                ->with('success', 'Действие обновлено успешно');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $name = DB::table('actions')->find($id)->name;
        $isSuccess = DB::table('actions')->delete($id);
        if($isSuccess)
        {
            return redirect()
                ->back()
                ->with('success', sprintf(
                    'Действие %s удалено',
                    $name
                    ));
        }
        return redirect('/actions');
       // return  $isSucces ? 'Успех' : 'Провал';
    }
}
