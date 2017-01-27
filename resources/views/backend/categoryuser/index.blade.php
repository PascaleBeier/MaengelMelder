@extends('layouts.backend')

@section('content')

    @component('jumbotron')

        @slot('heading')
            @component('icon')
                users
            @endcomponent
            {{ $category->name }}: Mitarbeiter
        @endslot
        Zugewiesene Mitarbeiter bearbeiten.

        <br>

    @endcomponent

    <div class="container">

        <p>
        <a href="{{ url('admin/categories/'.$category->id.'/users/create') }}" class="btn btn-primary">
            @component('icon')
                plus
            @endcomponent
            Neuen Mitarbeiter zuweisen
        </a>
        </p>

        @if (count($category->users()->get()) === 0)
            <p class="alert alert-info">
                Noch keine Mitarbeiter zugewiesen
            </p>

        @else
            @component('table')

                @slot('thead')
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Aktionen</th>
                @endslot

                @foreach($category->users()->get() as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default">
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
        @endif

    </div>

@endsection
