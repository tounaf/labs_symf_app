<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Repository\UserRepository;

#[AsCommand(
    name: 'app:user:change-password',
    description: 'Add a short description for your command',
)]
class UserChangePasswordCommand extends Command
{

    protected UserPasswordHasherInterface $userPasswordHasher;
    protected UserRepository $userRepository;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher, UserRepository $userRepository, string $name = null)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->userRepository = $userRepository;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::OPTIONAL, 'Username')
            ->addArgument('password', InputArgument::OPTIONAL, 'Password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if($user = $this->userRepository->findOneBy(['username' => $input->getArgument('username')])) {
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $input->getArgument('password')));
            $this->userRepository->add($user, true);
            $io->success('User password changed');
        } else {
            $io->warning('User password changed');
        }

        return Command::SUCCESS;
    }
}
