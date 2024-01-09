<x-admin-layout>
    <form class="w-full justify-start flex-col items-start flex" method="post"
        action="{{ route('admin.posts.update', ['post' => $post->id]) }}">
        <div class="flex w-full items-center">
            <div class="text-4xl py-5 font-bold">
                Edit Post
            </div>
            <div class="grow"></div>
            <a class="text-button" href="{{route('admin.posts.index')}}">
                <x-icons.arrow-left />
                Back
            </a>
            <button type="submit" class="ms-2 primary-button">
                <x-icons.check />
                Save
            </button>
        </div>
        <div class="card w-full">
            <div class="content">
                @method('PUT')
                <input type="hidden" class="custom-link" name="_token" value="{{ csrf_token() }}" />
                <div class="grid gap-4 grid-cols-2">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" wire:model="title" placeholder="Post title" autofocus
                            value="{{ old('title') ?? $post->title }}" />
                        @error('title')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" wire:model="slug" placeholder="Uri Slug"
                            value="{{ old('slug') ?? $post->slug  }}" />
                        @error('slug')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="summary">Summary</label>
                        <textarea id="summary" name="summary" wire:model="summary"
                            placeholder="Content summary">{{ old('summary') ?? $post->summary }}</textarea>
                        @error('summary')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="content">Content</label>
                        <div class="tiptap-editor" x-data="editor('{{ old('content') ?? $post->content }}')">
                            <input name="content" x-model="html" type="hidden" />
                            <template x-if="isLoaded()">
                                <x-editor-menu />
                            </template>
                            <div x-ref="element" class="p-5 editor"></div>
                        </div>

                        @error('content')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>

    <x-admin.posts.categories post-id="{{$post->id}}" />

    <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST" class="mb-10">
        @method('DELETE')
        {{ csrf_field() }}
        <div class="flex w-full items-center">
            <div class="text-4xl py-5 font-bold">
                Delete Post
            </div>
            <div class="grow"></div>
            <button type="submit" class="ms-2 danger-button">
                <x-icons.delete />
                Delete
            </button>
        </div>
        <div class="card">
            <div class="content">
                Once your post is deleted, all of its resources and data will be permanently deleted. Before deleting
                a post, please download any data or information that you wish to retain.
            </div>
        </div>
    </form>

</x-admin-layout>
