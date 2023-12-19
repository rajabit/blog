<x-admin-layout>
    <form class="w-full justify-start flex-col items-start flex" method="POST"
        action="{{ route('admin.categories.store') }}">
        <div class="flex w-full items-center">
            <div class="text-4xl py-5 font-bold">
                Creare a Category
            </div>
            <div class="grow"></div>
            <a class="text-button" href="{{route('admin.categories.index')}}">
                <x-icons.arrow-left />
                Back
            </a>
            <button type="submit" class="ms-2 primary-button">
                <x-icons.check />
                Create
            </button>
        </div>
        <div class="card w-full">
            <div class="content">
                <input type="hidden" class="custom-link" name="_token" value="{{ csrf_token() }}" />
                <div class="grid gap-4 grid-cols-2">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" wire:model="title" placeholder="Category title"
                            autofocus value="{{ old('title') }}" />
                        @error('title')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" wire:model="slug" placeholder="Uri Slug"
                            value="{{ old('slug') }}" />
                        @error('slug')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="subtitle">Subtitle</label>
                        <textarea id="subtitle" name="subtitle" wire:model="subtitle"
                            placeholder="Category subtitle">{{ old('subtitle') }}</textarea>
                        @error('subtitle')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
