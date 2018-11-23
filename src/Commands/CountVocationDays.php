<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 25-Nov-18
 * Time: 16:31
 */

namespace App\Commands;


use App\Output\DataOutputInterface;
use App\Output\FileLogger;
use App\Readers\CsvReader;
use App\Readers\ResourceParserInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\ResultsRepository;
use App\Result;
use Carbon\Carbon;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CountVocationDays extends Command
{

    protected $resourceParser=false;
    protected $loggers=[];
    protected $path;

    protected function configure(){
        $this->setName("count")
            ->setDescription("Counts vacation days for a given year")
            ->addArgument('Year', InputArgument::REQUIRED, 'What year should be used?)')
            ->addArgument('Path', InputArgument::OPTIONAL, 'Data resource',"resources/employees.csv");
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $year = $input->getArgument('Year');
        $this->path = $input->getArgument('Path');

        if(!strlen($year) === 4){
            echo "Wrong Year";exit;
        }
        define("INPUT_YEAR",(int)$year);

        $employees = $this->reader()->read();

        EmployeeRepository::fill($employees);

        $result = $this->calculateVocationDays();
        ResultsRepository::add($result);

        foreach ($this->logger() as $logger){
            $logger->execute();
        }

        $output->writeln('Task was complete!');

    }

    /**
     * Calculates employee vocation days based on year and how long have they been working
     *
     * @return Result
     * @throws \ReflectionException
     */
    protected function calculateVocationDays()
    {

        $result = new Result(INPUT_YEAR." Vocation days");
        $timestamp_year = Carbon::now()->setYear(INPUT_YEAR)->timestamp;
        foreach (EmployeeRepository::where('hired',"<=",$timestamp_year) as $member) {
            if ($member->is_experienced()) {
                $days_off = floor($member->get_experience() / 5) + $member->vocation_days;
                $result->setResult($member->name.": ".$days_off);
            }

            if ($member->is_newComer()) {
                $start_date = Carbon::createFromTimestamp($member->hired)->addMonth()->set('day', 1)->timestamp;
                $months_worked = dateDiff($start_date, 'month');
                $days_off = $months_worked * (floor(26 / 12));
                $result->setResult($member->name.": ".$days_off);
            }

            if ($member->is_Usual()) {
                $days_off = $member->vocation_days;
                $result->setResult($member->name.": ".$days_off);
            }
        }

        return $result;
    }

    /**
     * Adds new Logger if parameter was provided
     * or return existing loggers array
     * By default returns Log to a file logger
     *
     * @param bool|array $output
     * @return array|bool
     */
    public function logger($output=false){
        if($output and $output instanceof DataOutputInterface){
            $this->loggers[]=$output;
            return true;
        }
        return empty($this->loggers) ? [new FileLogger()] : $this->loggers;
    }

    /**
     * Sets new Resource reader if param was provided
     * or returns existing resource reader
     * By default returns CSV data reader
     *
     * @param bool $resourceParser
     * @return CsvReader|bool
     */
    public function reader($resourceParser=false){
        if($resourceParser and $resourceParser instanceof ResourceParserInterface){
            $this->resourceParser=$resourceParser;
            return true;
        }
        return !$this->resourceParser ? new CsvReader($this->path) : $this->resourceParser;
    }

}