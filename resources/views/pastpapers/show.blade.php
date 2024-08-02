@extends('layouts.app')

@section('content')
    <div class=" mx-auto p-5 ">
        <div class="flex items-center justify-between mb-5 ">
            <button onclick="history.back()" class="px-2 py-1 bg-black text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <i class="fa-solid fa-arrow-left"></i> 
            </button>
            <h1 class="text-2xl font-bold text-center flex-grow ">{{ $pastpaper->subject }}</h1>
        </div>
        
        <div class="flex flex-row justify-start md:justify-center">
            <p class="text-sm font-medium ml-2 text-black"><strong class="text-black">Course Code:</strong> <span class="font-normal"> {{ $pastpaper->coursecode }}</span></p>
            <div class="flex ">
                <p class="text-sm font-bold ml-8 ">{{ $pastpaper->papertype }} - {{ $pastpaper->papertime }}</p>
            </div>
        </div>
        <p class="text-sm font-medium ml-2 text-black md:text-center"><strong class="text-black">Teacher Name:</strong><span class="font-normal"> {{ $pastpaper->teacher }}</span></p>
        
        <div class="mt-4">
            <div class="flex flex-col md:flex-row md:justify-center md:gap-6">
                @foreach($pastpaper->images as $image)
                    <div class="flex flex-col items-center">
                        @if(in_array(pathinfo($image->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                            <a href="{{ asset('storage/' . $image->file_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $pastpaper->title }}" class="w-full h-full md:h-96  rounded-md mt-2 shadow-md ">
                            </a>
                            <a href="{{ route('download', ['file' => $image->file_path, 'original' => $image->original_filename]) }}" class="block text-center mt-2">
                                <button class="rounded bg-blue-600 px-4 py-2 text-white flex items-center shadow-md ">
                                    <i class="fa-solid fa-download mr-2 "></i> Download
                                </button>
                            </a>
                        @elseif(pathinfo($image->file_path, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{ asset('storage/' . $image->file_path) }}" target="_blank">
                                <object data="{{ asset('storage/' . $image->file_path) }}" type="application/pdf" class="w-full h-96 mb-2" aria-label="PDF Viewer">
                                    <p class="text-center mt-6 font-bold text-red-600">Your browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('storage/' . $image->file_path) }}">Download PDF</a>.</p>
                                </object>
                            </a>
                            <a href="{{ route('download', ['file' => $image->file_path, 'original' => $image->original_filename]) }}" class="block text-center mt-2">
                                <button class="rounded bg-blue-600 px-4 py-2 text-white flex items-center shadow-md ">
                                    <i class="fa-solid fa-download mr-2"></i> Download PDF
                                </button>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="mt-6 flex space-x-2">
            @can('update', $pastpaper)
                <a href="{{ route('pastpapers.edit', $pastpaper->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Edit</a>
            @endcan
            @can('delete', $pastpaper)
                <form action="{{ route('pastpapers.destroy', $pastpaper->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete</button>
                </form>
            @endcan
        </div>
    </div>
@endsection
