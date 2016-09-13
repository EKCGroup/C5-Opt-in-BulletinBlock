<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

$u = new User(); 
$ui = UserInfo::getByID($u->getUserID()); 
$subscription_status = $ui->getAttribute('staffbulletin_subscription');
//$subscription_status = $ui->setAttribute('staffbulletin_subscription', '1');
echo $subscription_status; 

if ($subscription_status == 0) { ?>
    
    <form method="POST" action="<?=$this->url('/subscription', 'subscribe')?>">
        <input type="button" id="subscribe" value="Subscribe for E-Mail alerts.">
    </form>
        
        <?php
    
} else {
    
    echo '<input type="button" onclick="" value="Un-subscribe for E-Mail alerts.">';
    
}
?>