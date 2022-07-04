<?php

/*
 * This file is part of the Idlab Composer Changelog Generator.
 *
 * (c) Idlab - Michael Vetterli (michael@idlab.ch)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Idlab\ComposerChangelogBundle;

use Idlab\ComposerChangelogBundle\DependencyInjection\IdlabComposerChangelogExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class IdlabComposerChangelogBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new IdlabComposerChangelogExtension();
        }

        return $this->extension;
    }
}
