@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-5">Past Papers</h1>
        
        @if(session('urls'))
    <div>
        <h5>Uploaded Files:</h5>
        <ul>
            @foreach(session('urls') as $url)
                <li><a href="{{ $url }}" target="_blank">{{ $url }}</a></li>
            @endforeach
        </ul>
    </div>
@endif
        <!-- Search Box -->
        <div class="max-w-md mx-auto mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded flex justify-center items-center">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                </div>
                <input type="search" id="search" name="search" class="block w-full p-2 pl-12 pr-4 text-sm text-gray-900 border border-gray-200 rounded-lg bg-white" placeholder="Search by Subject..." />
            </div>
        </div>

        <!-- Search Results Container -->
        <div id="search-results" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full px-4">
            @foreach($pastPapers as $pastPaper)
            <div class="p-4 bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                <!-- Paper Title -->
                <h5 class="text-lg font-bold text-gray-800 mb-2">{{ $pastPaper->subject }}</h5>
                
                <!-- Course Code -->
                <p class="text-sm text-gray-600 mb-2">
                    <strong>Course Code:</strong> 
                    <span class="font-normal">{{ $pastPaper->coursecode }}</span>
                </p>
                
                <!-- Paper Type and Time -->
                <p class="text-sm text-gray-600 mb-2">
                    <strong>Type:</strong> 
                    <span class="font-normal">{{ $pastPaper->papertype }}</span>
                    <strong> | Time:</strong> 
                    <span class="font-normal">{{ $pastPaper->papertime }}</span>
                </p>
                
                <!-- Teacher -->
                <p class="text-sm text-gray-600 mb-4">
                    <strong>Teacher:</strong> 
                    <span class="font-normal">{{ $pastPaper->teacher }}</span>
                </p>
                
                <!-- Actions -->
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <!-- View Paper Button -->
                    <a href="{{ route('pastpapers.show', $pastPaper) }}" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 transition-colors">
                        <i class="fa-solid fa-eye mr-2"></i> View
                    </a>
                    
                    <!-- Edit/Delete Buttons (if authorized) -->
                    @if(Auth::check())
                    <div class="flex flex-wrap gap-2">
                        <!-- Edit Button -->
                        <a href="{{ route('pastpapers.edit', $pastPaper->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-sm hover:bg-yellow-600 transition-colors">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('pastpapers.destroy', $pastPaper->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-sm hover:bg-red-700 transition-colors">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
    </div>

   <script>
    $(document).ready(function () {
        $("#search").on('keyup', function () {
            var value = $(this).val();

            $.ajax({
                url: "{{ route('pastpapersshow_home') }}",
                type: "GET",
                data: {
                    'search': value // Only send the search parameter
                },
                success: function (data) {
                    var html = '';
                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {
                            html += `
    <div class="landing-page">
        <div class="ml-4 mr-4 mt-2 hover:scale-105 hover:border-gray-600 hover:shadow-xl rounded-md border border-gray-200 p-4 shadow-lg md:ml-0 md:mr-2 bg-white">
            <a href="${data[i].url}">
                <h5 class="text-xl font-semibold">${data[i].subject}</h5>
                <div class="flex flex-row justify-between">
                    <p class="text-sm font-medium text-black">
                        <strong>Course Code: </strong>
                        <span class="font-normal">${data[i].coursecode}</span>
                    </p>
                    <div class="flex">
                        <p class="text-sm font-bold md:ml-2">${data[i].papertype} - ${data[i].papertime}</p>
                        <div class="mr-4 ml-8">
                            <button class="rounded bg-blue-600 px-2">
                                <i class="fa-solid fa-angle-right" style="color: #ffffff;"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <p class="text-sm font-medium text-black">
                    <strong>Teacher: </strong>
                    <span class="font-normal">${data[i].teacher}</span>
                </p>
            </a>
            <!-- Edit and Delete Buttons -->
            <div class="flex flex-wrap items-center justify-start mt-4 gap-2">
                <!-- Edit Button -->
                <a href="/pastpapers/edit/${data[i].id}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-sm hover:bg-yellow-600 transition-colors">
                    <i class="fa-solid fa-pen"></i> Edit
                </a>
                <!-- Delete Button -->
                <form action="/pastpapers/delete/${data[i].id}" method="POST" class="inline">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-sm hover:bg-red-700 transition-colors">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
`;

                        }
                    } else {
                        html = '<p class="text-center text-gray-500">No papers uploaded yet</p>';
                    }
                    $("#search-results").html(html); // Update search results container
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                }
            });
        });
    });
</script>

    
    
@endsection
