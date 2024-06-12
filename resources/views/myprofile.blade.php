<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  @if(session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-5 rounded relative flex justify-center items-center" role="alert">
        <span class="block text-center w-full">{{ session('success') }}</span>
        <span class="absolute top-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
                <title>Close</title>
                <path d="M14.348 14.849a.5.5 0 01-.707 0L10 11.207l-3.641 3.642a.5.5 0 01-.707-.707L9.293 10.5 5.651 6.857a.5.5 0 01.707-.707L10 9.793l3.641-3.642a.5.5 0 01.707.707L10.707 10.5l3.641 3.642a.5.5 0 010 .707z"/>
            </svg>
        </span>
    </div>
  @endif
  <form action="/update-public-info" method="POST">
    @method('PATCH')
    @csrf
    <h2 class="text-l font-semibold mb-4">Public Info</h2>
    <div class="mb-6 max-w-xs">
      <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
      <input type="text" id="username" name="username" class="@error('username') is-invalid @enderror mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="{{ auth()->user()->username }}">
      @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-6 max-w-xs">
      <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
      <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="{{ auth()->user()->name }}">
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-6 max-w-md">
      <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
      <input type="text" id="email" name="email" class="@error('email') is-invalid @enderror mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="{{ auth()->user()->email }}">
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="mb-10 max-w-xs ">
      <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
      <select id="gender" name="gender" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        <option value="Male" {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
      </select>
    </div>

    <div class="flex space-x-4 justify-end mb-4 pb-4 border-b border-gray-200">
      <button type="button" class="text-black hover:underline font-medium" onclick="window.history.back()">Cancel</button>
      <button type="submit" class="bg-red-700 hover:bg-red-600 text-white font-medium py-2 px-4 rounded">Save</button>
    </div>
  </form>
</x-layout>