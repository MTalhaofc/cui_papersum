@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100 mt-6 mb-6">
        <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center text-blue-600 mb-8">Edit Past Paper</h1>

            <form action="{{ route('pastpapers.update', $pastpaper) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Subject -->
                <div class="flex items-center">
                    <i class="fa fa-book text-blue-500 text-xl mr-3"></i>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label>
                </div>
                <input type="text" name="subject" id="subject" value="{{ $pastpaper->subject }}" required
                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                <!-- Course Code -->
                <div class="flex items-center">
                    <i class="fa fa-code text-green-500 text-xl mr-3"></i>
                    <label for="coursecode" class="block text-sm font-medium text-gray-700">Course Code:</label>
                </div>
                <input type="text" name="coursecode" id="coursecode" value="{{ $pastpaper->coursecode }}" required
                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                <!-- Teacher -->
                <div class="flex items-center">
                    <i class="fa fa-user-tie text-red-500 text-xl mr-3"></i>
                    <label for="teacher" class="block text-sm font-medium text-gray-700">Teacher:</label>
                </div>
                <input type="text" name="teacher" id="teacher" value="{{ $pastpaper->teacher }}" required
                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                <!-- Department -->
                <div class="flex items-center">
                    <i class="fa fa-building text-purple-500 text-xl mr-3"></i>
                    <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                </div>
                <input type="text" name="department" id="department" value="{{ $pastpaper->department }}" required
                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                <!-- Paper Type -->
                <div class="flex items-center">
                    <i class="fa fa-file-alt text-yellow-500 text-xl mr-3"></i>
                    <label for="papertype" class="block text-sm font-medium text-gray-700">Paper Type:</label>
                </div>
                <input type="text" name="papertype" id="papertype" value="{{ $pastpaper->papertype }}" required
                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                <!-- Paper Time -->
                <div class="flex items-center">
                    <i class="fa fa-clock text-pink-500 text-xl mr-3"></i>
                    <label for="papertime" class="block text-sm font-medium text-gray-700">Paper Time:</label>
                </div>
                <input type="text" name="papertime" id="papertime" value="{{ $pastpaper->papertime }}" required
                       class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">

                <!-- Existing Images -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fa fa-images text-indigo-500 text-xl mr-3"></i> Existing Images:
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($pastpaper->images as $image)
                            <div class="relative">
                                <img src="{{ $image->file_path }}" alt="{{ $pastpaper->subject }}" 
                                     class="w-full h-32 object-cover rounded-md shadow-md">
                                <button type="button" class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full hover:bg-red-700"
                                        onclick="deleteImage('{{ route('pastpapers.delete_image', [$pastpaper->id, $image->id]) }}')">
                                    Delete
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Upload Additional Images -->
                <div>
                    <div class="flex items-center">
                        <i class="fa fa-upload text-indigo-500 text-xl mr-3"></i>
                        <label for="images" class="block text-sm font-medium text-gray-700">Add More Images:</label>
                    </div>
                    <input type="file" name="images[]" id="images" multiple
                           class="block w-full mt-1 text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white text-lg font-medium rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        <i class="fa fa-save mr-2"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for deleting images -->
    <script>
        function deleteImage(deleteUrl) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to delete the image.');
                    }
                })
                .catch(error => {
                    alert('An error occurred while deleting the image.');
                });
            }
        }
    </script>
@endsection
