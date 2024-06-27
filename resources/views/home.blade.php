<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
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
            <h2 class="text-xl font-semibold hover:underline">{{ $discussion['author']['username'] }}</h2>
          </a>
          <h2 class="text-gray-600">{{ $discussion['created_at']->format('N M') }} at {{ $discussion['created_at']->format('g:i A') }}</h2>
        </div>
      </div>
      <a href="/community/{{ $discussion['community']['id'] }}">
        <h2 class="text-gray-400 hover:underline">{{ $discussion['community']['name'] }}</h2>
      </a>
      <h3 class="text-2xl font-bold mb-4">{{ $discussion['title']}}</h3>
      <p class="text-gray-800 mb-4">
        {{ Str::limit($discussion['content'], 200) }}
      </p>
      
      <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
          <a href="/discussion/{{$discussion['id']}}">
          <button class="flex items-center text-gray-600 hover:text-blue-600">
            <svg class="w-6 h-6 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
            {{ $discussion->comments_count }}
          </button>
          </a>
        </div>
          <a href="/discussion/{{$discussion['id']}}"> <button class="text-gray-600 hover:text-blue-600">Reply</button> </a>
      </div>
    </div>
  @endforeach
</x-layout>