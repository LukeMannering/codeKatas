<?php
class Checkout{
    
    public $total = 0;
    public $discountTotal = 0;
    public $freeItems = array();
    
    private $pricingRulesArray = array();
    private $itemsInBasket = array();
    private $itemsExpendedOnOffers = array();
    
    /**
     * 
     * @param string $pricingRules :  json data
     */
    public function __construct($pricingRules = ''){
     
        if ($pricingRules == ''){
            $pricingRules = file_get_contents('pricingRules.json');    
        }    
        
        $this->pricingRulesArray = json_decode($pricingRules,true);

        if($this->pricingRulesArray == null){
            throw new \Exception('Invalid pricing rules');
        }
    }
      
    public function scan($item){
      
        if($item == ''){
            return;    
        }
        
        // Check item exists 
        if (!isset($this->pricingRulesArray[$item])){
            throw new \Exception('Invalid item id');    
        }
        
        // Add price onto total
        $this->itemsInBasket[] = $item;
        $this->total           += $this->pricingRulesArray[$item]['unitPrice'];
        
        // Apply applicable promotions
        $this->applyPromotions();
 
    }
    
    function applyPromotions (){
        
        // Get offers from pricing rules
        $offersArray = $this->pricingRulesArray['offers'];
        $numberOfOffers = count($offersArray);
        
        
        
        // Create a pool of items available for promo use, once an item has been 'expended' to 
        // claim an offer it is removed from the pool 
        $itemsPool = array_count_values($this->itemsInBasket);
       
        // take away any items already being used in a promotion
        if ( count($this->itemsExpendedOnOffers) > 0 ){
            foreach( $this->itemsExpendedOnOffers as $expendedItem => $qty){
                $itemsPool[$expendedItem] -= $qty;
            }            
        }
        
        
        
        for ($i=0 ; $i<$numberOfOffers ; $i++){
        
            // Assume offer applies until proven otherwise
            $offerApplies = true;
                       
            // Check for required items left in the pool, is one of the checks fails, they can't claim the offer
            $requiredItems = array_count_values(str_split($offersArray[$i]['itemsRequired']));
            
            foreach ($requiredItems as $item => $qtyRequired){
               if (!isset($itemsPool[$item]) || $itemsPool[$item] < $qtyRequired){
                   $offerApplies = false;
               } 
            }
            
            // If they are allowed to claim the offer, take the items out of the pool and apply the effects
            if ($offerApplies){
                
               // Reduce the amount of the item in the pool by the qty required
                foreach ($requiredItems as $item => $qtyRequired){
                    $itemsPool[$item] = $itemsPool[$item] - $qtyRequired; 
                    $this->itemsExpendedOnOffers[$item] = $qtyRequired; 
                }
                
                // Modify the price
                $this->total += $offersArray[$i]['priceModifier'];
                 
                // Chuck in the free items if any
                $this->freeItems[] = $offersArray[$i]['freeItem'];
            }
            
        }
        
    }
    
}