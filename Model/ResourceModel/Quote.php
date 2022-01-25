<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/11/2019
 * Time: 10:53 PM
 */

namespace Osarz\Quote\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Quote extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('me3energy_quotes', 'id');
    }
}
