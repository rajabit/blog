@props(['postId'])

<div x-data="categories" x-init="load()">
    <div class="flex w-full items-center">
        <div class="text-4xl py-5 font-bold">
            Categories
        </div>
        <div class="grow"></div>
        <button @click="openModal('add-category')" class="secondary-button">
            <x-icons.plus />
            Add Category
        </button>
    </div>

    <div x-show="categories?.total == 0" class="card">
        <x-empty message="There is no category yet!" />
    </div>

    <div class="table">
        <table class="table-auto dark:bg-slate-900 border-none">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="x in categories.data" :key="x.id">
                    <tr :title="x.subtitle">
                        <td x-text="x.id"></td>
                        <td class="capitalize" x-text="x.title"></td>
                        <td class="lowercase" x-text="x.slug"></td>
                        <td>
                            <div class="flex items-center justify-center">
                                <button @click="detach({{$postId}}, x.id)" class="icon-button">
                                    <x-icons.close />
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <div class="flex items-center px-4 py-2">
            <div x-show="categories?.total > 0" class="grow">
                Showing <strong x-text="categories?.from"></strong>
                to <strong x-text="categories?.to"></strong> of <strong x-text="categories?.total"></strong> results
            </div>
            <div class="paginate">
                <template x-for="x in categories.links" :key="x.label">
                    <button :class="{'disabled': x.active}" @click="load(x.url)" x-html="pagination(x.label)">
                    </button>
                </template>
            </div>
        </div>
    </div>

    <div x-init="f(1)" id="add-category" class="modal">
        <div class="card !w-96">
            <div class="card-title">Select a category</div>
            <div class="list">
                <template x-for="item in list.data" :key="item.id">
                    <div class="item" @click="attach({{$postId}}, item.id)">
                        <div class="content">
                            <div class="title" :title="item.title" x-text="item.title"></div>
                            <div class="subtitle" :title="item.subtitle" x-text="item.subtitle"></div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

</div>

<script defer>
    document.addEventListener('alpine:init', () => {
        Alpine.data('categories', () => ({
            categories: false,
            list: { data: [] },
            detach(postId, index) {
                if (!confirm(" Are you sure?")) return;
                fetch(`/admin/post-category/${index}?post_id=${postId}`, {
                    method: 'delete',
                    headers:
                    {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'accept': 'application/json'
                    }
                }).then((response) => this.load(1))
            },
            load(url = null) {
                if (url == null) {
                    url = `/admin/post-category?post_id={{$postId}}&page=1`;
                } else {
                    url = `${url}&post_id={{$postId}}`
                }
                fetch(url, { headers: { 'accept': 'application/json' } })
                    .then((response) => response.json())
                    .then((json) => this.categories = json)
            },
            f(page = 1) {
                fetch('/admin/post-category?post_id={{$postId}}&' + encodeURIComponent('not-related') + '=1', { headers: { 'accept': 'application/json' } })
                    .then((response) => response.json())
                    .then((json) => this.list = json)
            },
            pagination(str) {
                return str.replace('Previous', '').replace('Next', '').trim();
            },
            attach(postId, categoryId) {
                fetch('/admin/post-category', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'accept': 'application/json',
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({ post_id: postId, category_id: categoryId })
                }).then((response) => {
                    this.load(1);
                    this.f(1);
                    closeModal('add-category');
                });
            },
        }));
    });
</script>
