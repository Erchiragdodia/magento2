<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Search\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class \Magento\Search\Controller\Adminhtml\Term
 *
 * @since 2.0.0
 */
abstract class Term extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Search::search';

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     * @since 2.0.0
     */
    protected function createPage()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Magento_Search::search_terms')
            ->addBreadcrumb(__('Search'), __('Search'));
        return $resultPage;
    }
}
