<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Scool\EbreEscoolModel\ClassroomGroup;
use Scool\EbreEscoolModel\Course;
use Scool\EbreEscoolModel\Department;
use Scool\EbreEscoolModel\Study;
use Scool\EbreEscoolModel\StudyModule;
use Scool\EbreEscoolModel\StudySubModule;
use Scool\Untis\Models\Profesor;

/**
 * Class CreateCodeSeedSpecialities.
 *
 * @package App\Console\Commands
 */
class CreateCodeSeedSpecialities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:specialities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create seed_specialities code';

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
     * Obtain Department Code By Speciality Code.
     *
     * @param $speciality
     * @return mixed
     */
    protected function obtainDepartmentCodeBySpecialityCode($speciality)
    {
        $departmentsBySpeciality = [
            "501" => "ADM",
            "504" => "EDF",
            "505" => "FOL",
            "507" => "INF",
            "508" => "SSC",
            "510" => "COM",
            "512" => "MEC",
            "513" => "ELE",
            "517" => "SAN",
            "518" => "SAN",
            "522" => "ART",
            "524" => "ELE",
            "525" => "ELE",
            "602" => "ELE",
            "605" => "ELE",
            "606" => "ELE",
            "611" => "MEC",
            "612" => "EDF",
            "619" => "SAN",
            "620" => "SAN",
            "621" => "COM",
            "622" => "ADM",
            "623" => "ART",
            "625" => "SSC",
            "627" => "INF",
            "AN" => "CAS",
            "CAS" => "CAS",
            "MA" => "CAS"
        ];
        return $departmentsBySpeciality[$speciality];
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Taken from Untis
        //Una vacante tiene que tener horarios Obtener los profes que tienen horario
        $profesores = Profesor::has('horarios')->whereNotNull('especialidad')->groupBy('especialidad')->get();
        foreach ($profesores as $profesor) {
            $code = '"' . $profesor->especialidad . '"';
            $shortname = '"' . $profesor->departamento . '"';
            $name = '""';
            $description = '""';
            print("first_or_create_speciality(" . $code .", " . $shortname . ", " . $name . ", " . $description . ");\n");
        }
    }
}
