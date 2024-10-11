<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class ConcoursController extends Controller
{
    public function insertExam(Request $request){
        $Exam = new Exam;
        $Exam->Name = $request->TitleExam;
        $Exam->exam_date = $request->dateExam;
        $Exam->exam_end = $request->dateExamEnd;
        $Exam->filiere_id = $request->Filiere;
        $Exam->save();
    }

    public function insertQuestion(Request $request){
        $Question = new Question;
        $Question->question_type = $request->QuetionType;
        $Question->question_temps = $request->QuestionTime;
        $Question->exam_id = $request->ExamTitle;

        $file = $request->file('QuetionImage');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = 'images/ExamQuestion/';
        $request->file('QuetionImage')->move($path, $filename);
        $Question->question_img_path = $filename;
        $Question->save();

        $lastRecord = DB::table('questions')->orderBy('id', 'desc')->first();

        count($request->all());
        if($request->CorrectAnswwer){
            $inputs = count($request->all()) - 6;   
        }else{
            $inputs = count($request->all()) - 5;
        }

        for($i=1; $i <= $inputs; $i++){
            $Answer = new Answer;
            $Answer->answer_value = $request->input('Choix_'.$i);
            $Answer->question_id = $lastRecord->id;

            if($request->CorrectAnswwer == $i && $Answer->question_id == $lastRecord->id){
                $Answer->correction = true;
            }else{
                $Answer->correction = false;
            }
            $Answer->save();
        }
    }
}
