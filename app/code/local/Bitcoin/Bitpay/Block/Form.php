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


    if (Mage::getSingleton('customer/session')->getBcAccount() && ($bc_address = Mage::getSingleton('customer/session')->getBcAddress())) {
        return $bc_address;
    }

    //I see config/default/payment/bitpay/rpc{host,port,user,password}

    $hostname = Mage::getConfig()->getNode('default/payment/bitpay/rpchost');
    $port = Mage::getConfig()->getNode('default/payment/bitpay/rpcport');
    $user = Mage::getConfig()->getNode('default/payment/bitpay/rpcuser');
    $password = Mage::getConfig()->getNode('default/payment/bitpay/rpcpassword');

    $bitcoin = new jsonRPCClient("http://$user:$password@$hostname:$port");

    Mage::Log("calling bitcoind:http://$user:xxxx@$hostname:$port");

    try {
      $bitcoin->getinfo();
    } catch (Exception $e) {
      $address = 'Error: Bitcoin server is down.  Please email system administrator regarding your order after confirmation.';
      return $address;
    }

    $info = Mage::getSingleton('checkout/cart')->getCustomerSession()->getCustomer();
    if($info->email=='') {
      $bc_account = 'GuestCheckout-';
    }
    else{
      $bc_account = $info->email.'-';		
    }

    $qid = Mage::getSingleton('checkout/cart')->getCheckoutSession()->getQuoteId();	
    $info = Mage::getSingleton('sales/quote')->load($qid);	

    //this is getting called again at a later time so its not getting trapped here
    $info->reserveOrderId();
    $bc_account .= $info->getReservedOrderId();

    $bc_address = $bitcoin->getaccountaddress($bc_account);

    Mage::Log('bc_account:'. $bc_account . ':bc_address:'. $bc_address . ':');

    Mage::getSingleton('customer/session')->setBcAccount($bc_account);
    Mage::getSingleton('customer/session')->setBcAddress($bc_address);

    $bam = Mage::getModel('bitpay/bam');
    $bam->setOrderId($bc_account);
    $bam->setAddress($bc_address);
    $bam->save();

    return $bc_address;
  }

  /**
  * Render block HTML
  *
  * @return string
  */
  protected function _toHtml()
  {
    $this->address = $this->getAddress();
    return parent::_toHtml();
  }
}
