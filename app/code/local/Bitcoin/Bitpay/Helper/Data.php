<?php
class Bitcoin_Bitpay_Helper_Data extends Mage_Payment_Helper_Data
{

  public function getMethodInstance($code)
  {
      $class = 'bitpay/checkout';
      
      Mage::log("class: ". $class);
      
      
      return Mage::getModel($class);
  }
  
} 
?>