<?php

namespace Betsol\JustClick\Entity;


/**
 * Class Order
 * @package Betsol\JustClick\Entity
 * @author Slava Fomin II <s.fomin@betsol.ru>
 */
class Order
{
    /** @var  array */
    protected $data;


    /**
     * Adds product to the order.
     *
     * @param string $name
     * @param integer|null $price
     */
    public function addProduct($name, $price = null)
    {
        if (!isset($this->data['goods'])) {
            $this->data['goods'] = [];
        }

        $product = [
            'good_name' => $name,
        ];

        if (null !== $price) {
            $product['good_sum'] = (int) $price;
        }

        $this->data['goods'][] = $product;
    }

    /**
     * @param string $nameFirst
     */
    public function setNameFirst($nameFirst)
    {
        $this->data['bill_first_name'] = $nameFirst;
    }

    /**
     * @param string $nameLast
     */
    public function setNameLast($nameLast)
    {
        $this->data['bill_surname'] = $nameLast;
    }

    /**
     * @param string $patronymic
     */
    public function setPatronymic($patronymic)
    {
        $this->data['bill_otchestvo'] = $patronymic;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->data['bill_email'] = $email;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->data['bill_phone'] = $phoneNumber;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->data['bill_country'] = $country;
    }

    /**
     * @param string $region
     */
    public function setRegion($region)
    {
        $this->data['bill_region'] = $region;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->data['bill_city'] = $city;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->data['bill_address'] = $address;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->data['bill_postal_code'] = $postalCode;
    }

    /**
     * @param string $coupon
     */
    public function setCoupon($coupon)
    {
        $this->data['bill_kupon'] = $coupon;
    }

    /**
     * @param int $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->data['bill_aff'] = $partnerId;
    }

    /**
     * @param string $name
     */
    public function setPartnerName($name)
    {
        $this->data['bill_aff_name'] = $name;
    }

    /**
     * @param int $partnerId
     */
    public function setPartnerOfPartnerId($partnerId)
    {
        $this->data['bill_paff'] = $partnerId;
    }

    /**
     * @param string $name
     */
    public function setPartnerOfPartnerName($name)
    {
        $this->data['bill_paff_name'] = $name;
    }

    /**
     * @param int $adId
     */
    public function setAdId($adId)
    {
        $this->data['bill_ad_id'] = $adId;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->data['bill_tag'] = $tag;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->data['bill_comment'] = $comment;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->data['bill_ip'] = $ip;
    }

    /**
     * @param string $timerLimit
     */
    public function setTimerLimit($timerLimit)
    {
        $this->data['bill_timer_kill'] = $timerLimit;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated)
    {
        $this->data['bill_created'] = $dateCreated->getTimestamp();
    }

    /**
     * @param string $domainName
     */
    public function setDomainName($domainName)
    {
        $this->data['bill_domain'] = $domainName;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}