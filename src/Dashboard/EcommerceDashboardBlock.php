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

namespace Librinfo\EcommerceBundle\Dashboard;

use Blast\CoreBundle\Dashboard\AbstractDashboardBlock;
use Librinfo\EcommerceBundle\Dashboard\Stats\Misc;
use Librinfo\EcommerceBundle\Dashboard\Stats\Sales;
use Librinfo\EcommerceBundle\Dashboard\Stats\OrdersToProcess;

class EcommerceDashboardBlock extends AbstractDashboardBlock
{
    /**
     * @var Sales
     */
    private $salesStats;

    /**
     * @var OrdersToProcess
     */
    private $orderToProcessStats;

    /**
     * @var Misc
     */
    private $miscStats;

    public function handleParameters()
    {
        $salesData = $this->salesStats->getData();
        $orderToProcess = $this->orderToProcessStats->getData();
        $miscStats = $this->miscStats->getData();

        $this->templateParameters = [
            'salesAmountData'     => $salesData,
            'lastOrdersToProcess' => $orderToProcess,
            'miscStats'           => $miscStats,
        ];
    }

    /**
     * @param Sales $salesStats
     */
    public function setSalesStats(Sales $salesStats): void
    {
        $this->salesStats = $salesStats;
    }

    /**
     * @param OrdersToProcess $orderToProcessStats
     */
    public function setOrderToProcessStats(OrdersToProcess $orderToProcessStats): void
    {
        $this->orderToProcessStats = $orderToProcessStats;
    }

    /**
     * @param Misc $miscStats
     */
    public function setMiscStats(Misc $miscStats): void
    {
        $this->miscStats = $miscStats;
    }
}
