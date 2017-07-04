<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Program;

class ProgramTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testHasOneRepMaxes()
    {
      $program = new Program([
        'one_rep_max_deadlift' => 255,
        'one_rep_max_press' => 125,
        'one_rep_max_squat' => 245,
        'one_rep_max_bench' => 195
      ]);

      $this->assertEquals(255, $program->one_rep_max_deadlift);
      $this->assertEquals(125, $program->one_rep_max_press);
      $this->assertEquals(245, $program->one_rep_max_squat);
      $this->assertEquals(195, $program->one_rep_max_bench);
    }

    public function testOneRepMaxesAreAlwaysIntegers()
    {
      $program = Program::create([
        'one_rep_max_deadlift' => 255.2,
        'one_rep_max_press' => 125.4,
        'one_rep_max_squat' => 245.5,
        'one_rep_max_bench' => 195.9
      ]);

      $this->assertEquals(255, $program->one_rep_max_deadlift);
      $this->assertEquals(125, $program->one_rep_max_press);
      $this->assertEquals(245, $program->one_rep_max_squat);
      $this->assertEquals(195, $program->one_rep_max_bench);
    }

    public function testGetBaseWeights()
    {
      $program = new Program([
        'one_rep_max_deadlift' => 255,
        'one_rep_max_press' => 125,
        'one_rep_max_squat' => 245,
        'one_rep_max_bench' => 195
      ]);

      $expected = [
        'deadlift' => 230,
        'press' => 115,
        'squat' => 225,
        'bench' => 180
      ];

      $this->assertEquals($expected, $program->base);
    }

}