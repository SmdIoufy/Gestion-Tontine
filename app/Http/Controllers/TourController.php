<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        return view('tours.index');
    }

    public function marquer($id)
    {
        $tour = Tontine::findOrFail($id);
        $tour->status = 'effectué';
        $tour->save();

        return redirect()->back()->with('success', 'Tour marqué comme effectué.');
    }
}
