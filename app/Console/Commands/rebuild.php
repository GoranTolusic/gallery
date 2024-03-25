<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class rebuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Gallery';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (env('APP_MODE') !== 'develop') {
            echo "HINT! - ";
            dd('App mode is set to production. This command is disabled if application is not in develop mode. Make sure your configuration inside .env file is correct. Make sure APP_MODE inside env file is set to develop. Be careful when executing this command on production server, because you might loose data.');
        }

        //Set variable for database "menu"
        $db = env('DB_DATABASE');

        //Make connection to DB
        $conn = mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'));

        if (!$conn) {
            dd("Can't connect to MySQL");
        }

        //Queries to drop and create fresh database "menu"
        mysqli_query($conn, "DROP DATABASE ".$db);
        echo "\nDroping current database; ";
        mysqli_query($conn, "CREATE DATABASE ".$db." character set UTF8 collate utf8_unicode_ci");
        echo "\nCreating $db database; ";

        echo "\nMigrating files; ";
        //Creating fresh DB tables defined in database/migration folder
        Artisan::call('migrate:refresh');

        echo "\nSeeding data; ";
        //Seed predefined data from app/Meta/Metadata.php file
        Artisan::call('db:seed');

        echo "\nSeting up public storage folder; ";
        //link public folder in storage with global public folder
        //Artisan::call('storage:link');

         echo "\nClearing cache; ";
        //clearing cache
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        echo "\nDuart installed successfully!\n\nHINT: Don't forget to set up your server permissions and configuration in .env file and config folder for proper work of application!";
    }
}
