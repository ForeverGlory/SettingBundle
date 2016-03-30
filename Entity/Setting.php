<?php

namespace Glory\Bundle\SettingBundle\Entity;

use Glory\Bundle\SettingBundle\Model\Setting as AbstractSetting;
use Doctrine\ORM\Mapping as ORM;

/**
 * Setting
 *
 * @ORM\Table(name="setting")
 * @ORM\Entity
 */
class Setting extends AbstractSetting
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text")
     */
    protected $value;


}

