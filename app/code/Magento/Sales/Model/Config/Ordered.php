<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Sales\Model\Config;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Serialize\SerializerInterface;

/**
 * Configuration class for ordered items
 * @api
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 * @since 2.0.0
 */
abstract class Ordered extends \Magento\Framework\App\Config\Base
{
    /**
     * Cache key for collectors
     *
     * @var string|null
     * @since 2.0.0
     */
    protected $_collectorsCacheKey = null;

    /**
     * Configuration group where to collect registered totals
     *
     * @var string
     * @since 2.0.0
     */
    protected $_configGroup;

    /**
     * Configuration section where to collect registered totals
     *
     * @var string
     * @since 2.0.0
     */
    protected $_configSection;

    /**
     * Prepared models
     *
     * @var array
     * @since 2.0.0
     */
    protected $_models = [];

    /**
     * Models configuration
     *
     * @var array
     * @since 2.0.0
     */
    protected $_modelsConfig = [];

    /**
     * Sorted models
     *
     * @var array
     * @since 2.0.0
     */
    protected $_collectors = [];

    /**
     * @var \Magento\Framework\App\Cache\Type\Config
     * @since 2.0.0
     */
    protected $_configCacheType;

    /**
     * @var \Psr\Log\LoggerInterface
     * @since 2.0.0
     */
    protected $_logger;

    /**
     * @var \Magento\Sales\Model\Config
     * @since 2.0.0
     */
    protected $_salesConfig;

    /**
     * @var SerializerInterface
     * @since 2.2.0
     */
    private $serializer;

    /**
     * @param \Magento\Framework\App\Cache\Type\Config $configCacheType
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Sales\Model\Config $salesConfig
     * @param \Magento\Framework\Simplexml\Element $sourceData
     * @param SerializerInterface $serializer
     * @since 2.0.0
     */
    public function __construct(
        \Magento\Framework\App\Cache\Type\Config $configCacheType,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Sales\Model\Config $salesConfig,
        $sourceData = null,
        SerializerInterface $serializer = null
    ) {
        parent::__construct($sourceData);
        $this->_configCacheType = $configCacheType;
        $this->_logger = $logger;
        $this->_salesConfig = $salesConfig;
        $this->serializer = $serializer ?: ObjectManager::getInstance()->get(SerializerInterface::class);
    }

    /**
     * Initialize total models configuration and objects
     *
     * @return $this
     * @since 2.0.0
     */
    protected function _initModels()
    {
        $totals = $this->_salesConfig->getGroupTotals($this->_configSection, $this->_configGroup);
        foreach ($totals as $totalCode => $totalConfig) {
            $class = $totalConfig['instance'];
            if (!empty($class)) {
                $this->_models[$totalCode] = $this->_initModelInstance($class, $totalCode, $totalConfig);
            }
        }
        return $this;
    }

    /**
     * Init model class by configuration
     *
     * @param string $class
     * @param string $totalCode
     * @param array $totalConfig
     * @return mixed
     * @abstract
     * @since 2.0.0
     */
    abstract protected function _initModelInstance($class, $totalCode, $totalConfig);

    /**
     * Prepare configuration array for total model
     *
     * @param   string $code
     * @param   \Magento\Framework\App\Config\Element $totalConfig
     * @return  array
     * @since 2.0.0
     */
    protected function _prepareConfigArray($code, $totalConfig)
    {
        $totalConfig = (array)$totalConfig;
        $totalConfig['_code'] = $code;
        return $totalConfig;
    }

    /**
     * Aggregate before/after information from all items and sort totals based on this data
     * Invoke simple sorting if the first element contains the "sort_order" key
     *
     * @param array $config
     * @return array
     * @since 2.0.0
     */
    private function _getSortedCollectorCodes(array $config)
    {
        reset($config);
        $element = current($config);
        if (isset($element['sort_order'])) {
            uasort(
                $config,
                // @codingStandardsIgnoreStart
                /**
                 * @param array $a
                 * @param array $b
                 * @return int
                 */
                // @codingStandardsIgnoreEnd
                function ($a, $b) {
                    if (!isset($a['sort_order']) || !isset($b['sort_order'])) {
                        return 0;
                    }
                    if ($a['sort_order'] > $b['sort_order']) {
                        return 1;
                    } elseif ($a['sort_order'] < $b['sort_order']) {
                        return -1;
                    } else {
                        return 0;
                    }
                }
            );
        }
        $result = array_keys($config);
        return $result;
    }

    /**
     * Initialize collectors array.
     * Collectors array is array of total models ordered based on configuration settings
     *
     * @return $this
     * @since 2.0.0
     */
    protected function _initCollectors()
    {
        $sortedCodes = [];
        $cachedData = $this->_configCacheType->load($this->_collectorsCacheKey);
        if ($cachedData) {
            $sortedCodes = $this->serializer->unserialize($cachedData);
        }
        if (!$sortedCodes) {
            $sortedCodes = $this->_getSortedCollectorCodes($this->_modelsConfig);
            $this->_configCacheType->save($this->serializer->serialize($sortedCodes), $this->_collectorsCacheKey);
        }
        foreach ($sortedCodes as $code) {
            $this->_collectors[$code] = $this->_models[$code];
        }

        return $this;
    }
}
