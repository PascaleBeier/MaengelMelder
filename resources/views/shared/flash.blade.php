@push('scripts')
    <script>
        swal(
            '{{ session('title') }}',
            '{{ session('message') }}',
            '{{ session('type') }}'
        )
    </script>
@endpush
