<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['email' => 'admin@example.com'], ['name' => 'Admin', 'password' => 'password']);

        $subjects = collect([
            ['IT101', 'Introduction to Computing', 3], ['IT102', 'Programming Fundamentals', 3],
            ['MATH101', 'Discrete Mathematics', 3], ['ENG101', 'Technical Writing', 3],
            ['IT201', 'Database Systems', 3], ['IT202', 'Web Development', 3],
        ])->map(fn ($s) => Subject::firstOrCreate(['code' => $s[0]], ['name' => $s[1], 'units' => $s[2]]));

        $names = [['Maria', 'Santos'], ['Juan', 'Dela Cruz'], ['Ana', 'Reyes'], ['Carlos', 'Garcia'], ['Liza', 'Mendoza'], ['Paolo', 'Ramos']];
        foreach ($names as $i => [$first, $last]) {
            $student = Student::firstOrCreate(['student_number' => '2026-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT)], [
                'first_name' => $first, 'last_name' => $last,
                'email' => strtolower($first . '.' . str_replace(' ', '', $last)) . '@school.test',
                'gender' => $i % 2 ? 'Male' : 'Female', 'course' => $i % 3 ? 'BS Information Technology' : 'BS Computer Science',
                'year_level' => ($i % 4) + 1,
            ]);

            foreach ($subjects->random(3) as $subject) {
                Enrollment::firstOrCreate(
                    ['student_id' => $student->id, 'subject_id' => $subject->id, 'school_year' => '2026-2027', 'semester' => '1st'],
                    ['status' => collect(Enrollment::STATUSES)->random()]
                );
            }
        }
    }
}
