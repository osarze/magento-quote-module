<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/9/2019
 * Time: 9:38 PM
 */

namespace Osarz\Quote\Controller\Adminhtml\Quote;


use Magento\Framework\App\ResponseInterface;
use Osarz\Quote\Controller\Adminhtml\Quote;

class Index extends Quote
{

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
        if ($this->getRequest()->getQuery('ajax')) {
            $resultForward = $this->resultForwardFactory-> create();
            $resultForward->forward('grid');
            return $resultForward;
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage-> setActiveMenu('Osarz_Quote::quote_manage');
        $resultPage->getConfig()->getTitle()-> prepend(__('Quote'));
        $resultPage->addBreadcrumb(__('Quote'), __('Quote'));
        $resultPage->addBreadcrumb(__('Manage Quote'), __('Manage Quotes'));
        return $resultPage;
    }
}
