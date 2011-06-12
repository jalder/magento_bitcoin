<?php
/**
 * @category    Bitcoin
 * @package     Bitpay
 * @copyright   Copyright (c) 2011 Joshua Harvey
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


class Bitcoin_Bitpay_Block_Form extends Mage_Payment_Block_Form
{

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('bitpay/form.phtml');
    }

}
