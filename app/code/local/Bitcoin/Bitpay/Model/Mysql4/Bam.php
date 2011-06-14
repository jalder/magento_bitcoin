<?php

class Bitcoin_Bitpay_Model_Mysql4_Bam extends Mage_Core_Model_Mysql4_Abstract {
    protected function _construct()
    {
        $this->_init('bitpay/bam', 'bam_id');
    }   
}
