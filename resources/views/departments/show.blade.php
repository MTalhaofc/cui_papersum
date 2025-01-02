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
                <input type="search" id="search" name="search" class="block w-full p-2 pl-12 pr-4 text-sm text-gray-900 border border-gray-200 rounded-lg rounded-l-none bg-white dark:text-black" placeholder="Search by Subject Name..." required />
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
                                <p class="text-sm font-medium text-black"> 
                                    <strong>Course Code: </strong> 
                                    <span class="font-normal">{{ $pastPaper->coursecode }}</span>
                                </p>
                                <div class="flex">
                                    <p class="text-sm font-bold md:ml-2">{{ $pastPaper->papertype }} - {{ $pastPaper->papertime }}</p>
                                    <div class="mr-4 ml-8">
                                        <button class="rounded bg-blue-600 px-2 hover:bg-blue-800">
                                            <i class="fa-solid fa-angle-right" style="color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm font-medium text-black">
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
    console.log("Document is ready."); // Log when the document is fully loaded

    var department = @json($department);
    console.log("Department loaded:", department); // Log the department value

    $("#search").on('keyup', function() {
        var value = $(this).val();
        console.log("Search input value:", value); // Log the value entered in the search box

        $.ajax({
            url: "{{ route('pastpapersshow') }}",
            type: "GET",
            data: {
                'search': value,
                'department': department
            },
            beforeSend: function() {
                console.log("Sending AJAX request with data:", { search: value, department: department });
            },
            success: function(data) {
                console.log("AJAX request successful. Response data:", data); // Log the response data

                var html = '';
                if (data.length > 0) {
                    console.log("Papers found:", data.length); // Log the number of papers returned
                    data.forEach(function(paper, index) {
                        console.log(`Processing paper ${index + 1}:`, paper); // Log each paper object
                        html += `
                        <div class="landing-page">
                            <div class="ml-4 mr-4 mt-2 hover:scale-105 hover:border-gray-600 hover:shadow-xl rounded-md border border-gray-200 p-1 shadow-lg md:ml-0 md:mr-2">
                                <a href="${paper.url}">
                                    <h5 class="text-xl font-semibold">${paper.subject}</h5>
                                    <div class="flex flex-row justify-between">
                                        <p class="text-sm font-medium text-black">
                                            <strong>Course Code: </strong>
                                            <span class="font-normal">${paper.coursecode}</span>
                                        </p>
                                        <div class="flex">
                                            <p class="text-sm font-bold md:ml-2">${paper.papertype} - ${paper.papertime}</p>
                                            <div class="mr-4 ml-8">
                                                <button class="rounded bg-blue-600 px-2">
                                                    <i class="fa-solid fa-angle-right" style="color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm font-medium text-black">
                                        <strong>Teacher: </strong>
                                        <span class="font-normal">${paper.teacher}</span>
                                    </p>
                                </a>
                            </div>
                        </div>
                        `;
                    });
                } else {
                    console.log("No papers found."); // Log if no papers are found
                    html = '<p class="text-center text-gray-500">No papers uploaded yet</p>';
                }
                $("#search-results").html(html); // Update search results container
                console.log("Search results updated."); // Log when the results are updated
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed."); // Log when the AJAX request fails
                console.error("Status:", status); // Log the status
                console.error("Error:", error); // Log the error message
                console.error("Response Text:", xhr.responseText); // Log the server's response text

                $("#search-results").html('<p class="text-center text-red-500">Something went wrong. Please try again later.</p>');
            }
        });
    });
});
</script>
@endsection
