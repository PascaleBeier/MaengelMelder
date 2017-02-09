@extends('layouts.backend')

@section('content')

    @component('jumbotron')

        @slot('heading')
            @component('icon')
                users
            @endcomponent
            Mitarbeiter
        @endslot
        Mitarbeiter und zugewiesene Kategorien verwalten.

    @endcomponent

    <div class="container categories">

        @component('table')

            @slot('thead')
                <th>#</th>
                <th>Name</th>
                <th>Kategorien</th>
                <th>Aktionen</th>
                <th>Aktiv</th>
            @endslot

            @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ count($user->categories()->get()) }}
                        <a href="{{ route('users.categories.create', $user->id) }}" class="btn btn-default">
                            @component('icon')
                                sitemap
                            @endcomponent
                        </a>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default">
                                @component('icon')
                                    edit
                                @endcomponent
                                Bearbeiten
                            </a>
                        </div>
                    </td>
                    <td>
                        <form style="display: inline" method="post" action="{{ route('users.update', $user->id) }}">
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            {{ csrf_field() }}
                            @if ($user->is_active)
                                <span class="hidden">1</span>
                                <input type="hidden" value="0" name="is_active">
                                <button type="submit" class="btn btn-success">
                                    @component('icon')
                                        eye
                                    @endcomponent
                                </button>
                            @else
                                <span class="hidden">2</span>
                                <input type="hidden" value="1" name="is_active">
                                <button type="submit" class="btn btn-danger">
                                    @component('icon')
                                        eye-slash
                                    @endcomponent
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach

        @endcomponent

    </div>

@endsection
