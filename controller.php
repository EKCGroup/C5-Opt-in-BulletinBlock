<?php

namespace Concrete\Package\OptInBulletin;
use \Concrete\Core\Attribute\Key\UserKey as UserAttributeKey;
use \Concrete\Core\Attribute\Type;
use BlockType, Package, Loader, Events;

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
    
    //Add event to concrete5's bootstrapping process
    public function on_start() {
        
    //Event fires when a page is approved.
    Events::addListener('on_page_version_approve',function() {

    //Check this is a bulletin page
    if ($_POST['ptID']=20) {
    
    //Get page data
    $pageData =array();
    $pageData['ptID'] = $_POST['ptID'];
    $pageData['ptComposer'][83]['name'] =$_POST['ptComposer'][83]['name'];
    $pageData['ptComposer'][84]['description'] = $_POST['ptComposer'][84]['description'];
    $pageData['ptComposer'][88]['content'] = $_POST['ptComposer'][88]['content'];    
        
    //Get list of subscribers.
    $db = \Database::connection();
    $statement = $db->prepare('SELECT Users.uEmail
    FROM UserSearchIndexAttributes INNER JOIN Users ON UserSearchIndexAttributes.uID = Users.uID
    WHERE (((UserSearchIndexAttributes.ak_staffbulletin_subscription)=1));');
    $statement->execute();
    $subscribers = $statement->fetchAll();

    foreach ($subscribers as $item) {
    //send e-mail to each subscribed user
    $to      = $item["uEmail"];
    $subject = $pageData['ptComposer'][83]['name'];
    $message = $pageData['ptComposer'][84]['description'];
    $headers = 'From: noreply@cant-col.ac.uk' . "\r\n" .
    'Reply-To: noreply@cant-col.ac.uk' . "\r\n";
    mail($to, $subject, $message, $headers);
    }   //end mail sending loop
    
    }    //end bulletin post.

    });  //end event listener.
    }    //end c5 bootstap.
}