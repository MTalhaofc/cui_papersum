<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Providers\AzureBlobStorageServiceProvider;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\PastPaperController;


class FileController extends Controller
{
  
public function download(Request $request,Pastpaper $pastpaper)
{
    // Retrieve the image data based on the provided ID
    $image = Image::find($pastpaper); // Ensure you adjust the model and retrieval logic as needed

    // Check if the image was found
    if (!$image) {
        return redirect()->back()->withErrors('Image not found.');
    }

    // Construct the file path relative to the storage disk
    $filePath = 'pastpapers/' . basename($image->file_path); // Assuming $image->file_path contains the full path

    // Get the original filename
    $originalName = $image->original_filename;

    // Check if the file exists on the Azure storage
    if (Storage::disk('azure')->exists($filePath)) {
        // Get a public or SAS URL for the file
        $url = Storage::disk('azure')->url($filePath);

        // Return the URL to the front-end (to be used as a download link)
        return response()->json([
            'download_url' => $url,
            'original_name' => $originalName,
        ]);
    } else {
        // Handle the case where the file doesn't exist
        return redirect()->back()->withErrors('File not found.');
    }
}



}
