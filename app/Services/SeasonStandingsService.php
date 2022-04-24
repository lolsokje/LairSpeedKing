<?php

namespace App\Services;

use App\Models\Round;
use App\Models\Season;
use Illuminate\Support\Collection;

class SeasonStandingsService
{
    private array $points = [];
    private array $standings = [];

    public function getStandings(Season $season): array
    {
        $this->buildPointsArray($season->points);

        $rounds = $season->rounds;

        foreach ($rounds as $round) {
            $this->getRoundResult($round);
        }

        $this->sortStandings();

        return array_values($this->standings);
    }

    private function buildPointsArray(Collection $pointsSystem): void
    {
        foreach ($pointsSystem as $system) {
            $this->points[$system->position] = $system->points;
        }
    }

    private function getRoundResult(Round $round): void
    {
        $results = $round->timesForLeaderboard();

        foreach ($results as $key => $result) {
            $position = $key + 1;
            $user = $result['user'];
            $id = $user['id'];

            $this->initialiseUserResult($id, $user);

            $this->standings[$id]['rounds'][$round->id] = $position;
            $this->standings[$id]['total'] += $this->getPointsScored($position);
        }
    }

    private function initialiseUserResult(int $id, array $user): void
    {
        if (!array_key_exists($id, $this->standings)) {
            $this->standings[$id] = [
                'username' => $user['username'],
                'avatar' => $user['avatar'],
                'total' => 0,
            ];
        }
    }

    private function getPointsScored($position): int
    {
        return $this->points[$position] ?? 0;
    }

    private function sortStandings(): void
    {
        uasort($this->standings, function ($a, $b) {
            if ($a['total'] === $b['total']) {
                return 0;
            }
            return $a['total'] < $b['total'];
        });
    }
}
