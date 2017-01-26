@extends('layouts.backend')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2>
                <i class="fa fa-fw fa-sitemap" aria-hidden="true"></i>
                Kategorien
            </h2>
            <p>Kategorien und zugeordnete Mitarbeiter verwalten.</p>
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Mitarbeiter</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                {{ count($category->users()->get()) }}
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-default">Bearbeiten</a>
                                    <button type="button"
                                            onclick="event.preventDefault();
                                                     document.querySelector('form').submit();"
                                            class="btn btn-danger">
                                        <i class="fa fa-fw fa-trash" aria-hidden="true"></i>
                                    </button>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection