<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAddresses extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_address';
    public function students()
    {

        return $this->hasMany( 'Student');

    }
}
