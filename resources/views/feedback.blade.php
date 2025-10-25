<x-app-layout>
    <div>
        <h1>Your Check-in History</h1>

        @if($checkIns->count() > 0)
            <div>
                @foreach($checkIns as $checkIn)
                    <div class=" bg-gray-800 p-4 rounded-md mb-4" href="{{ route('checkin.show', $checkIn) }}">
                        <div>
                            <h3>{{ $checkIn->created_at->format('l, F j, Y') }}</h3>
                        </div>
                        @if($checkIn->image_path)
                            <div>
                                <span>Image: Uploaded</span>
                            </div>
                        @else
                            <div>
                                <span>Image: Not Uploaded</span>
                            </div>
                        @endif
                        <a href="{{ route('checkin.show', $checkIn) }}" class="text-blue-500 hover:text-blue-700">View Details</a>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
