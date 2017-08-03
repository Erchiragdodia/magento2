<?php
/**
 * Google Optimizer Data Helper
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace Magento\GoogleOptimizer\Helper;

use \Magento\Store\Model\ScopeInterface;

/**
 * @api
 * @since 2.0.0
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Xml path google experiments enabled
     */
    const XML_PATH_ENABLED = 'google/analytics/experiments';

    /**
     * @var bool
     * @since 2.0.0
     */
    protected $_activeForCmsFlag;

    /**
     * @var \Magento\GoogleAnalytics\Helper\Data
     * @since 2.0.0
     */
    protected $_analyticsHelper;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\GoogleAnalytics\Helper\Data $analyticsHelper
     * @since 2.0.0
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\GoogleAnalytics\Helper\Data $analyticsHelper
    ) {
        $this->_analyticsHelper = $analyticsHelper;
        parent::__construct($context);
    }

    /**
     * Checks if Google Experiment is enabled
     *
     * @param string $store
     * @return bool
     * @since 2.0.0
     */
    public function isGoogleExperimentEnabled($store = null)
    {
        return (bool)$this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * Checks if Google Experiment is active
     *
     * @param string $store
     * @return bool
     * @since 2.0.0
     */
    public function isGoogleExperimentActive($store = null)
    {
        return $this->isGoogleExperimentEnabled($store) && $this->_analyticsHelper->isGoogleAnalyticsAvailable($store);
    }
}
