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
use Sphring\MicroWebFramework\Model\UserRepo;

class AddRepoController extends AbstractCiWatchController
{
    const CACHE_REPO_ID = 'github_cache_repos_%s';
    const CACHE_REPO_NAME_ID = 'github_cache_repos_name_%s';

    public function action()
    {
        parent::action();
        if (!empty($_POST)) {
            return $this->actionAddRepo();
        }
        return $this->actionList();
    }

    public function actionAddRepo()
    {
        if (empty($_POST['id']) && empty($_POST['full_name'])) {
            $this->response->setStatusCode(404);
            return '';
        }
        $userRepoDao = MicroWebFrameworkRunner::getInstance()->getBean('dao.userrepo');
        ignore_user_abort(true);
        $entityManager = $this->getEntityManager();
        $repo = $entityManager->find(Repo::class, (int)$_POST['id']);
        if ($repo === null) {
            $this->createRepoFromGithub($_POST['full_name']);
            return '';
        }
        $user = $entityManager->find(User::class, $this->getUserSession()->getId());
        $githubApi = $this->getGithubApi();
        $fullname = explode('/', $_POST['full_name']);
        $branchesGithub = $githubApi->api('repo')->branches($fullname[0], $fullname[1]);
        $branches = [];
        foreach ($branchesGithub as $brancheGithub) {
            $branches[] = $brancheGithub['name'];
        }
        $userRepo = $userRepoDao->findByUserRepo($user, $repo);
        $userRepo->setWatch(($userRepo->getWatch() ? false : true));
        $repo->setBranch(json_encode($branches));
        $entityManager->persist($repo);
        $entityManager->persist($userRepo);
        $entityManager->flush();
        return '';
    }

    private function createRepoFromGithub($fullname)
    {
        $githubApi = $this->getGithubApi();
        $fullname = explode('/', $fullname);
        $repoGithub = $githubApi->api('repo')->show($fullname[0], $fullname[1]);
        $branchesGithub = $githubApi->api('repo')->branches($fullname[0], $fullname[1]);
        $branches = [];
        foreach ($branchesGithub as $brancheGithub) {
            $branches[] = $brancheGithub['name'];
        }
        $entityManager = $this->getEntityManager();
        $user = $entityManager->find(User::class, $this->getUserSession()->getId());

        $repo = new Repo();
        $repo->setId($repoGithub['id']);
        $repo->setFullName($repoGithub['full_name']);
        $repo->setBranch(json_encode($branches));

        $userRepo = new UserRepo();
        $userRepo->setRepo($repo);
        $userRepo->setUser($user);
        $userRepo->setWatch(true);
        $repo->addUserRepoAssociation($userRepo);
        $user->addUserRepoAssociation($userRepo);
        $repo->setName($repoGithub['name']);

        $entityManager->persist($userRepo);
        $entityManager->persist($repo);
        $entityManager->flush();
    }

    public function actionList()
    {
        $cache = $this->getCache();
        $cacheId = sprintf($this::CACHE_REPO_ID, $this->getUserSession()->getId());
        $cacheIdName = sprintf($this::CACHE_REPO_NAME_ID, $this->getUserSession()->getId());
        if ($cache->contains($cacheId) && $cache->contains($cacheIdName)) {
            $repos = $cache->fetch($cacheId);
            $repoName = $cache->fetch($cacheIdName);
        } else {
            $this->getReposFromGithub($repos, $repoName);
            $cache->save($cacheId, $repos);
            $cache->save($cacheIdName, $repoName);
        }

        return $this->getEngine()->render('watch/addRepo.php', ['repos' => $repos, 'repoName' => $repoName]);
    }

    private function getReposFromGithub(&$repos, &$repoName)
    {
        $githubApi = $this->getGithubApi();
        $repos = [];
        $repoName = [];
        $nickName = $this->getUserSession()->getNickname();
        $repoName[] = $nickName;
        $repos[$nickName] = $githubApi->api('user')->repositories($nickName);
        $orgs = $githubApi->api('user')->organizations($nickName);
        foreach ($orgs as $org) {
            $repoName[] = $org['login'];
            $repos[$org['login']] = $githubApi->api('user')->repositories($org['login']);
        }
    }
}
