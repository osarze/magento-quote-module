<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/9/2019
 * Time: 9:25 PM
 */

namespace Osarz\Quote\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Quote extends Action
{
    protected $resultPageFactory;
    protected $resultForwardFactory;
    protected $resultRedirectFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();

        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Osarz_Quote::quote_manage');
    }

    protected function _initAction(){
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Osarz_Quote::quote_manage'
        )->_addBreadcrumb(
            __('Osarz'),
            __('Quote Request')
        );
        return $this;
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
        // TODO: Implement execute() method.
    }
}
