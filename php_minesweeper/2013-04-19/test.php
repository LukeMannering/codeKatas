<?php

include('minesweeper.php');

class MineTest extends PHPUnit_Framework_TestCase
{
    public function test_convert ()
    {


        $input = '4 4
*...
....
.*..
....
3 5
**...
.....
.*...
4 6
**....
...*..
.*...*
.*....
0 0';


        $output = 'Field #1:
*100
2210
1*10
1110

Field #2:
**100
33200
1*100

Field #3:
**2110
333*21
2*312*
2*2011';
        var_dump($output);

        $this->assertEquals($output, minesweeper::convert($input));
    }
}