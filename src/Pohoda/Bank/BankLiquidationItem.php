<?php
  
  namespace Riesenia\Pohoda\Bank;
  
  use Riesenia\Pohoda\Common\OptionsResolver;
  use Riesenia\Pohoda\Document\Item as DocumentItem;
  
  /**
   * Třída BankLiquidationItem.
   *
   * @author    Pavel Filípek <pavel@filipek-czech.cz>
   * @copyright © 2025, Proclient s.r.o.
   * @created   17.12.2025
   */
  class BankLiquidationItem extends DocumentItem
  {
    protected $_nodePrefix = 'bankLiquidation';
    
    /** @var string[] */
    protected $_elements = ['settingsLiquidation', 'liquidationItem'];
    
    protected function _configureOptions(OptionsResolver $resolver)
    {
      parent::_configureOptions($resolver);
    }
  }