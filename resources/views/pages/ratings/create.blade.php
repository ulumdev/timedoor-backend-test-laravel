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
                                <h5 class="card-title mb-0">⭐ Give a Rating</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body mx-3">
                    @include('components.alerts')
                    <div>
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-12 col-md-6">
                                <form action="{{ route('ratings.store') }}" method="POST"
                                    class="p-4 border rounded bg-white shadow-sm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="author" class="form-label fw-semibold">Author:</label>
                                        <select id="author" name="author_id" class="form-select w-100" required>
                                            <option value="">-- Select Author --</option>
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="book" class="form-label fw-semibold">Book:</label>
                                        <select id="book" name="book_id" class="form-select w-100" required>
                                            <option value="">-- Select Book --</option>
                                        </select>
                                    </div>
                                    <!-- Rating -->
                                    <div class="mb-3">
                                        <label for="rating" class="form-label fw-semibold">Rating</label>
                                        <select id="rating" name="rating" class="form-select w-100" required>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <!-- Buttons -->
                                    <div class="d-flex gap-3 mt-4 justify-content-end">
                                        <button type="submit" class="btn btn-primary px-4">
                                            Submit
                                        </button>
                                    </div>
                                </form>
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

@push('styles')
    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#author').on('change', function() {
            var authorId = $(this).val();
            $('#book').html('<option value="">Loading...</option>');
            if (authorId) {
                $.get('/api/books/by-author/' + authorId, function(data) {
                    $('#book').html('<option value="">-- Select Book --</option>');
                    data.forEach(function(book) {
                        $('#book').append('<option value="' + book.id + '">' + book.title +
                            '</option>');
                    });
                });
            } else {
                $('#book').html('<option value="">-- Select Book --</option>');
            }
        });
    </script>

    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi select2
            $('#author').select2({
                placeholder: "-- Select Author --",
                allowClear: true,
                width: '100%'
            });

            $('#book').select2({
                placeholder: "-- Select Book --",
                allowClear: true,
                width: '100%'
            });

            // Event ketika author berubah
            $('#author').on('change', function() {
                var authorId = $(this).val();
                $('#book').html('<option value="">Loading...</option>').trigger('change');

                if (authorId) {
                    $.get('/api/books/by-author/' + authorId, function(data) {
                        $('#book').html('<option value="">-- Select Book --</option>');
                        data.forEach(function(book) {
                            var newOption = new Option(book.title, book.id, false, false);
                            $('#book').append(newOption);
                        });
                        $('#book').trigger('change'); // Refresh select2
                    });
                } else {
                    $('#book').html('<option value="">-- Select Book --</option>').trigger('change');
                }
            });
        });
    </script>
@endpush
