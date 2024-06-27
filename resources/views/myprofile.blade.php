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
  <form action="/update-public-info" method="POST" enctype="multipart/form-data">
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

    <div class="mb-6">
      <label class="block text-sm font-medium text-gray-700 mb-1">Current Profile Picture</label>
      <div class="flex items-center space-x-4">
        <input name="current_profile_picture" value="{{ auth()->user()->profile_picture }}" type="hidden">
        @if(auth()->user()->profile_picture)
          <img id="profile_picture" class="rounded-full w-32 h-32 object-cover overflow-hidden" src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture">
        @else
          <img id="profile_picture" class="rounded-full w-32 h-32 object-cover overflow-hidden" src="{{ asset('images/default_pp.png') }}" alt="Default Profile Picture">
        @endif
        <label for="input_profile_picture" class="shadow-md inline-flex items-center bg-white hover:bg-gray-100 border border-gray-300 text-gray-700 text-sm font-semibold py-2 px-4 rounded cursor-pointer">
          Change
        </label>
        <input type="file" name="profile_picture" id="input_profile_picture" class="@error('profile_picture') is-invalid @enderror hidden" onchange="previewImage(event)">
        @error('profile_picture')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>

    <div class="flex space-x-4 justify-end mb-4 pb-4 border-b border-gray-200">
      <button type="button" class="text-black hover:underline font-medium" onclick="window.history.back()">Cancel</button>
      <button type="submit" class="bg-red-700 hover:bg-red-600 text-white font-medium py-2 px-4 rounded">Save</button>
    </div>
  </form>
  <form action="/update-private-info" method="POST">
    @method('PATCH')
    @csrf
    <h2 class="text-l font-semibold mb-4">Private Info</h2>
    <div class="mb-6 max-w-md">
      <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
      <input type="password" id="current_password" name="current_password" required class="@error('current_password') is-invalid @enderror mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      @error('current_password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-6 max-w-md">
      <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
      <input type="password" id="new_password" name="new_password" required class="@error('new_password') is-invalid @enderror mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      @error('new_password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-6 max-w-md">
      <label for="new_confirm_password" class="block text-sm font-medium text-gray-700">New Password Confirmation</label>
      <input type="password" id="new_confirm_password" name="new_confirm_password" required class="@error('new_confirm_password') is-invalid @enderror mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      @error('new_confirm_password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="flex space-x-4 justify-end mb-4 pb-4 border-b border-gray-200">
      <button type="button" class="text-black hover:underline font-medium" onclick="window.history.back()">Cancel</button>
      <button type="submit" class="bg-red-700 hover:bg-red-600 text-white font-medium py-2 px-4 rounded">Save</button>
    </div>
  </form>
  <div class="flex justify-end">
    <form action="/profile/{{ auth()->user()->id }}" method="POST" onsubmit="return confirm('Are you sure want to delete your account?');">
      @csrf
      @method('DELETE')
      <button type="submit" class="text-red-700 hover:underline">Delete Account</button>
    </form>
  </div>
  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        const output = document.getElementById('profile_picture');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
</x-layout>