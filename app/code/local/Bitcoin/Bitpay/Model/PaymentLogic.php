<?php
class Bitcoin_Bitpay_Model_PaymentLogic extends Mage_Payment_Model_Method_Abstract
{
	/**
	 * unique internal payment method identifier
	 */
	protected $_code = 'bitcoin';
 
	/**
	 * this should probably be true if you're using this
	 * method to take payments
	 */
	protected $_isGateway			   = true;
 
	/**
	 * can this method authorise?
	 */
	protected $_canAuthorize			= false;
 
	/**
	 * can this method capture funds?
	 */
	protected $_canCapture			  = true;
 
	/**
	 * can we capture only partial amounts?
	 */
	protected $_canCapturePartial	   = false;
 
	/**
	 * can this method refund?
	 */
	protected $_canRefund			   = false;
 
	/**
	 * can this method void transactions?
	 */
	protected $_canVoid				 = false;
 
	/**
	 * can admins use this payment method?
	 */
	protected $_canUseInternal		  = true;
 
	/**
	 * show this method on the checkout page
	 */
	protected $_canUseCheckout		  = true;
 
	/**
	 * available for multi shipping checkouts?
	 */
	protected $_canUseForMultishipping  = true;
  
	/**
	 * this method is called if we are just authorising
	 * a transaction
	 */
	public function authorize (Varien_Object $payment, $amount)
	{
    Mage::Log("in authorize");
	}
 
	/**
	 * this method is called if we are authorising AND
	 * capturing a transaction
	 */
	public function capture (Varien_Object $payment, $amount)
	{

    Mage::Log("in capture");
	}
 
	/**
	 * called if refunding
	 */
	public function refund (Varien_Object $payment, $amount)
	{
    Mage::Log("in refund");
	}
 
	/**
	 * called if voiding a payment
	 */
	public function void (Varien_Object $payment)
	{
    Mage::Log("in void");
	}

}
?>

