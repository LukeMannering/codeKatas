<?php

class DataProcessor
{
    /**
     * Must be defined in child
     * @var array
     */
    public $columnMap = array();
    
    /**
     * Parse the raw data, run analysis and return result
     * @param string $input : .dat file string
     */
    public function process($input){
    
        $dataRows = $this->extractDataLines($input);
    
        $dataArray = $this->mapColumnsToData($this->columnMap, $dataRows);
    
        return $this->analyse($dataArray);   
    }
    

    /**
     * Breaks the raw .dat files into array of lines in between the <pre> tags
     * @param string $input : From data file
     * @return array : Array of lines of Data
     */
    public function extractDataLines($input){
    
        // Split input by lines
        $arrayOfLines = explode(PHP_EOL,$input);
        $numberOfLines= count($arrayOfLines);
    
        // Find start and end of data, the <pre> tags
        for ($i=0 ; $i<$numberOfLines ; $i++){
    
            $line = trim($arrayOfLines[$i]);
    
            // Check for start of data
            if ( substr($line,0,5) == '<pre>'){
                $startOfData = $i;
            }
    
            // Check for end of data
            if ( substr($line,0,6) == '</pre>'){
                $endOfData = $i;
            }
        }
    
        // Slice the lines we want out of the lines array
        return array_slice($arrayOfLines, $startOfData, ($endOfData-$startOfData));
    
    }
    
} 