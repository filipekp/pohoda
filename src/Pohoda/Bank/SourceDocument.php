<?php
  
  declare(strict_types=1);
  
  namespace Riesenia\Pohoda\Bank;
  
  use Riesenia\Pohoda\Common\OptionsResolver;
  use Riesenia\Pohoda\Document\Part;
  
  class SourceDocument extends Part
  {
    protected $_elements = ['number'];
    
    protected function _configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefined(['number']);
      $resolver->setNormalizer('number', $resolver->getNormalizer('string32'));
    }
    
    protected function _getNodeName(): string
    {
      return 'bnk:sourceDocument';
    }
    
    public function getXML(): \SimpleXMLElement
    {
      $data = $this->_data ?? [];
      
      $xml = $this->_createXML()->addChild(
        'bnk:sourceDocument',
        '',
        $this->_namespace('bnk')
      );
      
      if (isset($data['number'])) {
        $xml->addChild('typ:number', (string) $data['number'], $this->_namespace('typ'));
      }
      
      return $xml;
    }
  }