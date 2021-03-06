<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Program;

class ProgramTest extends TestCase
{

    use DatabaseMigrations;

    protected $program;

    protected function setUp() {
      parent::setUp();

      $this->program = new Program([
        'one_rep_max_deadlift' => 255,
        'one_rep_max_press' => 125,
        'one_rep_max_squat' => 245,
        'one_rep_max_bench' => 195
      ]);
    }

    public function testHasOneRepMaxes()
    {
      $this->assertEquals(255, $this->program->one_rep_max_deadlift);
      $this->assertEquals(125, $this->program->one_rep_max_press);
      $this->assertEquals(245, $this->program->one_rep_max_squat);
      $this->assertEquals(195, $this->program->one_rep_max_bench);
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

      $expected = [
        'deadlift' => 230,
        'press' => 115,
        'squat' => 225,
        'bench' => 180
      ];

      $this->assertEquals($expected, $this->program->base);
    }

    public function testGetWorkOutWeeks()
    {
      // week 1
      $expected = [
        'week1' => [
          'deadlift' => [
            'set1' => [
              'weight' => 150,
              'reps' => 5
            ],
            'set2' => [
              'weight' => 175,
              'reps' => 5
            ],
            'set3' => [
              'weight' => 200,
              'reps' => '5+'
            ]
          ],
          'press' => [
            'set1' => [
              'weight' => 75,
              'reps' => 5
            ],
            'set2' => [
              'weight' => 90,
              'reps' => 5
            ],
            'set3' => [
              'weight' => 100,
              'reps' => '5+'
            ]
          ],
          'squat' => [
            'set1' => [
              'weight' => 150,
              'reps' => 5
            ],
            'set2' => [
              'weight' => 170,
              'reps' => 5
            ],
            'set3' => [
              'weight' => 195,
              'reps' => '5+'
            ]
          ],
          'bench' => [
            'set1' => [
              'weight' => 120,
              'reps' => 5
            ],
            'set2' => [
              'weight' => 135,
              'reps' => 5
            ],
            'set3' => [
              'weight' => 155,
              'reps' => '5+'
            ]
          ],
        ],
        'week2' => [
          'deadlift' => [
            'set1' => [
              'weight' => 165,
              'reps' => 3
            ],
            'set2' => [
              'weight' => 185,
              'reps' => 3
            ],
            'set3' => [
              'weight' => 210,
              'reps' => '3+'
            ]
          ],
          'press' => [
            'set1' => [
              'weight' => 85,
              'reps' => 3
            ],
            'set2' => [
              'weight' => 95,
              'reps' => 3
            ],
            'set3' => [
              'weight' => 105,
              'reps' => '3+'
            ]
          ],
          'squat' => [
            'set1' => [
              'weight' => 160,
              'reps' => 3
            ],
            'set2' => [
              'weight' => 180,
              'reps' => 3
            ],
            'set3' => [
              'weight' => 205,
              'reps' => '3+'
            ]
          ],
          'bench' => [
            'set1' => [
              'weight' => 130,
              'reps' => 3
            ],
            'set2' => [
              'weight' => 145,
              'reps' => 3
            ],
            'set3' => [
              'weight' => 165,
              'reps' => '3+'
            ]
          ],
        ],
        'week3' => [
            'deadlift' => [
              'set1' => [
                'weight' => 175,
                'reps' => 5
              ],
              'set2' => [
                'weight' => 200,
                'reps' => 3
              ],
              'set3' => [
                'weight' => 220,
                'reps' => '1+'
              ]
            ],
            'press' => [
              'set1' => [
                'weight' => 90,
                'reps' => 5
              ],
              'set2' => [
                'weight' => 100,
                'reps' => 3
              ],
              'set3' => [
                'weight' => 110,
                'reps' => '1+'
              ]
            ],
            'squat' => [
              'set1' => [
                'weight' => 170,
                'reps' => 5
              ],
              'set2' => [
                'weight' => 195,
                'reps' => 3
              ],
              'set3' => [
                'weight' => 215,
                'reps' => '1+'
              ]
            ],
            'bench' => [
              'set1' => [
                'weight' => 135,
                'reps' => 5
              ],
              'set2' => [
                'weight' => 155,
                'reps' => 3
              ],
              'set3' => [
                'weight' => 175,
                'reps' => '1+'
              ]
            ],
          ],
          'week4' => [
            'deadlift' => [
              'set1' => [
                'weight' => 95,
                'reps' => 5
              ],
              'set2' => [
                'weight' => 115,
                'reps' => 5
              ],
              'set3' => [
                'weight' => 140,
                'reps' => 5
              ]
            ],
            'press' => [
              'set1' => [
                'weight' => 50,
                'reps' => 5
              ],
              'set2' => [
                'weight' => 60,
                'reps' => 5
              ],
              'set3' => [
                'weight' => 70,
                'reps' => 5
              ]
            ],
            'squat' => [
              'set1' => [
                'weight' => 90,
                'reps' => 5
              ],
              'set2' => [
                'weight' => 115,
                'reps' => 5
              ],
              'set3' => [
                'weight' => 135,
                'reps' => 5
              ]
            ],
            'bench' => [
              'set1' => [
                'weight' => 75,
                'reps' => 5
              ],
              'set2' => [
                'weight' => 90,
                'reps' => 5
              ],
              'set3' => [
                'weight' => 110,
                'reps' => 5
              ]
            ],
          ]
      ]; // /expected

      $this->assertEquals($expected['week1'], $this->program->getWeek('week1'));
      $this->assertEquals($expected['week2'], $this->program->getWeek('week2'));
      $this->assertEquals($expected['week3'], $this->program->getWeek('week3'));
      $this->assertEquals($expected['week4'], $this->program->getWeek('week4'));
    }
}
