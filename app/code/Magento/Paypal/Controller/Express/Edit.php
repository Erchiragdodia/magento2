<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Paypal\Controller\Express;

/**
 * Class \Magento\Paypal\Controller\Express\Edit
 *
 * @since 2.0.0
 */
class Edit extends \Magento\Paypal\Controller\Express\AbstractExpress\Edit
{
    /**
     * Config mode type
     *
     * @var string
     * @since 2.0.0
     */
    protected $_configType = \Magento\Paypal\Model\Config::class;

    /**
     * Config method type
     *
     * @var string
     * @since 2.0.0
     */
    protected $_configMethod = \Magento\Paypal\Model\Config::METHOD_WPP_EXPRESS;

    /**
     * Checkout mode type
     *
     * @var string
     * @since 2.0.0
     */
    protected $_checkoutType = \Magento\Paypal\Model\Express\Checkout::class;
}
