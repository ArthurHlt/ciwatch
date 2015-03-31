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
use Sphring\MicroWebFramework\Model\Repo;
use Sphring\MicroWebFramework\Model\User;

class ShowController extends AbstractCiWatchController
{
    public function action()
    {
        parent::action();
        return $this->renderShow($this->getUserSession());
    }

    protected function renderShow(User $user, $readOnly = false)
    {
        $repoDao = MicroWebFrameworkRunner::getInstance()->getBean('dao.repo');

        $repos = $repoDao->findRepoWatched($user);
        $repoSource = [];
        $nickName = $user->getNickname();
        $columns = [
            [
                "label" => "Name",
                "property" => "name",
                "sortable" => true
            ],
            [
                "label" => "Info",
                "property" => "info",
                "sortable" => false,
                "width" => "500px"
            ],
            [
                "label" => "Branch",
                "property" => "branch",
                "sortable" => true,
                "width" => "70px"
            ],
            [
                "label" => "Control",
                "property" => "control"
            ]
        ];
        foreach ($repos as $repo) {
            $branches = json_decode($repo->getBranch(), true);
            foreach ($branches as $branch) {

                $repoSource[] = [
                    "name" => '<a href="https://github.com/' . $repo->getFullName() . '">' . $repo->getFullName() . '</a>',
                    "info" => $this->getInfo($repo, $branch),
                    "branch" => $branch,
                    "control" => 'empty',
                    "org" => $repo->getOrganization()
                ];
            }
        }
        $showTable = true;
        $orgs = [$nickName];
        $githubApi = $this->getGithubApi();
        $orgsGithub = $githubApi->api('user')->organizations($nickName);
        foreach ($orgsGithub as $org) {
            $orgs[] = $org['login'];
        }
        if (empty($repoSource)) {
            $showTable = false;
        }
        return $this->getEngine()->render('watch/show.php', [
            'providers' => $this->getProviders(),
            'columns' => json_encode($columns),
            'items' => json_encode($repoSource),
            'showTable' => $showTable,
            'orgs' => $orgs,
            'readOnly' => $readOnly,
            'user' => $user
        ]);
    }

    protected function getInfo(Repo $repo, $branch)
    {
        $info = "";
        $providers = $this->getProviders();
        foreach ($providers as $provider) {
            $info .= $provider->getImage($repo, $branch);
        }
        return $info;
    }
}
