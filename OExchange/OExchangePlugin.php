<?php
if (!defined('STATUSNET')) {
    exit(1);
}

/**
 * @package OExchange
 * @author Matthias Pfefferle <pfefferle@pfefferle.status.net>
 */
class OExchangePlugin extends Plugin
{
    /**
     * Hook for RouterInitialized event.
     *
     * @param Net_URL_Mapper $m path-to-action mapper
     * @return boolean hook return
     */
    function onRouterInitialized($m)
    {
        // Discovery actions
        $m->connect('.well-known/oexchange.xrd',
                    array('action' => 'oexchangexrd'));
        // Discovery actions
        $m->connect('oexchange/offer',
                     array('action' => 'oexchangeoffer'));
        return true;
    }

    /**
     * Adds oexchange link to the host-meta file
     *
     * @param array $links
     * @return boolean hook return
     */
    function onStartHostMetaLinks($links)
    {
        $url = common_local_url('oexchangexrd');        
        $links[] = array('rel' => 'http://oexchange.org/spec/0.8/rel/resident-target',
                       'type' => 'application/xrd+xml',
                       'href' => $url);
        return true;
    }

    /**
     * Automatically load the actions and libraries used by the plugin
     *
     * @param Class $cls the class
     * @return boolean hook return
     */
    function onAutoload($cls)
    {
        $base = dirname(__FILE__);
        $lower = strtolower($cls);
        
        if (isset($map[$lower])) {
            $lower = $map[$lower];
        }
        $files = array();
        if (substr($lower, -6) == 'action') {
            $files[] = "$base/actions/" . substr($lower, 0, -6) . ".php";
        }
        foreach ($files as $file) {
            if (file_exists($file)) {
                include_once $file;
                return false;
            }
        }
        return true;
    }
}
