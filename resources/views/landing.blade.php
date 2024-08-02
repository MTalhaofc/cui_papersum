@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class=" main font-black text-xl md:text-4xl text-center mt-14 md:mt-12 mt-6 ">Instant Access to Past Papers <br>for Comprehensive <span class="main"> Exam Preparation</span>.</h1>

        
        </div>

        <div class="mt-4 flex flex-col md:flex-row justify-center items-center">
            <div class="w-full md:w-1/3 max-w-sm h-full p-4 bg-white border hover:scale-110 hover:border-gray-600 border-gray-200 rounded-lg shadow-lg mx-2 my-1 md:my-0">
                <div class="flex justify-between">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Computer Science</h5>
                    <img class="h-8" src="{{ asset('assets/cs_dept.svg') }}" alt="Computer">
                </div>
                <p class="mb-3 text-base text-gray-700">Past papers of Computer Science (CS) ,FSN, Math and Software Engineering (SE).</p>
                <a href="{{ route('departments.show', ['department' => 'Computer Science']) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Go
                    <svg class="w-3.5 h-3.5 ml-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
            <div class="w-full md:w-1/3 max-w-sm h-full p-4 bg-white border hover:scale-110 hover:border-gray-600 border-gray-200 rounded-lg shadow-lg mx-2 my-1 md:my-0">
                <div class="flex justify-between">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Engineering</h5>
                    <img class="h-9" src="{{ asset('assets/eng_dept.svg') }}" alt="Engineering">
                </div>
                <p class="mb-3 text-base text-gray-700">Past papers of Electrical (EE), Civil (CE) and Mechanical (ME).</p>
                <a href="{{ route('departments.show', ['department' => 'Engineering']) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Go
                    <svg class="w-3.5 h-3.5 ml-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
            <div class="w-full md:w-1/3 max-w-sm h-full p-4 bg-white border border-gray-200 hover:scale-110 hover:border-gray-600 rounded-lg shadow-lg mx-2 my-1 md:my-0">
                <div class="flex justify-between">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">BBA</h5>
                    <img class="h-10" src="{{ asset('assets/bba_dept.svg') }}" alt="Business">
                </div>
                <p class="mb-3 text-base text-gray-700">Past papers of Business Administration and English.</p>
                <a href="{{ route('departments.show', ['department' => 'BBA']) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Go
                    <svg class="w-3.5 h-3.5 ml-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
        


        {{-- <form action="{{ route('landing') }}" method="GET" class="mt-8">
            <div>
                <label for="subject">Search by Subject:</label>
                <input type="text" name="subject" id="subject" value="{{ request('subject') }}">
            </div>
            <div>
                <label for="coursecode">Search by Course Code:</label>
                <input type="text" name="coursecode" id="coursecode" value="{{ request('coursecode') }}">
            </div>
            <button type="submit">Search</button>
        </form> --}}

        <!-- Existing search results and past papers -->
    </div>
@endsection
