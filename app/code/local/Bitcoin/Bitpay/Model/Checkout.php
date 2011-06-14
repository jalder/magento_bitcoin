<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Bitcoin
 * @package     Bitpay
 * @copyright   Copyright (c) 2011 Joshua Harvey
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Bitcoin_Bitpay_Model_Checkout extends Mage_Payment_Model_Method_Abstract
{
    /**
     * unique internal payment method identifier
     */
    protected $_code = 'bitpay';
//    protected $_paymentMethod	= 'bitcoind';
    
    protected $_formBlockType = 'bitpay/form';
    protected $_infoBlockType = 'bitpay/info';
    
    /**
     * Availability options
     */
    protected $_isGateway              = true;
    protected $_canAuthorize           = true;
    protected $_canCapture             = true;
    protected $_canCapturePartial      = false;
    protected $_canRefund              = false;
    protected $_canVoid                = false;
    protected $_canUseInternal         = false;
    protected $_canUseCheckout         = true;
    protected $_canUseForMultishipping = false;

    protected $_defaultLocale    = 'en';
    
    public function isAvailable($quote = null)
    {
        return true;
    }
    
    public function getTitle() {
      return 'Bitcoin';
    }    

    public function getMethodInstance() {
      Mage::log('in local getMethodInstance');

    }

}
