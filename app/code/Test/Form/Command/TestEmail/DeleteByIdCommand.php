<?php

namespace Test\Form\Command\TestEmail;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Test\Form\Api\Data\TestEmailInterface;
use Test\Form\Model\ResourceModel\TestEmailResource;
use Test\Form\Model\TestEmailModel;
use Test\Form\Model\TestEmailModelFactory;

/**
 * Delete TestEmail by id Command.
 */
class DeleteByIdCommand
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
     * Delete TestEmail.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void
    {
        try {
            /** @var TestEmailModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, TestEmailInterface::ENTITY_ID);

            if (!$model->getData(TestEmailInterface::ENTITY_ID)) {
                throw new NoSuchEntityException(
                    __('Could not find TestEmail with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete TestEmail. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete TestEmail.'));
        }
    }
}
