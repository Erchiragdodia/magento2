<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Controller\Router\Route;

use Magento\Framework\App\RouterInterface;
use Magento\Framework\ObjectManagerInterface as ObjectManager;

/**
 * Class \Magento\Framework\Controller\Router\Route\Factory
 *
 * @since 2.0.0
 */
class Factory
{
    /**
     * @var ObjectManager
     * @since 2.0.0
     */
    protected $objectManager;

    /**
     * @param ObjectManager $objectManager
     * @since 2.0.0
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Create route instance.
     *
     * @param string $routeClass
     * @param string $route Map used to match with later submitted URL path
     * @return RouterInterface
     * @throws \LogicException If specified route class does not implement proper interface.
     * @since 2.0.0
     */
    public function createRoute($routeClass, $route)
    {
        $route = $this->objectManager->create($routeClass, ['route' => $route]);
        if (!$route instanceof RouterInterface) {
            throw new \LogicException('Route must implement "Magento\Framework\App\RouterInterface".');
        }
        return $route;
    }
}
