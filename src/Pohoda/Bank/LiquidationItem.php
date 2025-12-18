<?php
  
  declare(strict_types=1);
  
  namespace Riesenia\Pohoda\Bank;
  
  use Riesenia\Pohoda\Common\OptionsResolver;
  use Riesenia\Pohoda\Document\Part;
  
  class LiquidationItem extends Part
  {
    /** @var string */
    protected $_nodePrefix = 'liquidation';
    
    /** @var string[] */
    protected $_elements = ['quantity', 'homeCurrency', 'foreignCurrency'];
    
    protected function _configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefined($this->_elements);
      $resolver->setNormalizer('quantity', $resolver->getNormalizer('float'));
      
    }
    
    public function getXML(): \SimpleXMLElement {
      $data = $this->_data ?? [];
      
      $xml = $this->_createXML()->addChild('bnk:liquidationItem', '', $this->_namespace('bnk'));
      
      // bnk:sourceAgenda
      if (isset($data['quantity'])) {
        $xml->addChild('bnk:quantity', (string)$data['quantity'], $this->_namespace('bnk'));
      }
      
      // bnk:sourceDocument (vnorene, ale node je bnk)
      if (isset($data['homeCurrency'])) {
        $hc = $data['homeCurrency'];
        
        // pokud ti tam přijde SourceDocument objekt, vezmeme jeho XML a připojíme
        if (\is_object($hc) && \method_exists($hc, 'getXML')) {
          $this->_appendNode($xml, $hc->getXML());
        } else {
          $hcXml = $this->_createXML()->addChild('bnk:homeCurrency', '', $this->_namespace('bnk'));
          
          if (isset($hc['unitPrice'])) {
            $hcXml->addChild('typ:unitPrice', (string)round($hc['unitPrice'], 2), $this->_namespace('bnk'));
          }
          
          $this->_appendNode($xml, $hcXml);
        }
      }
      
      return $xml;
    }
  }