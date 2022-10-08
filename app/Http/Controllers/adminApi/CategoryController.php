<?php

namespace App\Http\Controllers\adminApi;

use App\Http\Controllers\Controller;
use App\models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use Response;

    public function index(){
        $categories=category::select('id' , 'name')->get();

        return $this->apiResponse($categories , "Success" , 200);

    }
    public function indexById($id){

        $category=category::where('id',$id)->first();

        if($category) {
            return $this->apiResponse($category, "Success", 200);
        }else{
            return $this->apiResponse(null, "This Category isn't Found", 404);
        }
    }

    public function store(Request $request)
    {
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
            return $this->apiResponse(null, $validator->errors(), 400);
        }


        $category = category::create($request->all());

        if ($category) {
            return $this->apiResponse($category, "The Category Has Been Saved", 201);
        } else {
            return $this->apiResponse(null, "This Category Hasn't Saved", 400);
        }
    }


    public function update(Request $request , $id){
        $category=category::where('id',$id)->first();

        if(! $category){
            return $this->apiResponse(null, "This Category isn't Found", 404);
        }

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
            return $this->apiResponse(null, $validator->errors(), 400);
        }


          $category->update($request->all());

        if ($category) {
            return $this->apiResponse($category, "The Category Has Been Updated", 201);
        }

    }


    public function delete($id){
        $category=category::where('id',$id)->first();

        if(! $category){
            return $this->apiResponse(null, "This Category isn't Found", 404);
        }

        $delete= $category->delete();

        if ($delete) {
            return $this->apiResponse($delete, "The Category Has Been Deleted", 201);
        }
    }
}
