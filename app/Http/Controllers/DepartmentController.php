<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PastPaper;

class DepartmentController extends Controller
{
    public function show($department)
    {
        $pastPapers = PastPaper::where('department', $department)->get();
        return view('departments.show', compact('pastPapers', 'department'));
    }
}
