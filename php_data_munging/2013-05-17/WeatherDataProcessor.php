<?php

class WeatherDataProcessor extends DataProcessor
{
    
    public $columnMap = array(
        'Dy'    => 4, 
        'MxT'=> 6,
        'MnT'=> 6    
    );
    
//    public $columnMap = array('Dy', 'MxT', 'MnT', 'AvT', 'HDDay', 'AvDP', '1HrP', 'TPcpn', 'WxType', 'PDir', 'AvSp', 'Dir', 'MxS', 'SkyC', 'MxR', 'MnR', 'AvSLP');
    
    /**
     * 
     * @param array $columnMap
     * @param arrau $dataRows : Array of strings, where each string is one line of data from .dat file
     * @return array $processedData
     */
    public function mapColumnsToData($columnMap, $dataRows){
        
          $processedData = array();  
        
          foreach ($dataRows as $lineString){
             
              // Check its a row of valid data
              if(strlen($lineString) == 89 && substr(trim($lineString),0,2) != 'Dy'){
                                    
                  $rowData = array();
                  
                  foreach ($columnMap as $columnHeading => $fixedWidth){
                    
                      // Grab the reguired length of characters from the front of the string
                      $rowData[$columnHeading] = substr($lineString,0,$fixedWidth);
                      
                      // Remove thos characters from the line string
                      $lineString = substr_replace($lineString, '', 0, $fixedWidth);
                  }
                  
                  $processedData[] = $rowData;
              }    
          }
          
          return $processedData;
    }
    
    
    /**
     * Perform analysis specific to weather data
     * @param array $dataArray
     * @return string $lowestTempRangeDay : Day number with lowest temp range
     */
    public function analyse($dataArray){
        
        //  Find the lowest range
        foreach ($dataArray as $row){
        
            $tempRange = $row['MxT'] - $row['MnT'];
        
            if (!isset($lowestTempRange) || $tempRange < $lowestTempRange){
                $lowestTempRange = $tempRange;
                $lowestTempRangeDay = $row['Dy'];
            }
        }
        
        return $lowestTempRangeDay;
    }
    
}