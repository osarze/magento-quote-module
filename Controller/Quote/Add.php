<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/8/2019
 * Time: 3:55 AM
 */

namespace Osarz\Quote\Controller\Quote;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;

class Add extends Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $resultPageFactory = $this->resultPageFactory->create();
        // Add page title
        $resultPageFactory->getConfig()->getTitle()->set(__('Request Quote'));

        // Add breadcrumb
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
       $breadcrumbs = $resultPageFactory->getLayout()->getBlock('breadcrumbs');
       $breadcrumbs->addCrumb('home',
           [
               'label' => __('Home'),
               'title' => __('Quote'),
               'link' => $this->_url->getUrl('')
           ]
       );
       $breadcrumbs->addCrumb('tutorial_example',
           [
               'label' => __('Request Quote'),
               'title' => __('Request Quote')
           ]
       );
        return $this->resultPageFactory->create();
    }
}
