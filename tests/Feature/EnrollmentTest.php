<?php

namespace Tests\Feature;

use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\MakesRecords;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase, MakesRecords;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->makeUser());
    }

    private function payload(array $o = []): array
    {
        return $o + ['school_year' => '2026-2027', 'semester' => '1st', 'status' => 'Enrolled'];
    }

    public function test_can_view_enrollments_and_filter_by_status(): void
    {
        $this->makeEnrollment($this->makeStudent(['first_name' => 'Alpha', 'last_name' => 'Active']), null, ['status' => 'Enrolled']);
        $this->makeEnrollment($this->makeStudent(['first_name' => 'Beta', 'last_name' => 'Dropper']), null, ['status' => 'Dropped']);

        $this->get('/enrollments')->assertOk()->assertSee('Alpha Active')->assertSee('Beta Dropper');
        $this->get('/enrollments?status=Dropped')->assertSee('Beta Dropper')->assertDontSee('Alpha Active');
    }

    public function test_can_enroll_student(): void
    {
        $student = $this->makeStudent();
        $subject = $this->makeSubject();

        $this->get(route('enrollments.create'))->assertOk();
        $this->post('/enrollments', $this->payload(['student_id' => $student->id, 'subject_id' => $subject->id]))
            ->assertRedirect(route('enrollments.index'));
        $this->assertDatabaseHas('enrollments', ['student_id' => $student->id, 'subject_id' => $subject->id, 'status' => 'Enrolled']);
    }

    public function test_cannot_enroll_same_student_in_same_subject_and_term_twice(): void
    {
        $student = $this->makeStudent();
        $subject = $this->makeSubject();
        $data = $this->payload(['student_id' => $student->id, 'subject_id' => $subject->id]);

        $this->post('/enrollments', $data);
        $this->post('/enrollments', $data)->assertSessionHasErrors('subject_id');
        $this->assertDatabaseCount('enrollments', 1);
    }

    public function test_can_enroll_in_same_subject_in_a_different_term(): void
    {
        $student = $this->makeStudent();
        $subject = $this->makeSubject();

        $this->post('/enrollments', $this->payload(['student_id' => $student->id, 'subject_id' => $subject->id]));
        $this->post('/enrollments', $this->payload(['student_id' => $student->id, 'subject_id' => $subject->id, 'semester' => '2nd']))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseCount('enrollments', 2);
    }

    public function test_enrollment_validation(): void
    {
        $this->post('/enrollments', ['school_year' => '2026', 'semester' => 'Fall', 'status' => 'Pending'])
            ->assertSessionHasErrors(['student_id', 'subject_id', 'school_year', 'semester', 'status']);
    }

    public function test_can_update_enrollment_status_and_grade(): void
    {
        $enrollment = $this->makeEnrollment();

        $this->get(route('enrollments.edit', $enrollment))->assertOk();
        $this->put(route('enrollments.update', $enrollment), $this->payload(['status' => 'Completed', 'grade' => 1.75]))
            ->assertRedirect(route('enrollments.index'));

        $fresh = $enrollment->fresh();
        $this->assertSame('Completed', $fresh->status);
        $this->assertEquals(1.75, (float) $fresh->grade);
    }

    public function test_grade_must_be_in_range(): void
    {
        $enrollment = $this->makeEnrollment();

        $this->put(route('enrollments.update', $enrollment), $this->payload(['grade' => 9]))->assertSessionHasErrors('grade');
    }

    public function test_can_delete_enrollment(): void
    {
        $enrollment = $this->makeEnrollment();

        $this->delete(route('enrollments.destroy', $enrollment))->assertRedirect(route('enrollments.index'));
        $this->assertNull(Enrollment::find($enrollment->id));
    }
}
