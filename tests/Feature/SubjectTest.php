<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\MakesRecords;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    use RefreshDatabase, MakesRecords;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->makeUser());
    }

    public function test_can_view_and_search_subjects(): void
    {
        $this->makeSubject(['code' => 'IT101', 'name' => 'Intro to Computing']);
        $this->makeSubject(['code' => 'ZZ900', 'name' => 'Basket Weaving']);

        $this->get('/subjects')->assertOk()->assertSee('IT101')->assertSee('ZZ900');
        $this->get('/subjects?q=IT101')->assertSee('Intro to Computing')->assertDontSee('Basket Weaving');
    }

    public function test_can_add_subject(): void
    {
        $this->post('/subjects', ['code' => 'IT101', 'name' => 'Intro to Computing', 'units' => 3])
            ->assertRedirect(route('subjects.index'));
        $this->assertDatabaseHas('subjects', ['code' => 'IT101']);
    }

    public function test_add_subject_validation(): void
    {
        $this->makeSubject(['code' => 'IT101']);

        $this->post('/subjects', ['code' => 'IT101', 'name' => '', 'units' => 99])
            ->assertSessionHasErrors(['code', 'name', 'units']);
    }

    public function test_can_edit_subject(): void
    {
        $subject = $this->makeSubject(['code' => 'IT101']);

        $this->get(route('subjects.edit', $subject))->assertOk();
        $this->put(route('subjects.update', $subject), ['code' => 'IT101', 'name' => 'Renamed', 'units' => 4])
            ->assertRedirect(route('subjects.index'));
        $this->assertDatabaseHas('subjects', ['id' => $subject->id, 'name' => 'Renamed', 'units' => 4]);
    }

    public function test_can_delete_subject_and_its_enrollments(): void
    {
        $subject = $this->makeSubject();
        $enrollment = $this->makeEnrollment(null, $subject);

        $this->delete(route('subjects.destroy', $subject))->assertRedirect(route('subjects.index'));
        $this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
        $this->assertDatabaseMissing('enrollments', ['id' => $enrollment->id]);
    }
}
