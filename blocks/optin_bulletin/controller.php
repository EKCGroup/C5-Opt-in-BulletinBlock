<?php  

namespace Concrete\Package\OptInBulletin\Block\OptInBulletin;
use \Concrete\Core\Block\BlockController, BlockType, Loader;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends BlockController {
		
    protected $btTable = 'btOptInBulletin';
    protected $btInterfaceWidth = "400";
    protected $btInterfaceHeight = "300";
    protected $btWrapperClass = 'ccm-ui';
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
		
    public function getBlockTypeName() {
        return t("Opt-in Bulletin");
    }
    public function getBlockTypeDescription() {
        return t("Subscribe to bulletin Email notifications.");
    }
    public function registerAssets(){
   	$this->requireAsset('javascript', 'jquery');
    }
}