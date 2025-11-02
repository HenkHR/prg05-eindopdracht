<x-app-layout>
    <div>
        <div class="mb-4">
            @if(!auth()->user()->is_admin)
                <x-back href="{{ route('feedback') }}">Back to Check-in History</x-back>
            @endif
            @if(auth()->user()->is_admin)
            <x-back href="javascript:history.back()">Back</x-back>
            @endif
        </div>

        <h1 class="text-xl font-bold">Check-in from {{ $checkIn->created_at->format('l, F j, Y') }}</h1>

        <div class="flex flex-row gap-4">
            <div>
                <div>
                    <div class="text-lg">Weight:</div>
                    <div>{{ $checkIn->weight }}kg</div>
                </div>
                <div>
                    <div class="text-lg">Sleep Quality</div>
                    <div>{{ $checkIn->sleep_quality }}/10</div>
                </div>
                <div>
                    <div class="text-lg">Training Quality</div>
                    <div>{{ $checkIn->training_quality }}/10</div>
                </div>
                <div>
                    <div class="text-lg">Soreness</div>
                    <div>{{ $checkIn->soreness }}/10</div>
                </div>
                <div>
                    <div class="text-lg">Food Quality</div>
                    <div>{{ $checkIn->food_quality }}/10</div>
                </div>

                @if($checkIn->comment)
                    <div>
                        <h3 class="text-lg">Comments:</h3>
                        <p>{{ $checkIn->comment }}</p>
                    </div>
                @endif

                @if($checkIn->coach_comment && !auth()->user()->is_admin)
                    <div>
                        <h3 class="text-lg">Coach Comment:</h3>
                        <p>{{ $checkIn->coach_comment }}</p>
                    </div>
                @elseif(auth()->user()->is_admin)
                    <form action="{{ route('checkin.addComment', $checkIn) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <textarea name="coach_comment" class="text-black" placeholder="Add a comment">{{ old('coach_comment', $checkIn->coach_comment) }}</textarea>
                        @error('coach_comment')
                            <span>{{ $message }}</span>
                        @enderror
                        <button type="submit">{{ $checkIn->coach_comment ? 'Update Comment' : 'Add Comment' }}</button>
                    </form>
                @endif
            </div>
            <div>   
                @if($checkIn->image_path)
                    <div>
                        <h3 class="text-lg">Image:</h3>
                        <img src="{{ asset('storage/' . $checkIn->image_path) }}" alt="Check-in image" class="max-w-96 max-h-96 object-cover">
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
