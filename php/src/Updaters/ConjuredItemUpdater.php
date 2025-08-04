<?php

namespace GildedRose\Updaters;

use GildedRose\Interfaces\ItemUpdaterInterface;
use GildedRose\Item;

class ConjuredItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->sellIn--;

        $degrade = 2;

        if ($item->sellIn < 0) {
            $degrade *= 2;
        }

        $item->quality -= $degrade;

        if ($item->quality < 0) {
            $item->quality = 0;
        }
    }
}