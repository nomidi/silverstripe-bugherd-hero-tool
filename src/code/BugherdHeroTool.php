<?php

namespace Nomidi;

use SilverStripe\Dev\Debug;
use SilverStripe\Core\Config\Config;
use SilverStripe\Control\Director;
use SilverStripe\Security\Member;
use SilverStripe\View\Requirements;
use SilverStripe\Core\Extension;

class BugherdHeroTool extends Extension
{
    /**
     * Function which reads the Bugherd Key from the Configuration
     */
    public function getProjectKey()
    {
        debug::show(__CLASS__);
        $return =  Config::inst()->get(__CLASS__, 'project_key');
        debug::show($return);
        if ($return == '') {
            $return =  false;
        }
        return $return;
    }

    public function getEnvType()
    {
        $return = Config::inst()->get(__CLASS__, 'environment_type');

        if ($return == '') {
            $return =  'dev';
        }
        return $return;
    }

    public function getMemberStatus()
    {
        $return = Config::inst()->get(__CLASS__, 'member_status');
        if ($return == '') {
            $return = false;
        }
        return $return;
    }



    /**
     * Function which loads the bugherd template into the Website
    */
    public function onAfterInit()
    {
        $project_key = $this->getProjectKey();
        $env_type = $this->getEnvType();
        $member_status = $this->getMemberStatus();

        if ($project_key) {
            debug::show(Director::get_environment_type());
            if ($env_type == Director::get_environment_type()) {
                if (($member_status && Member::currentUserID() != 0) || !$member_status) {
                    Requirements::customScript($this->owner->renderWith('BugherdHeroTool'));
                }
            }
        }
    }
}
