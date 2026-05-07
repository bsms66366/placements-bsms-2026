<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    
/**
     * Return a paginated list of students
     */
    public function index(Request $request)
    {
        return Student::paginate(
            $request->get('per_page', 50) // safe default
        );
    }

    /**
     * Return a single student by ID
     */
    public function show(Student $student)
    {
        return $student->load([
            'gp_teacher',
            'facilitator',
            'group',
            'location2025',
            'Student Number',
            'Year',
            'Gender',
            'Rotation Group',
            'Seminar Group',
            'CPW',
            'CPS',
            'CPW/CPS',
            'Simulated Home Visit Group',
            'Car Owner',
            'GP Teacher',
            'Facilitator',
            'Placement', 

        ]);

}
