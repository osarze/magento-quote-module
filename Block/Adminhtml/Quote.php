<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/9/2019
 * Time: 6:05 AM
 */

namespace Osarz\Quote\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Quote extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml';
        $this->_blockGroup = 'Osarz_Quote';
        $this->_headerText = __('Quote Request');
        parent::_construct();
        $this->removeButton('add');
    }
}
