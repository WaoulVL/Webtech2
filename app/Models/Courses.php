<?php
// app/Models/Gebruiker.php

namespace App\Models;

use Core\Model;

class Courses extends Model
{
    protected string $table = 'Courses';
    protected string $primaryKey = 'CourseID';

    public function insertCourse(string $course): ?array {
        //TODO
        return null;
    }
}
