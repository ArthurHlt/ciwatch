<?php
/**
 * Copyright (C) 2015 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 30/03/2015
 */


namespace Sphring\MicroWebFramework\Providers;


use Sphring\MicroWebFramework\Model\Repo;

class ScrutinizerQualityProvider extends ScrutinizerProvider
{

    public function getImage(Repo $repo, $branch = "master")
    {
        $imgUrlQuality = sprintf($this->imageUrl,
            $repo->getFullName(), $branch, $repo->getFullName(), $branch, $repo->getFullName());
        return $imgUrlQuality;
    }

    public function runInspection(Repo $repo, $branch = "master")
    {
        // TODO: Implement runInspection() method.
    }
}