<?php

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
        return $this->extension;    }

}