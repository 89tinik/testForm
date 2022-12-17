<?php

namespace Test\Form\Model;

use Magento\Framework\Message\Manager;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;

class EmailSender extends AbstractHelper
{
    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Manager
     */
    protected $messageManager;

    /**
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param Manager $messageManager
     */
    public function __construct(
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        Manager $messageManager
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->messageManager = $messageManager;
    }

    public function send($email)
    {
        try {
            $sender = [
                'name' => 'From site',
                'email' => 'no-reply@magento.loc',
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('write_me')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $this->storeManager->getStore()->getId(),
                    ]
                )
                ->setTemplateVars([
                    'email'  => $email,
                ])
                ->setFromByScope($sender)
                ->addTo('6789.tinik@gmail.com')
                ->getTransport();
            $transport->sendMessage();
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage())->render());
        }
    }
}
