<x-admin-layout>
     <div class="mb-5">

          <div class="flex w-full items-center justify-between">
               <div class="text-4xl py-5 font-bold">
                    Posts
               </div>
               <a href="{{ route('admin.posts.create') }}" class="primary-button">
                    <x-icons.plus />
                    New
               </a>
          </div>

          <div class="table">
               <form class="flex w-full p-5" method="GET" action="{{ route('admin.posts.index') }}">
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
                              <th>User</th>
                              <th>Slug</th>
                              <th>Views</th>
                              <th>Published</th>
                              <th>Created</th>
                              <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($posts as $post)
                         <tr title="{{ $post->summary }}">
                              <td>{{ $post->id }}</td>
                              <td class="capitalize">{{ $post->title }}</td>
                              <td>
                                   <a class="custom-link">
                                        {{$post->user?->name}}
                                   </a>
                              </td>
                              <td class="lowercase">{{ $post->slug }}</td>
                              <td>{{ $post->views }}</td>
                              <td>{{ $post->published_at->format('M d, Y') }}</td>
                              <td>{{ $post->created_at->format('M d, Y') }}</td>
                              <td>
                                   <div class="flex items-center justify-center">
                                        <a title="Edit post" href="{{route('admin.posts.show', ['post'=>$post->id])}}"
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
                    {{ $posts->links() }}
               </div>
          </div>

     </div>
</x-admin-layout>
