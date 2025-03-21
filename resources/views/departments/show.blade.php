@extends('layouts.app')

@section('content')
    <div class="mt-2">
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
                    class="block w-full p-2 pl-12 pr-4 text-sm text-gray-900 border border-gray-200 rounded-lg rounded-l-none bg-white dark:text-black" 
                    placeholder="Search by Subject Name/Course Code..." 
                    autocomplete="off" 
                    required 
                />
            </div>

            <!-- Filter Checkboxes -->
            <div class="mt-3 flex justify-center space-x-4">
                <label class="flex items-center">
                    <input type="checkbox" class="filter-checkbox h-4 w-4 text-blue-600" value="Mid">
                    <span class="ml-2 text-sm text-gray-700">Mid</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" class="filter-checkbox h-4 w-4 text-blue-600" value="Terminal">
                    <span class="ml-2 text-sm text-gray-700">Terminal / Final</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" class="filter-checkbox h-4 w-4 text-blue-600" value="Both">
                    <span class="ml-2 text-sm text-gray-700">Both</span>
                </label>
            </div>
        </div>

        <div id="search-results" class="flex flex-col md:ml-2 md:flex-row flex-wrap mb-2 justify-center landing-page">
            @if($pastPapers->isEmpty())
                <div class="text-center mt-5">
                    <h4 class="text-black">No papers uploaded yet</h4>
                </div>
            @else
                @foreach($pastPapers as $pastPaper)
                    <div class="paper-item ml-4 mr-4 mt-2 md:w-1/3 hover:scale-105 hover:border-gray-600 hover:shadow-xl rounded-md border border-gray-200 p-1 shadow-lg md:ml-0 md:mr-2" data-type="{{ $pastPaper->papertype }}">
                        <a href="{{ route('pastpapers.show', $pastPaper) }}">
                            <h5 class="text-xl font-semibold">{{ $pastPaper->subject }}</h5>
                            <div class="flex flex-row justify-between">
                                <p class="text-sm font-medium text-black flex items-center">
                                    <i class="fas fa-bookmark mr-2 text-blue-600"></i>
                                    <strong>Course Code: </strong> 
                                    <span class="font-normal course-code">{{ $pastPaper->coursecode }}</span>                                </p>
                                <div class="flex">
                                    <p class="text-sm font-bold md:ml-2 flex items-center">
                                        <i class="fas fa-clock ml-2 mr-2 text-green-600"></i>
                                        {{ $pastPaper->papertype }} - {{ $pastPaper->papertime }}
                                    </p>
                                    <div class="mr-4 ml-8">
                                        <button class="rounded bg-blue-600 px-2 hover:bg-blue-800">
                                            <i class="fa-solid fa-angle-right" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm font-medium text-black flex items-center">
                                <i class="fas fa-chalkboard-teacher mr-2 text-red-600"></i>
                                <strong>Teacher: </strong>
                                <span class="font-normal">{{ $pastPaper->teacher }}</span>
                            </p>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
      $(document).ready(function() {
    function filterResults() {
        var searchText = $("#search").val().toLowerCase();
        var selectedTypes = $(".filter-checkbox:checked").map(function() {
            return $(this).val();
        }).get();

        $(".paper-item").each(function() {
            var subject = $(this).find("h5").text().toLowerCase();
            var courseCode = $(this).find(".course-code").text().toLowerCase(); // Get course code

            var matchesSearch = subject.includes(searchText) || courseCode.includes(searchText);
            var type = $(this).data("type");
            var matchesFilter = selectedTypes.length === 0 || selectedTypes.includes(type) || (type === "Final" && selectedTypes.includes("Terminal"));

            $(this).toggle(matchesSearch && matchesFilter);
        });
    }

    $("#search").on("keyup", filterResults);
    $(".filter-checkbox").on("change", filterResults);
});

    </script>
    <style>
        /* Remove the clear (cross) button in modern browsers */
        input[type="search"]::-webkit-search-cancel-button {
            display: none; /* Chrome, Safari, Edge */
        }
    
        input[type="search"]::-moz-search-clear {
            display: none; /* Firefox */
        }
    
        /* General fallback for other browsers */
        input[type="search"] {
            appearance: none;
        }
    </style>
@endsection
