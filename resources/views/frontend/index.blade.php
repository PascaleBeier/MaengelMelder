@extends('layouts.frontend')

@inject('faker', 'Faker\Generator')

@section('content')
    <div class="container">

        <form method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" value="{{ old('name') }}" name="name" id="name" required
                       placeholder="{{ $faker->name }}">
                @if (count($errors->get('name')) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('name') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="help-block">
                    Geben Sie Ihren Namen an.
                </div>
            </div>

            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" required
                       placeholder="{{ $faker->email }}">
                @if (count($errors->get('email')) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->get('email') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="help-block">
                    Geben Sie Ihre E-Mail Adresse an.
                </div>
            </div>

            <div class="form-group">
                <label for="category">Kategorie</label>
                <select class="form-control" id="category" name="category_id" required>
                    @foreach($categories as $category)
                        @if (old('category_id') === $category)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
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
                <input class="form-control" value="{{ old('address') }}" name="address" id="address"
                       onfocus="geolocate()"
                       required placeholder="{{ $faker->streetAddress. ', '.$faker->postcode. ' '.$faker->city}}">
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
                <textarea class="form-control" id="body" name="body" required>{{ old('body') }}</textarea>
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
                <label for="image">Foto (optional)</label>
                <input class="filestyle" data-iconName="fa fa-file-image-o" data-buttonText="Foto auswählen"
                       data-buttonBefore="true" data-placeholder="Noch kein Foto ausgewählt"
                       name="image" id="image" type="file">
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
                    <p>Sie können zusätzlich ein Foto hochladen. Ihr Foto ist öffentlich einsehbar.</p>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" id="submit"
                        data-loading-text="Formular wird verarbeitet
                        <i class='fa fa-circle-o-notch fa-spin fa-fw' aria-hidden='true'></i>"
                        class="btn btn-primary">Absenden
                </button>
            </div>

        </form>
    </div>

@endsection

@if(session()->has('title'))
    @include('flash')
@endif

@push('scripts')
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=<?=config('googlemaps.apiKey')?>&libraries=places&callback=initAutocomplete"
        async defer></script>
<script>

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(<?=$bounds->southwest->lat?>, <?=$bounds->southwest->lng?>),
            new google.maps.LatLng(<?=$bounds->northeast->lat?>, <?=$bounds->northeast->lng?>));

        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('address')),
            {
                bounds: defaultBounds,
                types: ['address'],
                restrictedComponents: { country: 'de' },
                strictBounds: true,
            });

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    // [START region_fillform]
    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        this.value = place.formatted_address;
    }


    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
@endpush