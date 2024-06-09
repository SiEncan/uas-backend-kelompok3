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
  
</x-layout>