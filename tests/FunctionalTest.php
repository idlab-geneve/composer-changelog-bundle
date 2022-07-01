<?php

namespace Idlab\ComposerChangelogBundle\Tests;

use Idlab\ComposerChangelogBundle\Command\ComposerChangelogCommand;
use Idlab\ComposerChangelogBundle\IdlabComposerChangelogBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        $kernel = new IdlabComposerChangelogTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $service = $container->get('idlab_composer_changelog.composer_changelog_command');
        $this->assertInstanceOf(ComposerChangelogCommand::class, $service);
    }
}

class IdlabComposerChangelogTestingKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        return [
            new IdlabComposerChangelogBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {

    }


}