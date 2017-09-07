<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Scool\EbreEscoolModel\ClassroomGroup;
use Scool\EbreEscoolModel\Course;
use Scool\EbreEscoolModel\Department;
use Scool\EbreEscoolModel\Study;
use Scool\EbreEscoolModel\StudyModule;
use Scool\EbreEscoolModel\StudySubModule;

/**
 * Class CreateCodeSeedCurriculum.
 *
 * @package App\Console\Commands
 */
class CreateCodeSeedCurriculum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:curriculum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create seed_curriculum code';

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
        // First execute :
//        /usr/bin/ssh -o StrictHostKeyChecking=no  -N -i /home/sergi/.ssh/id_rsa -L 14852:127.0.0.1:3306 -p 22 sergi@192.168.50.180

        // Studies:
//        $studies = Study::orderBy('studies_shortname')->get();
//        $studies->each(function ($study) {
//            $law = "LOE"; if ($study->studies_law_id == 2) $law = "LOGSE";
//            $this->line('first_or_create_study("' . $study->shortname . '","' . $study->name . '",obtainLawIdByCode("' . $law . '"));');
//        });

//        // Departments:
//        $departments = Department::all();
//        $departments->each(function ($department) {
//            $this->line('first_or_create_department("' . $department->shortname . '","' . $department->name . '");');
//        });

//        $courses = Course::orderBy('course_study_id')->orderBy('course_number')->get();
//        $courses->each(function ($course) {
//            $this->line('first_or_create_course("' . $course->shortname . '", "' . $course->name . '", "active",' . $course->number . ', [ obtainStudyIdByCode("' . $course->study->shortname . '") ] );');
//        });

//        $classrooms = ClassroomGroup::orderBy('classroom_group_course_id')->get();
//        $classrooms->each(function ($classroom) {
////            dd($classroom);
//            $this->line('first_or_create_classroom("' . $classroom->code . '","' . $classroom->shortName . '","' . $classroom->name . '", obtainLocationIdByName("20.2"), obtainShiftIdByCode("M"));');
//        });

        // SUBMODULES GROUPED BY MODULES
        $modules = StudyModule::orderBy('study_module_study_shortname')->orderBy('study_module_shortname')->get();
        $modules->each(function ($module) {
            $moduleCode = $module->study_shortname .'_'. $module->shortname;
                $this->line('first_or_create_module("' . $moduleCode . '","' . $module->shortname . '","' . $module->name . '","","active",' . $module->order . ',"' . $module->type->name . '");');
            //SUBMODULES
            $submodules = StudySubModule::where('study_submodules_study_module_id',$module->id)->orderBy('study_submodules_order');
            $submodules->each(function ($submodule) use ($module, $moduleCode) {
//                dd($submodule->course->classrooms->first()->code);
                $this->line(' first_or_create_submodule("' . $module->study_shortname . '_'. $module->shortname .'_' . $submodule->shortname . '","' . $submodule->shortname . '","' . $submodule->name . '","","active",' . $submodule->order .',"' . $submodule->type->name . '",obtainModuleIdByCode("'. $moduleCode . '"), [ obtainClassroomIdByCode("'. $submodule->course->classrooms->first()->code . '") ]);');
            });
        });

    }

    /**
     * Study already exists
     */
    protected function study_already_exists( $shortname)
    {

    }
}
