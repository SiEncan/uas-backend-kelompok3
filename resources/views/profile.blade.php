<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="flex items-center p-4">
      <!-- <img class="w-24 h-24 rounded-full mx-auto" src="https://via.placeholder.com/150" alt="Profile Picture"> -->
      @if($user['profile_picture'])
        <img class="w-36 h-36 rounded-full mx-auto object-cover overflow-hidden" src="{{ asset('storage/' . $user['profile_picture']) }}" alt="Profile Picture">
      @else
        <img class="w-36 h-36 rounded-full mx-auto object-cover overflow-hidden" src="{{ asset('images/default_pp.png') }}" alt="Default Profile Picture">
      @endif
    </div>
    <div class="p-4">
      <h2 class="text-center text-2xl font-bold text-gray-800">{{ $user["username"] }}</h2>
      <p class="text-center text-gray-600">{{ $user["name"] }} <span class="text-gray-400">({{ $user["gender"] }})</span></p>
      <div class="mt-2">
        <div class="flex items-center justify-center mb-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
          </svg>
          <p class="text-gray-500">{{ $user["email"] }}</p>
        </div>
        <p class="text-center text-gray-500">Discussion Posted: <span class="text-gray-700">{{ $user['discussions_count'] }}</span> </p>
        <div class="flex items-center justify-center">
          <p class="max-w-xs bg-gray-50 p-1 rounded-lg border text-gray-400 text-sm text-center">
            Joined at {{ $user['created_at']->format('j F Y') }}
          </p>
        </div>
      </div>
    </div>
  </div>
</x-layout>