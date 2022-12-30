<?php

namespace App\Http\Controllers;

use App\models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.categories');
    }



    public function store(Request $request){
        $rules=[
            'name'=>'required |min:5 | max:50|string ',
        ];
        $messages=[
            'name.required'=>'You Must Enter The Category Name',
            'name.max'=>'The Category Name should be maximum 50 character',
            'name.min'=>'The Category Name should be minimum 5 character',
        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }

        category::create([
            'name'=>$request -> name,
        ]);
        return redirect()->back()->with(['success' => 'DONE']);
    }



    public function show()
    {
        $categories= category::select('id','name')->get();
        return view('admin.categories' , compact('categories'));
    }


    public function edit($id)
    {
        $category =category::findOrFail($id);
        return view('admin.edit.categories-edit' , compact('category'));
    }


    public function update(Request $request, $id)
    {
        $category =category::findOrFail($id);

        $rules=[
            'name'=>'required | max:50 |min:5|string',
        ];
        $messages=[
            'name.required'=>'You Must Enter The Category Name',
            'name.max'=>'The Category Name should be maximum 50 character',
            'name.min'=>'The Category Name should be minimum 5 character',
        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }

        $category->update($request->all());

        return redirect()->back()->with( ['success'=>'Updated']);
    }


    public function delete($id)
    {
        $category = category::where('id',$id)->first();
        if (! $category){
            return redirect()->back()->with(['error' => 'This Category Does Not exist']);
        }

        $category-> delete();

        return redirect()-> back( )->with(['deleted','Category Deleted Successfully']);
    }
}
