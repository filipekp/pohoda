<?php
  
  declare(strict_types=1);
  
  namespace Riesenia\Pohoda\Bank;
  
  use Riesenia\Pohoda\Common\OptionsResolver;
  use Riesenia\Pohoda\Document\Part;
  use Tracy\Debugger;
  
  
  /**
   * Třída BankLiquidationItem.
   *
   * @author    Pavel Filípek <pavel@filipek-czech.cz>
   * @copyright © 2025, Proclient s.r.o.
   * @created   17.12.2025
   */
  class SettingsLiquidation extends Part
  {
    protected $_elements = [
      'sourceAgenda',
      'sourceDocument',
    ];
    
    protected function _configureOptions(OptionsResolver $resolver)
    {
      $resolver->setDefined($this->_elements);
      
      $resolver->setAllowedValues('sourceAgenda', [
        'issuedInvoice',
        'receivedInvoice',
      ]);
    }
    
    public function getXML(): \SimpleXMLElement
    {
      $data = $this->_data ?? [];
      
      $xml = $this->_createXML()->addChild(
        'bnk:settingsLiquidation',
        '',
        $this->_namespace('bnk')
      );
      
      // bnk:sourceAgenda
      if (isset($data['sourceAgenda'])) {
        $xml->addChild(
          'bnk:sourceAgenda',
          (string) $data['sourceAgenda'],
          $this->_namespace('bnk')
        );
      }
      
      // bnk:sourceDocument (vnorene, ale node je bnk)
      if (isset($data['sourceDocument'])) {
        $sd = $data['sourceDocument'];
        
        // pokud ti tam přijde SourceDocument objekt, vezmeme jeho XML a připojíme
        if (\is_object($sd) && \method_exists($sd, 'getXML')) {
          $this->_appendNode($xml, $sd->getXML());
        } else {
          // nebo když přijde pole: ['number' => '...']
          $sdXml = $this->_createXML()->addChild('bnk:sourceDocument', '', $this->_namespace('bnk'));
          
          if (isset($sd['number'])) {
            $sdXml->addChild('typ:number', (string) $sd['number'], $this->_namespace('typ'));
          }
          
          $this->_appendNode($xml, $sdXml);
        }
      }
      
      return $xml;
    }
  }