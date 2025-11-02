<x-app-layout>
<div>
        <h1>Clients</h1>

        <form method="GET" action="{{ route('clients') }}" class="mb-10">
            <input type="text"
                   name="search"
                   placeholder="Search clients"
                   value="{{ $searchTerm ?? '' }}" class="text-black">

                <select name="filter" class="text-black">
                    <option value="">All Clients</option>
                    <option value="checked_in_today" {{ ($selectedFilter ?? '') === 'checked_in_today' ? 'selected' : '' }}>
                        Checked in today
                    </option>
                    <option value="not_checked_in_today" {{ ($selectedFilter ?? '') === 'not_checked_in_today' ? 'selected' : '' }}>
                        Not checked in today
                    </option>
                    <option value="checked_in_this_week" {{ ($selectedFilter ?? '') === 'checked_in_this_week' ? 'selected' : '' }}>
                        Checked in this week
                    </option>
                    <option value="has_img_today" {{($selectedFilter ?? '') === 'has_img_today' ? 'selected' : ''}}>
                        Has image today
                    </option>
                </select>


            <button type="submit">Search</button>
        </form>



        @if($clients->count() > 0)
            <div>
                @foreach($clients as $client)
                    <div class="">
                        <a href="{{ route('clients.show', $client) }}" class="flex flex-col bg-gray-700 hover:bg-gray-600 rounded-md w-80 p-2 mb-4">{{ $client->name }}
                            <span>{{ $client->email }}</span></a>

                    </div>
                @endforeach
            </div>
        @else
            <p>No clients found.</p>
        @endif
    </div>
</x-app-layout>
