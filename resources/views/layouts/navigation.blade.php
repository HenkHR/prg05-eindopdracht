<nav class="flex flex-col min-w-72 min-h-screen bg-black border-r border-white mr-4">
    <h1 class="text-white text-2xl font-bold">Coaching App</h1>
    <x-nav-link href="{{ route('dashboard') }}" :active="request()->is('dashboard')">Dashboard</x-nav-link>
    @if(auth()->user()->is_admin)
    <x-nav-link href="{{ route('clients') }}" :active="request()->is('clients')">Clients</x-nav-link>
    <x-nav-link href="{{ route('checkins.today') }}" :active="request()->is('checkins/today')">Today ({{ \App\Models\CheckIn::whereDate('created_at', today())->count() }})</x-nav-link>
    @endif

    @if(!auth()->user()->is_admin)
    <x-nav-link href="{{ route('checkin') }}" :active="request()->is('checkin')">Check-in</x-nav-link>
    <x-nav-link href="{{ route('feedback') }}" :active="request()->is('feedback')">Feedback</x-nav-link>
        @if(!auth()->user()->is_admin && \App\Models\CheckIn::where('user_id', auth()->id())->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() >= 2)
            <x-nav-link href="{{ route('weekly.report') }}" :active="request()->is('weekly-report')">Last week</x-nav-link>
            @else
            <x-nav-link class="text-gray-500" href="#" :active="false">Last week</x-nav-link>
        @endif
    @endif

    <x-nav-link href="{{ route('profile.edit') }}" :active="request()->is('profile.edit')">Profile</x-nav-link>

    <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-nav-link>
                </form>

</nav>
