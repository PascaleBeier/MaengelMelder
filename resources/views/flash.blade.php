@if (session('flash.driver'))
    @if (session('flash.driver') === 'toastr')
        <script>
            @if (session('flash.type') === 'success')
                toastr.success(
                    '{{ session('flash.message') }}',
                    '{{ session('flash.title') }}'
                );
            @else
                toastr.error(
                    '{{ session('flash.message') }}',
                    '{{ session('flash.title') }}'
                );
            @endif
        </script>
    @else
    <script>
        swal(
            '{{ session('flash.title') }}',
            '{{ session('flash.message') }}',
            '{{ session('flash.type') }}'
        );
    </script>
    @endif
@endif
