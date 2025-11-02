<x-app-layout>
        <div class="mb-4">
            <x-back href="{{ route('clients') }}">Back to Clients</x-back>
        </div>
    <div class="flex flex-row space-x-40">
        <div>
            <div class="mb-4">
                <h1 class="text-white text-xl">{{ $user->name }}</h1>
            </div>
            <div>
                <h2 class="text-lg">Email:</h2>
                <p>{{ $user->email }}</p>
            </div>
        </div>

        <div>
            <h2 class="text-xl mb-4">Check-ins</h2>
            <div class="flex flex-col">
                @if($user->checkIns->count() > 0)
                    @foreach($user->checkIns as $checkIn)
                        <a href="{{ route('checkin.show', $checkIn) }}" class="bg-gray-700 p-2 mb-4 text-center rounded">
                            {{ $checkIn->created_at->format('l, F j, Y') }}
                            <br>
                            @if($checkIn->image_path)
                                <span>Image: Uploaded</span>
                            @else
                                <span>Image: Not Uploaded</span>
                            @endif
                        </a>
                    @endforeach
                @else
                    <p>No check-ins found</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
