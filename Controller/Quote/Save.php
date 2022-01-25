<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/8/2019
 * Time: 5:08 AM
 */

namespace Osarz\Quote\Controller\Quote;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Osarz\Quote\Model\QuoteFactory;

class Save extends Action
{
    protected $transportBuilder;
    protected $inlineTranslation;
    protected $scopeConfig;
    protected $storeManager;
    protected $formKeyValidator;
    protected $dateTime;
    protected $quoteFactory;

    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        Validator $formKeyValidator,
        DateTime $dateTime,
        QuoteFactory $quoteFactory
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->formKeyValidator = $formKeyValidator;
        $this->dateTime = $dateTime;
        $this->quoteFactory = $quoteFactory;
        $this->messageManager = $context->getMessageManager();


        parent::__construct($context);
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
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addError(__('Invalid form key'));
            return $resultRedirect->setRefererUrl();
        }




        $firstName = $this->getRequest()->getParam('first_name');
        $lastName = $this->getRequest()->getParam('last_name');
        $phoneNumber = $this->getRequest()->getParam('phone_number');
        $email = $this->getRequest()->getParam('email');
        $comment = $this->getRequest()->getParam('comment');

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

        try {
            /* Save ticket */
            $quote = $this->quoteFactory->create();
            $quote->setFirstName($firstName);
            $quote->setLastName($lastName);
            $quote->setPhoneNumber($phoneNumber);
            $quote->setEmail($email);
            $quote->setComment($comment);

            $quote->setCreatedAt($this->dateTime->formatDate(true));
            $quote->save();
            /* Send email to store owner */
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->transportBuilder
                ->setTemplateIdentifier($this->scopeConfig->getValue('osarz_quote/email_template/store_owner', $storeScope))
                ->setTemplateOptions([
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $this->storeManager-> getStore()->getId(),
                ])
                ->setTemplateVars(['quote' => $quote])
                ->setFrom([
                    'name' => $firstName . ' ' . $lastName,
                    'email' => $email
                ])
                ->addTo($this->scopeConfig->getValue(
                'trans_email/ident_general/email', $storeScope))
                ->getTransport();

            $transport->sendMessage();
            $this->inlineTranslation->resume();
            $this->messageManager->addSuccess(__('Quote Request successfully submitted.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__('Error occurred during quote creation.'));
        }
        return $resultRedirect->setRefererUrl();
    }
}
