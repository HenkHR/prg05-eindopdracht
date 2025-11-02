<x-app-layout>
    <div>
        <div>
            <h1>Weekly Report</h1>
            <p>{{ $startOfWeek->format('F j') }} - {{ $endOfWeek->format('F j, Y') }}</p>
        </div>

        @if($checkIns->count() > 0)
            <div>
                <h2>Week Summary</h2>
                <p>Total check-ins: {{ $checkIns->count() }} / 7 days</p>
                
                <div>
                    <h3>Average Scores</h3>
                    <div class="flex flex-row gap-4 bg-gray-700 p-4 rounded-md">
                        <div>
                            <span>Average Weight:</span>
                            <span>{{ number_format($averages['weight'], 1) }} kg</span>
                        </div>
                        <div>
                            <span>Average Sleep:</span>
                            <span>{{ number_format($averages['sleep_quality'], 1) }}/10</span>
                        </div>
                        <div>
                            <span>Average Training:</span>
                            <span>{{ number_format($averages['training_quality'], 1) }}/10</span>
                        </div>
                        <div>
                            <span>Average Soreness:</span>
                            <span>{{ number_format($averages['soreness'], 1) }}/10</span>
                        </div>
                        <div>
                            <span>Average Food Quality:</span>
                            <span>{{ number_format($averages['food_quality'], 1) }}/10</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2>Daily Check-ins</h2>
                
                @foreach($checkIns as $checkIn)
                    <div class="bg-gray-700 p-4 rounded-md mb-4 space-y-1">
                        <div>
                            <h3>{{ $checkIn->created_at->format('l, F j') }}</h3>
                            <p>{{ $checkIn->created_at->format('g:i A') }}</p>
                        </div>

                    

                        @if($checkIn->comment)
                            <div>
                                <p>Comment: {{ $checkIn->comment ? 'Yes' : 'No' }}</p>
                            </div>
                        @endif

                        @if($checkIn->coach_comment)
                            <div>
                                <p>Coach Comment: {{ $checkIn->coach_comment ? 'Yes' : 'No' }}</p>
                            </div>
                        @endif

                        @if($checkIn->image_path)
                            <div>
                                <span>Has Progress Photo</span>
                            </div>
                        @endif

                        <a href="{{ route('checkin.show', $checkIn) }}" class="mt-2 block text-center  bg-gray-600 text-white hover:bg-gray-900 px-4 py-2 rounded-md h-10 text-lg">View Full Details</a>
                    </div>
                @endforeach
            </div>
        @else
            <div>
                <p>No check-ins recorded last week.</p>
            </div>
        @endif
    </div>
</x-app-layout>