<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Multishipping\Controller\Checkout;

/**
 * Class \Magento\Multishipping\Controller\Checkout\Login
 *
 * @since 2.0.0
 */
class Login extends \Magento\Multishipping\Controller\Checkout
{
    /**
     * Multishipping checkout login page
     *
     * @return void
     * @since 2.0.0
     */
    public function execute()
    {
        if ($this->_objectManager->get(\Magento\Customer\Model\Session::class)->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }

        $this->_view->loadLayout();

        // set account create url
        $loginForm = $this->_view->getLayout()->getBlock('customer.new');
        if ($loginForm) {
            $loginForm->setCreateAccountUrl($this->_getHelper()->getMSRegisterUrl());
        }
        $this->_view->renderLayout();
    }
}
