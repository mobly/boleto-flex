<?php

namespace Mobly\Boletoflex\Sdk\Entities;

class Cart
{

    /**
     * @var array
     */
    protected $items;

    /**
     * @param CartItem $cartItem
     */
    public function addItem(CartItem $cartItem)
    {
        $this->items[] = $cartItem;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

}