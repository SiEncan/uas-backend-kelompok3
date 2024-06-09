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
      <div class="ml-4 flex items-center md:ml-6 space-x-5">
        <h1 class="text-base font-medium leading-none text-gray-300 py-1">
          Hi, <a href="/profile" class="text-white hover:underline" >{{ request()->user()->username }}</a>!
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