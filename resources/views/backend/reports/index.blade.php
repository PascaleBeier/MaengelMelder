@extends('layouts.backend')

@section('content')

    @component('jumbotron')

        @slot('heading')
            @component('icon')
                bullhorn
            @endcomponent
            Mängel
        @endslot
        Mängel einsehen und verwalten.

    @endcomponent

    <div class="container">

        @component('table')

            @slot('thead')
                <th>#</th>
                <th>Adresse</th>
                <th>Beschreibung</th>
                <th>Status</th>
                <th>Aktionen</th>
            @endslot

            @foreach($reports as $report)
                <tr>
                    <td>
                        {{ $report->id }}
                    </td>
                    <td>
                        {{ $report->address }}
                    </td>
                    <td>
                        {{ str_limit($report->body) }}
                    </td>
                    <td>
                        @if($report->is_resolved)
                            <button class="btn btn-success">
                                @component('icon')
                                    check
                                @endcomponent
                                Geschlossen
                            </button>
                        @else
                            <button class="btn btn-danger">
                                @component('icon')
                                    exclamation
                                @endcomponent
                                Offen
                            </button>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('reports.show', $report->id) }}" clasS="btn btn-default">
                                @component('icon')
                                    eye
                                @endcomponent
                                Ansehen
                            </a>
                            <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-default">
                                @component('icon')
                                    edit
                                @endcomponent
                                Bearbeiten
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach

        @endcomponent
        
    </div>

@endsection
