<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'BookSwap')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <header class="font-inter bg-gray-700 text-white">
  <div class="relative container mx-auto flex flex-wrap items-center justify-between py-4 px-8">
    <h1 class="text-3xl font-bold">Буквоежка</h1>

    <button id="nav-toggle" class="md:hidden focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    <nav id="nav-menu"
         class="absolute top-full left-0 w-full bg-gray-700 px-4 py-4 flex-col gap-2 hidden flex-wrap self-center md:justify-normal md:static md:flex md:flex-row md:w-auto md:items-center md:bg-transparent md:p-0">
      <x-link-button href="{{ route('home') }}">Главная</x-link-button>

      @guest
        <x-link-button href="{{ route('login') }}">Вход</x-link-button>
        <x-link-button href="{{ route('register') }}">Регистрация</x-link-button>
      @endguest

      @auth
        @can('admin')
          <x-link-button href="{{ route('admin.index') }}">Админка</x-link-button>
        @endcan

        @cannot('admin')
          <x-link-button href="{{ route('cards.index') }}">Карточки</x-link-button>
        @endcannot

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        <x-link-button href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</x-link-button>
      @endauth
    </nav>
  </div>
</header>



  <main class="container mx-auto mb-20 py-8">
    <div class="flex flex-col items-center font-inter">
      @yield('content')
    </div>
  </main>

  <script>
  const toggle = document.getElementById('nav-toggle');
  const menu = document.getElementById('nav-menu');

  toggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
  </script>

  @stack('scripts')

</body>
</html>