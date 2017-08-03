<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Backend\Model\View\Result;

use Magento\Framework\ObjectManagerInterface;

/**
 * Factory class for \Magento\Backend\Model\View\Result\Redirect
 * @api
 * @since 2.0.0
 */
class RedirectFactory extends \Magento\Framework\Controller\Result\RedirectFactory
{
    /**
     * Object Manager instance
     *
     * @var ObjectManagerInterface
     * @since 2.0.0
     */
    protected $objectManager;

    /**
     * Instance name to create
     *
     * @var string
     * @since 2.0.0
     */
    protected $instanceName;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @since 2.0.0
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $instanceName = \Magento\Backend\Model\View\Result\Redirect::class
    ) {
        $this->objectManager = $objectManager;
        $this->instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @since 2.0.0
     */
    public function create(array $data = [])
    {
        return $this->objectManager->create($this->instanceName, $data);
    }
}
