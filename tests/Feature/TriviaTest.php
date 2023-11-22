<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TriviaTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_load_questions(): void
    {

        $response = $this->withoutMiddleware()->post(route('store'), [
            'full_name' => 'John Doe',
            'email' => 'john@acme.com',
            'number_of_questions' => 10,
            'difficulty' => 'easy',
            'type' => 'multiple',
        ]);

        $response->assertSeeText('Trivia Questions');
        $response->assertSeeText('Question 1');
        $response->assertSeeText('Question 2');

    }
}
