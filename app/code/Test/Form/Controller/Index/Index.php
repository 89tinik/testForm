<?php

namespace Test\Form\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action implements HttpGetActionInterface
{
//    /**
//     * @var ResultFactory
//     */
//    protected $resultFactory;
//
//    /**
//     * @param ResultFactory $resultFactory
//     */
//    public function __construct(
//        ResultFactory $resultFactory
//    ) {
//        $this->resultFactory = $resultFactory;
//    }
    public function execute()
    {
       return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
