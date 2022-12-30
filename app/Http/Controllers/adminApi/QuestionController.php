<?php

namespace App\Http\Controllers\adminApi;

use App\Http\Controllers\Controller;
use App\models\category;
use App\models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    use Response;

    public function index()
    {
        $questions = question::select('id', 'question', 'answer', 'wrong_answer1', 'wrong_answer2', 'wrong_answer3', 'course_id')->get();

        return $this->apiResponse($questions, "Success", 200);

    }

    public function indexById($id)
    {

        $questions = question::where('id', $id)->first();

        if ($questions) {
            return $this->apiResponse($questions, "Success", 200);
        } else {
            return $this->apiResponse(null, "This Question isn't Found", 404);
        }
    }

    public function store(Request $request)
    {
        $rules = [

            'question' => 'required ',
            'answer' => 'required |max:100',
            'wrong_answer1' => 'required |max:100 ',
            'wrong_answer2' => 'required |max:100',
            'wrong_answer3' => 'required |max:100',
            'course_id' => 'required'
        ];
        $messages = [
            'question.required' => 'You Must Enter question',
            'answer.required' => 'You Must Enter The Right Answer',
            'wrong_answer1.required' => 'You Must Enter Some Wrong Answers',
            'wrong_answer2.required' => 'You Must Enter Some Wrong Answers',
            'wrong_answer3.required' => 'You Must Enter Some Wrong Answers',
            'course_id.required' => 'You Must Enter course',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }


        $questions = question::create($request->all());

        if ($questions) {
            return $this->apiResponse($questions, "The Question Has Been Saved", 201);
        } else {
            return $this->apiResponse(null, "This Question Hasn't Saved", 400);
        }
    }

    public function update(Request $request, $id)
    {
        $questions = question::where('id', $id)->first();
        if (!$questions) {
            return $this->apiResponse(null, "This Category isn't Found", 404);
        }

        $rules = [

            'question' => 'required ',
            'answer' => 'required |max:100 ',
            'wrong_answer1' => 'required |max:100 ',
            'wrong_answer2' => 'required |max:100',
            'wrong_answer3' => 'required |max:100',
            'course_id' => 'required'
        ];
        $messages = [
            'question.required' => 'You Must Enter question',
            'answer.required' => 'You Must Enter The Right Answer',
            'wrong_answer1.required' => 'You Must Enter Some Wrong Answers',
            'wrong_answer2.required' => 'You Must Enter Some Wrong Answers',
            'wrong_answer3.required' => 'You Must Enter Some Wrong Answers',
            'course_id.required' => 'You Must Enter course',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }



         $questions->update($request->all());

        if ($questions) {
            return $this->apiResponse($questions, "The Question Has Been Updated", 201);
        }
    }

    public function delete($id){
        $questions=question::where('id',$id)->first();

        if(! $questions){
            return $this->apiResponse(null, "This Question isn't Found", 404);
        }

        $delete= $questions->delete();

        if ($delete) {
            return $this->apiResponse($delete, "The Question Has Been Deleted", 201);
        }
    }
}
