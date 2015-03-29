<?php
/**
 * Copyright (C) 2014 Arthur Halet
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

class ScrutinizerProvider extends AbstractProvider
{

    public function getImage(Repo $repo, $branch = "master")
    {
        //[![Code Coverage](https://scrutinizer-ci.com/g/sphring/sphring/badges/coverage.png?b=master)]
        //(https://scrutinizer-ci.com/g/sphring/sphring/?branch=master)
        $imgUrlQuality = '<a href="https://scrutinizer-ci.com/g/%s/?branch=%s"><img src="https://scrutinizer-ci.com/g/%s/badges/quality-score.png?b=%s"
                    alt="Scrutinizer Code Quality %s"/></a> ';
        $imgUrlQuality = sprintf($imgUrlQuality,
            $repo->getFullName(), $branch, $repo->getFullName(), $branch, $repo->getFullName());
        $imgUrlCoverage = '<a href = "https://scrutinizer-ci.com/g/%s/?branch=%s" ><img src = "https://scrutinizer-ci.com/g/%s/badges/coverage.png?b=%s"
        alt = "Code Coverage %s" /></a >';
        $imgUrlCoverage = sprintf($imgUrlCoverage,
            $repo->getFullName(), $branch, $repo->getFullName(), $branch, $repo->getFullName());
        return $imgUrlQuality . $imgUrlCoverage;
    }

    public function runInspection(Repo $repo, $branch = "master")
    {
        // TODO: Implement runInspection() method.
    }
}
