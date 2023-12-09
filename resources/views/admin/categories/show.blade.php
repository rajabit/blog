<x-admin-layout>
    <form class="w-full justify-start flex-col items-start flex" method="POST"
        action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
        <div class="flex w-full items-center">
            <div class="text-4xl py-5 font-bold">
                Edit Category
            </div>
            <div class="grow"></div>
            <a class="text-button" href="{{route('admin.categories.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back
            </a>
            <button type="submit" class="ms-2 primary-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Save
            </button>
        </div>
        <div class="card w-full">
            @method('PUT')
            <input type="hidden" class="custom-link" name="_token" value="{{ csrf_token() }}" />
            <div class="grid gap-4 grid-cols-2">
                <div>
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" wire:model="title" placeholder="Category title" autofocus
                        value="{{ old('title') ?? $category->title }}" />
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                Delete
            </button>
        </div>
        <div class="card">
            Once your category is deleted, all of its resources and data will be permanently deleted. Before deleting
            a category, please download any data or information that you wish to retain.
        </div>
    </form>
</x-admin-layout>
