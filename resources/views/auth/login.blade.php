@extends('layouts.guest')

@section('content')
    @error('login')
    <p>{{ $message }}</p>
    @enderror
    <div
        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blue-gray-200 border-0">
        <div class="rounded-t mb-0 px-6 py-6">
            <div class="text-center mb-3">
                <h6 class="text-blue-gray-500 text-sm font-bold">
                    Sign in with
                </h6>
            </div>
        </div>
        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="relative w-full mb-3">
                    <label class="block uppercase text-blue-gray-600 text-xs font-bold mb-2" for="grid-password">Username</label>
                    <input
                        name="username"
                        type="text"
                        class="border-0 px-3 py-3 placeholder-blue-gray-300 text-blue-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        placeholder="Username"
                        value="{{ old('username') }}" required autocomplete="username" autofocus>
                </div>
                <div class="relative w-full mb-3">
                    <label class="block uppercase text-blue-gray-600 text-xs font-bold mb-2" for="grid-password">Password</label>
                    <input
                        name="password"
                        type="password"
                        class="border-0 px-3 py-3 placeholder-blue-gray-300 text-blue-gray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        placeholder="Password"
                        required autocomplete="password">
                </div>
                <div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input id="remember"
                               name="remember"
                               type="checkbox"
                               class="form-checkbox border-0 rounded text-blue-gray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2 text-sm font-semibold text-blue-gray-600">Remember me</span>
                    </label>
                </div>
                <div class="text-center mt-6">
                    <button
                        class="bg-blue-gray-800 text-white active:bg-blue-gray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                        type="submit"> Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
