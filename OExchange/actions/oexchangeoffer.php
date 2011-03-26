<?php
if (!defined('STATUSNET')) {
  exit(1);
}

/**
 * @package OExchangePlugin
 * @author Matthias Pfefferle <pfefferle@pfefferle.status.net>
 */
class OExchangeOfferAction extends Action
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
   * Take arguments for running
   *
   * @param array $args $_REQUEST args
   * @return boolean success flag
   */
  function prepare($args)
  {
    parent::prepare($args);
    $this->url = $this->arg('url');
    $this->title = $this->arg('title');
    $this->description = $this->arg('description');
      
    return true;
  }

  /**
   * Handle the request
   *
   * check OExchange params and redirect
   *
   * @param array $args $_REQUEST data (unused)
   * @return void
   */
  function handle($args)
  {
    parent::handle($args);

    $url = common_local_url('newnotice');
    $url .= "?status_textarea=".urlencode('"'.$this->title.'" '.$this->url);
    
    // redirect to "newnotice" page
    common_redirect($url);
  }
}
