<?php
/**
 * Copyright (C) 2014 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 28/03/2015
 */

namespace Sphring\MicroWebFramework\Controller\Ciwatch;


use Github\Client;
use League\OAuth2\Client\Token\AccessToken;
use Sphring\MicroWebFramework\Controller\AbstractController;
use Sphring\MicroWebFramework\Model\User;

class AbstractCiWatchController extends AbstractController
{

    public function action()
    {
        if (empty($_SESSION['token']) || empty($_SESSION['user'])) {
            $this->redirect('login');
        }
        $this->getGithubApi()->authenticate($this->getToken(), null, Client::AUTH_HTTP_TOKEN);
    }

    /**
     * @return User
     */
    public function getUserSession()
    {
        $mwf = $this->getMicroWebFramework();
        $platesExtension = $mwf->getPlateExtensions();
        $userSession = $platesExtension['userSession'];
        return $userSession->getUser();
    }

    /**
     * @return AccessToken|null
     */
    public function getToken()
    {

        return $_SESSION['token'];
    }

}
