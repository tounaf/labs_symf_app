<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:user:create',
    description: 'Add a short description for your command',
)]
class UserCreateCommand extends Command
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
            ->addArgument('username', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('firstname', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('lastname', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('password', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('phone', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('address', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
        try {

            $user = (new User())->setUsername($input->getArgument('username'))
                ->setFirstname($input->getArgument('firstname'))
                ->setLastname($input->getArgument('lastname'))
                ->setPhoneNumber($input->getArgument('phone'))
            ;
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $input->getArgument('password')));
            $this->userRepository->add($user, true);
            $io->success('User added');
        } catch (\Exception $exception) {
            $io->error('Erreur ');
        }

        return Command::SUCCESS;
    }
}
