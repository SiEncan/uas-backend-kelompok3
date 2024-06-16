<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  
  <div class="bg-white shadow-md rounded-lg p-6 mb-6">
    <div class="flex items-center mb-4">
      <img class="w-12 h-12 rounded-full" src="https://via.placeholder.com/150" alt="User Avatar">
      <div class="ml-4">
        <h2 class="text-xl font-semibold">{{$discussion['author']['username']}}</h2>
        <p class="text-gray-600">{{ $discussion['created_at']->format('N M') }} at {{ $discussion['created_at']->format('g:i A') }}</p>
      </div>
    </div>
    <h3 class="text-2xl font-bold mb-4">{{ $discussion['title']}}</h3>
    <p class="text-gray-800 mb-4">
      {{ $discussion['content']}}
    </p>
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
          <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
            <span class="text-xl font-bold">B</span>
          </div>
          <div class="ml-4">
            <div class="bg-gray-100 p-3 rounded-lg shadow-sm">
              <h4 class="text-md font-semibold text-gray-800">{{ $comment['author']['name'] }}</h4>
              <p class="text-gray-600">
                {{ $comment['content'] }}
              </p>
            </div>
            <p class="mt-1 text-sm text-gray-600">{{ $comment['created_at']->format('N M') }} at {{ $comment['created_at']->format('g:i A') }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</x-layout>