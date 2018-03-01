<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CreateDatabase extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new database as mentioned in .env file';

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
     * i can give the name in argument also to make database name dynamically
     * but here i am only i am using this project for myself that why name is hardcoded
     *
     * @return mixed
     * @author : Rohit N.
     */
    public function handle()
    {
        $database = 'nbaDatabase';
        $databaseCheck = $this->checkIfDBExist($database);
        if (empty($databaseCheck)) {
            DB::connection()->statement("CREATE DATABASE $database DEFAULT CHARACTER SET utf8;");
            echo "Database created successfully";
        } else {
            echo 'Database already exists!';
        }
    }

    /**
     * @param $database
     * @return mixed
     * this function is just to check whether the database that
     * we are creating is exist or not.
     * @author:Rohit N.
     */
    private function checkIfDBExist($database)
    {
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $databaseCheck = DB::select($query, [$database]);

        return $databaseCheck;
    }
}
