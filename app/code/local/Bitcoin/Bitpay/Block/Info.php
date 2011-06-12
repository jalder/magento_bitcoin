<?php 
class Phoenix_Moneybookers_Block_Info extends Mage_Payment_Block_Info
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
     * Returns code of payment method
     *
     * @return string
     */
    public function getMethodCode()
    {
        Mage::log('in local getMethodCode');
      
        return $this->getInfo()->getMethodInstance()->getCode();
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