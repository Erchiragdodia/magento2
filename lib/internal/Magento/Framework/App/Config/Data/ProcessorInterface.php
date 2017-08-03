<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\App\Config\Data;

/**
 * Processes data from admin store configuration fields
 *
 * @api
 * @since 2.0.0
 */
interface ProcessorInterface
{
    /**
     * Process config value
     *
     * @param string $value Raw value of the configuration field
     * @return string Processed value
     * @since 2.0.0
     */
    public function processValue($value);
}
