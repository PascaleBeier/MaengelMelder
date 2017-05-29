<?php

namespace App\Http\Controllers;

use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

/**
 * Class SetupController.
 */
class SetupController extends Controller
{
    /**
     * @var string
     */
    protected $envPath;

    /**
     * SetupController constructor.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $envExampleFile = base_path('.env.example');

        if (! file_exists($this->envPath)) {
            copy($envExampleFile, $this->envPath);
        }

        return view('frontend.setup');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'databaseHost' => 'required',
            'databaseUser' => 'required',
            'databasePassword' => 'required',
            'databaseName' => 'required',
            'clientName' => 'required',
            'clientLocation' => 'required',
        ]);

        $envContent =
            'DB_HOST='.$request->get('databaseHost').PHP_EOL.
            'DB_DATABASE='.$request->get('databaseName').PHP_EOL.
            'DB_USERNAME='.$request->get('databaseUser').PHP_EOL.
            'DB_PASSWORD='.$request->get('databasePassword').PHP_EOL.
            'CLIENT_NAME="'.$request->get('clientName').'"'.PHP_EOL.
            'CLIENT_LOCATION="'.$request->get('clientLocation').'"';

        $env = implode(PHP_EOL, preg_grep(
            "/DB_HOST|DB_DATABASE|DB_USERNAME|DB_PASSWORD|CLIENT_NAME|CLIENT_LOCATION/i",
            explode("\n", file_get_contents($this->envPath)),
            PREG_GREP_INVERT
        )).$envContent;
        $error = [];

        try {
            $dbh = new \PDO('mysql:host='.$request->get('databaseHost'),
                $request->get('databaseUser'),
                $request->get('databasePassword'));

            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // First check if database exists
            $dbh->query(
                'CREATE DATABASE IF NOT EXISTS '.$request->get('databaseName').
                ' CHARACTER SET utf8 COLLATE utf8_general_ci;'
            );
        } catch (\PDOException $e) {
            $error[] = 'Fehler beim Aufbau der Datenbankverbindung: '.$e->getMessage();
        } catch (\Exception $e) {
            $error[] = 'Fehler bei der Datenbankverbindung: '.$e->getMessage();
        }

        try {
            Artisan::call('migrate:refresh', [
                '--force' => true,
                '--seed' => true,
            ]);
        } catch (\Exception $e) {
            $error[] = 'Fehler bei der Datenbankmigration: '.$e->getMessage();
        }

        try {
            file_put_contents($this->envPath, $env);
        } catch (\Exception $e) {
            $error[] = 'Konfiguration konnte nicht geschrieben werden: '.$e->getMessage();
        }

        if (! empty($error)) {
            return redirect()->back()->withErrors($error);
        }

        touch(storage_path('install.lock'));

        return (new Helpers())->flashTo('Erfolg!', 'Installation abgeschlossen.', 'root');
    }
}
