@component('mail::message')

{{ $user->name }},

Soeben wurde eine neue Meldung eingereicht:

@component('mail::panel')
@component('mail::table')
| Bezeichnung   | Eingabe                               |
|--------------	|------------------------------ |
| Nummer        | {{ $report->id }}             |
| Absender      | {{ $report->name }}           |
| Kategorie    	| {{ $report->category->name }} |
| Adresse      	| {{ $report->address }}        |
| Beschreibung 	| {{ $report->body }}           |
@endcomponent
@endcomponent

Vielen Dank,<br>
{{ config('app.client') }}

@endcomponent
