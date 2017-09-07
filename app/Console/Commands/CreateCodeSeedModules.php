<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Scool\EbreEscoolModel\StudyModule;

/**
 * Class CreateCodeSeedModules.
 *
 * @package App\Console\Commands
 */
class CreateCodeSeedModules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:modules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create seed_modules code';

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

        $modules = StudyModule::orderBy('study_module_study_shortname')->orderBy('study_module_shortname')->get();;

        $modules->each(function ($module) {
//            dd($module);
//            dd($module->module->shortname);
//            dd($module->module->name);
            // Some code
//            dd($module->name);
            $this->line('first_or_create_module("' . $module->study_shortname . '","' . $module->shortname . '","' . $module->name . '")');
        });


    }
}
