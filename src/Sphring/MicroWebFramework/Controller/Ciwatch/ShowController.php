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


class ShowController extends AbstractCiWatchController
{
    public function action()
    {
        parent::action();

        $repos = $this->getUserSession()->getRepos();
        $showTable = false;
        foreach ($repos as $repo) {
            if ($repo->getWatch()) {
                $showTable = true;
                break;
            }
        }
        return $this->getEngine()->render('watch/show.php', [
            'providers' => $this->getProviders(),
            'showTable' => $showTable
        ]);
    }
}
