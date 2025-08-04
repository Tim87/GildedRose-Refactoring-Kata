<?php

namespace GildedRose\Interfaces;

interface ItemUpdaterInterface
{
    public function update(Item $item): void;
}