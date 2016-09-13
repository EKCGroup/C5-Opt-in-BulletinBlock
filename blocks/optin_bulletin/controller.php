<?php  

namespace Concrete\Package\OptInBulletin\Block\OptInBulletin;
use \Concrete\Core\Block\BlockController, BlockType, Loader, Core, Page, User, UserInfo, Redirect;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends BlockController {
		
    protected $btTable = 'btOptInBulletin';
    protected $btInterfaceWidth = "400";
    protected $btInterfaceHeight = "300";
    protected $btWrapperClass = 'ccm-ui';
    protected $btCacheBlockRecord = false;
    protected $btCacheBlockOutput = false;
    protected $btCacheBlockOutputOnPost = false;
    protected $btCacheBlockOutputForRegisteredUsers = false;
		
    public function getBlockTypeName() {
        return t("Opt-in Bulletin");
    }
    public function getBlockTypeDescription() {
        return t("Subscribe to bulletin Email notifications.");
    }
    public function registerAssets(){
   	$this->requireAsset('javascript', 'jquery');
    }
    
    public function action_subscribe($token = false, $bID = false) {
        if ($this->bID != $bID) {
            return false;
        }
        if (Core::make('token')->validate('subscribe_page', $token)) {
            
            //Get page requested from
            $page = Page::getCurrentPage();
            
            //Get user trying to subscribe
            $u = new User(); 
            $ui = UserInfo::getByID($u->getUserID());
            $subscription_status = $ui->setAttribute('staffbulletin_subscription', '1');
            
            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                $b = $this->getBlockObject();
                $bv = new BlockView($b);
                $bv->render('view');
            } else {
                //Redirect to previous page
                Redirect::page($page)->send();
            }
        }
        exit;
    }
    public function action_unsubscribe($token = false, $bID = false) {
        if ($this->bID != $bID) {
            return false;
        }
        if (Core::make('token')->validate('unsubscribe_page', $token)) {
            
            //Get page requested from
            $page = Page::getCurrentPage();
            
            //Get user trying to subscribe
            $u = new User(); 
            $ui = UserInfo::getByID($u->getUserID());
            $subscription_status = $ui->setAttribute('staffbulletin_subscription', '0');
            
            if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
                $b = $this->getBlockObject();
                $bv = new BlockView($b);
                $bv->render('view');
            } else {
                //Redirect to previous page
                Redirect::page($page)->send();
            }
        }
        exit;
    }
}