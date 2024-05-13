<?php

namespace Database\Seeders;

use App\Services\UserWordCollectionService;
use App\Services\WordCollectionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordCollectionSeeder extends Seeder
{

    private WordCollectionService $wordCollection;
    private UserWordCollectionService $userWordCollectionService;

    /**
     * @param WordCollectionService $wordCollection
     */
    public function __construct(WordCollectionService $wordCollection, UserWordCollectionService $userWordCollectionService)
    {
        $this->wordCollection = $wordCollection;
        $this->userWordCollectionService = $userWordCollectionService;
    }


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData1 = [
            'name' => 'Tourism',
            'text'=>'Discover the enchanting beauty of Italy\'s Amalfi Coast. With its picturesque cliffside villages, azure waters, and vibrant culture, the Amalfi Coast offers an unforgettable travel experience. Whether you\'re exploring the historic streets of Positano, indulging in delicious Mediterranean cuisine, or lounging on pristine beaches, every moment is a postcard-worthy memory waiting to be captured.',
            'status'=>'public',
            'userId'=>1,
        ];
        $categoryData2 = [
            'name' => 'Technologies',
            'text'=>'Welcome to the future of transportation with autonomous vehicles. These cutting-edge cars are revolutionizing the way we travel, promising safer roads, reduced congestion, and increased efficiency. By harnessing the power of artificial intelligence and advanced sensors, autonomous vehicles are paving the way for a more sustainable and convenient transportation ecosystem.',
            'status'=>'public',
            'userId'=>1,
        ];
        $wordCollection1 = $this->wordCollection->createWordCollection($categoryData1);
        $wordCollection2 = $this->wordCollection->createWordCollection($categoryData2);
        $this->userWordCollectionService->startCollection(1, $wordCollection1['id']);
        $this->userWordCollectionService->makeUserAuthorOfCollection(1, 1);
        $this->userWordCollectionService->startCollection(1, 2);
        $this->userWordCollectionService->makeUserAuthorOfCollection(1, 2);
    }
}
