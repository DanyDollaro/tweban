<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;

class AdminController extends Controller
{
    public function getDepartments()
    {
        $dipartimenti = Dipartimento::all(); // Recupera tutti i dipartimenti
        return view('admin_layouts.departments', compact('dipartimenti'));
    }
}

