<?php
  
  declare(strict_types=1);
  
  namespace Riesenia\Pohoda\Bank;
  
  use Riesenia\Pohoda\Common\OptionsResolver;
  use Riesenia\Pohoda\Document\Item as DocumentItem;
  
  class LiquidationItem extends DocumentItem
  {
    /** @var string[] */
    protected $_elements = ['quantity', 'homeCurrency', 'foreignCurrency'];
    
    protected function _configureOptions(OptionsResolver $resolver)
    {
      parent::_configureOptions($resolver);
      
      $resolver->setNormalizer('quantity', $resolver->getNormalizer('float'));
    }
    
    protected function _getNodeName(): string
    {
      return 'bnk:liquidationItem';
    }
  }