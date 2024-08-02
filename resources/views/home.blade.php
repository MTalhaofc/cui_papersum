@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-5">Past Papers</h1>
        
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
        <div id="search-results" class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full px-2">
            @foreach($pastPapers as $pastPaper)
            <div class="ml-4 mr-4 mt-2 rounded-md border border-gray-200 p-1 shadow-lg md:ml-0 md:mr-2">
                <h5 class="text-xl font-semibold">{{ $pastPaper->subject }}</h5>
                <div class="flex flex-row justify-between">
                  <p class="text-sm font-medium text-black"> <strong>Course Code: </strong> <span class="font-normal"> {{ $pastPaper->coursecode }}</span></p>
                  <div class="flex ">
                    <p class=" text-sm font-bold md:ml-2">{{ $pastPaper->papertype }} - {{ $pastPaper->papertime }}</p>
                  <div class="mr-4 ml-8">
            
                    <a href="{{ route('pastpapers.show', $pastPaper) }}" class="">
                      <button class="rounded bg-blue-600 px-2 "><i class="fa-solid fa-angle-right" style="color: #ffffff;"></i></i></button>
                    </a>
                  </div>

                <p class="text-sm font-medium text-black"><strong> Teacher: </strong> <span class="font-normal"> {{ $pastPaper->teacher }}</span></p>
              </div>
                    @if(Auth::id() === $pastPaper->user_id)
                        <a href="{{ route('pastpapers.edit', $pastPaper->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Edit</a>
                        <form action="{{ route('pastpapers.destroy', $pastPaper->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 ml-2">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('search').addEventListener('keyup', function() {
                const value = this.value;
                fetch(`{{ route('pastpapersshow') }}?search=${value}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Debug: log data received from the server
                        let html = '';
                        if(data.length > 0) {
                            data.forEach(paper => {
                                html += `
                                    <div class="border border-gray-200 bg-white rounded-lg shadow-lg flex justify-between items-center p-3">
                                        <div>
                                            <h5 class="text-xl font-bold">${paper.subject}</h5>
                                            <div class="mt-2 flex">
                                                <p class="text-sm mr-5"><strong>Course Code:</strong> ${paper.coursecode}</p>
                                                <p class="text-sm font-bold">${paper.papertype}</p>
                                                <p class="text-sm font-bold ml-1"><strong> -</strong> ${paper.papertime}</p>
                                            </div>
                                            <div class="mt-2 flex">
                                                <p class="text-sm mr-5"><strong>Teacher:</strong> ${paper.teacher}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <a href="${paper.url}" class="flex items-center px-3 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                        ${paper.user_id === {{ Auth::id() }} ? `
                                            <a href="/pastpapers/${paper.id}/edit" class="px-4 py-2 bg-yellow-500 text-white rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Edit</a>
                                            <form action="/pastpapers/${paper.id}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 ml-2">Delete</button>
                                            </form>
                                        ` : ''}
                                    </div>
                                `;
                            });
                        } else {
                            html = '<p class="text-center text-gray-500">Nothing to Show</p>';
                        }
                        document.getElementById('search-results').innerHTML = html;
                    })
                    .catch(error => console.error('AJAX Error:', error));
            });
        });
    </script>
@endsection
