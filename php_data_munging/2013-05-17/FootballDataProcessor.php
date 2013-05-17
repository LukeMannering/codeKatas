<?php

class FootballDataProcessor extends DataProcessor
{
    
    public $columnMap = array('','pos','Team','P','W' ,'L','D','F','-','A','Pts');
     
    /**
     * 
     * @param array $columnMap
     * @param arrau $dataRows : Array of strings, where each string is one line of data from .dat file
     * @return array $processedData
     */
    public function mapColumnsToData($columnMap, $dataRows){
    
        $processedData = array();
        
        foreach ($dataRows as $lineString){
            
            $columns = preg_split('/[\s]+/',$lineString);
           
            // Check this row has the correct number of columns
            if(count($columns) == count($columnMap)){
                
                $processedRow = array();
                
                foreach($columns as $index => $value){
                    
                    if(trim($value) != '' && $value != '-'){
                        $processedRow[$columnMap[$index]] = $value;
                    }    
                }

                $processedData[] = $processedRow;
            }
        }    

    
        return $processedData;
    }
    
    /**
     * Perform analysis specific to football data
     * @param array $dataArray
     * @return string $lowestTempRangeDay : Day number with lowest temp range
     */
    public function  analyse($dataArray){
        
        // Compare for and against on each row
        foreach ($dataArray as $row){
        
            $difference = $row['A'] - $row['F'];
        
            if (!isset($lowestDifference) || $difference < $lowestDifference){
                $lowestDifference = $difference;
                $lowestDifferenceTeam = $row['Team'];
            }
        }
        
        
        return $lowestDifferenceTeam;
    }
    
}