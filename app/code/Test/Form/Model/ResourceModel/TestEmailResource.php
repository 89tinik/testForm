<?php

namespace Test\Form\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Test\Form\Api\Data\TestEmailInterface;

class TestEmailResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'test_email_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('test_email', TestEmailInterface::ENTITY_ID);
        $this->_useIsObjectNew = true;
    }
}
