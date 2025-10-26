<x-app-layout>
    <div>
        <a href="{{ route('clients') }}">Back to Clients</a>
    </div>
    <div>
        <h1>{{ $user->name }}</h1>
    </div>
    <div>
        <h2>Email</h2>
        <p>{{ $user->email }}</p>
    </div>

    <div>
        <h2>Check-ins</h2>
        @if($user->checkIns->count() > 0)
            @foreach($user->checkIns as $checkIn)
                <a href="{{ route('checkin.show', $checkIn) }}">{{ $checkIn->created_at->format('l, F j, Y') }}</a>
            @endforeach
        @else
            <p>No check-ins found</p>
        @endif
    </div>
</x-app-layout>
