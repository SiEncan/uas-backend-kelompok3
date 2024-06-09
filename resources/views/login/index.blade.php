<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <title>Login Page</title>
</head>
<body>
    
<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
--> 
    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex justify-center items-center" role="alert">
            <span class="block text-center w-full">{{ session('success') }}</span>
            <span class="absolute top-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                    <title>Close</title>
                    <path d="M14.348 14.849a.5.5 0 01-.707 0L10 11.207l-3.641 3.642a.5.5 0 01-.707-.707L9.293 10.5 5.651 6.857a.5.5 0 01.707-.707L10 9.793l3.641-3.642a.5.5 0 01.707.707L10.707 10.5l3.641 3.642a.5.5 0 010 .707z"/>
                </svg>
            </span>
        </div>
    @endif

    @if(session()->has('loginFailed'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex justify-center items-center" role="alert">
            <span class="block text-center w-full">{{ session('loginFailed') }}</span>
            <span class="absolute top-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                    <title>Close</title>
                    <path d="M14.348 14.849a.5.5 0 01-.707 0L10 11.207l-3.641 3.642a.5.5 0 01-.707-.707L9.293 10.5 5.651 6.857a.5.5 0 01.707-.707L10 9.793l3.641-3.642a.5.5 0 01.707.707L10.707 10.5l3.641 3.642a.5.5 0 010 .707z"/>
                </svg>
            </span>
        </div>
    @endif


    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-100 w-auto" src="{{ asset('images/logo-text.png') }}" alt="Taruma Space Logo">
        <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login to your Taruma Space account</h2>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/login" method="POST">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
            <input id="email" name="email" type="email" autofocus autocomplete="email"  required class="@error('email') is-invalid @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror      
        </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            </div>
            <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="@error('password') is-invalid @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror  
        </div>
        </div>

        <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-red-700 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
        </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
        Not Registered?
        <a href="/register" class="font-semibold leading-6 text-red-700 hover:text-red-500">Register</a>
        </p>
    </div>
    </div>
</body>
</html>