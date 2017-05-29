@extends('layouts.backend')

@section('content')

    @component('jumbotron')

        @slot('heading')
            @component('icon')
                sitemap
            @endcomponent
            Kategorie {{ $category->name }} (#{{ $category->id }}) bearbeiten
        @endslot
    @endcomponent

    <div class="container category">
        <form method="post" action="{{ route('categories.update', $category->id) }}">
            {{-- Hidden fields --}}
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{-- Category Name --}}
            <div class="form-group">
                <label for="name">
                    Name der Kategorie
                </label>

                <input class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}"
                       placeholder="Name der Kategorie">
                <div class="help-block">Der Name der Kategorie, wie er Besuchern angezeigt wird.</div>
            </div>
            {{-- Category Status --}}
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="1" name="is_active" @if($category->is_active) checked @endif>
                    Aktiv
                </label>
                <div class="help-block">Soll die Kategorie für Besucher zur Auswahl stehen?</div>
            </div>

            <button class="btn btn-primary">
                @component('icon')
                    save
                @endcomponent
                Kategorie speichern
            </button>

        </form>
    </div>




@endsection
