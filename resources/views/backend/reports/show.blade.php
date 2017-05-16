@extends('layouts.backend')

@section('content')

    @component('jumbotron')

        @slot('heading')
            @component('icon')
                bullhorn
            @endcomponent
            Mängel #{{ $report->id }}
        @endslot
        <p>
            @component('icon')
                clock
            @endcomponent
            {{ $report->created_at }}
        </p>
        <p>
            @component('icon')
                map
            @endcomponent
            {{ $report->address }}
        </p>
        <p>
            @component('icon')
                sitemap
            @endcomponent
            {{ $report->category->name }}
        </p>

    @endcomponent

    <div class="container">
        @if ($report->image)
            <h3>Bild:</h3>
            <img src="/{{ $report->image->path }}/{{ $report->image->name }}">
        @else

        @component('alert-info')
            Kein Bild hochgeladen
        @endcomponent

        @endif

        <h3>Beschreibung:</h3>
        <p>
            {{ $report->body }}
        </p>


        
    </div>

@endsection
