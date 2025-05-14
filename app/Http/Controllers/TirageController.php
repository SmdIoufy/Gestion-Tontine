<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tontine;
use App\Models\User;

class TirageController extends Controller
{
    public function index()
    {
        $tontines = Tontine::all();
        return view('tirages.index', compact('tontines'));
    }

    public function tirage(Request $request)
    {
        $request->validate([
            'tontine_id' => 'required|exists:tontines,id',
        ]);

        $tontine = Tontine::find($request->tontine_id);
        $membres = $tontine->membres;
        $gagnant = $membres->random();

        return view('tirages.result', compact('gagnant', 'tontine'));
    }
}
