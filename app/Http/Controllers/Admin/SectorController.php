<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sector;

class SectorController extends Controller
{
    public function insertFiliere(Request $request){
        $Sector = new Sector;
        $Sector->Name = $request->TitleSector;
        $Sector->save();
    }

    public function ViewFiliere($id){
        $data = Sector::findOrFail($id);
        return view('admin/Filiere/editfiliere', ['Filiere' => $data]);
    }

    public function EditFiliere(Request $request, $id){
        $Sector = Sector::findOrFail($id);
        $Sector->Name = $request->TitleSector;
        $Sector->save();

        return redirect()->route('filiere_list');
    }

    public function deleteFiliere($id){
        Sector::destroy($id);

        return redirect()->back();
    }
}
