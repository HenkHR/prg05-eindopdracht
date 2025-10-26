<x-app-layout>
    <div>
        <div>
            @if(!auth()->user()->is_admin)
            <a href="{{ route('feedback') }}">Back to Check-in History</a>
            @endif
            @if(auth()->user()->is_admin)
            <a href="{{ route('clients.show', $checkIn->user) }}">Back to Client</a>
            @endif
        </div>
        
        <h1>Check-in from {{ $checkIn->created_at->format('l, F j, Y') }}</h1>
        
        <div>
            <div>
                <div>Weight</div>
                <div>{{ $checkIn->weight }}kg</div>
            </div>
            <div>
                <div>Sleep Quality</div>
                <div>{{ $checkIn->sleep_quality }}/10</div>
            </div>
            <div>
                <div>Training Quality</div>
                <div>{{ $checkIn->training_quality }}/10</div>
            </div>
            <div>
                <div>Soreness</div>
                <div>{{ $checkIn->soreness }}/10</div>
            </div>
            <div>
                <div>Food Quality</div>
                <div>{{ $checkIn->food_quality }}/10</div>
            </div>
            
            @if($checkIn->comment)
                <div>
                    <h3>Comments:</h3>
                    <p>{{ $checkIn->comment }}</p>
                </div>
            @endif
            
            @if($checkIn->image_path)
                <div>
                    <h3>Image:</h3>
                    <img src="{{ asset('storage/' . $checkIn->image_path) }}" alt="Check-in image">
                </div>
            @endif

            @if($checkIn->coach_comment)
                <div>
                    <h3>Coach Comment:</h3>
                    <p>{{ $checkIn->coach_comment }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>