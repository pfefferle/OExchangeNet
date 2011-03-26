<?php
if (!defined('STATUSNET')) {
  exit(1);
}

/**
 * @package OExchangePlugin
 * @author Matthias Pfefferle <pfefferle@pfefferle.status.net>
 */
class OExchangeXrdAction extends Action
{
  /**
   * Is read only?
   *
   * @return boolean true
   */
  function isReadOnly()
  {
    return true;
  }

  /**
   * Handle the request
   *
   * @param array $args $_REQUEST data (unused)
   * @return void
   * @todo implement XRD class if it supports <properties />
   */
  function handle()
  {
    parent::handle();

    $domain = common_config('site', 'server');
    $sharelink = common_local_url('oexchangeoffer');
    
    if (defined('OEXCHANGE_ICON')) {
      $icon = OEXCHANGE_ICON;
    } else {
      $icon = common_path('plugins/OExchange/images/icon.png');
    }
    
    if (defined('OEXCHANGE_ICON32')) {
      $icon32 = OEXCHANGE_ICON32;
    } else {
      $icon32 = common_path('plugins/OExchange/images/icon32.png');
    }

    header('Content-type: application/xrd+xml');
?>
<?xml version='1.0' encoding='UTF-8'?>
<XRD xmlns="http://docs.oasis-open.org/ns/xri/xrd-1.0">
    <Subject><?php echo common_local_url('newnotice'); ?></Subject>

    <Property type="http://www.oexchange.org/spec/0.8/prop/vendor"><?php echo common_config('site', 'broughtby'); ?></Property>
    <Property type="http://www.oexchange.org/spec/0.8/prop/title"><?php echo common_config('site', 'name'); ?></Property>
    <Property type="http://www.oexchange.org/spec/0.8/prop/name">StatusNet Version <?php echo STATUSNET_VERSION; ?></Property>
    <Property type="http://www.oexchange.org/spec/0.8/prop/prompt">Share with your "<?php echo common_config('site', 'name'); ?>" network!</Property>

    <Link rel="icon" href="<?php echo $icon; ?>" type="image/png" />
    <Link rel="icon32" href="<?php echo $icon32; ?>" type="image/png" />

    <Link rel="http://www.oexchange.org/spec/0.8/rel/offer" href="<?php echo $sharelink; ?>" type="text/html" />
</XRD>
<?php
  }
}