<?php
  
  declare(strict_types=1);
  
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
  class SettingsLiquidation extends DocumentItem
  {
    /** @var string[] */
    protected $_elements = ['sourceAgenda', 'sourceDocument'];
    
    protected function _configureOptions(OptionsResolver $resolver)
    {
      parent::_configureOptions($resolver);
      
      $resolver->setAllowedValues('sourceAgenda', [
        'issuedInvoice',
        'receivedInvoice',
      ]);
    }
    
    protected function _getNodeName(): string
    {
      return 'bnk:settingsLiquidation';
    }
  }