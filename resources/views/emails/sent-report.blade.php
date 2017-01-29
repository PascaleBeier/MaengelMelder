@component('mail::message')
# Vielen Dank für Ihre Mithilfe, {{ $report->name }}!

Wir haben Ihre nachfolgende Meldung erhalten und bearbeiten diese schnellstmöglich.

@component('mail::panel')
## Ihre Meldung

@component('mail::table')
|               |                               |
|--------------	|------------------------------ |
| Kategorie    	| {{ $report->category->name }} |
| Adresse      	| {{ $report->address }}        |
| Beschreibung 	| {{ $report->body }}           |
@endcomponent

@endcomponent

Vielen Dank,<br>
{{ config('app.client') }}

@endcomponent
