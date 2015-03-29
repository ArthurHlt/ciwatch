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


use Guzzle\Http\Client;
use Sphring\MicroWebFramework\Model\Repo;

class TravisProvider extends AbstractProvider
{

    /**
     * @var string
     */
    private $apiUrl;

    public function getImage(Repo $repo, $branch = "master")
    {
        $imgText = '<a href="https://travis-ci.org/%s"><img alt="Build Status %s" src="https://travis-ci.org/%s.svg?branch=%s"></a>';
        return sprintf($imgText, $repo->getFullName(), $repo->getFullName(), $repo->getFullName(), $branch);
    }

    public function runInspection(Repo $repo, $branch = "master")
    {
        $token = $_SESSION['token'];

        $clientTravis = $client = new Client([
            'base_url' => $this->apiUrl,
            'defaults' => [
                'headers' => [
                    "User-Agent" => 'CIWatch/1.0.0',
                    'Accept' => 'application/vnd.travis-ci.2+json'
                ],
            ]
        ]);
        $tokenToPass = ['github_token' => $token];
        $tokenToPass = json_encode($tokenToPass);
        $response = $clientTravis->post('/auth/github', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Content-Length' => strlen($tokenToPass)
            ],
            'body' => $tokenToPass,
        ])->send();
        $travisToken = $response->json();
        $travisToken = $travisToken['access_token'];
        $response = $clientTravis->get('/repos/' . $repo->getFullName(), [
            'headers' => [
                'Authorization' => 'token ' . $travisToken
            ]
        ])->send();
        $repoTravis = $response->json();
        $lastBuild = $repoTravis['last_build_id'];
        $clientTravis->post('/builds/' . $lastBuild . '/restart', [
            'headers' => [
                'Authorization' => 'token ' . $travisToken
            ]
        ])->send();
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @Required
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }
}
