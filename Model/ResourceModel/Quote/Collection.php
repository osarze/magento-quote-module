<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/11/2019
 * Time: 10:57 PM
 */

namespace Osarz\Quote\Model\ResourceModel\Quote;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Osarz\Quote\Model\Quote', 'Osarz\Quote\Model\ResourceModel\Quote');
    }
}
