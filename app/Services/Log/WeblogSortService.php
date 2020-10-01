<?php

namespace App\Services\Log;

class WeblogSortService implements WeblogSortInterface
{
    /**
     * @param string $fileContents
     * @return array
     */
    public function sort(string $fileContents): array
    {
        $mostVisitedPages = [];
        $uniquePagesViews = [];

        $logsArray = explode(PHP_EOL, $fileContents);

        if (empty($logsArray)) return [$mostVisitedPages, $uniquePagesViews];

        foreach ($logsArray as $log) {
            if (empty($log)) continue;

            $line = explode(' ', $log);

            $url = $line[0];
            $ip = $line[1];

            // unique views logic
            if (!isset($uniquePagesViews[$url])) $uniquePagesViews[$url] = [];
            if (!in_array($ip, $uniquePagesViews[$url])) $uniquePagesViews[$url][] = $ip;

            //most visited Pages logic
            isset($mostVisitedPages[$url])
                ? $mostVisitedPages[$url]++
                : $mostVisitedPages[$url] = 1;
        }

        foreach ($uniquePagesViews as $key => $value) {
            $uniquePagesViews[$key] = count($value);
        }

        arsort($mostVisitedPages);
        arsort($uniquePagesViews);

        return [$mostVisitedPages, $uniquePagesViews];
    }
}
