<?php
/**
 * Copyright (C) 2014 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 29/03/2015
 */

namespace Sphring\MicroWebFramework\Providers;


use Sphring\MicroWebFramework\Model\Repo;
use Sphring\MicroWebFramework\PlatesExtension\UserSession;

abstract class AbstractProvider implements Provider
{
    /**
     * @var UserSession
     */
    protected $userSession;

    abstract public function getImage(Repo $repo, $branch = "master");

    abstract public function runInspection(Repo $repo, $branch = "master");

    /**
     * @return UserSession
     */
    public function getUserSession()
    {
        return $this->userSession;
    }

    /**
     * @param UserSession $userSession
     * @Required
     */
    public function setUserSession(UserSession $userSession)
    {
        $this->userSession = $userSession;
    }

}
