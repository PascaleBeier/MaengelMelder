@push('scripts')
    <script>
        swal(
            '{{ session('title') }}',
            '{{ session('message') }}',
            '{{ session('type') }}'
        )
    </script>
@endpush
@push('no-js')
    <div class="no-js alert alert-success">
        <h3>{{ session('title') }}</h3>
        <p>{{ session('message') }}</p>
    </div>
@endpush