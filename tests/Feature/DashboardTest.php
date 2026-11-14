<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\MakesRecords;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase, MakesRecords;

    public function test_dashboard_loads_when_empty(): void
    {
        $this->actingAs($this->makeUser())->get('/dashboard')->assertOk()->assertSee('No enrollments yet');
    }

    public function test_dashboard_statistics_are_correct(): void
    {
        $student = $this->makeStudent();
        $this->makeStudent();
        $subject = $this->makeSubject(['units' => 3]);
        $this->makeEnrollment($student, $subject, ['status' => 'Enrolled']);
        $this->makeEnrollment($student, $this->makeSubject(['units' => 2]), ['status' => 'Completed']);

        $this->actingAs($this->makeUser())->get('/dashboard')
            ->assertOk()
            ->assertViewHas('stats', fn ($s) => $s['students'] === 2 && $s['subjects'] === 2
                && $s['enrollments'] === 2 && $s['total_units'] == 5)
            ->assertViewHas('byStatus', fn ($b) => $b['Enrolled'] === 1 && $b['Completed'] === 1);
    }

    public function test_root_redirects_to_dashboard(): void
    {
        $this->get('/')->assertRedirect('/dashboard');
    }
}
