<?php

namespace Tests\Feature;

use App\Utils;
use Tests\Data\DecryptSlipsData;
use Tests\TestCase;

class DecryptSlipsPerformanceTest extends TestCase
{
    /**
     * Copy of Utils::DECRYPT_SLIP method with resource measurement.
     */
    public static function DECRYPT_SLIP($file, $aesKey, $iv, $privateKey): array
    {
        $resources = [];

        // Decrypt Private Key using Laravel ENV decryption
        $start = microtime(true);
        $startMemory = memory_get_usage();
        $startCpu = getrusage();
        $privateKey = Utils::DECRYPT_ENV($privateKey);
        $wallClockTime = microtime(true) - $start;
        $resources[] = [
            'operation' => 'DECRYPT ENV (Private Key)',
            'Execution Time (s)' => $wallClockTime,
            'RAM (KB)' => (memory_get_usage() - $startMemory) / 1024,
            'CPU Time (s)' => self::calculateCpuCost($startCpu, getrusage()),
        ];

        // Decrypt AES Key using RSA
        $start = microtime(true);
        $startMemory = memory_get_usage();
        $startCpu = getrusage();
        $aesKey = Utils::DECRYPT_RSA($aesKey, $privateKey);
        $wallClockTime = microtime(true) - $start;
        $resources[] = [
            'operation' => 'DECRYPT RSA (AES Key)',
            'Execution Time (s)' => $wallClockTime,
            'RAM (KB)' => (memory_get_usage() - $startMemory) / 1024,
            'CPU Time (s)' => self::calculateCpuCost($startCpu, getrusage()),
        ];

        // Decrypt IV using Laravel ENV decryption
        $start = microtime(true);
        $startMemory = memory_get_usage();
        $startCpu = getrusage();
        $iv = Utils::DECRYPT_ENV($iv);
        $wallClockTime = microtime(true) - $start;
        $resources[] = [
            'operation' => 'DECRYPT ENV (IV)',
            'Execution Time (s)' => $wallClockTime,
            'RAM (KB)' => (memory_get_usage() - $startMemory) / 1024,
            'CPU Time (s)' => self::calculateCpuCost($startCpu, getrusage()),
        ];

        // Decrypt Data with AES
        $start = microtime(true);
        $startMemory = memory_get_usage();
        $startCpu = getrusage();
        $decryptedData = collect(
            json_decode(json_decode(Utils::DECRYPT_AES($file, $iv, $aesKey)))
        )->toArray();
        $wallClockTime = microtime(true) - $start;
        $resources[] = [
            'operation' => 'DECRYPT AES (Data)',
            'Execution Time (s)' => $wallClockTime,
            'RAM (KB)' => (memory_get_usage() - $startMemory) / 1024,
            'CPU Time (s)' => self::calculateCpuCost($startCpu, getrusage()),
        ];

        return $resources;
    }

    /**
     * Calculate CPU cost in seconds.
     */
    private static function calculateCpuCost($start, $end): float
    {
        $userTimeStart = $start['ru_utime.tv_sec'] + $start['ru_utime.tv_usec'] / 1e6;
        $systemTimeStart = $start['ru_stime.tv_sec'] + $start['ru_stime.tv_usec'] / 1e6;

        $userTimeEnd = $end['ru_utime.tv_sec'] + $end['ru_utime.tv_usec'] / 1e6;
        $systemTimeEnd = $end['ru_stime.tv_sec'] + $end['ru_stime.tv_usec'] / 1e6;

        return ($userTimeEnd - $userTimeStart) + ($systemTimeEnd - $systemTimeStart);
    }

    /**
     * Print performance metrics in a table.
     */
    /**
     * Print performance metrics in a well-aligned table.
     */
    protected function printPerformanceTable($title, $results)
    {
        // Calculate maximum widths for each column
        $colWidths = [
            'operation' => max(array_map('strlen', array_column($results, 'operation'))),
            'Execution Time (s)' => max(strlen('Execution Time (s)'), ...array_map(fn($r) => strlen(number_format($r['Execution Time (s)'], 5)), $results)),
            'RAM (KB)' => max(strlen('RAM Usage (KB)'), ...array_map(fn($r) => strlen(number_format($r['RAM (KB)'], 2)), $results)),
            'CPU Time (s)' => max(strlen('CPU Time (s)'), ...array_map(fn($r) => strlen(number_format($r['CPU Time (s)'], 5)), $results)),
        ];

        $colWidths['operation'] += 2; // Add padding
        $colWidths['Execution Time (s)'] += 2;
        $colWidths['RAM (KB)'] += 2;
        $colWidths['CPU Time (s)'] += 2;

        // Table header
        echo "\n$title\n";
        echo str_repeat('-', array_sum($colWidths) + 9) . "\n"; // +9 for column separators
        printf(
            "| %-{$colWidths['operation']}s | %-{$colWidths['Execution Time (s)']}s | %-{$colWidths['RAM (KB)']}s | %-{$colWidths['CPU Time (s)']}s |\n",
            'Cryptographic Operation',
            'Execution Time (s)',
            'RAM Usage (KB)',
            'CPU Time (s)'
        );
        echo str_repeat('-', array_sum($colWidths) + 9) . "\n";

        // Table rows
        foreach ($results as $result) {
            printf(
                "| %-{$colWidths['operation']}s | %-{$colWidths['Execution Time (s)']}s | %-{$colWidths['RAM (KB)']}s | %-{$colWidths['CPU Time (s)']}s |\n",
                $result['operation'],
                number_format($result['Execution Time (s)'], 5),
                number_format($result['RAM (KB)'], 2),
                number_format($result['CPU Time (s)'], 5)
            );
        }

        // Table footer
        echo str_repeat('-', array_sum($colWidths) + 9) . "\n";
    }

    /**
     * A test to measure performance of DECRYPT_SLIP with individual and average metrics.
     */
    public function testDecryptSlipPerformance(): void
    {
        // Simulated data for testing
        $data = DecryptSlipsData::getData(); // Returns an array with [file, aesKey, iv, privateKey] tuples

        $individualResults = [];
        $aggregatedResults = [];

        // Iterate over the data and run DECRYPT_SLIP for each set
        foreach ($data as $item) {
            $file = $item['file'];
            $aesKey = $item['key'];
            $iv = $item['iv'];
            $privateKey = $item['private_key'];

            // Run DECRYPT_SLIP and capture resources
            $results = self::DECRYPT_SLIP($file, $aesKey, $iv, $privateKey);
            foreach ($results as $result) {
                $individualResults[] = $result;

                // Aggregate for averages
                $operation = $result['operation'];
                if (!isset($aggregatedResults[$operation])) {
                    $aggregatedResults[$operation] = [
                        'Execution Time (s)' => 0,
                        'RAM (KB)' => 0,
                        'CPU Time (s)' => 0,
                        'count' => 0,
                    ];
                }
                $aggregatedResults[$operation]['Execution Time (s)'] += $result['Execution Time (s)'];
                $aggregatedResults[$operation]['RAM (KB)'] += $result['RAM (KB)'];
                $aggregatedResults[$operation]['CPU Time (s)'] += $result['CPU Time (s)'];
                $aggregatedResults[$operation]['count']++;
            }
        }

        // Prepare average results
        $averageResults = [];
        foreach ($aggregatedResults as $operation => $aggregate) {
            $averageResults[] = [
                'operation' => $operation,
                'Execution Time (s)' => $aggregate['Execution Time (s)'] / $aggregate['count'],
                'RAM (KB)' => $aggregate['RAM (KB)'] / $aggregate['count'],
                'CPU Time (s)' => $aggregate['CPU Time (s)'] / $aggregate['count'],
            ];
        }

        // Print individual results
        $this->printPerformanceTable("Individual Results", $individualResults, [
            "Execution Time (s)",
            "RAM Usage (KB)",
            "CPU Time (s)"
        ]);

        // Print average results
        $this->printPerformanceTable("Average Results", $averageResults, [
            "Execution Time (s)",
            "RAM Usage (KB)",
            "CPU Time (s)"
        ]);
    }
}
