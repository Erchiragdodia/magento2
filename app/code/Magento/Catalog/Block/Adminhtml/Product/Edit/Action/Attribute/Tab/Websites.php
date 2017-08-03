<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Product mass attribute update websites tab
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magento\Catalog\Block\Adminhtml\Product\Edit\Action\Attribute\Tab;

use Magento\Store\Model\Group;
use Magento\Store\Model\Website;

/**
 * @api
 * @since 2.0.0
 */
class Websites extends \Magento\Backend\Block\Widget implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @return Website[]
     * @since 2.0.0
     */
    public function getWebsiteCollection()
    {
        return $this->_storeManager->getWebsites();
    }

    /**
     * @param Website $website
     * @return Group[]
     * @since 2.0.0
     */
    public function getGroupCollection(Website $website)
    {
        return $website->getGroups();
    }

    /**
     * @param Group $group
     * @return array
     * @since 2.0.0
     */
    public function getStoreCollection(Group $group)
    {
        return $group->getStores();
    }

    /**
     * Tab settings
     *
     * @return \Magento\Framework\Phrase
     * @since 2.0.0
     */
    public function getTabLabel()
    {
        return __('Websites');
    }

    /**
     * @return \Magento\Framework\Phrase
     * @since 2.0.0
     */
    public function getTabTitle()
    {
        return __('Websites');
    }

    /**
     * @return bool
     * @since 2.0.0
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     * @since 2.0.0
     */
    public function isHidden()
    {
        return false;
    }
}
