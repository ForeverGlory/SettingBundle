<?php

namespace Glory\Bundle\SettingBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Glory\SettingsBundle\Model\Setting;

/**
 * Description of SettingManager
 *
 * @author ForeverGlory
 */
class SettingManager
{

    protected $om;
    protected $repository;
    protected $model;

    public function __construct(ObjectManager $om, $model = NULL)
    {
        $this->om = $om;
        if (!$model instanceof Setting) {
            
        }
        $this->model = $model;
        $this->repository = $om->getRepository($model);
    }

    public function value($name, $default = null)
    {
        $keys = explode('.', $name);
        $setting = $this->get(array_shift($keys));
        $return = $default;
        if ($setting) {
            $value = unserialize($setting->getValue());
            foreach ($keys as $key) {
                if (!array_key_exists($key, $value)) {
                    return $return;
                }
                $value = $value[$key];
            }
            $return = $value;
        }
        return $return;
    }

    public function get($name)
    {
        return $this->repository->findOneByName($name);
    }

    /**
     * save Setting
     * insert,update,delete
     */
    public function save($name, $value = NULL)
    {
        $setting = $this->get($name);
        if (is_null($value)) {
            if ($setting) {
                $this->om->remove($setting);
                $this->om->flush();
            }
            return true;
        }
        if (!$setting) {
            $setting = new $this->model();
            $setting->setName($name);
        }
        $setting->setValue(serialize($value));
        $this->om->persist($setting);
        $this->om->flush();
        return true;
    }

}
