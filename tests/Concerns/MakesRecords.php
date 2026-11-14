<?php

namespace Tests\Concerns;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;

trait MakesRecords
{
    private static int $seq = 0;

    protected function makeUser(array $o = []): User
    {
        $n = ++self::$seq;
        return User::create($o + ['name' => "User $n", 'email' => "user$n@test.com", 'password' => 'password']);
    }

    protected function makeStudent(array $o = []): Student
    {
        $n = ++self::$seq;
        return Student::create($o + [
            'student_number' => "2026-" . str_pad($n, 4, '0', STR_PAD_LEFT),
            'first_name' => 'First' . $n, 'last_name' => 'Last' . $n,
            'email' => "student$n@school.test", 'course' => 'BS Information Technology', 'year_level' => 1,
        ]);
    }

    protected function makeSubject(array $o = []): Subject
    {
        $n = ++self::$seq;
        return Subject::create($o + ['code' => "SUB$n", 'name' => "Subject $n", 'units' => 3]);
    }

    protected function makeEnrollment(?Student $student = null, ?Subject $subject = null, array $o = []): Enrollment
    {
        return Enrollment::create($o + [
            'student_id' => ($student ?? $this->makeStudent())->id,
            'subject_id' => ($subject ?? $this->makeSubject())->id,
            'school_year' => '2026-2027', 'semester' => '1st', 'status' => 'Enrolled',
        ]);
    }

    protected function studentData(array $o = []): array
    {
        return $o + [
            'student_number' => '2026-9999', 'first_name' => 'Maria', 'last_name' => 'Santos',
            'email' => 'maria@school.test', 'course' => 'BS Computer Science', 'year_level' => 2,
        ];
    }
}
