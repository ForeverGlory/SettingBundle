SettingBundle
===========
Symfony SettingBundle

Introduction
------------

### Composer

Add to `composer.json` in your project to `require` section:

```json
{
    "foreverglory/setting-bundle": "~0.1"
}
```
### Add this bundle to your application's kernel

```php
//app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new Glory\SettingBundle\GlorySettingBundle(),
        // ...
    );
}
```

### Conﬁgure service in your YAML configuration
```yaml
#app/conﬁg/conﬁg.yml
glory_setting:
    driver:~    #default %database_driver%
    manager:~   #service id, default if driver is 'pdo_mysql', manager is @doctrine.orm.default_entity_manager
    model:~     #model class,default if driver is 'pdo_mysql', model is Glory\SettingBundle\Entity\Setting
```

### php code
```php
$settingManager = $container->get('glory_setting.manager');

$settingManager->value('name');
$settingManager->value('name','default-value');

$settingManager->value('name.key');
$settingManager->value('name.key','default-value');

$settingManager->save('name','value');
$settingManager->save('name',array('key'=>'value'));
```

### twig code
```twig
{# string #}
{{setting('name')}}
{{setting('name','default-value')}}

{# array #}
{{setting('name.key')}}
{{setting('name.key','default-value')}}

{% set value=setting('name') %}
{{value.key}}

{# Warning #}
{# 
    if setting('name') is array 
    use {{setting('name')}}
    will throw Exception("Notice: Array to string conversion")
#}

```