<?php

namespace app\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Webman\Console\Util;


class MakeDaoCommand extends Command
{
    protected static $defaultName = 'make:dao';
    protected static $defaultDescription = 'Make dao';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'Dao Name');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln('Make dao ' . $name);

        $class = Util::nameToClass($name);
        $tube = Util::classToName($name);

        $file = app_path() . "/dao/$class.php";
        $this->createDao($class, $tube, $file);

        return self::SUCCESS;
    }

    protected function createDao($class, $tube, $file)
    {
        $modelName = str_replace('Dao', 'Model', $class);
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $content = <<<EOF
<?php

namespace app\\dao;

use app\\model\\$modelName;

class $class extends BaseDao
{

    /**
     * @inheritDoc
     */
    protected function setModel(): string
    {
        return $modelName::class;
    }
}

EOF;
        file_put_contents($file, $content);
    }

}
