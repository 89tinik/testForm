<?php

namespace Test\Form\ViewModel;

use Magento\Framework\Url;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Form extends Template implements ArgumentInterface
{
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @param Url $urlBuilder
     */
    public function __construct( Url $urlBuilder) {
        $this->_urlBuilder = $urlBuilder;
    }

    public function getFormAction()
    {
        return $this->_urlBuilder->getUrl('testform/index/send', ['_secure' => true]);
    }
}
