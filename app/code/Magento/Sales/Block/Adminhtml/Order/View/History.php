<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Sales\Block\Adminhtml\Order\View;

/**
 * Order history block
 *
 * @api
 * @since 2.0.0
 */
class History extends \Magento\Backend\Block\Template
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     * @since 2.0.0
     */
    protected $_coreRegistry = null;

    /**
     * Sales data
     *
     * @var \Magento\Sales\Helper\Data
     * @since 2.0.0
     */
    protected $_salesData = null;

    /**
     * @var \Magento\Sales\Helper\Admin
     * @since 2.0.0
     */
    private $adminHelper;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Sales\Helper\Data $salesData
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param array $data
     * @since 2.0.0
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Sales\Helper\Data $salesData,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_salesData = $salesData;
        parent::__construct($context, $data);
        $this->adminHelper = $adminHelper;
    }

    /**
     * Preparing global layout
     *
     * @return $this
     * @since 2.0.0
     */
    protected function _prepareLayout()
    {
        $onclick = "submitAndReloadArea($('order_history_block').parentNode, '" . $this->getSubmitUrl() . "')";
        $button = $this->getLayout()->createBlock(
            \Magento\Backend\Block\Widget\Button::class
        )->setData(
            ['label' => __('Submit Comment'), 'class' => 'action-save action-secondary', 'onclick' => $onclick]
        );
        $this->setChild('submit_button', $button);
        return parent::_prepareLayout();
    }

    /**
     * Get stat uses
     *
     * @return array
     * @since 2.0.0
     */
    public function getStatuses()
    {
        $state = $this->getOrder()->getState();
        $statuses = $this->getOrder()->getConfig()->getStateStatuses($state);
        return $statuses;
    }

    /**
     * Check allow to send order comment email
     *
     * @return bool
     * @since 2.0.0
     */
    public function canSendCommentEmail()
    {
        return $this->_salesData->canSendOrderCommentEmail($this->getOrder()->getStore()->getId());
    }

    /**
     * Retrieve order model
     *
     * @return \Magento\Sales\Model\Order
     * @since 2.0.0
     */
    public function getOrder()
    {
        return $this->_coreRegistry->registry('sales_order');
    }

    /**
     * Check allow to add comment
     *
     * @return bool
     * @since 2.0.0
     */
    public function canAddComment()
    {
        return $this->_authorization->isAllowed('Magento_Sales::comment') && $this->getOrder()->canComment();
    }

    /**
     * Submit URL getter
     *
     * @return string
     * @since 2.0.0
     */
    public function getSubmitUrl()
    {
        return $this->getUrl('sales/*/addComment', ['order_id' => $this->getOrder()->getId()]);
    }

    /**
     * Customer Notification Applicable check method
     *
     * @param  \Magento\Sales\Model\Order\Status\History $history
     * @return bool
     * @since 2.0.0
     */
    public function isCustomerNotificationNotApplicable(\Magento\Sales\Model\Order\Status\History $history)
    {
        return $history->isCustomerNotificationNotApplicable();
    }

    /**
     * Replace links in string
     *
     * @param array|string $data
     * @param null|array $allowedTags
     * @return string
     * @since 2.0.0
     */
    public function escapeHtml($data, $allowedTags = null)
    {
        return $this->adminHelper->escapeHtmlWithLinks($data, $allowedTags);
    }
}
