<?php

namespace App\Http\Controllers\adminApi;

use App\Http\Controllers\Controller;
use App\models\category;
use App\models\trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainerController extends Controller
{
    use Response;

    public function index()
    {
        $trainers = trainer::select('id', 'name')->get();

        return $this->apiResponse($trainers, "Success", 200);

    }

    public function indexById($id)
    {

        $trainers = trainer::where('id', $id)->first();

        if ($trainers) {
            return $this->apiResponse($trainers, "Success", 200);
        } else {
            return $this->apiResponse(null, "This Trainer isn't Found", 404);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required | max:50 |alpha_dash',
        ];
        $messages = [
            'name.required' => 'You Must Enter Trainer name',
            'name.max' => 'The Name should be maximum 50 character',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }


        $trainers = trainer::create($request->all());

        if ($trainers) {
            return $this->apiResponse($trainers, "The Trainer Has Been Saved", 201);
        } else {
            return $this->apiResponse(null, "This Trainer Hasn't Saved", 400);
        }
    }

    public function update(Request $request, $id)
    {

        $trainer = trainer::where('id', $id)->first();
        if (!$trainer) {
            return $this->apiResponse(null, "This Trainer isn't Found", 404);
        }

        $rules = [
            'name' => 'required | max:50 |alpha_dash',
        ];
        $messages = [
            'name.required' => 'You Must Enter Trainer name',
            'name.max' => 'The Name should be maximum 50 character',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }


         $trainer->update($request->all());

        if ($trainer) {
            return $this->apiResponse($trainer, "The Trainer Info Has Been Updated", 201);
        }
    }

    public function delete($id){
        $trainer=trainer::where('id',$id)->first();

        if(! $trainer){
            return $this->apiResponse(null, "This Trainer isn't Found", 404);
        }

        $delete= $trainer->delete();

        if ($delete) {
            return $this->apiResponse($delete, "The Trainer Data Has Been Deleted", 201);
        }
    }
}
