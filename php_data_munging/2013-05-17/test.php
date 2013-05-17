<?php

include('DataProcessor.php');
include('WeatherDataProcessor.php');
include('FootballDataProcessor.php');

class WeatherDataProcessorTest extends PHPUnit_Framework_TestCase
{
    public function test_process ()
    {
        $data = file_get_contents('weather.dat');
        
        $processor = new WeatherDataProcessor();
        
        $this->assertEquals('14', $processor->process($data));
        
    }
    
    
    public function test_football_process ()
    {
        $data = file_get_contents('football.dat');
        
        $processor = new FootballDataProcessor();
        
        $this->assertEquals('Arsenal', $processor->process($data));
    }
}