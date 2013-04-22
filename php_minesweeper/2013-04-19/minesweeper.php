<?php

class minesweeper
{

    public static function convert($input)
    {
        
        // PARSE INPUT
        $inputLines = explode(PHP_EOL, $input);
        $fieldNumber = 0;
        $fieldsArray = array();
        
        foreach ($inputLines as $key => $inputLine){
           
            if (preg_match('/^[1-9\s]+$/', $inputLine) == 1){

                // It's the "n m" start of field line
                $fieldsArray[++$fieldNumber] = array();
                               
            } elseif(preg_match('/^[\.\*]+$/', $inputLine) == 1){
                
                // It's a standard  .*.. line
                $fieldsArray[$fieldNumber][] = str_split($inputLine);
                                
            } elseif(preg_match('/^[0\s]+$/', $inputLine) == 1){
                
                // Its the "0 0" end of file line 
                break;
                
            } else{
                // The line isn't valid
                throw new Exception('Invalid input on line ' . ($key + 1) . ': "' . $inputLine . '"');
            }    
                       
        }
        
        // ANALYSE INPUT
        
        // Copy $fieldsArray into and output array, and we'll overwrite the input characters with the numbers
        $output = $fieldsArray;
        
        // Iterate over all fields
        foreach ($fieldsArray as $fieldNumber => $fieldArray){

            foreach($fieldArray as $rowNumber => $rowArray){

                foreach($rowArray as $colNumber => $character){
                      
                        // if this cell a mine?
                        if ($character == '*'){
                            
                            $output[$fieldNumber][$rowNumber][$colNumber] = '*';
                        
                        } else{
                    
                            // It's an empty square find out how many mines are adjacent
                            $adjacentToThisCell = array();
                            
                            // Row above
                            if ( isset($fieldsArray[$fieldNumber][$rowNumber-1][$colNumber-1])){
                                $adjacentToThisCell[] = $fieldsArray[$fieldNumber][$rowNumber-1][$colNumber-1];
                            }
                            
                            if ( isset($fieldsArray[$fieldNumber][$rowNumber-1][$colNumber])){
                                $adjacentToThisCell[] = $fieldsArray[$fieldNumber][$rowNumber-1][$colNumber];
                            }
                            
                            if ( isset($fieldsArray[$fieldNumber][$rowNumber-1][$colNumber+1])){
                                $adjacentToThisCell[] = $fieldsArray[$fieldNumber][$rowNumber-1][$colNumber+1];
                            }
                            
                            // Same row
                            if ( isset($fieldsArray[$fieldNumber][$rowNumber][$colNumber-1])){
                                $adjacentToThisCell[] = $fieldsArray[$fieldNumber][$rowNumber][$colNumber-1];
                            }
                            
                            if ( isset($fieldsArray[$fieldNumber][$rowNumber][$colNumber+1])){
                                $adjacentToThisCell[] = $fieldsArray[$fieldNumber][$rowNumber][$colNumber+1];
                            }
                            
                            // Row below
                            if ( isset($fieldsArray[$fieldNumber][$rowNumber+1][$colNumber-1])){
                                $adjacentToThisCell[] = $fieldsArray[$fieldNumber][$rowNumber+1][$colNumber-1];
                            }
                            
                            if ( isset($fieldsArray[$fieldNumber][$rowNumber+1][$colNumber])){
                                $adjacentToThisCell[] = $fieldsArray[$fieldNumber][$rowNumber+1][$colNumber];
                            }
                            
                            if ( isset($fieldsArray[$fieldNumber][$rowNumber+1][$colNumber+1])){
                                $adjacentToThisCell[] = $fieldsArray[$fieldNumber][$rowNumber+1][$colNumber+1];
                            }
                       
                            // It's not a mine so count up adjacent cells
                            $characterCounts = array_count_values($adjacentToThisCell);
                            
                            if (isset($characterCounts['*'])){
                                $output[$fieldNumber][$rowNumber][$colNumber] = $characterCounts['*'];
                            } else {
                                $output[$fieldNumber][$rowNumber][$colNumber] = 0;
                            }
                            
                        }
                }
            }
        }
        
        // MAKE THE OUTPUT STRING
        $outputStr = '';
        
        // Iterate over all fields
        foreach ($output as $fieldNumber => $fieldArray){
        
            // Start Minefield
            $outputStr .= 'Field #' . $fieldNumber . ':' . PHP_EOL;
            
            foreach($fieldArray as $rowNumber => $rowArray){
                $outputStr.= implode('', $rowArray ) . PHP_EOL; 
            }
            
            // End of this minefield
            $outputStr .= PHP_EOL;
        }
        
        // Trim trailing spaces and EOL's
        $outputStr = rtrim($outputStr);
        
        return $outputStr;
    }
    

}