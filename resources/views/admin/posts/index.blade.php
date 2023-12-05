<x-admin-layout>
     <div class="mb-5">

          <div class="flex w-full items-center justify-between">
               <div class="text-4xl py-5 font-bold">
                    Posts
               </div>
               <a href="{{ route('admin.posts.create') }}" class="primary-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New
               </a>
          </div>

          <div class="table">
               <form class="flex w-full p-5" method="GET" action="{{ route('admin.posts.index') }}">
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
                    {{ $posts->links() }}
               </div>
          </div>

     </div>

</x-admin-layout>