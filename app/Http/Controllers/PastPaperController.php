<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PastPaper;
use App\Models\PastPaperImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Providers\AzureBlobStorageServiceProvider;
use App\Http\Controllers\Image;
use Symfony\Component\HttpFoundation\StreamedResponse;


class PastPaperController extends Controller
{
    public function index(Request $request) {
        $query = PastPaper::query();

        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }

        if ($request->filled('coursecode')) {
            $query->where('coursecode', 'like', '%' . $request->coursecode . '%');
        }

        $pastPapers = $query->latest()->get();

        return view('landing', compact('pastPapers'));
    }

    public function create() {
        return view('pastpapers.createpaper');
    }

   
    
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'subject' => 'required|string|max:255',
        'coursecode' => 'required|string|max:255',
        'teacher' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'papertype' => 'required|string|max:255',
        'papertime' => 'required|string|max:255',
        'files.*' => 'required|file|mimes:pdf,jpg,jpeg,png', // Validation for multiple file types
    ]);

    // Create the past paper entry in the database
    $pastPaper = PastPaper::create([
        'user_id' => auth()->id(),
        'subject' => $request->subject,
        'coursecode' => $request->coursecode,
        'teacher' => $request->teacher,
        'department' => $request->department,
        'papertype' => $request->papertype,
        'papertime' => $request->papertime,
    ]);

    $publicUrls = []; // Array to hold the public URLs

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            // Generate a unique filename
            $filename = time() . '-' . $file->getClientOriginalName();

            // Store the file using Flysystem's write method
            Storage::disk('azure')->write('pastpapers/' . $filename, file_get_contents($file));

            // Construct the public URL for the uploaded file
            $publicUrl = rtrim(env('AZURE_STORAGE_URL'), '/') . '/' . 
                         rtrim(env('AZURE_STORAGE_CONTAINER'), '/') . '/' . 
                         'pastpapers/' . $filename;

            // Save the public URL in the database
            $pastPaper->images()->create(['file_path' => $publicUrl]);

            // Add the public URL to the array
            $publicUrls[] = $publicUrl;
        }
    }

    // Redirect back to the homepage with a success message and the public URLs
    return redirect()->route('home')->with([
        'success' => 'Past paper uploaded successfully!',
        'urls' => $publicUrls, // Passing the URLs along with the status
    ]);
}

    
    
    
    
    

    
    
        // ... other methods ...
    
    
        public function show(PastPaper $pastpaper)
        {
            
            $images = $pastpaper->images; // Assuming images are a relationship defined in the PastPaper model
        
            return view('pastpapers.show', compact('pastpaper', 'images'));
        }
        
        
        
        
        
        

        
        
        

    public function edit(PastPaper $pastpaper) {
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }
        return view('pastpapers.edit', compact('pastpaper'));
    }

    public function update(Request $request, PastPaper $pastpaper)
    {
        // Ensure the authenticated user is the owner of the past paper
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }
    
        // Validate the incoming request
        $request->validate([
            'subject' => 'required|string|max:255',
            'coursecode' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'papertype' => 'required|string|max:255',
            'papertime' => 'required|string|max:255',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf', // Accepting optional image/pdf files
        ]);
    
        // Update the past paper details in the database
        $pastpaper->update([
            'subject' => $request->subject,
            'coursecode' => $request->coursecode,
            'teacher' => $request->teacher,
            'department' => $request->department,
            'papertype' => $request->papertype,
            'papertime' => $request->papertime,
        ]);
    
        // Handle the new file uploads to Azure Blob Storage
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Generate a unique filename
                $filename = time() . '-' . $file->getClientOriginalName();
    
                // Get file contents
                $fileContent = file_get_contents($file);
    
                // Upload the file to Azure Blob Storage using Flysystem
                Storage::disk('azure')->write('pastpapers/' . $filename, $fileContent);
    
                // Generate the public URL of the uploaded file
                $publicUrl = rtrim(env('AZURE_STORAGE_URL'), '/') . '/' . 
                             rtrim(env('AZURE_STORAGE_CONTAINER'), '/') . '/' . 
                             'pastpapers/' . $filename;
    
                // Save the URL in the `images` table linked to the `pastpaper`
                $pastpaper->images()->create(['file_path' => $publicUrl]);
            }
        }
    
        // Redirect with a success message after updating
        return redirect()->route('home')->with('success', 'Past paper updated successfully!');
    }
    
    

    public function destroy(PastPaper $pastpaper)
{
    // Ensure the user is authorized to delete the past paper
    if (!Auth::check()) {
        abort(403, 'Unauthorized action.');
    }

    // Loop through all the images associated with the past paper
    foreach ($pastpaper->images as $image) {
        // Delete the image from Azure Blob Storage
        Storage::disk('azure')->delete('pastpapers/' . basename($image->file_path));

        // Delete the image record from the database
        $image->delete();
    }

    // Delete the past paper record from the database
    $pastpaper->delete();

    // Redirect back with a success message
    return redirect()->route('home')->with('success', 'Past paper deleted successfully!');
}








    
public function deleteImage(PastPaper $pastpaper, $imageId)
{
    // Find the image record associated with the past paper
    $image = $pastpaper->images()->findOrFail($imageId);

    // Delete the image file from Azure Blob Storage
    Storage::disk('azure')->delete('pastpapers/' . basename($image->file_path));

    // Delete the image record from the database
    $image->delete();

    // Return a JSON response indicating success
    return response()->json(['success' => true]);
}

public function indexByDepartment($department)
{
    $pastPapers = PastPaper::where('department', $department)->get();

    return view('pastpapers.indexbydepartment', compact('pastPapers', 'department'));
}



public function download($file_path)
    {
        // The file path stored in the database is relative to Azure Blob Storage
        // So, construct the full URL to the file
        $publicUrl = rtrim(env('AZURE_STORAGE_URL'), '/') . '/' . 
                     rtrim(env('AZURE_STORAGE_CONTAINER'), '/') . '/' . 
                     $file_path; // Ensure $file_path includes the full path inside the container

        // Check if the file exists in Azure (optional, based on whether you want to validate before redirecting)
        if (Storage::disk('azure')->exists($file_path)) {
            return response()->redirectTo($publicUrl); // Redirect the user to the Azure Blob URL for download
        } else {
            // If the file does not exist, return a 404 error
            return abort(404, 'File not found.');
        }
    }








public function search(Request $request)
{
    $pastPapers = PastPaper::query();

    if ($request->ajax()) {
        $department = $request->input('department');

        $data = $pastPapers
            ->where('department', $department) // Filter by department
            ->where('subject', 'LIKE', '%' . $request->search . '%')
            ->get()
            ->map(function ($paper) {
                // Add the view URL to each paper
                $paper->url = route('pastpapers.show', $paper);
                return $paper;
            });

        return response()->json($data);
    } else {
        $data = $pastPapers->get();
        return view('departments.show', compact('data'));
    }
}


public function search_home()
{
    $search = $request->input('search');
    $papers = PastPaper::where('subject', 'like', "%{$search}%")
        ->orWhere('coursecode', 'like', "%{$search}%")
        ->get();

    return response()->json($papers);
}

public function pastPapersShow(Request $request)
{
    $pastPapers = PastPaper::query();

    if ($request->ajax()) {
        

        $data = $pastPapers
           
            ->where('Subject', 'LIKE', '%' . $request->search . '%')
            ->get()
            ->map(function ($paper) {
                // Add the view URL to each paper
                $paper->url = route('pastpapers.show', $paper);
                return $paper;
            });

        return response()->json($data);
    } else {
        $data = $pastPapers->get();
        return view('home', compact('data'));
    }
}


}