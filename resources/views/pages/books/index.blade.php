@extends('layouts.master')

@section('title')
    {{ $title ?? 'Timedoor Test' }}
@endsection

@push('styles')
    {{-- Customize your style --}}
@endpush

@section('content')
    @component('components.breadcrumb')
        @slot('titleContent')
            {{ $titleContent ?? 'Title Content' }}
        @endslot
        @slot('li_1')
            {{ $li_1 ?? 'Li 1' }}
        @endslot
        @slot('subTitleContent')
            {{ $subTitleContent ?? 'Sub Title Content' }}
        @endslot
    @endcomponent

    {{-- start content --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="customerList">
                <div class="card-header border-bottom-dashed">

                    <div class="row g-4 align-items-center">
                        <div class="col-sm">
                            <div>
                                <h5 class="card-title mb-0">📚 List of Books</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom-dashed border-bottom">
                    @include('components.alerts')
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <form action="{{ route('books.index') }}" method="GET" class="position-relative">
                                <div class="input-group mb-6 flex flex-wrap gap-2 items-center">
                                    <input type="text" class="form-control search" placeholder="Search for..."
                                        name="search" value="{{ request()->input('search') }}" id="searchInput">
                                    <select name="per_page" class="border px-3 py-2 rounded" id="perPageSelect">
                                        @foreach (range(100, 1000, 100) as $num)
                                            <option value="{{ $num }}" {{ $perPage == $num ? 'selected' : '' }}>
                                                {{ $num }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn-primary text-white px-3 py-2 rounded shadow">
                                        Filter
                                    </button>
                                    <button type="button" class="btn-danger text-white px-3 py-2 rounded shadow"
                                        onclick="clearSearch()">
                                        Reset
                                    </button>
                                </div>

                            </form>
                        </div>
                        <div class="col-sm-auto
                                        ms-auto">
                            <div class="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body mx-3">
                    <div>
                        <div class="table-responsive table-card mb-1">
                            <table class="table align-middle" id="customerTable">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th class="sort">#</th>
                                        <th class="sort" data-sort="customer_name">Title</th>
                                        <th class="sort" data-sort="email">Category Name</th>
                                        <th class="sort" data-sort="email">Author Name</th>
                                        <th class="sort" data-sort="email">Average Rating</th>
                                        <th class="sort" data-sort="email">Voters</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($books as $data)
                                        <tr>
                                            <td class="number">{{ $loop->iteration ?? '-' }}</td>
                                            <td class="px-4 py-2 border">{{ $data->title }}</td>
                                            <td class="px-4 py-2 border">{{ $data->category_name }}</td>
                                            <td class="px-4 py-2 border">{{ $data->author_name }}</td>
                                            <td class="px-4 py-2 border">{{ number_format($data->avg_rating, 2) }}</td>
                                            <td class="px-4 py-2 border">{{ $data->total_voter }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ customer We
                                        did not find any
                                        customer for you search.</p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            {{ $books->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    {{-- end of content --}}
@endsection

@push('scripts')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <script>
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('perPageSelect').value = '10'; // Reset to default per page
            document.querySelector('form[action="{{ route('books.index') }}"]').submit();
        }
    </script>
@endpush
