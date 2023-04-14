<?php

namespace App\Models;

use Core\Model;

class student_begeleider extends Model
{
    public function insertStudentBegeleider($student, $begeleider): ?array
    {
        $statement = $this->database->getPdo()->prepare("INSERT INTO {$this->table} (StudentID, DocentID) VALUES (:student, :begeleider)");
        $statement->execute([':student' => $student, ':begeleider' => $begeleider]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }
}