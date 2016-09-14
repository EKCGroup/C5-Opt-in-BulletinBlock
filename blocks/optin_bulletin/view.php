<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

$u = new User(); 
$ui = UserInfo::getByID($u->getUserID()); 
$subscription_status = $ui->getAttribute('staffbulletin_subscription');

if ($subscription_status == 0) { ?>

<div class="ccm-block-subscribe-wrapper">
    <a href="<?php echo $view->action('subscribe', Loader::helper('validation/token')->generate('subscribe_page'))?>" data-action="block-subscribe-page">
        <input type="button" id="subscribe" value="Subscribe to E-Mail alerts.">
    </a>
</div>

<?php
} else {
?>

<div class="ccm-block-unsubscribe-wrapper">
    <a href="<?php echo $view->action('unsubscribe', Loader::helper('validation/token')->generate('unsubscribe_page'))?>" data-action="block-unsubscribe-page">
        <input type="button" id="unsubscribe" value="Un-Subscribe to E-Mail alerts.">
    </a>
</div>

<?php } ?>
