<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Catalog\Model\Category\Attribute\Source;

/**
 * Catalog Category *_sort_by Attributes Source Model
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 * @since 2.0.0
 */
class Sortby extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Catalog config
     *
     * @var \Magento\Catalog\Model\Config
     * @since 2.0.0
     */
    protected $_catalogConfig;

    /**
     * Construct
     *
     * @param \Magento\Catalog\Model\Config $catalogConfig
     * @since 2.0.0
     */
    public function __construct(\Magento\Catalog\Model\Config $catalogConfig)
    {
        $this->_catalogConfig = $catalogConfig;
    }

    /**
     * Retrieve Catalog Config Singleton
     *
     * @return \Magento\Catalog\Model\Config
     * @since 2.0.0
     */
    protected function _getCatalogConfig()
    {
        return $this->_catalogConfig;
    }

    /**
     * {@inheritdoc}
     * @since 2.0.0
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [['label' => __('Position'), 'value' => 'position']];
            foreach ($this->_getCatalogConfig()->getAttributesUsedForSortBy() as $attribute) {
                $this->_options[] = [
                    'label' => __($attribute['frontend_label']),
                    'value' => $attribute['attribute_code'],
                ];
            }
        }
        return $this->_options;
    }
}
