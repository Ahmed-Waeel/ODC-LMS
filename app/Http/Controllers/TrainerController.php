<?php

namespace App\Http\Controllers;

use App\models\trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class TrainerController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request){
        $rules=[
            'name'=>'required min: 5| max:30 ' ,
        ];
        $messages=[
            'name.required'=>'You Must Enter Trainer name',
            'name.max'=>'The Name should be maximum 30 character',
            'name.min'=>'The Name should be minimum 5 character',


        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }

        trainer::create([
            'name'=>$request -> name,

        ]);
        return redirect()->back()->with(['success' => 'DONE']);
    }


    public function show()
    {
        $trainers=trainer::select('id' , 'name')->get();
        return view('admin.trainer' , compact('trainers'));
    }


    public function edit($id)
    {
        $category =category::findOrFail($id);
        return view('admin.edit.categories-edit' , compact('category'));
    }


    public function update(Request $request, $id)
    {
        $trainer =trainer::findOrFail($id);

        $rules=[
            'name'=>'required min: 5| max:50 ',
        ];
        $messages=[
            'name.required'=>'You Must Enter Trainer name',
            'name.max'=>'The Name should be maximum 50 character',
        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }

        $trainer->update($request->all());

        return redirect()->back()->with( ['success'=>'Updated']);
    }



    public function delete($id)
    {
        $trainer = trainer::where('id',$id)->first();
        if (! $trainer){
            return redirect()->back()->with(['error' => 'This Trainer Does Not exist']);
        }

        $trainer-> delete();

        return redirect()-> back( )->with(['deleted','Trainer Deleted Successfully']);
    }
}
