<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course';

    public $timestamps = false;

    public function students()
    {
        return $this->hasMany('Students');
    }
    static public function getStudentCount(){
        return self::join('student', 'student.course_id', '=', 'course.id')
            ->select('course.id', 'course.course_name', DB::raw('COUNT(student.course_id) as count'))
            ->groupBy('student.course_id');
    }
}
