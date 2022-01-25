<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/11/2019
 * Time: 10:47 PM
 */

namespace Osarz\Quote\Model;


use Magento\Framework\Model\AbstractModel;

class Quote extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Osarz\Quote\Model\ResourceModel\Quote');
    }
}
