<?php
class BugherdHeroTool extends Extension
{
    /**
     * Function which reads the Bugherd Key from the Configuration
     */
    public function getProjectKey()
    {
        $return =  Config::inst()->get('BugherdHeroTool', 'project_key');
        if ($return == '') {
            $return =  false;
        }
        return $return;
    }

    public function getEnvType()
    {
        $return = Config::inst()->get('BugherdHeroTool', 'environment_type');

        if ($return == '') {
            $return =  'dev';
        }
        return $return;
    }

    public function getMemberStatus()
    {
        $return = Config::inst()->get('BugherdHeroTool', 'member_status');
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
            if ($env_type == Config::inst()->get('Director', 'environment_type')) {
                if (($member_status && Member::currentUserID() != 0) || !$member_status) {
                    Requirements::customScript($this->owner->renderWith('BugherdHeroTool'), 'BugherdHeroTool');
                }
            }
        }
    }
}
