<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download(Request $request)
    {
        $filePath = 'public/' . $request->input('file');
        $originalName = $request->input('original');

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $originalName);
        }

        return redirect()->back()->withErrors('File not found.');
    }
}
