<?php

namespace Test\Form\Controller\Adminhtml\TestEmail;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\CouldNotSaveException;
use Test\Form\Api\Data\TestEmailInterface;
use Test\Form\Api\Data\TestEmailInterfaceFactory;
use Test\Form\Command\TestEmail\SaveCommand;

/**
 * Save TestEmail controller action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Test_Form::management';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var SaveCommand
     */
    private $saveCommand;

    /**
     * @var TestEmailInterfaceFactory
     */
    private $entityDataFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveCommand $saveCommand
     * @param TestEmailInterfaceFactory $entityDataFactory
     */
    public function __construct(
        Context                   $context,
        DataPersistorInterface    $dataPersistor,
        SaveCommand               $saveCommand,
        TestEmailInterfaceFactory $entityDataFactory
    )
    {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->saveCommand = $saveCommand;
        $this->entityDataFactory = $entityDataFactory;
    }

    /**
     * Save TestEmail Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getParams();

        try {
            /** @var TestEmailInterface|DataObject $entityModel */
            $entityModel = $this->entityDataFactory->create();
            $entityModel->addData($params['general']);
            $this->saveCommand->execute($entityModel);
            $this->messageManager->addSuccessMessage(
                __('The TestEmail data was saved successfully')
            );
            $this->dataPersistor->clear('entity');
        } catch (CouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->dataPersistor->set('entity', $params);

            return $resultRedirect->setPath('*/*/edit', [
                TestEmailInterface::ENTITY_ID => $this->getRequest()->getParam(TestEmailInterface::ENTITY_ID)
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
