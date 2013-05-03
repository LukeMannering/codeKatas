<?php 

$pricing = array(
	'A' => array( 'unitPrice' => 50),
				 
	'B' => array( 'unitPrice' => 30), 
				 
	'C' => array( 'unitPrice' => 20), 
				 
	'D' => array( 'unitPrice' => 15) ,
        
    'offers'    => array( 0 => array (
                                        'itemsRequired' => 'BB',
                                        'priceModifier' => -15,
                                        'freeItem'		=> ''
                                        ),
            
                          1 =>  array (
	  								    'itemsRequired' => 'AAA',
	  								    'priceModifier' => -20,
	  								    'freeItem'		=> ''					
	  									)
                        )
);

echo json_encode($pricing);
?>