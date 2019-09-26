<?php

namespace Mobly\Boletoflex\Sdk\Entities;

class History extends AbstractEntity
{

    /**
     * @var array
     */
    protected $items;

    /**
     * @param $historyItem
     */
    public function addItem(HistoryItem $historyItem)
    {
        $this->items[] = $historyItem;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }
}
