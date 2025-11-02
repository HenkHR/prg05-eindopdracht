<x-app-layout>
    <div class="top-0 left-72 right-0 bottom-0 absolute flex justify-center items-center w-[screen-72]">
        <div class=" center h-4/5 border w-4/5 p-4 flex flex-col gap-4">

            <h1>Community board</h1>

            <div class="flex flex-col gap-4 overflow-y-auto flex-grow">
                @foreach($posts as $post)
                @if($post->is_visible || auth()->user()?->is_admin)

                    <div class="flex flex-col gap-2 border p-4 rounded-md bg-gray-500">
                        <div class="flex flex-col gap-2">
                            <div class="flex flex-row justify-between">
                                <p class="text-lg font-bold">{{ $post->user->name }}</p>
                                <div class="flex flex-row gap-4">

                                    @if(auth()->user()?->is_admin)
                                    <form action="{{ route('posts.toggleVisibility', $post) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="bg-gray-700 text-white px-2 py-1 rounded-md text-sm">
                                            {{ $post->is_visible ? 'Hide' : 'Show' }}
                                        </button>
                                    </form>
                                    @endif

                                    @if($post->is_visible && auth()->user()?->is_admin)
                                        <p class="text-lg text-gray-700 font-bold" >Visible</p>
                                    @elseif(!$post->is_visible && auth()->user()?->is_admin)
                                        <p class="text-lg text-gray-700 font-bold" >Hidden</p>
                                    @endif

                                    <p class="text-lg">{{ $post->created_at->format('d/m/Y H:i') }}</p>
                                    
                                    @if(auth()->user()?->is_admin)
                                    <div>
                                         <a href="{{ route('posts.edit', $post) }}" class="bg-gray-700 text-white px-4 py-2 rounded-md h-10 text-lg">edit</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <p>{{ $post->content }}</p>
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="max-w-56 max-h-56 object-cover">
                            @endif
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
            
			@if(auth()->user()?->is_admin)
				<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2 mt-4 border-t pt-4 w-full">
					@csrf
                    <div class="flex flex-row gap-2">   
					    <div class="flex flex-row gap-2 w-full">
						    <label for="content">Message</label>
						    <textarea id="content" name="content" class="text-black w-full resize-none h-10 rounded-md">{{ old('content') }}</textarea>
						    @error('content')
							<span>{{ $message }}</span>
						    @enderror
					    </div>
					    <button type="submit" class="bg-gray-700 text-white px-4 rounded-md h-10" >Post</button>
                        <div>
                            <input id="is_visible" name="is_visible" type="checkbox" value="1" checked />
                            <label for="is_visible">Visible to users</label>
                        </div>

                    </div>

                    <div>
                        <label for="image">Image (optional)</label>
                        <input id="image" name="image" type="file" accept="image/*" />
                        @error('image')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

				</form>
			@endif
        </div>
    </div>
</x-app-layout>
