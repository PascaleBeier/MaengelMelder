@extends('layouts.backend')

@section('content')

    @component('jumbotron')

        @slot('heading')
            @component('icon')
                sitemap
            @endcomponent
            Kategorien
        @endslot
        Mängelkategorien einsehen und verwalten.

    @endcomponent

    <div class="container categories">

        @component('table')

            @slot('thead')
                <th>#</th>
                <th>Name</th>
                <th>Aktionen</th>
                <th>Aktiv</th>
            @endslot

            @foreach($categories as $category)
                <tr>
                    <td>
                        {{ $category->id }}
                    </td>
                    <td>
                        {{ $category->name }}
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
                    <td>
                        <form style="display: inline" method="post" action="{{ route('categories.update', $category->id) }}">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            @if ($category->is_active)
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
