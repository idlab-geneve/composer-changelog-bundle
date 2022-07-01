<?php

namespace Idlab\ComposerChangelogBundle\Tests\Command;

use Idlab\ComposerChangelogBundle\Command\ComposerChangelogCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ComposerChangelogCommandTest extends TestCase
{
    public function testCommand()
    {

        $command = new ComposerChangelogCommand();
        $tester = new CommandTester($command);
        $tester->execute([]);
        var_dump($tester->getOutput());
        $tester->assertCommandIsSuccessful();
//
//        $command = $application->find('idlab:composer-changelog');
//
//        $commandTester->assertCommandIsSuccessful();
//
//        $output = $commandTester->getDisplay();
//        $this->assertStringContainsString('Username: Wouter', $output);
    }

}