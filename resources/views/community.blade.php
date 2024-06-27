<x-layout>
  <x-slot:title>Community: {{$title}}</x-slot:title>
  <x-slot:description>{{ $description }}</x-slot:description>
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
      <form action="/discussion" method="POST" class="bg-white rounded-lg shadow-lg p-6 w-full">
        @csrf
        <div class="space-y-5">
          <label class="block text-sm font-bold text-black-700">Create A Discussion</label>

          <div>
            <div class="mb-4">
              <input type="hidden" id="community_id" name="community_id" value="{{ $community_id }}">
              <input type="hidden" id="author_id" name="author_id" value="{{ request()->user()->id }}">
              <input type="text" id="title" name="title" required class="@error('title') is-invalid @enderror mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Write a Title ...">
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-4">
              <textarea id="content" name="content" required class="@error('content') is-invalid @enderror mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Write a paragraph ..." rows="5"></textarea>
              @error('content')
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
      @foreach ($discussions as $discussion)
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
          <div class="flex items-center mb-4">
            @if($discussion['author']['profile_picture'])
              <img class="rounded-full w-12 h-12 object-cover overflow-hidden" src="{{ asset('storage/' . $discussion['author']['profile_picture']) }}" alt="Profile Picture">
            @else
              <img class="rounded-full w-12 h-12 object-cover overflow-hidden" src="{{ asset('images/default_pp.png') }}" alt="Default Profile Picture">
            @endif
            <div class="ml-4">
              <a href="/profile/{{ $discussion['author_id'] }}">
                <h2 class="text-xl font-semibold hover:underline">{{$discussion['author']['username']}}</h2>
              </a>
              <p class="text-gray-600">{{ $discussion['created_at']->format('N M') }} at {{ $discussion['created_at']->format('g:i A') }}</p>
            </div>
          </div>
          <h3 class="text-2xl font-bold mb-4">{{ $discussion['title']}}</h3>
          <p class="text-gray-800 mb-4">
            {{ $discussion['content']}}
          </p>
          
          <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">

              <!-- comment -->
              <a href="/discussion/{{$discussion['id']}}">
              <button class="flex items-center text-gray-600 hover:text-blue-600">
                <svg class="w-6 h-6 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
                <span>{{ $discussion->comments_count }}</span>
              </button>
              </a>

            </div>
              <a href="/discussion/{{$discussion['id']}}"> <button class="text-gray-600 hover:text-blue-600">Reply</button> </a>
          </div>
        </div>
      @endforeach
    </div>
  </body>
</x-layout>