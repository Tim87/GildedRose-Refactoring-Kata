<?php

namespace GildedRose\Updaters;

use GildedRose\Interfaces\ItemUpdaterInterface;
use GildedRose\Item;

class NormalItemUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->sellIn--;

        if ($item->quality > 0) {
            $item->quality--;
        }

        if ($item->sellIn < 0 && $item->quality > 0) {
            $item->quality--;
        }    
    }
}