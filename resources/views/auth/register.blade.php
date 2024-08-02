@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h1 class="text-2xl font-bold mb-6">Register</h1>

                    @if (Session::has('error'))
                        <p class="text-red-500 mb-4">{{ Session::get('error') }}</p>
                    @endif

                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Name" />
                            @if ($errors->has('name'))
                                <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Email" />
                            @if ($errors->has('email'))
                                <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Password" />
                            @if ($errors->has('password'))
                                <p class="text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Password Confirmation" />
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="#" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Forgot Password?</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
