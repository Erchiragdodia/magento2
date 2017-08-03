<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Sales\Model\Order\Creditmemo;

use Magento\Sales\Api\Data\CreditmemoInterface;
use Magento\Sales\Exception\DocumentValidationException;
use Magento\Sales\Model\ValidatorInterface;
use Magento\Sales\Model\ValidatorResultInterface;

/**
 * Interface CreditmemoValidatorInterface
 * @since 2.2.0
 */
interface CreditmemoValidatorInterface
{
    /**
     * @param CreditmemoInterface $entity
     * @param ValidatorInterface[] $validators
     * @return ValidatorResultInterface
     * @throws DocumentValidationException
     * @since 2.2.0
     */
    public function validate(CreditmemoInterface $entity, array $validators);
}
