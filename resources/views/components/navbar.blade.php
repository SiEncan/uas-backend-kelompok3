<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <img class="h-10 w-10" src="{{ asset('images/logo.png') }}" alt="Taruma Space Logo">
        </div>
        <a href="/">
          <h1 class=" text-white rounded-md px-5 font-bold">Taruma Space</h1>
        </a>
        <div class="ml-5 flex items-baseline space-x-4">
          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
          <x-navlink href="/" :active="request()->is('/')">Home</x-navlink>
          <x-navlink href="/community" :active="request()->is('community')">Community</x-navlink>
        </div>
      </div>
      <div class="flex-1 ml-4 md:ml-6 mr-10">
        <form class="relative" id="searchForm" action="/search-discussion" method="POST">
          @method('GET')
          @csrf
          <input type="text" placeholder="Search..." name="search_key" class="w-full py-2 px-4 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-600 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
          </button>
        </form>
      </div>
      <div class="ml-4 flex items-center md:ml-6 space-x-5">
        <h1 class="text-base font-medium leading-none text-gray-300 py-1">
          Hi, <a href="/myprofile" class="text-white hover:underline" >{{ request()->user()->username }}</a>!
        </h1>
        <form action="/logout" method="POST">
          @csrf
          <button type="submit" class="bg-red-800 hover:bg-red-900 text-white text-sm font-bold py-2 px-4 rounded">
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>