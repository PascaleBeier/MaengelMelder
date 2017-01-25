<p align="center">
<a href="https://travis-ci.org/PascaleBeier/MaengelMelder"><img src="https://travis-ci.org/PascaleBeier/MaengelMelder.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/pascalebeier/maengelmelder"><img src="https://poser.pugx.org/pascalebeier/maengelmelder/license.svg" alt="License"></a>
</p>

# MängelMelder

> [WIP] Mängelmelder Für Kommunen und Städte.

## Systemvoraussetzungen

- PHP >= 7.0 (empfohlen >= 7.1)
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL bzw MariaDB (empfohlen >= 5.7.7 bzw >= 10.2.2)

## Installation

### Herunterladen

`composer create-project pascalebeier/maengelmelder maengelmelder`

### Konfiguration

Datenbankverbindung, E-Mail-Konfiguration und Kundenspezifische Einstellungen in der `.env` vornehmen.

### Datenbankschema migrieren

`php artisan migrate`

### Testen

`composer test`

### Demo importieren

`php artisan db:seed`

## Lizenz

Der MängelMelder ist quelloffene Software unter der [MIT license](http://opensource.org/licenses/MIT).
