@extends('layouts.app')

@section('content')
    <div class=" mt-2">
        <h1 class="text-2xl font-bold text-center mt-6 mb-5">{{ $department }} Past Papers</h1>
        
        <div class="max-w-md mx-auto">
            <div class="relative mr-6 ml-6 md:mr-0 md:ml-0">
                <div class="absolute inset-y-0 left-0 flex items-center">
                    <div class="w-10 h-9 bg-blue-700 text-white rounded-l flex justify-center items-center">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                </div>
                <input 
    type="search" 
    id="search" 
    name="search" 
    class="block w-full p-2 pl-12 pr-4 text-sm text-gray-900 border border-gray-200 rounded-lg rounded-l-none bg-white dark:text-black no-clear-button" 
    placeholder="Search by Subject Name..." 
    autocomplete="off" 
    onsearch="return false;" 
    required 
/>
            </div>
        </div>

        <div id="search-results" class=" flex flex-col md:ml-2 md:flex-row flex-wrap mb-2 md:mb-2 justify-center landing-page ">
            @if($pastPapers->isEmpty())
                <div class="text-center mt-5">
                    <h4 class="text-black">No papers uploaded yet</h4>
                </div>
            @else
            @foreach($pastPapers as $pastPaper)
            <div class="ml-4 mr-4 mt-2 md:w-1/3 hover:scale-105 hover:border-gray-600 hover:shadow-xl rounded-md border border-gray-200 p-1 shadow-lg md:ml-0 md:mr-2">
                <a href="{{ route('pastpapers.show', $pastPaper) }}">
                    <h5 class="text-xl font-semibold">{{ $pastPaper->subject }}</h5>
                    <div class="flex flex-row justify-between">
                        <!-- Course Code -->
                        <p class="text-sm font-medium text-black flex items-center"> 
                            <i class="fas fa-bookmark mr-2 text-blue-600"></i> <!-- Blue Course Code Icon -->
                            <strong>Course Code: </strong> 
                            <span class="font-normal">{{ $pastPaper->coursecode }}</span>
                        </p>
        
                        <div class="flex">
                            <!-- Paper Type & Time -->
                            <p class="text-sm font-bold md:ml-2 flex items-center">
                                <i class="fas fa-clock ml-2 mr-2 text-green-600"></i> <!-- Green Time Icon -->
                                {{ $pastPaper->papertype }} - {{ $pastPaper->papertime }}
                            </p>
        
                            <div class="mr-4 ml-8">
                                <button class="rounded bg-blue-600 px-2 hover:bg-blue-800">
                                    <i class="fa-solid fa-angle-right" style="color: #ffffff;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
        
                    <!-- Teacher -->
                    <p class="text-sm font-medium text-black flex items-center">
                        <i class="fas fa-chalkboard-teacher mr-2 text-red-600"></i> <!-- Red Teacher Icon -->
                        <strong>Teacher:  </strong>
                        <span class="font-normal"> {{ $pastPaper->teacher }}</span>
                    </p>
                </a>
            </div>
        @endforeach
        
            @endif
        </div>
    </div>
    <style>
        /* Remove the cross button for modern browsers */
        input[type="search"]::-webkit-search-cancel-button {
            display: none; /* For Chrome, Safari, Edge */
        }
    
        input[type="search"]::-moz-search-clear {
            display: none; /* For Firefox */
        }
    
        /* General fallback for other browsers */
        input[type="search"] {
            appearance: none; /* Standard styling override */
        }
    </style>
    <script>
        $(document).ready(function() {
            var department = @json($department);

            $("#search").on('keyup', function() {
                var value = $(this).val();

                $.ajax({
                    url: "{{ route('pastpapersshow') }}",
                    type: "GET",
                    data: {
                        'search': value,
                        'department': department // Pass department to the server
                    },
                    success: function(data) {
                        var html = '';
                        if(data.length > 0) {
                            for(let i = 0; i < data.length; i++) {
                                html +=`<div class="landing-page">
    <div class="ml-4 mr-4 mt-2 hover:scale-105 hover:border-gray-600 hover:shadow-xl rounded-md border border-gray-200 p-1 shadow-lg md:ml-0 md:mr-2">
        <a href="${data[i].url}">
            <h5 class="text-xl font-semibold">${data[i].subject}</h5>
            <div class="flex flex-row justify-between">
                <!-- Course Code with Icon -->
                <p class="text-sm font-medium text-black flex items-center">
                    <i class="fas fa-bookmark mr-2 text-blue-600"></i> <!-- Blue Course Code Icon -->
                    <strong>Course Code: </strong>
                    <span class="font-normal">${data[i].coursecode}</span>
                </p>

                <div class="flex">
                    <!-- Paper Type and Time with Icon -->
                    <p class="text-sm font-bold md:ml-2 flex items-center">
                        <i class="fas fa-clock mr-2 ml-2 text-green-600"></i> <!-- Green Time Icon -->
                        ${data[i].papertype} - ${data[i].papertime}
                    </p>

                    <div class="mr-4 ml-8">
                        <button class="rounded bg-blue-600 px-2">
                            <i class="fa-solid fa-angle-right" style="color: #ffffff;"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Teacher with Icon -->
            <p class="text-sm font-medium text-black flex items-center">
                <i class="fas fa-chalkboard-teacher mr-2 text-red-600"></i> <!-- Red Teacher Icon -->
                <strong>Teacher: </strong>
                <span class="font-normal">${data[i].teacher}</span>
            </p>
        </a>
    </div>
</div>`

                                ;
                            }
                        } else {
                            html = '<p class="text-center text-gray-500">No papers uploaded yet</p>';
                        }
                        $("#search-results").html(html); // Update search results container
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + error);
                    }
                });
            });
        });
    </script>
@endsection
