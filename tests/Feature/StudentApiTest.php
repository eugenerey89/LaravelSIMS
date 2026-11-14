<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\Concerns\MakesRecords;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
    use RefreshDatabase, MakesRecords;

    public function test_login_returns_a_token(): void
    {
        $this->makeUser(['email' => 'api@test.com', 'password' => 'password']);

        $this->postJson('/api/login', ['email' => 'api@test.com', 'password' => 'password'])
            ->assertOk()->assertJsonStructure(['token', 'token_type']);
    }

    public function test_login_rejects_bad_credentials(): void
    {
        $this->makeUser(['email' => 'api@test.com']);

        $this->postJson('/api/login', ['email' => 'api@test.com', 'password' => 'wrong'])->assertStatus(401);
    }

    public function test_student_endpoints_require_authentication(): void
    {
        $student = $this->makeStudent();

        $this->getJson('/api/students')->assertStatus(401);
        $this->getJson("/api/students/{$student->id}")->assertStatus(401);
        $this->postJson('/api/students', $this->studentData())->assertStatus(401);
        $this->deleteJson("/api/students/{$student->id}")->assertStatus(401);
    }

    public function test_can_list_and_search_students(): void
    {
        Sanctum::actingAs($this->makeUser());
        $this->makeStudent(['first_name' => 'Maria', 'last_name' => 'Santos']);
        $this->makeStudent(['first_name' => 'Zacharias', 'last_name' => 'Quill']);

        $this->getJson('/api/students')->assertOk()->assertJsonCount(2, 'data');
        $this->getJson('/api/students?q=Maria')->assertOk()->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.full_name', 'Maria Santos');
    }

    public function test_can_show_student_with_enrollments(): void
    {
        Sanctum::actingAs($this->makeUser());
        $student = $this->makeStudent();
        $this->makeEnrollment($student, $this->makeSubject(['code' => 'IT101']));

        $this->getJson("/api/students/{$student->id}")->assertOk()
            ->assertJsonPath('data.id', $student->id)
            ->assertJsonPath('data.enrollments.0.subject_code', 'IT101');
    }

    public function test_show_returns_404_for_unknown_student(): void
    {
        Sanctum::actingAs($this->makeUser());
        $this->getJson('/api/students/9999')->assertNotFound();
    }

    public function test_can_create_student(): void
    {
        Sanctum::actingAs($this->makeUser());

        $this->postJson('/api/students', $this->studentData())->assertCreated()
            ->assertJsonPath('data.student_number', '2026-9999');
        $this->assertDatabaseHas('students', ['email' => 'maria@school.test']);
    }

    public function test_create_returns_422_on_invalid_data(): void
    {
        Sanctum::actingAs($this->makeUser());

        $this->postJson('/api/students', [])->assertStatus(422)
            ->assertJsonValidationErrors(['student_number', 'first_name', 'last_name', 'email', 'course', 'year_level']);
    }

    public function test_can_partially_update_student(): void
    {
        Sanctum::actingAs($this->makeUser());
        $student = $this->makeStudent(['first_name' => 'Old']);

        $this->patchJson("/api/students/{$student->id}", ['first_name' => 'New'])->assertOk()
            ->assertJsonPath('data.first_name', 'New');
        $this->assertDatabaseHas('students', ['id' => $student->id, 'first_name' => 'New']);
    }

    public function test_can_delete_student(): void
    {
        Sanctum::actingAs($this->makeUser());
        $student = $this->makeStudent();

        $this->deleteJson("/api/students/{$student->id}")->assertNoContent();
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
