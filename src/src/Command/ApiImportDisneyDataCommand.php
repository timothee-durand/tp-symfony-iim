<?php

namespace App\Command;

use App\Entity\Character;
use App\Entity\Film;
use App\Entity\ParkAttractions;
use App\Entity\TvShows;
use App\Entity\VideoGames;
use App\Repository\FilmRepository;
use App\Repository\ParkAttractionsRepository;
use App\Repository\TvShowsRepository;
use App\Repository\VideoGamesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'api:import-disney-data',
    description: 'Import data from disney api',
)]
class ApiImportDisneyDataCommand extends Command
{

    private HttpClientInterface $client;
    private EntityManagerInterface $entityManager;
    private FilmRepository $filmRepository;
    private ParkAttractionsRepository $parkAttractionsRepository;
    private TvShowsRepository $tvShowsRepository;
    private VideoGamesRepository $videoGamesRepository;

    public function __construct(
        HttpClientInterface $client,
        EntityManagerInterface $entityManager,
        FilmRepository $filmRepository,
        ParkAttractionsRepository $parkAttractionsRepository,
        TvShowsRepository $tvShowsRepository,
        VideoGamesRepository $videoGamesRepository,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->client = $client;
        $this->entityManager = $entityManager;
        $this->filmRepository = $filmRepository;
        $this->parkAttractionsRepository = $parkAttractionsRepository;
        $this->tvShowsRepository = $tvShowsRepository;
        $this->videoGamesRepository = $videoGamesRepository;
    }

    protected function configure(): void
    {
        $this->addArgument('pageNumber', InputArgument::OPTIONAL, 'Number of page to import');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $pageNumber = $input->getArgument('pageNumber');


        if (!$pageNumber) {
            $pageNumber = $io->askQuestion(new Question('Please enter the number of page to import'));
        }
        $io->info('Start getting data from Disney API - '. $pageNumber .' pages');
        $this->importDisneyData($pageNumber, $io);
        return Command::SUCCESS;
    }

    private function importDisneyData($characterNumber, SymfonyStyle $io)
    {
        $pageNumber = 1;
        do {
            $io->info('Importing page ' . $pageNumber);
            $url = 'https://api.disneyapi.dev/characters?page=' . $pageNumber;
            $result = $this->client->request('GET', $url);
            $body = $result->toArray();
            $characters = $body['data'];
            $totalPageNumber = $body['totalPages'];
            foreach ($characters as $character) {
                $importedCharacter = $this->importCharacter($character);
                if($importedCharacter) $io->text('-- Character ' . $importedCharacter->getName() . ' imported');
            }
            $pageNumber++;
            $this->entityManager->flush();
        } while ($pageNumber < $characterNumber && $pageNumber < $totalPageNumber);


    }

    private function importCharacter(array $arrayCharacter): Character | null
    {
        if(!isset($arrayCharacter['imageUrl'])) return null;
        $character = new Character();
        $character->setName($arrayCharacter['name']);
        $character->setImageUrl($arrayCharacter['imageUrl']);
        if(!empty($arrayCharacter['films'])) {
            foreach ($arrayCharacter['films'] as $filmName) {
                $film = $this->filmRepository->findOneBy(['name' => $filmName]);
                if(!$film) {
                    $film = new Film();
                    $film->setName($filmName);
                    $this->entityManager->persist($film);
                }
                $character->addFilm($film);
            }
        }
        if(!empty($arrayCharacter['parkAttractions'])) {
            foreach ($arrayCharacter['parkAttractions'] as $parkAttractionName) {
                $attraction = $this->parkAttractionsRepository->findOneBy(['name' => $parkAttractionName]);
                if(!$attraction) {
                    $attraction = new ParkAttractions();
                    $attraction->setName($parkAttractionName);
                    $this->entityManager->persist($attraction);
                }
                $character->addParkAttraction($attraction);
            }
        }
        if(!empty($arrayCharacter['tvShows'])) {
            foreach ($arrayCharacter['tvShows'] as $showName) {
                $show = $this->tvShowsRepository->findOneBy(['name' => $showName]);
                if(!$show) {
                    $show = new TvShows();
                    $show->setName($showName);
                    $this->entityManager->persist($show);
                }
                $character->addTvShow($show);
            }
        }
        if(!empty($arrayCharacter['videoGames'])) {
            foreach ($arrayCharacter['videoGames'] as $gameName) {
                $game = $this->videoGamesRepository->findOneBy(['name' => $gameName]);
                if(!$game) {
                    $game = new VideoGames();
                    $game->setName($gameName);
                    $this->entityManager->persist($game);
                }
                $character->addVideoGame($game);
            }
        }

        $this->entityManager->persist($character);
        return $character;
    }
}
