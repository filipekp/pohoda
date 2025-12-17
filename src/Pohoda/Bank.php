<?php
  /**
   * This file is part of riesenia/pohoda package.
   *
   * Licensed under the MIT License
   * (c) RIESENIA.com
   */
  declare(strict_types=1);
  
  namespace Riesenia\Pohoda;
  
  use Riesenia\Pohoda\Bank\BankLiquidationItem;
  use Riesenia\Pohoda\Bank\LiquidationItem;
  use Riesenia\Pohoda\Bank\SettingsLiquidation;
  
  class Bank extends Document
  {
    /** @var string */
    public static $importRoot = 'lst:bank';
    
    
    /**
     * Add link.
     *
     * @param array<string,mixed> $data
     *
     * @return $this
     */
    public function addBankLiquidationItem(array $data): self {
      if (!isset($this->_data['bankDetail'])) {
        $this->_data['bankDetail'] = [];
      }
      
      $this->_data['bankDetail'][] = new BankLiquidationItem([
        'settingsLiquidation' => new SettingsLiquidation($data['settingsLiquidation'], $this->_ico),
        'liquidationItem' => new LiquidationItem($data['liquidationItem'], $this->_ico),
      ], $this->_ico);
      
      return $this;
    }
    
    protected function _getDocumentNamespace(): string {
      return 'bnk';
    }
    
    protected function _getDocumentName(): string {
      return 'bank';
    }
  }
