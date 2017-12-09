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

class Conversionbug_Sms_Helper_Error extends Mage_Core_Helper_Abstract
{

    // error code http://api.textlocal.in/docs/sendsms
    protected $_errorCodes = array(
        4 => "No recipients specified",
        5 => "No message content.",
        6 => "Message too long.",
        7 => "Insufficient credits.",
        8 => "Invalid schedule date.",
        9 => "Schedule date is in the past.",
        10 => "Invalid group ID.",
        11 => "Selected group is empty.",
        32 => "Invalid number format.",
        33 => "You have supplied too many numbers.",
        34 => "You have supplied both a group ID and a set of numbers.",
        43 => "Invalid sender name.",
        44 => "No sender name specified.",
        51 => "No valid numbers specified.",
        191 => "Schedule time is outside that allowed.",
        192 => "You cannot send message at this time.",
    );

    protected $_warningCodes = array(
        3 => 'Invalid number.'
    );
}
