<?php

namespace Nomidi\BugherdHeroTool\Tests;

use SilverStripe\Core\Config\Config;
use Nomidi\BugherdHeroTool\BugherdHeroTool;
use SilverStripe\Control\Director;
use SilverStripe\Security\Member;
use SilverStripe\Dev\FunctionalTest;

class BugherdHeroToolTest extends FunctionalTest
{
    protected static $fixture_file = 'SiteTreeTest.yml';
    public static $use_draft_site = true;
    private $bugherd_string = 'sidebarv2.js?apikey=';
    /**
     * Test checks if an bugherd key was entered
     */
    public function testProjectKey()
    {
        Config::inst()->update(BugherdHeroTool::class, 'project_key', 'xxxx');
        $project_key = Config::inst()->get(BugherdHeroTool::class, 'project_key');
        $this->assertTrue(is_string($project_key), "Can't find your Bugherd project_key, please insert the key into your _config.yml");
    }



    public function testMemberStatus()
    {
        Config::inst()->update(BugherdHeroTool::class, 'member_status', true);
        Config::inst()->update(Director::class, 'environment_type', 'dev');
        Config::inst()->update(BugherdHeroTool::class, 'environment_type', 'dev');
        Config::inst()->update(BugherdHeroTool::class, 'project_key', 'xxxx');

        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertFalse($body, _t('BugherdHeroToolTest.FindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedModeMember'), array('loggedOut')));

        $cmseditor = $this->objFromFixture(Member::class, 'cmseditor');
        $cmseditor->logIn();
        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertTrue(is_numeric($body), _t('BugherdHeroToolTest.CantFindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedModeMember'), array('loggedIn')));
    }

    /**
     * Test checks if the bugherd template can be found in the template implementation
     */
    public function testModusDevNoMember()
    {
        Config::inst()->update(BugherdHeroTool::class, 'environment_type', 'dev');
        Config::inst()->update(Director::class, 'environment_type', 'dev');
        Config::inst()->update(BugherdHeroTool::class, 'project_key', 'xxxx');

        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertTrue(is_numeric($body), _t('BugherdHeroToolTest.CantFindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('dev', 'dev')));

        Config::inst()->update(Director::class, 'environment_type', 'test');
        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertFalse($body, _t('BugherdHeroToolTest.FindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('dev', 'test')));

        Config::inst()->update(Director::class, 'environment_type', 'live');
        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertFalse($body, _t('BugherdHeroToolTest.FindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('dev', 'live')));
    }

    public function testModusTestNoMember()
    {
        Config::inst()->update(BugherdHeroTool::class, 'environment_type', 'test');
        Config::inst()->update(Director::class, 'environment_type', 'test');
        Config::inst()->update(BugherdHeroTool::class, 'project_key', 'xxxx');

        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertTrue(is_numeric($body), _t('BugherdHeroToolTest.CantFindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('test', 'test')));

        Config::inst()->update(Director::class, 'environment_type', 'dev');
        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertFalse($body, _t('BugherdHeroToolTest.FindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('test', 'dev')));

        Config::inst()->update(Director::class, 'environment_type', 'live');
        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertFalse($body, _t('BugherdHeroToolTest.FindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('test', 'live')));
    }

    public function testModusLiveNoMember()
    {
        Config::inst()->update(BugherdHeroTool::class, 'environment_type', 'live');
        Config::inst()->update(Director::class, 'environment_type', 'live');
        Config::inst()->update(BugherdHeroTool::class, 'project_key', 'xxxx');

        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertTrue(is_numeric($body), _t('BugherdHeroToolTest.CantFindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('live', 'live')));

        Config::inst()->update(Director::class, 'environment_type', 'dev');
        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertFalse($body, _t('BugherdHeroToolTest.FindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('live', 'dev')));

        Config::inst()->update(Director::class, 'environment_type', 'test');
        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = strpos($response->getBody(), $this->bugherd_string);
        $this->assertFalse($body, _t('BugherdHeroToolTest.FindInTemplate').vsprintf(_t('BugherdHeroToolTest.ModeTestedMode'), array('live', 'test')));
    }
}
