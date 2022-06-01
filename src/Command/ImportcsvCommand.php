<?php

namespace App\Command;

use App\Entity\Gare;
use App\Entity\Ligne;
use App\Entity\LigneStations;
use App\Entity\Station;
use App\Repository\GareRepository;
use App\Repository\LigneRepository;
use App\Repository\LigneStationsRepository;
use App\Repository\StationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[AsCommand(
    name: 'importcsv',
    description: 'import le fichier csv',
)]
class ImportcsvCommand extends Command
{
    

    private EntityManagerInterface $entityManagerInterfarce;
    private string $dataDirectory;
    private SymfonyStyle $io;
    private GareRepository $gareRepository;
    private StationRepository $stationRepository;
    private LigneRepository $ligneRepository;
    private LigneStations $ligneStationsRepository;


    public function __construct(EntityManagerInterface $entityManagerInterface,GareRepository $gareRepository,StationRepository $stationRepository,string $dataDirectory,LigneRepository $ligneRepository,LigneStationsRepository $ligneStationsRepository)
    {
        parent::__construct();
        $this->EntityManagerInterfarce = $entityManagerInterface;
        $this->GareRepository = $gareRepository;
        $this->StationRepository = $stationRepository;
        $this->LigneRepository = $ligneRepository;
        $this->LigneStationsRepository = $ligneStationsRepository;
        $this->dataDirectory =  $dataDirectory;

        
    }
   
    protected function configure(): void
    {
      
    }

    public function initialize(InputInterface $input, OutputInterface $output): void
    {

        $this->io = new SymfonyStyle($input, $output);
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->createDataMetro();
        return Command::SUCCESS;

        }


        private function getData(): array
        {
            $file = $this->dataDirectory . 'exports-des-gares-idf.csv';
    
            $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
            return $serializer->decode(file_get_contents($file), 'csv', [CsvEncoder::DELIMITER_KEY => ';']);
            
        }


        private function createDataMetro(): void
        {
            $this->io->section('Création des ligne a partir du fichier ');
    
            $metroCreated = 0;
    
            foreach ($this->getData() as $row) {
    
                $gare = new Gare();
                $station = new Station();
                $ligne = new Ligne();
                $ligneStation = new LigneStations();
                
                $gare->setNomGare($row['nom_gare']);
                $gare->setNomIV($row["nom_iv"]);
                $gare->setNomLong($row['nom_long']);
                

                $ligne->setCodLigf($row['cod_ligf']);
                $ligne->setIndiceLig($row['indice_lig']);
                $ligne->setResCom($row['res_com']);
                $ligne->setLigneCode($row['ligne_code']);

                $station->setIdrefliga($row['idrefliga']);
                $station->setGaresId($row['gares_id']);
                $station->setGeoPoint($row['geo_point']);
                $station->setGeoShape($row['geo_shape']);
                $station->setX($row['x']);
                $station->setY($row['y']);
                $station->setTermetro($row['termetro']);
                $station->setGare($gare);

                $ligneStation->setStation($station);
                $ligneStation->setLigne($ligne);
                $ligneStation->setLigneCode($row['ligne_code']);
                
                $this->entityManagerInterfarce->createQuery('SELECT COUNT(nom_gare) FROM gare WHERE nom_gare = "Strasbourg-Saint-Denis"');

                
                $this->EntityManagerInterfarce->persist($gare);
                $this->EntityManagerInterfarce->persist($station);
                $this->EntityManagerInterfarce->persist($ligne);
                $this->EntityManagerInterfarce->persist($ligneStation);


            }
                
    
            $this->EntityManagerInterfarce->flush();
    
            if ($metroCreated > 1) {
                $string = "{$metroCreated} Metro crée en base de donnéés.";
            } elseif ($metroCreated === 1) {
                $string = '1 utilisateur a créee en base de données';

            } else {
                $string = "aucun utilisateur  dans la base de données";
            }

    
            $this->io->success($string);
            $metroCreated++;

        }






    }


