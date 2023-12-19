<x-admin-layout>
    <form class="w-full justify-start flex-col items-start flex" method="POST"
        action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
        <div class="flex w-full items-center">
            <div class="text-4xl py-5 font-bold">
                Edit Category
            </div>
            <div class="grow"></div>
            <a class="text-button" href="{{route('admin.categories.index')}}">
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
                        <input type="text" id="title" name="title" wire:model="title" placeholder="Category title"
                            autofocus value="{{ old('title') ?? $category->title }}" />
                        @error('title')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" wire:model="slug" placeholder="Uri Slug"
                            value="{{ old('slug') ?? $category->slug  }}" />
                        @error('slug')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="subtitle">Subtitle</label>
                        <textarea id="subtitle" name="subtitle" wire:model="subtitle"
                            placeholder="Category subtitle">{{ old('subtitle') ?? $category->subtitle }}</textarea>
                        @error('subtitle')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST" class="mb-10">
        @method('DELETE')
        {{ csrf_field() }}
        <div class="flex w-full items-center">
            <div class="text-4xl py-5 font-bold">
                Delete category
            </div>
            <div class="grow"></div>
            <button type="submit" class="ms-2 danger-button">
                <x-icons.delete />
                Delete
            </button>
        </div>
        <div class="card">
            <div class="content">
                Once your category is deleted, all of its resources and data will be permanently deleted. Before
                deleting
                a category, please download any data or information that you wish to retain.
            </div>
        </div>
    </form>
</x-admin-layout>
