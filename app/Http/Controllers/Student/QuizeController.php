<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class QuizeController extends Controller
{
    public function EndExam(){
        return view('student/EndExam');
    }

    public function countdown(){
        $Exams = DB::table('exams')
        ->where('exam_date', '>', Carbon::now()->addHour())
        ->orderBy('exam_date','ASC')
        ->get();
      
        
        $currentDateTime = Carbon::now()->addHour();
        foreach($Exams as $Exam){
           
            $startExamTime = $Exam->exam_date;
            $endExamTime = $Exam->exam_end;

            // Create a DateTime object from the string
            $Start = Carbon::createFromFormat('Y-m-d H:i:s', $startExamTime);
            $End = Carbon::createFromFormat('Y-m-d H:i:s', $endExamTime);
            
            // Compare the two dates and times
            
            if (!$currentDateTime->between($Start, $End)) {

                    return view('student/timer')->with('Exam', $Exam);
          
            }

        }
        return redirect('End');
    }

    public function getdata(Request $request){
        $id_etudiant = Auth::id();

        $etudiantAnswer2 = DB::table('etudiant_answers')
        ->where('id_etudiant', '=', $id_etudiant)
        ->where('question_id', '=', $request->query('id_exam'))
        ->first();

        if(!$etudiantAnswer2){
            $test=DB::table('etudiant_answers')->insert([
                'id_etudiant' => $id_etudiant,
                'exam_id' => $request->query('id_exam'),
                'question_id' => $request->query('id_question'),
                'answer_value' => $request->query('data') ,
            ]);
        }


        $query1 = DB::table('questions')
            ->select(DB::raw('MAX(question_img_path) AS question_img_path, id, question_type'))
            ->groupBy('id',  'question_type')
            ->where('exam_id',$request->query('id_exam'))
            ->get();

       

        $result = [];
           
        foreach ($query1 as $item){
            $etudiantAnswer = DB::table('etudiant_answers')
                ->where('id_etudiant', '=', $id_etudiant)
                ->where('question_id', '=', $item->id)
                ->first();

            if ($etudiantAnswer) {
                // the query returned one row
                continue;
            } else {
                // the query returned 0 row
                $newElement = [];

                $newElement["id"] = $item->id;
                $newElement["question"] = $item->question_img_path;
                $newElement["type"] = $item->question_type;

                $newElement["id_etudiant"] = $id_etudiant;
                $newElement["id_exam"] =$request->query('id_exam');



                $query2 = DB::table('answers')
                    ->select(DB::raw(' answer_value, id'))
                    ->where('question_id', $item->id)
                    ->get();
                
                $newElement2 = [];

                foreach ( $query2 as $item2){
                
                    array_push($newElement2, $item2->answer_value);

                }

                $newElement["options"]  = $newElement2;

                array_push($result, $newElement);
            }
            return response()->json($result);
        }

        
        return response()->json([
            'message' => "C'est fini",
        ], 200);

    }

    public function main()
    {                       
        $id_etudiant = Auth::id();
        $currentDateTime = Carbon::now()->addHour();
        $query0 = DB::table('users')
            ->select('id', 'filiere_id')
            ->where('id', '=', $id_etudiant)
            ->where('role', 'student')
            ->get();

       
            $query2 = DB::table('exams')
            ->where('filiere_id', '=', $query0[0]->filiere_id)
            ->where('exam_date', '<=', $currentDateTime)
            ->where('exam_end', '>=', $currentDateTime)
            ->orderBy('exam_date', 'ASC')
            ->first();

            
          
          

            if($query2==null) {
                $query3 = DB::table('exams')
                ->where('exam_date', '>', Carbon::now()->addHour())
                ->where('filiere_id', '=', $query0[0]->filiere_id)
                ->orderBy('exam_date','ASC')
                ->first(); 

                if($query3){
                    return view('student/timer')->with('Exam', $query3);   
                }
                return redirect('End');

            }else if ( $query2!=null ) {

                $etudiantAnswer = DB::table('etudiant_answers')
                ->where('id_etudiant', '=', $id_etudiant)
                ->where('exam_id', '=', $query2->id)
                ->first();
                if($etudiantAnswer == null){

              


                $nextExam = [];
                 
              
                  
                    // Compare the two dates and times
               
                       
                        $query1 = DB::table('questions')
                        ->select(DB::raw('MAX(question_img_path) AS question_img_path, id, question_type'))
                        ->groupBy('id', 'question_type')
                        ->where('exam_id', $query2->id)
                        ->get();
                    
        
                        $result = [];
                                                    
                        foreach( $query1 as $item) {
                       
                         
                            $etudiantAnswer = DB::table('etudiant_answers')
                                ->where('id_etudiant', '=', $id_etudiant)
                                ->where('question_id', '=', $item->id)
                                ->first();
                            
                            if ($etudiantAnswer !=null) {
                                continue;
                            } else if($etudiantAnswer == null) {
                
                                $newElement = [];
                
                                $newElement["id"] = $item->id;
                                $newElement["question"] = $item->question_img_path;
                                $newElement["type"] = $item->question_type;
                
                                $newElement["id_etudiant"] = $id_etudiant;
                                $newElement["id_exam"] = $query2->id;
                
                
                
                                $query2 = DB::table('answers')
                                        ->select(DB::raw('answer_value, id'))
                                        ->where('question_id', $item->id)
                                        ->get();
                
                                $newElement2 = [];
                
                                foreach ( $query2 as $item2){
                                
                                    array_push($newElement2, $item2->answer_value);
                
                                }
                                
                                $newElement["options"]  = $newElement2;
                
                                array_push($result, $newElement);

                           
                                                                $error_message = json_encode($result);
                                return view('student/control',compact('result'));
                            }
                        }
              
                  
                
            

            }else if ( $query2!=null && $etudiantAnswer != null) { return redirect('End');}
        }
    }
}