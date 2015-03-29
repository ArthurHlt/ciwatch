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

interface Provider
{
    public function getImage(Repo $repo, $branch = "master");

    public function runInspection(Repo $repo, $branch = "master");
}
