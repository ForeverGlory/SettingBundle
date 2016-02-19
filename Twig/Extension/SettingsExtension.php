<?php

namespace Glory\SettingBundle\Twig\Extension;

use Glory\SettingBundle\Manager\SettingManager;

/**
 * Description of SettingsExtension
 *
 * @author ForeverGlory
 */
class SettingsExtension extends \Twig_Extension
{

    private $manager;

    public function __construct(SettingManager $manager)
    {
        $this->manager = $manager;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('setting', array($this, 'getSetting')),
        );
    }

    public function getSetting($name, $default = null)
    {
        return $this->manager->value($name, $default);
    }

    public function getName()
    {
        return 'glory.setting';
    }

}
