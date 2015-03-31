<?php
/**
 * Copyright (C) 2015 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 01/04/2015
 */


namespace Sphring\MicroWebFramework\Controller\Ciwatch;


use Sphring\MicroWebFramework\Model\User;

class ShowReadOnlyController extends ShowController
{
    public function action()
    {
        $args = $this->getArgs();
        $user = $this->getEntityManager()->find(User::class, (int)$args['id']);
        return $this->renderShow($user, true);
    }
}