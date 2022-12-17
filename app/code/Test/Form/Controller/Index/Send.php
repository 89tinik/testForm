<?php

namespace Test\Form\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\HTTP\PhpEnvironment\Request;
use Magento\Framework\Message\Manager;
use Test\Form\Model\EmailSender;

class Send extends Action implements HttpPostActionInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var EmailSender
     */
    protected $emailSender;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var Manager
     */
    protected $messageManager;

    /**
     * @param Request $request
     * @param EmailSender $emailSender
     * @param ResultFactory $resultFactory
     * @param Manager $messageManager
     * @param Context $context
     */
    public function __construct(
        Request     $request,
        EmailSender $emailSender,
        ResultFactory $resultFactory,
        Manager $messageManager,
        Context     $context)
    {
        parent::__construct($context);
        $this->request = $request;
        $this->emailSender = $emailSender;
        $this->resultFactory = $resultFactory;
        $this->messageManager = $messageManager;
    }

    public function execute()
    {
        if (!empty($post = $this->request->getPostValue())) {
            try {
                $this->emailSender->send($post['email']);
                $this->messageManager->addSuccessMessage(__('Thank!')->render());
            } catch (\Throwable $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage())->render());
            }
        } else {
            $message = __('Incorrect email');
            $this->messageManager->addErrorMessage($message->render());
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
