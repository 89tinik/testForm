<?php

namespace Test\Form\Controller\Adminhtml\TestEmail;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * TestEmail backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    public const ADMIN_RESOURCE = 'Test_Form::management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Test_Form::management');
        $resultPage->addBreadcrumb(__('TestEmail'), __('TestEmail'));
        $resultPage->addBreadcrumb(__('Manage TestEmails'), __('Manage TestEmails'));
        $resultPage->getConfig()->getTitle()->prepend(__('TestEmail List'));

        return $resultPage;
    }
}
