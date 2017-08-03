<?php
/**
 * Forward action class
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\App\Action;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

/**
 * Class \Magento\Framework\App\Action\Forward
 *
 * @since 2.0.0
 */
class Forward extends AbstractAction
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @since 2.0.0
     */
    public function dispatch(RequestInterface $request)
    {
        return $this->execute();
    }

    /**
     * @inheritdoc
     * @since 2.0.0
     */
    public function execute()
    {
        $this->_request->setDispatched(false);
        return $this->_response;
    }
}
