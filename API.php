<?php

/**
 * Part of Piwik Login Shibboleth Plug-in.
 */

namespace Piwik\Plugins\LoginShibboleth;

use Exception;
use Piwik\Piwik;
use RuntimeException;

/**
 * API functionality for settings.
 *
 * API is used by the Setting to write or read settings from the configuration file.
 * If this plug-in should have any other API related functions, they should be added here.
 * The API is only available to the user with SuperUser access.
 *
 */
class API extends \Piwik\Plugin\API
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Saves the Login Shibboleth settings in the config file automatically.
     *
     * @param string $data JSON encoded config array.
     *
     * @return array
     *
     * @throws Exception if user does not have super access, if this is not a POST method or
     *                   if JSON is not supplied.
     */
    public function saveShibbolethConfig($data)
    {
        $this->checkHttpMethodIsPost();
        Piwik::checkUserHasSuperUserAccess();
        Config::savePluginOptions($data);
        return array('result' => 'success', 'message' => Piwik::translate('General_YourChangesHaveBeenSaved'));
    }

    /**
     * Check is the method sending the data is post.
     *
     * @throws \Exception
     */
    private function checkHttpMethodIsPost()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new RuntimeException('Invalid HTTP method.');
        }
    }
}
