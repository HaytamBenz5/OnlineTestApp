<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function main(){
        return view('index');
    }

    public function filiere_section(){
        return view('admin/Filiere/filiere');
    }

    public function filiere_list(){
        $Filieres = DB::table('sectors')->orderBy('id', 'ASC')->get();
        return view('admin/Filiere/listfiliere')->with('Filieres', $Filieres)->with('Val', 1);
    }

    public function exam_section(){
        $Filieres = DB::table('sectors')->get();
        return view('admin/councours/exam')->with('Filieres', $Filieres);
    }

    public function question_section(){
        $Exams = DB::table('exams')->get();
        return view('admin/councours/question')->with('Exams', $Exams);
    }

    public function List_users(){
        $users = User::with('sector')->where('role','student')->get();
        return view('admin/users/listusers')->with('Users', $users)->with('Val', 1);
    }
}
