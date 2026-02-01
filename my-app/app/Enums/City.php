<?php

namespace App\Enums;

enum City: string {
    case Tokyo = 'Tokyo';
    case Osaka = 'Osaka';
    case Sapporo = 'Sapporo';
    case Fukuoka = 'Fukuoka';
    case Nagoya = 'Nagoya';
    case Naha = 'Naha';

    public function getCoordinates(): array
    {
        return match($this) {
            self::Tokyo => ['latitude' => 35.682839, 'longitude' => 139.759455],
            self::Osaka => ['latitude' => 34.693737, 'longitude' => 135.502165],
            self::Sapporo => ['latitude' => 43.062096, 'longitude' => 141.354376],
            self::Fukuoka => ['latitude' => 33.590354, 'longitude' => 130.401716],
            self::Nagoya => ['latitude' => 35.181472, 'longitude' => 136.906586],
            self::Naha => ['latitude' => 26.212401, 'longitude' => 127.680932],
        };
    }

    public function getKanjiName(): string
    {
        return match($this) {
            self::Tokyo => '東京',
            self::Osaka => '大阪',
            self::Sapporo => '札幌',
            self::Fukuoka => '福岡',
            self::Nagoya => '名古屋',
            self::Naha => '那覇',
        };
    }
    
    public static function getAllCities(): array
    {
        return array_map(fn($city) => [
            'english_name' => $city->value,
            'kanji_name' => $city->getKanjiName(),
        ],City::cases());  
    }
}