<?php

namespace GildedRose\Interfaces;

use GildedRose\Item;

interface ItemUpdaterInterface
{
    public function update(Item $item): void;
}