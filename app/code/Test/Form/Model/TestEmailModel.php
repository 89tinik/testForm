<?php

namespace Test\Form\Model;

use Magento\Framework\Model\AbstractModel;
use Test\Form\Model\ResourceModel\TestEmailResource;

class TestEmailModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'test_email_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TestEmailResource::class);
    }
}
