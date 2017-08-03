<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Ui\Component\Wrapper;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\View\Element\UiComponent\ContainerInterface;
use Magento\Framework\View\Element\Template\Context as TemplateContext;

/**
 * Class UiComponent
 *
 * Encapsulate UI Component to represent it as standard Layout Block
 * @since 2.0.0
 */
class UiComponent extends Template implements ContainerInterface
{
    /**
     * Ui component
     *
     * @var UiComponentInterface
     * @since 2.0.0
     */
    protected $component;

    /**
     * @var BlockFactory
     * @since 2.0.0
     */
    protected $blockWrapperFactory;

    /**
     * Constructor
     *
     * @param TemplateContext $context
     * @param UiComponentInterface $component
     * @param BlockFactory $blockWrapperFactory
     * @param array $data
     * @since 2.0.0
     */
    public function __construct(
        TemplateContext $context,
        UiComponentInterface $component,
        BlockFactory $blockWrapperFactory,
        array $data = []
    ) {
        $this->component = $component;
        $this->blockWrapperFactory = $blockWrapperFactory;
        $this->setNameInLayout($this->component->getName());
        parent::__construct($context, $data);
    }

    /**
     * Render block HTML
     *
     * @return string
     * @since 2.0.0
     */
    protected function _toHtml()
    {
        foreach ($this->getChildNames() as $childName) {
            $childBlock = $this->getLayout()->getBlock($childName);
            if ($childBlock) {
                $wrapper = $this->blockWrapperFactory->create([
                    'block' => $childBlock,
                    'data' => [
                        'name' => 'block_' . $childName
                    ]
                ]);
                $this->component->addComponent('block_' . $childName, $wrapper);
            }
        }

        $result = $this->component->render();
        return (string)$result;
    }
}
