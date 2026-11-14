<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\MakesRecords;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase, MakesRecords;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->makeUser());
    }

    public function test_can_view_students_list(): void
    {
        $this->makeStudent(['first_name' => 'Maria', 'last_name' => 'Santos']);
        $this->get('/students')->assertOk()->assertSee('Maria Santos');
    }

    public function test_list_shows_empty_state(): void
    {
        $this->get('/students')->assertOk()->assertSee('No students found');
    }

    public function test_can_search_students(): void
    {
        $this->makeStudent(['first_name' => 'Maria', 'last_name' => 'Santos']);
        $this->makeStudent(['first_name' => 'Zacharias', 'last_name' => 'Quill']);

        $this->get('/students?q=Maria')->assertSee('Maria Santos')->assertDontSee('Zacharias');
    }

    public function test_can_add_student(): void
    {
        $this->post('/students', $this->studentData())->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', ['student_number' => '2026-9999', 'email' => 'maria@school.test']);
    }

    public function test_add_student_validates_required_fields(): void
    {
        $this->post('/students', [])->assertSessionHasErrors(['student_number', 'first_name', 'last_name', 'email', 'course', 'year_level']);
    }

    public function test_student_number_and_email_must_be_unique(): void
    {
        $this->makeStudent(['student_number' => '2026-9999', 'email' => 'maria@school.test']);

        $this->post('/students', $this->studentData())->assertSessionHasErrors(['student_number', 'email']);
        $this->assertDatabaseCount('students', 1);
    }

    public function test_can_view_student_profile_with_enrollments(): void
    {
        $student = $this->makeStudent();
        $this->makeEnrollment($student, $this->makeSubject(['code' => 'IT101']));

        $this->get(route('students.show', $student))->assertOk()->assertSee('IT101');
    }

    public function test_can_edit_student(): void
    {
        $student = $this->makeStudent();

        $this->get(route('students.edit', $student))->assertOk();
        $this->put(route('students.update', $student), $this->studentData(['first_name' => 'Updated']))
            ->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', ['id' => $student->id, 'first_name' => 'Updated']);
    }

    public function test_can_update_student_keeping_own_unique_values(): void
    {
        $student = $this->makeStudent(['student_number' => '2026-9999', 'email' => 'maria@school.test']);

        $this->put(route('students.update', $student), $this->studentData(['last_name' => 'Changed']))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('students', ['id' => $student->id, 'last_name' => 'Changed']);
    }

    public function test_can_delete_student_and_their_enrollments(): void
    {
        $student = $this->makeStudent();
        $enrollment = $this->makeEnrollment($student);

        $this->delete(route('students.destroy', $student))->assertRedirect(route('students.index'));
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
        $this->assertDatabaseMissing('enrollments', ['id' => $enrollment->id]);
    }
}
