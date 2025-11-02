<x-app-layout>
    <div class="top-0 left-72 right-0 bottom-0 absolute flex justify-center items-center w-[screen-72]">
        <div class="center h-4/5 border w-4/5 p-4">
            <div class="flex justify-between">
                <h1>Edit Post</h1>
                <x-back href="{{ route('dashboard') }}">Back</x-back>
            </div>

            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                @csrf
                @method('PATCH')

                <div>
                    <label for="content">Message</label>
                    <textarea id="content" name="content" class="text-black">{{ old('content', $post->content) }}</textarea>

                    @error('content')
                        <span>{{ $message }}</span>
                    @enderror

                </div>

                <div>
                    <label>Current Image</label>
                    @if($post->image_path)
                        <div>
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="w-32 h-32 object-cover rounded-md">
                            <label>
                                <input type="checkbox" name="remove_image" value="1" />
                                Remove current image
                            </label>
                        </div>
                    @else
                        <p>No image</p>
                    @endif
                </div>

                <div>
                    <label for="image">Upload New Image (optional)</label>
                    <input id="image" name="image" type="file" accept="image/*" />
                    @error('image')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input id="is_visible" name="is_visible" type="checkbox" value="1" {{ $post->is_visible ? 'checked' : '' }} />
                    <label for="is_visible">Visible to users</label>
                </div>

                <div>
                    <button type="submit">Update Post</button>
                </div>
            </form>

            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"">Delete Post</button>
            </form>
        </div>
    </div>
</x-app-layout>