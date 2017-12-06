<?php

namespace AppBundle\Command;

use AppBundle\Entity\Sneakers;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\VarDumper\Cloner\Data;
use GuzzleHttp;
use GuzzleHttp\Client;

class AddSneakersCommand extends ContainerAwareCommand {

    protected $em;
    private $sneakers = array('air force 2', 'air jordan', 'cortez', 'flyknit trainer', 'vans sk8', 'asics gel-lyte', 'puma fenty', 'vapor max', 'blazer low', 'air max 95');

    protected function configure() {
        $this
                ->setName('task:add:sneakers');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $client = new Client();

        shuffle($this->sneakers);
        foreach ($this->sneakers as $name) {
            $output->writeln([ 'POST', $name,]);
            $response = $client->request('POST', 'http://feetzi/sneakers.json', [
                'json' => ['name' => $name],
                'headers' => ['Content-Type' => 'application/json'],
            ]);
            if (201 == $response->getStatusCode())
                $output->writeln('ok');
            else
                $output->writeln('something is wrong');
        }
    }

}
