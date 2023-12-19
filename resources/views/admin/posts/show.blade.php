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

    <div x-data="{categories: false}" x-init="fetch('/admin/post-category?post_id={{$post->id}}', {headers: {'accept': 'application/json'}})
         .then((response) => response.json())
         .then((json) =>  categories = json)">
        <div class="flex w-full items-center">
            <div class="text-4xl py-5 font-bold">
                Categories
            </div>
            <div class="grow"></div>
            <div x-show="categories?.total > 0" class="text-gray-600 dark:text-gray-400">
                <span x-text="categories?.total"></span> categories <br />
                in <span x-text="categories?.last_page"></span> pages
            </div>
            <button @click="openModal('add-category')" class="secondary-button">
                <x-icons.plus />
                Add Category
            </button>
        </div>
        <div class="card">
            <div class="content">
                <x-empty x-show="categories?.total == 0" message="There is no category yet!" />
            </div>
        </div>
    </div>
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

    <div x-data="{list: {data: []}, f(page = 1) {fetch('/admin/post-category?post_id={{$post->id}}&'+encodeURIComponent('not-related')+'=1', {headers: {'accept': 'application/json'}})
    .then((response) => response.json())
    .then((json) =>  this.list = json)}}" x-init="f(1)" id="add-category" class="modal">
        <div class="card !w-96">
            <div class="card-title">Select a category</div>
            <div class="list">
                <template x-for="item in list.data" :key="item.id">
                    <div class="item">
                        <div class="logo">
                            <div class="text-xl bg-gray-600 text-white flex items-center justify-center shadow rounded-full w-10 h-10 font-bold"
                                x-text="item.id"></div>
                        </div>
                        <div class="content">
                            <div class="title" x-text="item.title"></div>
                            <div class="subtitle" x-text="item.subtitle"></div>
                        </div>
                    </div>
                </template>

            </div>
        </div>
    </div>
</x-admin-layout>
