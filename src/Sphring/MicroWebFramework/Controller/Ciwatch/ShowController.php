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

namespace Sphring\MicroWebFramework\Controller\Ciwatch;


use Sphring\MicroWebFramework\MicroWebFrameworkRunner;

class ShowController extends AbstractCiWatchController
{
    public function action()
    {
        parent::action();

        $showTable = false;
        $repoDao = MicroWebFrameworkRunner::getInstance()->getBean('dao.repo');

        $repos = $repoDao->findRepoWatched($this->getUserSession());
        return $this->getEngine()->render('watch/show.php', [
            'providers' => $this->getProviders(),
            'repos' => $repos
        ]);
    }
}
