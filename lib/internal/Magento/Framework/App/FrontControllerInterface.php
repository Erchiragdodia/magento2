<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\App;

/**
 * Application front controller responsible for dispatching application requests.
 * Front controller contains logic common for all actions.
 * Evary application area has own front controller
 *
 * @api
 * @since 2.0.0
 */
interface FrontControllerInterface
{
    /**
     * Dispatch application action
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @since 2.0.0
     */
    public function dispatch(RequestInterface $request);
}
