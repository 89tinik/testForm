<?php

namespace Test\Form\Command\TestEmail;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Test\Form\Api\Data\TestEmailInterface;
use Test\Form\Model\ResourceModel\TestEmailResource;
use Test\Form\Model\TestEmailModel;
use Test\Form\Model\TestEmailModelFactory;

/**
 * Save TestEmail Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var TestEmailModelFactory
     */
    private $modelFactory;

    /**
     * @var TestEmailResource
     */
    private $resource;

    /**
     * @param LoggerInterface $logger
     * @param TestEmailModelFactory $modelFactory
     * @param TestEmailResource $resource
     */
    public function __construct(
        LoggerInterface       $logger,
        TestEmailModelFactory $modelFactory,
        TestEmailResource     $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save TestEmail.
     *
     * @param TestEmailInterface $testEmail
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(TestEmailInterface $testEmail): int
    {
        try {
            /** @var TestEmailModel $model */
            $model = $this->modelFactory->create();
            $model->addData($testEmail->getData());
            $model->setHasDataChanges(true);

            if (!$model->getData(TestEmailInterface::ENTITY_ID)) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save TestEmail. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save TestEmail.'));
        }

        return (int)$model->getData(TestEmailInterface::ENTITY_ID);
    }
}
