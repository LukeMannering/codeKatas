<?php
include('Swordsman.php');
include('Brute.php');
include('Grappler.php');

class BattleTest extends PHPUnit_Framework_TestCase
{

    public function test_SwordsmanConstructor()
    {
        for ($i=0; $i<100; $i++) {
            $fighter = new Swordsman(
                    'testName9012345678901234567890'
            );

            $this->assertEquals(
                    'testName9012345678901234567890',
                    $fighter->name
            );
            $this->assertGreaterThanOrEqual(40, $fighter->health);
            $this->assertLessThanOrEqual(60, $fighter->health);
            $this->assertGreaterThanOrEqual(60, $fighter->strength);
            $this->assertLessThanOrEqual(70, $fighter->strength);
            $this->assertGreaterThanOrEqual(20, $fighter->defense);
            $this->assertLessThanOrEqual(30, $fighter->defense);
            $this->assertGreaterThanOrEqual(90, $fighter->speed);
            $this->assertLessThanOrEqual(100, $fighter->speed);
            $this->assertGreaterThanOrEqual(0.3, $fighter->luck);
            $this->assertLessThanOrEqual(0.5, $fighter->luck);
        }
    }

    public function test_BruteConstructor()
    {
        for ($i=0; $i<100; $i++) {
            $fighter = new Brute(
                    'testName9012345678901234567890'
            );

            $this->assertEquals(
                    'testName9012345678901234567890',
                    $fighter->name
            );
            $this->assertGreaterThanOrEqual(90, $fighter->health);
            $this->assertLessThanOrEqual(100, $fighter->health);
            $this->assertGreaterThanOrEqual(65, $fighter->strength);
            $this->assertLessThanOrEqual(75, $fighter->strength);
            $this->assertGreaterThanOrEqual(40, $fighter->defense);
            $this->assertLessThanOrEqual(50, $fighter->defense);
            $this->assertGreaterThanOrEqual(40, $fighter->speed);
            $this->assertLessThanOrEqual(65, $fighter->speed);
            $this->assertGreaterThanOrEqual(0.3, $fighter->luck);
            $this->assertLessThanOrEqual(0.35, $fighter->luck);
        }
    }

    public function test_GrapplerConstructor()
    {
        for ($i=0; $i<100; $i++) {
            $fighter = new Grappler(
                    'testName9012345678901234567890'
            );

            $this->assertEquals(
                    'testName9012345678901234567890',
                    $fighter->name
            );
            $this->assertGreaterThanOrEqual(60, $fighter->health);
            $this->assertLessThanOrEqual(100, $fighter->health);
            $this->assertGreaterThanOrEqual(75, $fighter->strength);
            $this->assertLessThanOrEqual(80, $fighter->strength);
            $this->assertGreaterThanOrEqual(35, $fighter->defense);
            $this->assertLessThanOrEqual(40, $fighter->defense);
            $this->assertGreaterThanOrEqual(60, $fighter->speed);
            $this->assertLessThanOrEqual(80, $fighter->speed);
            $this->assertGreaterThanOrEqual(0.3, $fighter->luck);
            $this->assertLessThanOrEqual(0.4, $fighter->luck);
        }
    }

}