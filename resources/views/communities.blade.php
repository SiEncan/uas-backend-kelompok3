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
  <body class="bg-gray-100 p-10 mb-5">
    <div class="space-y-10">
      <form action="/community" method="POST" class="bg-white rounded-lg shadow-lg p-6 w-full">
        @csrf
        <input type="hidden" id="creator_id" name="creator_id" value="{{ request()->user()->id }}">
        <div class="space-y-5">
          <label class="block text-sm font-bold text-black-700">Create A Community</label>

          <div>
            <div class="mb-4">
              <input type="text" id="name" name="name" required class="@error('name') is-invalid @enderror mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Write a Name ...">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-4">
              <textarea id="description" name="description" required class="@error('description') is-invalid @enderror mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Write a Description ..." rows="5"></textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
        </div>
        <div class="flex justify-end items-center">
          <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Create
          </button>
        </div>
      </form>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($communities as $community)
          <a href="/community/{{$community['id']}}">
            <div class="bg-white p-10 rounded-lg shadow flex items-center hover:bg-gray-100"> 
              <div>
                <h2 class="text-xl font-bold mb-1">{{ $community['name']}}</h2>
                <h2 class="text-l mb-3">Creator: {{ $community['creator']['username'] }}</h2>
                <p class="text-gray-600">{{ $community['description']}}</p>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </body>
</x-layout>