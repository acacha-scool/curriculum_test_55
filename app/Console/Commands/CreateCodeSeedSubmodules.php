<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Scool\EbreEscoolModel\StudySubModule;

class CreateCodeSeedSubmodules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:submodules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create seed_submodules code';

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
//        /usr/bin/ssh -o StrictHostKeyChecking=no  -N -i /home/sergi/.ssh/id_rsa -L 14852:127.0.0.1:3306 -p 22 sergi@192.168.50.180

        $submodules = StudySubModule::orderBy();

//        $sorted = $submodules->sortBy(function ($submodule, $key) {
//            if ($submodule->module) return $submodule->module->study_shortname;
//        });

        $submodules->each(function ($submodule) {
//            dd($submodule->module->study_shortname);
//            dd($submodule->module->shortname);
//            dd($submodule->module->name);
            // Some code
//            dd($submodule->name);
            $this->line('first_or_create_submodule("' . $submodule->module->study_shortname . '","' . $submodule->shortname . '","' . $submodule->name . '")');
        });


    }
}
