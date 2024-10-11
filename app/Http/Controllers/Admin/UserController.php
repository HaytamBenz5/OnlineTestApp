<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sector;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function UserResultat($id){
        $user = User::findOrFail($id);
        $filiere = $user->filiere;
        $exams = $filiere->exams;
        $chosenAnswers = $user->etudiantAnswers;
        
        return view('admin/users/userResultat', compact('user', 'filiere', 'exams', 'chosenAnswers'));
    }

    public function ViewUser($id){
        $data = User::findOrFail($id);
        return view('admin/users/edituser', ['User' => $data]);
    }

    public function EditUser(Request $request, $id){
        $User = User::findOrFail($id);
        $User->name = $request->FullName;
        $User->CNI = $request->CIN;
        $User->date_naissance = $request->date_naissance;
        $User->Email = $request->Email;
        $User->save();

        return redirect()->route('List_users');
    }

    public function deleteUser($id){
        User::destroy($id);

        return redirect()->back();
    }
}
