<?php

namespace Test\Form\Block\Form\TestEmail;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Test\Form\Api\Data\TestEmailInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return $this->wrapButtonSettings(
            'Delete',
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this testemail?'),
                $this->getUrl(
                    '*/*/delete',
                    [TestEmailInterface::ENTITY_ID => $this->getEntityId()]
                )
            ),
            [],
            20
        );
    }
}
