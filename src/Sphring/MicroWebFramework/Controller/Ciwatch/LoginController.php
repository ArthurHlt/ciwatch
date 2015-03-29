<?php
/**
 * Copyright (C) 2014 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 28/03/2015
 */

namespace Sphring\MicroWebFramework\Controller\Ciwatch;


use Sphring\MicroWebFramework\Model\User;

class LoginController extends AbstractCiWatchController
{
    public function action()
    {
        $provider = $this->getGithubProvider();
        $token = (empty($_SESSION['token']) ? null : $_SESSION['token']);
        if (!isset($_GET['code']) && empty($token)) {

            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->state;
            header('Location: ' . $authUrl);
            exit;
        }
        if (isset($_GET['code'])) {
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);
            $_SESSION['token'] = $token->accessToken;
        }

        // Optional: Now you have a token you can look up a users profile data


        // We got an access token, let's now get the user's details
        $userDetails = $provider->getUserDetails($token);
        $entityManager = $this->getEntityManager();
        $user = $entityManager->find(User::class, $userDetails->uid);
        if ($user === null) {
            $user = new User();
            $user->setId($userDetails->uid);
        }

        $user->setEmail($userDetails->email);
        $user->setImageUrl($userDetails->imageUrl);
        $user->setName($userDetails->name);
        $user->setNickname($userDetails->nickname);
        $entityManager->persist($user);
        $entityManager->flush();
        $_SESSION['user'] = $user->getId();

        $this->redirect('index');
    }
}
