<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;

/**
 * Class PayerInfo
 *
 * A resource representing a information about Payer.
 *
 * @package PayPal\Api
 *
 * @property string email
 * @property string external_remember_me_id
 * @property string buyer_account_number
 * @property string salutation
 * @property string first_name
 * @property string middle_name
 * @property string last_name
 * @property string suffix
 * @property string payer_id
 * @property string phone
 * @property string phone_type
 * @property string birth_date
 * @property string tax_id
 * @property string tax_id_type
 * @property string country_code
 * @property \PayPal\Api\Address billing_address
 */
class PayerInfo extends PayPalModel
{
    private string $email;

    private string $externalRememberMeId;

    private string $buyerAccountNumber;

    private string $salutation;

    private string $firstName;

    private string $middleName;

    private string $lastName;

    private string $suffix;

    private string $payerId;

    private string $phone;

    private string $phoneType;

    private string $birthDate;

    private string $taxId;

    private string $taxIdType;

    private string $countryCode;

    private Address $billingAddress;

    /**
     * Email address representing the payer. 127 characters max.
     *
     * @param string $email
     * 
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Email address representing the payer. 127 characters max.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * External Remember Me id representing the payer
     *
     * @param string $externalRememberMeId
     * 
     * @return $this
     */
    public function setExternalRememberMeId($externalRememberMeId)
    {
        $this->externalRememberMeId = $externalRememberMeId;
        return $this;
    }

    /**
     * External Remember Me id representing the payer
     *
     * @return string
     */
    public function getExternalRememberMeId()
    {
        return $this->externalRememberMeId;
    }

    /**
     * Account Number representing the Payer
     *
     * @deprecated Use #setBuyerAccountNumberInstead
     * @param string $account_number
     *
     * @return $this
     */
    public function setAccountNumber($account_number)
    {
        $this->account_number = $account_number;
        return $this;
    }

    /**
     * Account Number representing the Payer
     *
     * @deprecated Use #getBuyerAccountNumberInstead
     *
     * @deprecated Not publicly available
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->account_number;
    }

    /**
     * Account Number representing the Payer
     *
     * @param string $buyerAccountNumber
     * 
     * @return $this
     */
    public function setBuyerAccountNumber($buyerAccountNumber)
    {
        $this->buyerAccountNumber = $buyerAccountNumber;
        return $this;
    }

    /**
     * Account Number representing the Payer
     *
     * @return string
     */
    public function getBuyerAccountNumber()
    {
        return $this->buyerAccountNumber;
    }

    /**
     * Salutation of the payer.
     *
     * @param string $salutation
     * 
     * @return $this
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
        return $this;
    }

    /**
     * Salutation of the payer.
     *
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * First name of the payer.
     *
     * @param string $firstName
     * 
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * First name of the payer.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Middle name of the payer.
     *
     * @param string $middleName
     * 
     * @return $this
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * Middle name of the payer.
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Last name of the payer.
     *
     * @param string $lastName
     * 
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Last name of the payer.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Suffix of the payer.
     *
     * @param string $suffix
     * 
     * @return $this
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * Suffix of the payer.
     *
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * PayPal assigned encrypted Payer ID.
     *
     * @param string $payerId
     * 
     * @return $this
     */
    public function setPayerId($payerId)
    {
        $this->payerId = $payerId;
        return $this;
    }

    /**
     * PayPal assigned encrypted Payer ID.
     *
     * @return string
     */
    public function getPayerId()
    {
        return $this->payerId;
    }

    /**
     * Phone number representing the payer. 20 characters max.
     *
     * @param string $phone
     * 
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Phone number representing the payer. 20 characters max.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Phone type
     * Valid Values: ["HOME", "WORK", "MOBILE", "OTHER"]
     *
     * @param string $phoneType
     * 
     * @return $this
     */
    public function setPhoneType($phoneType)
    {
        $this->phoneType = $phoneType;
        return $this;
    }

    /**
     * Phone type
     *
     * @return string
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     * Birth date of the Payer in ISO8601 format (yyyy-mm-dd).
     *
     * @param string $birthDate
     * 
     * @return $this
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * Birth date of the Payer in ISO8601 format (yyyy-mm-dd).
     *
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Payer’s tax ID. Only supported when the `payment_method` is set to `paypal`.
     *
     * @param string $taxId
     * 
     * @return $this
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;
        return $this;
    }

    /**
     * Payer’s tax ID. Only supported when the `payment_method` is set to `paypal`.
     *
     * @return string
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * Payer’s tax ID type. Allowed values: `BR_CPF` or `BR_CNPJ`. Only supported when the `payment_method` is set to `paypal`.
     * Valid Values: ["BR_CPF", "BR_CNPJ"]
     *
     * @param string $taxIdType
     * 
     * @return $this
     */
    public function setTaxIdType($taxIdType)
    {
        $this->taxIdType = $taxIdType;
        return $this;
    }

    /**
     * Payer’s tax ID type. Allowed values: `BR_CPF` or `BR_CNPJ`. Only supported when the `payment_method` is set to `paypal`.
     *
     * @return string
     */
    public function getTaxIdType()
    {
        return $this->taxIdType;
    }

    /**
     * Two-letter registered country code of the payer to identify the buyer country.
     *
     * @param string $countryCode
     * 
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Two-letter registered country code of the payer to identify the buyer country.
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Billing address of the Payer.
     *
     * @param \PayPal\Api\Address $billingAddress
     * 
     * @return $this
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * Billing address of the Payer.
     *
     * @return \PayPal\Api\Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @deprecated [DEPRECATED] Use shipping address present in purchase unit or at root level of checkout Session.
     *
     * @param \PayPal\Api\ShippingAddress $shipping_address
     * 
     * @return $this
     */
    public function setShippingAddress($shipping_address)
    {
        $this->shipping_address = $shipping_address;
        return $this;
    }

    /**
     * @deprecated  [DEPRECATED] Use shipping address present in purchase unit or at root level of checkout Session.
     *
     * @return \PayPal\Api\ShippingAddress
     */
    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

}
