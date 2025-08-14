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
                                <h5 class="card-title mb-0">🏆 Top 10 Most Famous Authors</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom-dashed border-bottom">
                    @include('components.alerts')
                </div>
                <div class="card-body mx-3">
                    <div>
                        <div class="table-responsive table-card mb-1">
                            <table class="table align-middle" id="customerTable">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th class="sort">#</th>
                                        <th class="sort" data-sort="email">Author Name</th>
                                        <th class="sort" data-sort="email">Total Voter</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($authors as $data)
                                        <tr>
                                            <td class="number">{{ $loop->iteration ?? '-' }}</td>
                                            <td class="px-4 py-2 border">{{ $data->name }}</td>
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
@endpush
