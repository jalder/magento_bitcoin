<?php
/**
* @category    Bitcoin
* @package     Bitpay
* @copyright   Copyright (c) 2011 Joshua Harvey
* @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*/

require_once('Bitcoin/Bitpay/Helper/jsonRPCClient.php');

class Bitcoin_Bitpay_Block_Form extends Mage_Payment_Block_Form
{
  private $rpcurl;

  protected function _construct()
  {
    parent::_construct();
//    $this->rpcurl = $this->_getRpcUrl();      
    $this->setTemplate('bitpay/form.phtml');
  }

  protected function _getRpcUrl()
  {
    return Mage::getSingleton('bitpay/checkout')->getConfig()->getRpcUrl();
  }

  protected function getAddress(){
//    $url = $this->rpcurl;
    $bitcoin = new jsonRPCClient('http://josh:pass@localhost:8332');

    try {
      $bitcoin->getinfo();
    } catch (Exception $e) {
      $address = 'Error: Bitcoin server is down.  Please email system administrator regarding your order after confirmation.';
      return $address;
    }

    $info = Mage::getSingleton('checkout/cart')->getCustomerSession()->getCustomer();
    if($info->email=='') {
      $address = 'GuestCheckout-';
    }
    else{
      $address = $info->email.'-';		
    }

    $qid = Mage::getSingleton('checkout/cart')->getCheckoutSession()->getQuoteId();	
    $info = Mage::getSingleton('sales/quote')->load($qid);	
    $info->reserveOrderId();
    $address .= $info['reserved_order_id'];

    $address = $bitcoin->getaccountaddress($address);
    return $address;
  }

  /**
  * Render block HTML
  *
  * @return string
  */
  protected function _toHtml()
  {
    $this->address = $this->getAddress();
    Mage::dispatchEvent('payment_form_block_to_html_before', array(
      'block'     => $this
      ));
    return parent::_toHtml();
  }
}
