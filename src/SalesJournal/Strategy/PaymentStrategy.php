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

namespace Librinfo\EcommerceBundle\SalesJournal\Strategy;

use Sylius\Component\Core\Model\PaymentInterface;
use Librinfo\EcommerceBundle\Entity\SalesJournalItem;

class PaymentStrategy implements StrategyInterface
{
    /**
     * @var string
     */
    private $default = 'Payment';

    /**
     * @param PaymentInterface $payment
     *
     * @return string
     */
    public function getLabel($payment): string
    {
        $adjustmentIdentifier = $payment->getMethod()->getCode();

        return $adjustmentIdentifier;
    }

    /**
     * @param PaymentInterface $payment
     */
    public function handleOperation(SalesJournalItem $salesJournalItem, $payment): void
    {
        $salesJournalItem->addDebit($payment->getAmount());
    }
}
