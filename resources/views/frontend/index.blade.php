@extends('layouts.frontend')

@inject('faker', 'Faker\Generator')

@section('content')
    <div class="container">

        <form method="post" enctype="multipart/form-data">
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
                <input class="form-control" value="{{ old('address') }}" name="address" id="address" required placeholder="{{ $faker->streetAddress }}">
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
                    <p>Sie können zusätzlich ein Foto hochladen. Ihr Foto ist öffentlich einsehbar.</p>
                </div>
            </div>

            {{ csrf_field() }}

            <div class="form-group">
                <button type="submit" id="submit"
                        data-loading-text="Formular wird verarbeitet
                        <i class='fa fa-circle-o-notch fa-spin fa-fw' aria-hidden='true'></i>"
                        class="btn btn-primary">Absenden</button>
            </div>

        </form>
    </div>

@endsection

@push('scripts')
    <script src="{{ url('js/index.js') }}"></script>
@endpush

@if(session()->has('title'))
    @include('shared.flash')
@endif