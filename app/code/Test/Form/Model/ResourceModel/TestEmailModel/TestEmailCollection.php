<?php

namespace Test\Form\Model\ResourceModel\TestEmailModel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Test\Form\Model\ResourceModel\TestEmailResource;
use Test\Form\Model\TestEmailModel;

class TestEmailCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'test_email_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(TestEmailModel::class, TestEmailResource::class);
    }
}
