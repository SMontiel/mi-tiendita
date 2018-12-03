<div class="px-16 py-2 shadow bg-primary border-tertiary border-t-4">
  <nav class="flex items-center justify-between flex-wrap">
    <a class="no-underline flex items-center text-soft-black" href="/">
      <img src="{{ asset('images/don-balon.png') }}" class="fill-current h-16 w-16 mr-2" alt="Logo">
      <span class="font-semibold font-sans text-xl">Don Balón</span>
    </a>

    <div class="block w-full flex-grow sm:flex sm:items-center sm:w-auto">
      <div class="text-sm sm:flex-grow"></div>
      <div class="sm:inline-flex sm:items-center">
        <a href="/acerca-de" class="mx-2 no-underline font-sans text-grey-darker border-b-2 border-transparent hover:border-tertiary hover:text-black">
          Acerca de
        </a>

        @guest
            <a href="{{ route('login') }}" class="mx-2 no-underline font-sans text-grey-darker border-b-2 border-transparent hover:border-tertiary hover:text-black">
                {{ __('Login') }}
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="mx-2 no-underline font-sans text-grey-darker border-b-2 border-transparent hover:border-tertiary hover:text-black">
                    {{ __('Register') }}
                </a>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest

      </div>
    </div>

  </nav>
</div>
