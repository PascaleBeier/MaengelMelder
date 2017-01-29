@component('mail::message')
# Vielen Dank für Ihre Mithilfe, {{ $report->name }}!

Wir haben Ihre nachfolgende Meldung erhalten und bearbeiten diese schnellstmöglich.

@component('mail::panel')
Ihre Meldung
@endcomponent

@component('mail::table')
|               |                               |
|--------------	|------------------------------ |
| Kategorie    	| {{ $report->category->name }} |
| Adresse      	| {{ $report->address }}        |
| Beschreibung 	| {{ $report->body }}           |


Vielen Dank,<br>
{{ config('app.client') }}
@endcomponent
@endcomponent
