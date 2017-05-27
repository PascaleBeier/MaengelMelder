@extends('layouts.frontend')

@push('styles')
.navbar-default {
    margin-bottom: 0;
}
@endpush

@section('content')

    @component('jumbotron')
        @slot('heading')
            Installationassistent
        @endslot
        Herzlich Willkommen bei der Installation des {{ config('app.name') }}s.
    @endcomponent

    <div class="container">

        @if (count($errors->all()) > 0)
            <div class="alert alert-danger">
                <p>
                    Bei der Installation sind folgende Fehler aufgetreten:
                </p>
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('setup.store') }}">

            {{ csrf_field() }}

            <h3>Datenbankverbindung</h3>

            <div class="form-group">
                <label for="name">Hostname</label>
                <input class="form-control" name="databaseHost" value="{{ old('databaseHost') }}"
                       id="databaseUser" required placeholder="localhost">
                <div class="help-block">
                    Geben Sie den Hostnamen der Datenbank an.
                </div>
            </div>

            <div class="form-group">
                <label for="name">Benutzername</label>
                <input class="form-control" name="databaseUser" value="{{ old('databaseUser') }}"
                       id="databaseUser" required placeholder="root">
                <div class="help-block">
                    Geben Sie den Namen des Datenbanknutzers an.
                </div>
            </div>

            <div class="form-group">
                <label for="name">Passwort</label>
                <input class="form-control" name="databasePassword"
                       value="{{ old('databasePassword') }}"
                       type="password" required placeholder="secret">
                <div class="help-block">
                    Geben Sie das Passwort des Datenbanknutzers an.
                </div>
            </div>

            <div class="form-group">
                <label for="name">Datenbank</label>
                <input class="form-control" name="databaseName"
                       value="{{ old('databaseName') }}"
                       required placeholder="{{ mb_strtolower(config('app.name'))  }}">
                <div class="help-block">
                    Geben Sie den Namen der Datenbank an.
                </div>
            </div>

            <h3>Kundenspezifika</h3>

            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" name="clientName"
                       value="{{ old('clientName') }}"
                       required placeholder="{{ config('app.client')  }}">
                <div class="help-block">
                    Der Name des Kunden erscheint mitunter im Header des Front- und Backends.
                </div>
            </div>

            <div class="form-group">
                <label for="location">Ort</label>
                <input class="form-control" name="clientLocation"
                       value="{{ old('clientLocation') }}" id="clientLocation"
                       required placeholder="{{ config('app.location')  }}">
                <div class="help-block">
                    Der Adressbereich, in welchem der Kunde Mängel annimmt.
                </div>
            </div>

            <button class="btn btn-primary">
                @component('icon')
                    step-forward
                @endcomponent
                    Weiter
            </button>

        </form>
    </div>

    <footer style="padding: 25px">
        <div class="container">
            &copy; {{ date('Y') }} Pascale Beier.
        </div>
    </footer>

@endsection
@push('scripts')
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key={{ config('googlemaps.apiKey') }}&libraries=places&callback=initAutocomplete"
        async defer></script>
<script>
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('clientLocation')),
            {
                types: ['address'],
                restrictedComponents: { country: 'de' }
            });
        autocomplete.addListener('place_changed', fillInAddress);
    }
    function fillInAddress() {
        var place = autocomplete.getPlace();
        this.value = place.formatted_address;
    }
</script>
@endpush