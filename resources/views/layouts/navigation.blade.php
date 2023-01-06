<nav class="navbar bg-primary" style="height: 15vh">
  <div class="container">
    <a class="col-1 navbar-brand" href="#">
      <img src="/public/assets/images/logo-pam.jpg" alt="Logo" width="120" height="120"
        class="d-inline-block align-text-top">
    </a>
    <div class="col">
      <p class="text-white">NON REVENUE WATER</p>
      <p class="text-white">PDAM PAM DKI JAKARTA</p>
    </div>
    <!-- Settings Dropdown -->
    <div class="col-1">
      <x-dropdown>
        <x-slot name="trigger">
          <button
            class="flex items-center text-sm font-medium text-white hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
            <div>{{ Auth::user()->name }}</div>

            <div class="ml-1">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd" />
              </svg>
            </div>
          </button>
        </x-slot>

        <x-slot name="content">
          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">
              {{ __('Log Out') }}
            </x-dropdown-link>
          </form>
        </x-slot>
      </x-dropdown>
    </div>
  </div>
</nav>