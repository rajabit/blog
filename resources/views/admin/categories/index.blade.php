<x-admin-layout>
    <div class="mb-5">

        <div class="flex w-full items-center justify-between">
            <div class="text-4xl py-5 font-bold">
                Categories
            </div>
            <a href="{{ route('admin.categories.create') }}" class="primary-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New
            </a>
        </div>

        <div class="table">
            <form class="flex w-full p-5" method="GET" action="{{ route('admin.categories.index') }}">
                <input required type="text" name="search" placeholder="Search" value="{{ $search }}" />
                <button type="submit" class="ms-2 secondary-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
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
