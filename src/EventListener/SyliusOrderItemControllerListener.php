<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\EcommerceBundle\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;

class SyliusOrderItemControllerListener
{
    /**
     * @var array
     */
    private $bulkInformations = [];

    public function onOrderItemAddToCart(GenericEvent $event): void
    {
        if ($this->bulkInformations['bulk-weight'] === null) {
            return;
        }

        $orderItem = $event->getSubject();
        $orderItem->setBulk(true);
        $orderItem->setQuantity(intval($this->bulkInformations['bulk-weight'] * 1000));
    }

    /**
     * @param array bulkInformations
     */
    public function setBulkInformations(array $bulkInformations): void
    {
        $this->bulkInformations = $bulkInformations;
    }
}
