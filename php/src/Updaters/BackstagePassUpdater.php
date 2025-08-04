<?php

namespace GildedRose\Updaters;

use GildedRose\Interfaces\ItemUpdaterInterface;
use GildedRose\Item;

class BackstagePassUpdater implements ItemUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality = 0;
            return;
        }

        if ($item->quality >= 50) {
            return;
        }

        $increase = 1;

        if ($item->sellIn < 5) {
            $increase = 3;
        } elseif ($item->sellIn < 10) {
            $increase = 2;
        }

        $item->quality += $increase;

        if ($item->quality > 50) {
            $item->quality = 50;
        }
    }
}