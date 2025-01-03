@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100  mt-6 mb-6">
        <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-6 text-blue-600">Upload Past Paper</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded relative mb-5" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pastpapers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Subject -->
                <div>
                    <div class="flex items-center">
                        <i class="fa fa-book text-blue-500 text-xl mr-2"></i>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label>
                    </div>
                    <div class="relative mt-1">
                        <input type="text" name="subject" id="subject" required 
                               class="block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Course Code -->
                <div>
                    <div class="flex items-center">
                        <i class="fa fa-code text-green-500 text-xl mr-2"></i>
                        <label for="coursecode" class="block text-sm font-medium text-gray-700">Course Code:</label>
                    </div>
                    <div class="relative mt-1">
                        <input type="text" name="coursecode" id="coursecode" required 
                               class="block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Teacher -->
                <div>
                    <div class="flex items-center">
                        <i class="fa fa-user-tie text-red-500 text-xl mr-2"></i>
                        <label for="teacher" class="block text-sm font-medium text-gray-700">Teacher:</label>
                    </div>
                    <div class="relative mt-1">
                        <input type="text" name="teacher" id="teacher" required 
                               class="block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Department -->
                <div>
                    <div class="flex items-center">
                        <i class="fa fa-building text-purple-500 text-xl mr-2"></i>
                        <span class="block text-sm font-medium text-gray-700">Department:</span>
                    </div>
                    <div class="mt-3 space-y-2">
                        @foreach(['Computer Science', 'Engineering', 'BBA'] as $dept)
                        <label class="inline-flex items-center">
                            <input type="radio" name="department" value="{{ $dept }}" required 
                                   class="form-radio text-blue-600 focus:ring-blue-500">
                            <span class="ml-2">{{ $dept }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Paper Type -->
                <div>
                    <div class="flex items-center">
                        <i class="fa fa-file-alt text-yellow-500 text-xl mr-2"></i>
                        <label for="papertype" class="block text-sm font-medium text-gray-700">Paper Type:</label>
                    </div>
                    <div class="relative mt-1">
                        <input type="text" name="papertype" id="papertype" required 
                               class="block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Paper Time -->
                <div>
                    <div class="flex items-center">
                        <i class="fa fa-clock text-pink-500 text-xl mr-2"></i>
                        <label for="papertime" class="block text-sm font-medium text-gray-700">Paper Time:</label>
                    </div>
                    <div class="relative mt-1">
                        <input type="text" name="papertime" id="papertime" required 
                               class="block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Files -->
                <div>
                    <div class="flex items-center">
                        <i class="fa fa-upload text-indigo-500 text-xl mr-2"></i>
                        <label for="files" class="block text-sm font-medium text-gray-700">Files:</label>
                    </div>
                    <div class="relative mt-1">
                        <input type="file" name="files[]" id="files" multiple required 
                               class="block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fa fa-cloud-upload-alt mr-2"></i> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
