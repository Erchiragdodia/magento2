<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Analytics\Controller\Adminhtml\Subscription;

use Magento\Analytics\Model\NotificationTime;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Intl\DateTimeFactory;
use Psr\Log\LoggerInterface;

/**
 * Postpones notification about subscription to Magento BI Advanced Reporting.
 * @since 2.2.0
 */
class Postpone extends Action
{
    /**
     * @var DateTimeFactory
     * @since 2.2.0
     */
    private $dateTimeFactory;

    /**
     * @var NotificationTime
     * @since 2.2.0
     */
    private $notificationTime;

    /**
     * @var LoggerInterface
     * @since 2.2.0
     */
    private $logger;

    /**
     * @param Context $context
     * @param DateTimeFactory $dateTimeFactory
     * @param NotificationTime $notificationTime
     * @param LoggerInterface $logger
     * @since 2.2.0
     */
    public function __construct(
        Context $context,
        DateTimeFactory $dateTimeFactory,
        NotificationTime $notificationTime,
        LoggerInterface $logger
    ) {
        $this->dateTimeFactory = $dateTimeFactory;
        $this->notificationTime = $notificationTime;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Check admin permissions for this controller
     *
     * @return boolean
     * @since 2.2.0
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Analytics::analytics_settings');
    }

    /**
     * Postpones notification about subscription
     *
     * @return Json
     * @since 2.2.0
     */
    public function execute()
    {
        try {
            $dateTime = $this->dateTimeFactory->create();
            $responseContent = [
                'success' => $this->notificationTime->storeLastTimeNotification($dateTime->getTimestamp()),
                'error_message' => ''
            ];
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
            $responseContent = [
                'success' => false,
                'error_message' => $e->getMessage()
            ];
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $responseContent = [
                'success' => false,
                'error_message' => __('Error occurred during postponement notification')
            ];
        }
        /** @var Json $resultJson */
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $resultJson->setData($responseContent);
    }
}
