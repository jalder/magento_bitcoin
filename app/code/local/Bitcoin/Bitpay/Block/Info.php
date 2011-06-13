<?php 
class Bitcoin_Bitpay_Block_Info extends Mage_Payment_Block_Info
{
    /**
     * Constructor. Set template.
     */
    protected function _construct()
    {
        parent::_construct();
//        $this->setTemplate('moneybookers/info.phtml');
    }

    /**
     * Build PDF content of info block
     *
     * @return string
     */
    public function toPdf()
    {
        $this->setTemplate('moneybookers/pdf/info.phtml');
        return $this->toHtml();
    }
}

?>