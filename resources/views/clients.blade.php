<x-app-layout>
<div>
        <h1>Clients</h1>

        <form method="GET" action="{{ route('clients') }}">
            <input type="text" 
                   name="search" 
                   placeholder="Search clients" 
                   value="{{ $searchTerm ?? '' }}">
            <button type="submit">Search</button>
        </form>
        
        
        @if($clients->count() > 0)
            <div>
                @foreach($clients as $client)
                    <div>
                        <a href="{{ route('clients.show', $client) }}">{{ $client->name }}</a>
                        <span>{{ $client->email }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p>No clients found.</p>
        @endif
    </div>
</x-app-layout> 
