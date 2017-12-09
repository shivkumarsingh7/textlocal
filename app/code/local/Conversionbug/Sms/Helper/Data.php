<?php
/**
 * ConversionBug
 * @category    SMS
 * @package     Conversionbug_SMS
 * @copyright   Copyright (c) 2017 Conversionbug (http://www.conversionbug.com/)
 * @author      shivam
 * @email       shivam.kumar@conversionbug.com
 * @version     Release: 1.0.0.0
 */

class Conversionbug_Sms_Helper_Data extends Mage_Core_Helper_Abstract
{
    const SMS_ENABLED = 1;
    const SMS_STATUS = 'sms/status/enable';
    const SMS_USERNAME = 'sms/status/username';
    const SMS_HASH = 'sms/status/hash';
    const SMS_SENDER = 'sms/status/sender';

    /**
     *  get sms module status
     */
    public function is_sms_enabled()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        if (self::SMS_ENABLED == Mage::getStoreConfig(self::SMS_STATUS, $storeId))
            return true;

        return false;
    }

    /**
     *  get username
     */
    public function get_username()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        return Mage::getStoreConfig(self::SMS_USERNAME, $storeId);
    }

    /**
     *  get hash
     */
    public function get_hash()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        return Mage::getStoreConfig(self::SMS_HASH, $storeId);
    }

    /**
     *  get sender
     */
    public function get_sender()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        return Mage::getStoreConfig(self::SMS_SENDER, $storeId);
    }

    public function send($numbers, $message)
    {
        try {

            if($this->is_sms_enabled()) {
                // Textlocal account details

                $username = $this->get_username();
                $hash = $this->get_hash();
                $sender = $this->get_sender();

                if (is_array($numbers)) {
                    $numbers = implode(',', $numbers);
                    //$numbers = (array)$numbers;
                }
                // Prepare data for POST request
                $data = array(
                    'username' => $username,
                    'hash' => $hash,
                    'numbers' => $numbers,
                    "sender" => $sender,
                    "message" => $message,
                    "test"    => true,
                );
                // Send the POST request with cURL
                $ch = curl_init('http://api.textlocal.in/send/');
                curl_setopt($ch, CURLOPT_POST, true);
                //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);

                // Process your response here
                Mage::log($response, null, 'sms.log');
                //return $response;

            }
            // For Error
            // {"errors":[{ "code":2, "message":"Unrecognised command" }], "status":"failure"}
        } catch (Exception $e) {
            Mage::log($e->getMessage(), null, 'sms.log');
        }
    }
}
