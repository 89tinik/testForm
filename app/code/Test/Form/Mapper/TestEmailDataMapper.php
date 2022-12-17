<?php

namespace Test\Form\Mapper;

use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Test\Form\Api\Data\TestEmailInterface;
use Test\Form\Api\Data\TestEmailInterfaceFactory;
use Test\Form\Model\TestEmailModel;

/**
 * Converts a collection of TestEmail entities to an array of data transfer objects.
 */
class TestEmailDataMapper
{
    /**
     * @var TestEmailInterfaceFactory
     */
    private $entityDtoFactory;

    /**
     * @param TestEmailInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        TestEmailInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|TestEmailInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var TestEmailModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var TestEmailInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
