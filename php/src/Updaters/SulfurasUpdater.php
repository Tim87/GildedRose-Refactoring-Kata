<?php

namespace GildedRose\Updaters;

use GildedRose\Interfaces\ItemUpdaterInterface;
use GildedRose\Item;

class SulfurasUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        // Sulfuras never changes in quality or sellIn
    }
}