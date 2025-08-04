<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Interfaces\ItemUpdaterInterface;
use GildedRose\Updaters\NormalItemUpdater;
use GildedRose\Updaters\AgedBrieUpdater;
use GildedRose\Updaters\SulfurasUpdater;
use GildedRose\Updaters\ConjuredItemUpdater;
use GildedRose\Updaters\BackstagePassUpdater;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
        $this->initUpdaters();
    }

    /**
     * @var ItemUpdaterInterface[]
     */
    private array $updaters = [];

    private function initUpdaters(): void
    {
        $this->updaters = [
            'Aged Brie' => new AgedBrieUpdater(),
            'Sulfuras, Hand of Ragnaros' => new SulfurasUpdater(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassUpdater(),
            'Conjured Mana Cake' => new ConjuredItemUpdater(),
            'default' => new NormalItemUpdater(),
        ];
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) 
        {
            $updater = $this->updaters[$item->name] ?? $this->updaters['default'];
            $updater->update($item);
        }
    }
}
