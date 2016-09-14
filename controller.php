<?php

namespace Concrete\Package\OptInBulletin;
use \Concrete\Core\Attribute\Key\UserKey as UserAttributeKey;
use \Concrete\Core\Attribute\Type;
use BlockType, Package, Loader;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package {

    protected $pkgHandle = 'optin_bulletin';
    protected $appVersionRequired = '5.7.0';
    protected $pkgVersion = '1.0';

    public function getPackageName() {
        return t("Opt-in Bulletin");
    }
    public function getPackageDescription() {
        return t("Subscribe to bulletin Email notifications.");
    }

    public function install() {
        $pkg = parent::install();
        BlockType::installBlockTypeFromPackage('optin_bulletin', $pkg);
        UserAttributeKey::add(
            Type::getByHandle('boolean'), 
            array('akHandle' => 'staffbulletin_subscription', 'akName' => t('Staff Bulletin Subscription'), 'akIsSearchable' => true), $pkg
        );
        
    }
    public function uninstall(){
        parent::uninstall();
    }
}