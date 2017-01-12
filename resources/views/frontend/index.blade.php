@extends('layouts.frontend')

@inject('faker', 'Faker\Generator')

@section('content')
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Kategorie</label>
                <select class="form-control" id="category" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @if (count($errors->get('category_id')) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('category_id') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="help-block">
                    <p>Wählen Sie eine Kategorie, die zum vorliegenden Mangel passt.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Adresse</label>
                <input class="form-control" name="address" id="address" required placeholder="{{ $faker->streetAddress }}">
                @if (count($errors->get('address')) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('address') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="help-block">
                    Geben Sie die Straße und Hausnummer des Mängels an.
                </div>
            </div>

            <div class="form-group">
                <label for="body">Beschreibung</label>
                <textarea class="form-control" id="body" name="body" required></textarea>
                @if (count($errors->get('body')) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('body') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="help-block">
                    <p>Hier können Sie den vorliegenden Mangel beschreiben.</p>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Foto</label>
                <input class="form-control" name="image" id="image" type="file">
                @if (count($errors->get('image')) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('image') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="help-block">
                    <p>Wenn Sie ein Foto hochladen, werden auch die Standortinformationen des Fotos genutzt.</p>
                </div>
            </div>

            {{ csrf_field() }}

            <div class="form-group">
                <button type="submit" id="submit" data-loading-text="Formular wird verarbeitet ..." class="btn btn-primary">Absenden</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')
    <script>
        $('#submit').click(function () {
            var form = $('form');
            form.validate();
            if (form.valid()) {
                $(this).button('loading');
            }
        });
    </script>
@endpush

@if(session()->has('success'))
    @push('scripts')
    <script>
        swal(
            'Meldung erfolgreich versendet!',
            'Vielen Dank für Ihre Mithilfe! Wir haben Ihre Meldung erhalten.',
            'success'
        )
    </script>
    @endpush
@endif

@if(count($errors->all()) > 0)
    @push('scripts')
    <script>
        swal(
            'Meldung nicht versendet!',
            'Bei der Verarbeitung Ihrer Meldung sind Fehler aufgetreten.',
            'error'
        )
    </script>
    @endpush
@endif