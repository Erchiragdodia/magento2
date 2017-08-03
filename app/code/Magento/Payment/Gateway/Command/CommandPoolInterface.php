<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Payment\Gateway\Command;

use Magento\Framework\Exception\NotFoundException;
use Magento\Payment\Gateway\CommandInterface;

/**
 * Interface CommandPoolInterface
 * @package Magento\Payment\Gateway\Command
 * @api
 * @since 2.0.0
 */
interface CommandPoolInterface
{
    /**
     * Retrieves operation
     *
     * @param string $commandCode
     * @return CommandInterface
     * @throws NotFoundException
     * @since 2.0.0
     */
    public function get($commandCode);
}
