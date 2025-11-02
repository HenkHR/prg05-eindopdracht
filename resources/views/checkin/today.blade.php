<x-app-layout>
    <div>
        <div>
            <h1>Today's Check-ins</h1>
            <p>{{ today()->format('l, F j, Y') }}</p>
        </div>

        @if($checkIns->count() > 0)
            <div class="flex flex-row flex-wrap gap-4">
                @foreach($checkIns as $checkIn)
                    <a href="{{ route('checkin.show', $checkIn) }}" class="bg-gray-700 p-4 rounded-md flex flex-col justify-between gap-2 visited:bg-gray-800" >
                        <p class="text-lg font-bold">{{ $checkIn->user->name }}</p>
                        <p> Has image: {{ $checkIn->image_path ? 'Yes' : 'No' }}</p>
                        <p> Comment: {{ $checkIn->comment ? 'Yes' : 'No'	 }}</p>
                        <p class='bg-gray-700 text-white hover:bg-gray-900 px-4 py-2 border border-white rounded-md'>View Details</p>
                    </a>
                @endforeach
            </div>
        @else
            <div>
                <p>No check-ins today yet.</p>
            </div>
        @endif

        <div>
            <p>Total check-ins today: <span>{{ $checkIns->count() }}</span></p> 
        </div>
    </div>
</x-app-layout>