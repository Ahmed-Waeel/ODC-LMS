<?php

namespace App\Http\Controllers;

use App\models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class QuestionController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.questions');
    }


    public function create()
    {
        //
    }


    public function store(Request $request){
        $rules=[

            'question'=>'required |min:10|max:50 |string ',
            'answer'=>'required |min:10|max:50 |string ',
            'wrong_answer1'=>'required |min:10|max:50 |string ',
            'wrong_answer2'=>'required |min:10|max:50 |string',
            'wrong_answer3'=>'required |min:10|max:50 |string',
            'course_id'=>'required '
        ];
        $messages=[
            'question.required'=>'You Must Enter question',
            'answer.string'=>'the answer must start with alpha character',
            'wrong_answer1.string'=>'the answer must start with alpha character',
            'wrong_answer2.string'=>'the answer must start with alpha character',
            'wrong_answer3.string'=>'the answer must start with alpha character',
            'answer.required'=>'You Must Enter The Right Answer',
            'wrong_answer1.required'=>'You Must Enter Some Wrong Answers',
            'wrong_answer2.required'=>'You Must Enter Some Wrong Answers',
            'wrong_answer3.required'=>'You Must Enter Some Wrong Answers',
            'course_id.required'=>'You Must Enter course',
            'question.min'=>'the Question Must be At Least 10 characters',
            'question.max'=>'the Question Must be At Most 50 characters',
            'answer.min'=>'the Question Must be At Least 10 characters',
            'answer.max'=>'the Question Must be At Most 50 characters',
            'wrong_answer1.min'=>'the Question Must be At Least 10 characters',
            'wrong_answer2.min'=>'the Question Must be At Least 10 characters',
            'wrong_answer3.min'=>'the Question Must be At Least 10 characters',
            'wrong_answer1.max'=>'the Question Must be At Most 50 characters',
            'wrong_answer2.max'=>'the Question Must be At Most 50 characters',
            'wrong_answer3.max'=>'the Question Must be At Most 50 characters',
        ];

        $validator= Validator::make($request->all(),$rules , $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['failed' => 'There\'s Something Wrong'])->withInput($request->all()) ;
        }


        question::create([
            'question'=>$request -> question,
            'answer'=>$request -> answer,
            'wrong_answer1'=>$request -> wrong_answer1,
            'wrong_answer2'=>$request -> wrong_answer2,
            'wrong_answer3'=>$request -> wrong_answer3,
            'course_id'=>$request -> course_id,
        ]);
        return redirect()->back()->with(['success' => 'DONE']);
    }

    public function show(question $question)
    {
        $questions=question::select('id','question','answer','wrong_answer1','wrong_answer2','wrong_answer3','course_id')->get();
        return view('admin.questions' , compact('questions'));
    }


    public function edit($id)
    {
        $question =question::findOrFail($id);
        return view('admin.questions.admin-edit' , compact('question'));
    }


    public function update(Request $request, $id)
    {
        $question =question::findOrFail($id);

        $rules=[

            'question'=>'required |min:10|max:50 |string ',
            'answer'=>'required |min:10|max:50 |string ',
            'wrong_answer1'=>'required |min:10|max:50 |string ',
            'wrong_answer2'=>'required |min:10|max:50 |string',
            'wrong_answer3'=>'required |min:10|max:50 |string',
            'course_id'=>'required '
        ];
        $messages=[
            'question.required'=>'You Must Enter question',
            'answer.string'=>'the answer must start with alpha character',
            'wrong_answer1.string'=>'the answer must start with alpha character',
            'wrong_answer2.string'=>'the answer must start with alpha character',
            'wrong_answer3.string'=>'the answer must start with alpha character',
            'answer.required'=>'You Must Enter The Right Answer',
            'wrong_answer1.required'=>'You Must Enter Some Wrong Answers',
            'wrong_answer2.required'=>'You Must Enter Some Wrong Answers',
            'wrong_answer3.required'=>'You Must Enter Some Wrong Answers',
            'course_id.required'=>'You Must Enter course',
            'question.min'=>'the Question Must be At Least 10 characters',
            'question.max'=>'the Question Must be At Most 50 characters',
            'answer.min'=>'the Question Must be At Least 10 characters',
            'answer.max'=>'the Question Must be At Most 50 characters',
            'wrong_answer1.min'=>'the Question Must be At Least 10 characters',
            'wrong_answer2.min'=>'the Question Must be At Least 10 characters',
            'wrong_answer3.min'=>'the Question Must be At Least 10 characters',
            'wrong_answer1.max'=>'the Question Must be At Most 50 characters',
            'wrong_answer2.max'=>'the Question Must be At Most 50 characters',
            'wrong_answer3.max'=>'the Question Must be At Most 50 characters',
        ];

        $validator= validator::make($request->all(),$rules , $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $question->update($request->all());

        return redirect()->back()->with( ['success'=>'Updated']);
    }


    public function delete($id)
    {
        $question = question::where('id',$id)->first();
        if (! $question){
            return redirect()->back()->with(['error' => 'This Question Does Not exist']);
        }

        $question-> delete();

        return redirect()-> back( )->with(['deleted','Question Deleted Successfully']);
    }
}
