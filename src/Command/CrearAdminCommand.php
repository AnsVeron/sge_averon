<?php
namespace App\Command;
use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
#[AsCommand(
    name: 'app:crear-admin',
    description: 'Crea un administrador del sistema'
)]
class CrearAdminCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private UsuarioRepository $usuarioRepository
    ) {
        parent::__construct();
    }
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);
        $io->title('Alta de administrador');
        $email = trim((string) $io->ask('Correo electrónico'));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $io->error('Correo electrónico no válido.');
            return Command::FAILURE;
        }
        if ($this->usuarioRepository->findOneBy(['email' => $email])) {
            $io->error('Ya existe un usuario con ese correo.');
            return Command::FAILURE;
        }
        $helper = $this->getHelper('question');
        $pregunta = new Question('Contraseña: ');
        $pregunta->setHidden(true);
        $pregunta->setHiddenFallback(false);
        $password = $helper->ask($input, $output, $pregunta);
        if (!is_string($password) || strlen($password) < 12) {
            $io->error('La contraseña debe tener al menos 12 caracteres.');
            return Command::FAILURE;
        }
        $confirmacion = new Question('Confirmar contraseña: ');
        $confirmacion->setHidden(true);
        $confirmacion->setHiddenFallback(false);
        $repetida = $helper->ask($input, $output, $confirmacion);
        if ($password !== $repetida) {
            $io->error('Las contraseñas no coinciden.');
            return Command::FAILURE;
        }
        $usuario = new Usuario();
        $usuario->setEmail($email);
        $usuario->setRoles(['ROLE_ADMIN']);
        $hash = $this->passwordHasher->hashPassword(
            $usuario,
            $password
        );
        $usuario->setPassword($hash);
        $this->entityManager->persist($usuario);
        $this->entityManager->flush();
        $io->success('Administrador creado correctamente.');
        return Command::SUCCESS;
    }
}