<x-app-layout>
    <div>
        <h1>Daily Check-in</h1>
        
        <form method="POST" action="{{ route('checkin.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="weight">Weight (kg)</label>
                <input type="number" id="weight" name="weight" step="0.1" required class="text-black">
                @error('weight')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="sleep_quality">Sleep Quality (1-10)</label>
                <input type="number" id="sleep_quality" name="sleep_quality" min="1" max="10" required class="text-black">
                @error('sleep_quality')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="training_quality">Training Quality (1-10)</label>
                <input type="number" id="training_quality" name="training_quality" min="1" max="10" required class="text-black">
                @error('training_quality')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="soreness">Soreness Level (1-10)</label>
                <input type="number" id="soreness" name="soreness" min="1" max="10" required class="text-black">
                @error('soreness')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="food_quality">Food Quality (1-10)</label>
                <input type="number" id="food_quality" name="food_quality" min="1" max="10" required class="text-black">
                @error('food_quality')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="comment">Comments (optional)</label>
                <textarea id="comment" name="comment" class="text-black"></textarea>
                @error('comment')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="image">Upload Image (optional)</label>
                <input type="file" id="image" name="image" accept="image/*">
                @error('image')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Submit Check-in</button>
        </form>
    </div>
</x-app-layout>