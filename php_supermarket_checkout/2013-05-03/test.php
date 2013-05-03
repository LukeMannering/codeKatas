<?php
include('checkout.php');

class CheckoutTest extends PHPUnit_Framework_TestCase
{
    
    /**
     * Takes a string of letters that represent stocked items
     * @param string $goodString
     * @return number
     */
    public function price($goodString){
        
       $checkout = new Checkout(); 

       $goodsArray = str_split($goodString,1);
       
       foreach ($goodsArray as $item){
           $checkout->scan($item);           
       }
       
       return $checkout->total;
    }
    

    /**
     * 
     */
    public function test_totals(){

      $this->assertEquals(  0, $this->price(""));
      $this->assertEquals( 50, $this->price("A"));
      $this->assertEquals( 80, $this->price("AB"));
      $this->assertEquals(115, $this->price("CDBA"));

      $this->assertEquals(100, $this->price("AA"));
      $this->assertEquals(130, $this->price("AAA"));
      $this->assertEquals(180, $this->price("AAAA"));
      $this->assertEquals(230, $this->price("AAAAA"));
      $this->assertEquals(260, $this->price("AAAAAA"));

      $this->assertEquals(160, $this->price("AAAB"));
      $this->assertEquals(175, $this->price("AAABB"));
      $this->assertEquals(190, $this->price("AAABBD"));
      $this->assertEquals(190, $this->price("DABABA"));
        
    }
    
    /**
     * 
     */
    public function test_incremental(){
        
        $checkout = new Checkout();
        $this->assertEquals(0, $checkout->total);

        $checkout->scan('A');
        $this->assertEquals(50, $checkout->total);

        $checkout->scan('B');
        $this->assertEquals(80, $checkout->total);

        $checkout->scan('A');
        $this->assertEquals(130, $checkout->total);

        $checkout->scan('A');
        $this->assertEquals(160, $checkout->total);
        
        $checkout->scan('B');
        $this->assertEquals(175, $checkout->total);
    }
    
}