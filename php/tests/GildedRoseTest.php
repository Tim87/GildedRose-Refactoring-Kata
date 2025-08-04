<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

    public function testNormalItemDegradesBy1()
    {
        $items = [new Item("Normal Item", 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        
        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(19, $items[0]->quality);
    }

    public function testQualityNeverNegative()
    {
        $items = [new Item("Normal Item", 5, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(0, $items[0]->quality);
    }

    public function testAgedBrieIncreasesInQuality()
    {
        $items = [new Item("Aged Brie", 2, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(1, $items[0]->quality);
        $this->assertSame(1, $items[0]->sellIn);
    }

    public function testQualityMax50()
    {
        $items = [new Item("Aged Brie", 2, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(50, $items[0]->quality);
    }

    public function testSulfurasNeverChanges()
    {
        $items = [new Item("Sulfuras, Hand of Ragnaros", 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseQuality()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 15, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(21, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseBy2()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(22, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseBy3()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 5, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(23, $items[0]->quality);
    }

    public function testBackstagePassesDropToZero()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(0, $items[0]->quality);
    }

    public function testBackstagePassesMaxQuality50()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 5, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(50, $items[0]->quality);
    }

    public function testConjuredItemDegradesTwiceAsFast()
    {
        $items = [new Item("Conjured Mana Cake", 3, 6)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(2, $items[0]->sellIn);
        $this->assertSame(4, $items[0]->quality);
    }

    public function testConjuredItemDegradesFourAfterSellIn()
    {
        $items = [new Item("Conjured Mana Cake", 0, 6)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(2, $items[0]->quality);
    }
}
