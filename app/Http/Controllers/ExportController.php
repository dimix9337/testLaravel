<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{

    /**
     * $fields must be like  ['field' => 0, 'field2' => 0]
     * @param $fields
     * @param $model
     * @return string
     */
    private function generateCSV($fields, $model)
    {
        $bodyCSV = [];

        foreach ($model as $column) {
            $columnValues = $column->toArray();
            $bodyCSV[] = implode('; ', array_intersect_key($columnValues, $fields));
        }

        return implode(" \n ", $bodyCSV);
    }

    private function generateFile($DBCollections,$fileName,$filePath,$fields)
    {
        $contents = $this->generateCSV($fields, $DBCollections);

        Storage::put('public\\'.$filePath . $fileName, $contents);

        return public_path('storage\\'.$filePath . $fileName);
    }

    /**
     * Exports the total amount of students that are taking each course to a CSV file
     */

    public function export(Request $request)
    {
        $studentIds = $request->input('studentId');
        $students = Students::with('course')->find($studentIds);

        $fileName = time() . '-students.csv';
        $filePath = 'CSV\\';
        $fields = [
            'id' => 0,
            'firstname' => 0,
            'surname' => 0,
            'email' => 0,
            'course_id' => 0
        ];

        if (empty($students)) {
            return view('errors.503', ['error' => "Select at least one student to export"]);
        }

        $file = $this->generateFile($students,$fileName, $filePath,$fields);

        return response()->download($file);
    }

    public function exportCourse()
    {
        $course = Course::getStudentCount()->get();
        $fileName = time() . '-courses.csv';
        $filePath = 'CSV\\courses\\';
        $fields = [
            'id' => 0,
            'course_name' => 0,
            'count' => 0,
        ];

        if (empty($course)) {
            return view('errors.503', ['error' => "We don't have any courses"]);
        }

        $file = $this->generateFile($course,$fileName, $filePath,$fields);

        return response()->download($file);

    }

}
