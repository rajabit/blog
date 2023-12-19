<x-admin-layout>
    <div class="mb-5">

        <div class="flex w-full items-center justify-between">
            <div class="text-4xl py-5 font-bold">
                Categories
            </div>
            <a href="{{ route('admin.categories.create') }}" class="primary-button">
                <x-icons.plus />
                New
            </a>
        </div>

        <div class="table">
            <form class="flex w-full p-5" method="GET" action="{{ route('admin.categories.index') }}">
                <input required type="text" name="search" placeholder="Search" value="{{ $search }}" />
                <button type="submit" class="ms-2 secondary-button">
                    <x-icons.magnify />
                    Search
                </button>
            </form>
            <table class="table-auto">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Posts</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr title="{{ $category->subtitle }}">
                        <td>{{ $category->id }}</td>
                        <td class="capitalize">{{ $category->title }}</td>
                        <td class="lowercase">{{ $category->slug }}</td>
                        <td>{{ number_shorten($category->posts_count) }}</td>
                        <td>{{ $category->created_at->format('M d, Y') }}</td>
                        <td>{{ $category->updated_at->format('M d, Y') }}</td>
                        <td>
                            <div class="flex items-center justify-center">
                                <a title="Edit category"
                                    href="{{route('admin.categories.show', ['category'=>$category->id])}}"
                                    class="icon-button">
                                    <x-icons.edit />
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $categories->links() }}
            </div>
        </div>

    </div>
</x-admin-layout>
