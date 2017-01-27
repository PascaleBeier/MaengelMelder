@extends('layouts.backend')

@section('content')

    @component('jumbotron')

        @slot('heading')
            @component('icon')
                users
            @endcomponent
            {{ $category->name }}: Mitarbeiter
        @endslot
        Neue Mitarbeiter zuweisen

        <br>

    @endcomponent



    <div class="container">

        <form method="post" action="{{ route('categories.users.store', $category->id) }}">
            {{ csrf_field() }}
            @foreach($users as $user)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="{{ $user->id }}" name="user_id[]"> {{ $user->name }} (<i>{{ $user->email }}</i>)
                    </label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">
                @component('icon')
                    check
                @endcomponent
                Mitarbeiter hinzufügen
            </button>
        </form>

    </div>

@endsection
