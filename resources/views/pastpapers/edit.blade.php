@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Edit Past Paper</h1>
        <form action="{{ route('pastpapers.update', $pastpaper) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Existing fields -->
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label>
                <input type="text" name="subject" id="subject" value="{{ $pastpaper->subject}}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="coursecode" class="block text-sm font-medium text-gray-700">Course Code:</label>
                <input type="text" name="coursecode" id="coursecode" value="{{ $pastpaper->coursecode }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="teacher" class="block text-sm font-medium text-gray-700">teacher:</label>
                <input type="text" name="teacher" id="teacher" value="{{ $pastpaper->teacher }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                <input type="text" name="department" id="department" value="{{ $pastpaper->department }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="papertype" class="block text-sm font-medium text-gray-700">Paper Type:</label>
                <input type="text" name="papertype" id="papertype" value="{{ $pastpaper->papertype }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div><div class="mb-4">
                <label for="papertime" class="block text-sm font-medium text-gray-700">Paper Time:</label>
                <input type="text" name="papertime" id="papertime" value="{{ $pastpaper->papertime }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            

            <!-- Existing images section -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Existing Images:</h3>
                @foreach($pastpaper->images as $image)
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $pastpaper->subject }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
                        <div class="ml-4 flex space-x-2">
                            <button type="button" class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500" onclick="deleteImage('{{ route('pastpapers.delete_image', [$pastpaper->id, $image->id]) }}')">Delete</button>
                            <a href="{{ asset('storage/' . $image->file_path) }}" download class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Download</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Upload additional images -->
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700">Add More Images:</label>
                <input type="file" name="images[]" id="images" multiple class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:text-sm file:font-semibold file:bg-gray-50 hover:file:bg-gray-100">
            </div>

            <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">Update</button>
        </form>

        <!-- JavaScript for deleting images -->
        <script>
            function deleteImage(url) {
                if (confirm('Are you sure you want to delete this image?')) {
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Failed to delete image');
                        }
                    });
                }
            }
        </script>
    </div>
@endsection
