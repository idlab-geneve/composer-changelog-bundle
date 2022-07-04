<?php

/*
 * This file is part of the Idlab Composer Changelog Generator.
 *
 * (c) Idlab - Michael Vetterli (michael@idlab.ch)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Idlab\ComposerChangelogBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'idlab:composer-changelog',
    description: 'This command generates a changelog for composer dependencies',
)]
class ComposerChangelogCommand extends Command
{
    public function __construct(private ?string $format = 'md')
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $format = '';
        if (\in_array($this->format, ['md', 'json'])) {
            $format = '--'.$this->format;
        } elseif ('json-pretty' === $this->format) {
            $format = '--json --pretty';
        }
        $io = new SymfonyStyle($input, $output);
        $cmd = 'git log --follow --pretty=\'format:%H||%ad||%s\' -- composer.lock';

        $output = [];
        $res = exec($cmd, $output);
        $io->writeln("# Composer dependecies changelog\n");

        $previousHash = null;
        $previousMessage = null;
        foreach ($output as $line) {
            [$hash, $date, $message] = explode('||', $line);
            $changes = [];
            if ($previousHash && $previousMessage) {
                $cmd = sprintf('php ./vendor/bin/composer-lock-diff %s --from %s --to %s', $format, $hash, $previousHash);
            } else {
                $previousMessage = 'Uncommited composer.lock. Once commited, the commit message will apear here :-)';
                $cmd = sprintf('php ./vendor/bin/composer-lock-diff %s --from %s', $format, $hash);
            }
            $res = exec($cmd, $changes);
            if ($changes) {
                $io->writeln('### '.date('Y-m-d H:i', strtotime($date)).' - '.$previousMessage."\n");
                $io->writeln($changes);
            }
            $previousMessage = $message;
            $previousHash = $hash;
        }

        $io->writeln(sprintf('This file was generated on %s by running command `php bin/console idlab:composer-changelog`'.\PHP_EOL, date('Y-m-d H:i:s')));
        $io->writeln('The command is provided by [idlab/composer-changelog-bundle](https://github.com/idlab-geneve/composer-changelog-bundle) which is an intergration of the great [composer-lock-diff](https://github.com/davidrjonas/composer-lock-diff) by [davidrjonas](https://github.com/davidrjonas)');

        return Command::SUCCESS;
    }
}
