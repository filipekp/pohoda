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
  use Riesenia\Pohoda\Bank\SourceDocument;
  
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
      
      // sourceDocument (Part)
      $sourceDocument = new SourceDocument(
        $data['settingsLiquidation']['sourceDocument'],
        $this->_ico
      );
      $sourceDocument->setNamespace('bnk'); // 🔥 KLÍČOVÉ
      
      // settingsLiquidation (Part)
      $settings = new SettingsLiquidation([
        'sourceAgenda' => $data['settingsLiquidation']['sourceAgenda'],
        'sourceDocument' => $sourceDocument,
      ], $this->_ico);
      $settings->setNamespace('bnk'); // 🔥 KLÍČOVÉ
      
      // liquidationItem (Document\Item)
      $liquidationItem = new LiquidationItem(
        $data['liquidationItem'],
        $this->_ico
      );
      $liquidationItem->setNamespace('bnk');
      
      // bankLiquidationItem (Document\Item)
      $item = new BankLiquidationItem([
        'settingsLiquidation' => $settings,
        'liquidationItem' => $liquidationItem,
      ], $this->_ico);
      $item->setNamespace('bnk');
      
      $this->_data['bankDetail'][] = $item;
      
      return $this;
    }
    
    protected function _getDocumentNamespace(): string {
      return 'bnk';
    }
    
    protected function _getDocumentName(): string {
      return 'bank';
    }
  }
