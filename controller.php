<?php

namespace Concrete\Package\OptInBulletin;
use \Concrete\Package\LikesThisBlock\Src\RouteHelper;
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
    }
    public function uninstall(){
        parent::uninstall();
    }
}