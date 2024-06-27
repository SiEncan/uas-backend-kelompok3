<x-layout>
  <x-slot:title>in: {{$title}}</x-slot:title>
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

  @if(session()->has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex justify-center items-center" role="alert">
      <span class="block text-center w-full">{{ session('error') }}</span>
      <span class="absolute top-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';">
            <title>Close</title>
            <path d="M14.348 14.849a.5.5 0 01-.707 0L10 11.207l-3.641 3.642a.5.5 0 01-.707-.707L9.293 10.5 5.651 6.857a.5.5 0 01.707-.707L10 9.793l3.641-3.642a.5.5 0 01.707.707L10.707 10.5l3.641 3.642a.5.5 0 010 .707z"/>
        </svg>
      </span>
    </div>
  @endif

  <div class="bg-white shadow-md rounded-lg p-6 mb-6">
    <div class="flex items-center mb-4">
      <!-- <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/150" alt="User Avatar"> -->
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

    @if ($discussion['author_id'] == auth()->user()->id)
      <div class="flex justify-end">
        <form action="/discussion/{{ $discussion['id'] }}" method="POST" onsubmit="return confirm('Are you sure want to delete this discussion?');">
          @csrf
          @method('DELETE')
          <input type="hidden" id="community_id" name="community_id" value="{{ $discussion['community']['id'] }}">
          <button type="submit" class="text-red-700 hover:underline">Delete Discussion</button>
        </form>
      </div>
    @endif
  </div>
  
  <div class="bg-white shadow-md rounded-lg p-6 mb-6">

    <h3 class="text-xl font-semibold text-gray-900">Add a Comment</h3>
    <form class="mt-4" action="/discussion/post-comment" method="POST">
      @csrf
      <input type="hidden" id="discussion_id" name="discussion_id" value="{{ $discussion['id'] }}">
      <div class="mb-4">
        <textarea name="content" rows="4" class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Write your comment here..." required></textarea>
      </div>
      <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Post Comment</button>
      </div>
    </form>

    <h3 class="text-xl font-semibold text-gray-900">Comments</h3>
    <div class="mt-4 space-y-4">
      @foreach ($comments as $comment)
        <div class="flex items-start">
          <!-- <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
            <span class="text-xl font-bold">B</span>
          </div> -->
          @if($comment['author']['profile_picture'])
            <img class="rounded-full w-12 h-12 object-cover overflow-hidden" src="{{ asset('storage/' . $comment['author']['profile_picture']) }}" alt="Profile Picture">
          @else
            <img class="rounded-full w-12 h-12 object-cover overflow-hidden" src="{{ asset('images/default_pp.png') }}" alt="Default Profile Picture">
          @endif
          <div class="ml-4">
            <div class="bg-gray-100 p-3 rounded-lg shadow-sm">
              <a href="/profile/{{ $comment['author_id'] }}">
                <h4 class="text-md font-semibold text-gray-800 hover:underline">{{ $comment['author']['username'] }}</h4>
              </a>
              <p class="text-gray-600">
                {{ $comment['content'] }}
              </p>
            </div>
            <p class="mt-1 text-sm text-gray-600">{{ $comment['created_at']->format('N M') }} at {{ $comment['created_at']->format('g:i A') }}</p>
            @if ($comment['author_id'] == auth()->user()->id)
              <div class="flex justify-end mt-2">
                <form action="/comment/{{ $comment['id'] }}" method="POST" onsubmit="return confirm('Are you sure want to delete this comment?');">
                  @csrf
                  @method('DELETE')
                  <input type="hidden" id="discussion_id" name="discussion_id" value="{{ $discussion['id'] }}">
                  <button type="submit" class="text-red-700 hover:underline">Delete Comment</button>
                </form>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</x-layout>