<nav class="flex flex-col min-w-72 min-h-screen bg-black border-r border-white mr-4">
    <h1 class="text-white text-2xl font-bold">Coaching App</h1>
    <x-nav-link href="{{ route('dashboard') }}" :active="request()->is('dashboard')">Dashboard</x-nav-link>
    @if(auth()->user()->is_admin)
    <x-nav-link href="{{ route('clients') }}" :active="request()->is('clients')">Clients</x-nav-link>
    @endif

    @if(!auth()->user()->is_admin)
    <x-nav-link href="{{ route('checkin') }}" :active="request()->is('checkin')">Check-in</x-nav-link>
    <x-nav-link href="{{ route('feedback') }}" :active="request()->is('feedback')">Feedback</x-nav-link>
    @endif

    <x-nav-link href="{{ route('profile') }}" :active="request()->is('profile')">Profile</x-nav-link>

    <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>

</nav>
