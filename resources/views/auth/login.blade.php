@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h1 class="text-2xl font-bold mb-6">Login</h1>

                    @if (Session::has('error'))
                        <p class="text-red-500 mb-4">{{ Session::get('error') }}</p>
                    @endif
                    @if (Session::has('success'))
                        <p class="text-green-500 mb-4">{{ Session::get('success') }}</p>
                    @endif

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Email" />
                            @if ($errors->has('email'))
                                <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="Password" />
                            @if ($errors->has('password'))
                                <p class="text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <a href="#" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Forgot Password?</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
