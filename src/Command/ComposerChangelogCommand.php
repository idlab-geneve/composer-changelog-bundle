<?php

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
    public function __construct(private ?string $format = null, private ?string $output_file = null)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $cmd = 'git log --follow --pretty=\'format:%H||%ad||%s\' -- composer.lock';

        $output = [];
        $res = exec($cmd, $output);
        $io->writeln("# Composer dependecies changelog\n");

        $previousHash = null;
        $previousMessage = null;
        foreach ($output as $line) {
            [$hash, $date, $message] = explode("||", $line);
            $changes = [];
            if ($previousHash && $previousMessage) {
                $cmd = sprintf('php ./vendor/bin/composer-lock-diff --md --from %s --to %s', $hash, $previousHash);
            } else {
                $previousMessage = 'Uncommited composer.lock. Once commited, the commit message will apear here :-)';
                $cmd = sprintf('php ./vendor/bin/composer-lock-diff --md --from %s', $hash);
            }
            $res = exec($cmd, $changes);
            if ($changes) {
                $io->writeln('### '.date('Y-m-d H:i', strtotime($date)).' - '.$previousMessage."\n");
                $io->writeln($changes);
            }
            $previousMessage = $message;
            $previousHash = $hash;
        }

        $io->writeln(sprintf('This file was generated on %s by running command `php bin/console idlab:composer-changelog`', date('Y-m-d H:i:s')));
        return Command::SUCCESS;
    }
}
