<?php
  
  declare(strict_types=1);
  
  namespace Riesenia\Pohoda\Bank;
  
  use Riesenia\Pohoda\Common\OptionsResolver;
  use Riesenia\Pohoda\Document\Item as DocumentItem;
  
  class SourceDocument extends DocumentItem
  {
    /** @var string[] */
    protected $_elements = ['number'];
    
    protected function _configureOptions(OptionsResolver $resolver)
    {
      parent::_configureOptions($resolver);
      
      $resolver->setNormalizer('number', $resolver->getNormalizer('string32'));
    }
    
    protected function _getNodeName(): string
    {
      return 'bnk:sourceDocument';
    }
    
    protected function _getElementName(string $key): string
    {
      if ($key === 'number') {
        return 'typ:number';
      }
      
      return parent::_getElementName($key);
    }
  }