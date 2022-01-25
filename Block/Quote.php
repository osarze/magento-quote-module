<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/8/2019
 * Time: 5:02 AM
 */

namespace Osarz\Quote\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
class Quote extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getFormAction(){
        return '/quote/quote/save';
    }

    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Request Quote'));
        return parent::_prepareLayout();
    }
}
