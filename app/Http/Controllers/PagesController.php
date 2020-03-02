<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('hello');
    }

    /**
     * View all students found in the database
     */
    public function viewStudents()
    {
        $students = Students::with('course')->get();
        return view('view_students', compact(['students']));
    }

}
