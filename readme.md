<p align="center">
<a href="https://travis-ci.org/PascaleBeier/MaengelMelder"><img src="https://travis-ci.org/PascaleBeier/MaengelMelder.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/pascalebeier/maengelmelder"><img src="https://poser.pugx.org/pascalebeier/maengelmelder/license.svg" alt="License"></a>
</p>

# MängelMelder

> [In Entwicklung] Mängelmelder Für Kommunen und Städte.

## Features

- Besucher reichen Mängel in Kategorien ein
- Mängelverwaltung
- Kategorieverwaltung
- Benutzerverwaltung

## Systemvoraussetzungen

- PHP 5.6, 7.0 oder 7.1 (empfohlen)
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL-kompatible Datenbank

## Installation

### Herunterladen

Die Abhängigkeiten sowie das automatische Laden der Quelldateien des 
MängelMelders werden über `composer` realisiert.

Die Installation erfolgt über `composer`. Installationshinweise für `composer` finden
sich [auf getcomposer.org](https://getcomposer.org/). 

Nach der Installation von `composer` kann der MägelMelder wie folgt installiert werden:

(Eingabeaufforderung)
`composer create-project pascalebeier/maengelmelder maengelmelder --stability="dev"`

### Erstinstallation

- Der DocumentRoot des Webservers muss auf das `public`-Verzeichnis zeigen.
- Wird nun die verbundene Domain aufgerufen, wird der Installationsassistent automatisch ausgeführt.

## Tests

Die Tests finden sich im `tests`-Verzeichnis. Die Continuous Integration der Tests
für PHP 5.6, PHP 7.0 und PHP 7.1 befinden sich auf [Travis](https://travis-ci.org/PascaleBeier/MaengelMelder).

## Lizenz

Der MängelMelder ist quelloffene Software unter der [MIT license](http://opensource.org/licenses/MIT).
