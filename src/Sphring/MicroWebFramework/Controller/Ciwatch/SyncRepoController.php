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

namespace Sphring\MicroWebFramework\Controller\Ciwatch;


class SyncRepoController extends AbstractCiWatchController
{
    public function action()
    {
        parent::action();
        $cache = $this->getCache();
        $cacheId = sprintf(AddRepoController::CACHE_REPO_ID, $this->getUserSession()->getId());
        $cacheIdName = sprintf(AddRepoController::CACHE_REPO_NAME_ID, $this->getUserSession()->getId());
        if ($cache->contains($cacheId) && $cache->contains($cacheIdName)) {
            $cache->delete($cacheId);
            $cache->delete($cacheIdName);
        }
        $this->redirect('addRepo');
    }
}
