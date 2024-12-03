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
            'operation' => 'DECRYPT PRIVATE KEY (AES-256-CBC)',
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
            'operation' => 'DECRYPT AES KEY (RSA-2048)',
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
            'operation' => 'DECRYPT IV (AES-256-CBC)',
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
            'operation' => 'DECRYPT DATA (AES-128)',
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
    protected function printPerformanceTable($title, $results)
    {
        // Calculate column widths dynamically for the two tables
        $colWidthsFirstTable = [
            'operation' => max(strlen('Cryptographic Operation'), ...array_map(fn($r) => strlen($r['operation']), $results)) + 2,
            'Execution Time (s)' => max(strlen('Execution Time (s)'), ...array_map(fn($r) => strlen(number_format($r['Execution Time (s)'], 5)), $results)) + 2,
        ];

        $colWidthsSecondTable = [
            'operation' => max(strlen('Cryptographic Operation'), ...array_map(fn($r) => strlen($r['operation']), $results)) + 2,
            'RAM (KB)' => max(strlen('RAM Usage (KB)'), ...array_map(fn($r) => strlen(number_format($r['RAM (KB)'], 2)), $results)) + 2,
            'CPU Time (s)' => max(strlen('CPU Time (s)'), ...array_map(fn($r) => strlen(number_format($r['CPU Time (s)'], 5)), $results)) + 2,
        ];

        // First Table - Execution Time
        echo "\n$title - Execution Time\n";
        echo str_repeat('-', array_sum($colWidthsFirstTable) + 5) . "\n";
        printf(
            "| %-{$colWidthsFirstTable['operation']}s | %-{$colWidthsFirstTable['Execution Time (s)']}s |\n",
            'Cryptographic Operation',
            'Execution Time (s)'
        );
        echo str_repeat('-', array_sum($colWidthsFirstTable) + 5) . "\n";

        foreach ($results as $result) {
            printf(
                "| %-{$colWidthsFirstTable['operation']}s | %-{$colWidthsFirstTable['Execution Time (s)']}s |\n",
                $result['operation'],
                number_format($result['Execution Time (s)'], 5)
            );
        }

        echo str_repeat('-', array_sum($colWidthsFirstTable) + 5) . "\n";

        // Second Table - RAM and CPU Time
        echo "\n$title - RAM and CPU Time\n";
        echo str_repeat('-', array_sum($colWidthsSecondTable) + 5) . "\n";
        printf(
            "| %-{$colWidthsSecondTable['operation']}s | %-{$colWidthsSecondTable['RAM (KB)']}s | %-{$colWidthsSecondTable['CPU Time (s)']}s |\n",
            'Cryptographic Operation',
            'RAM Usage (KB)',
            'CPU Time (s)'
        );
        echo str_repeat('-', array_sum($colWidthsSecondTable) + 5) . "\n";

        foreach ($results as $result) {
            printf(
                "| %-{$colWidthsSecondTable['operation']}s | %-{$colWidthsSecondTable['RAM (KB)']}s | %-{$colWidthsSecondTable['CPU Time (s)']}s |\n",
                $result['operation'],
                number_format($result['RAM (KB)'], 2),
                number_format($result['CPU Time (s)'], 5)
            );
        }

        echo str_repeat('-', array_sum($colWidthsSecondTable) + 5) . "\n";
    }

    protected function printNumberMessage($results)
    {
        echo "\n Number of messages \n";

        echo "+-----------------------------------+--------------------+---------------------+-------------------+-------------------+\n";
        echo "| Cryptographic Operation         | Number of Messages | Execution Time (s)  | RAM Usage (KB)    | CPU Time (s)      |\n";
        echo "+-----------------------------------+--------------------+---------------------+-------------------+-------------------+\n";

        // Print individual results
        foreach ($results as $result) {
            printf(
                "| %-33s | %-18d | %-19.5f | %-18.2f | %-17.5f |\n",
                $result['operation'],
                $result['messages'],
                $result['Execution Time (s)'],
                $result['RAM (KB)'],
                $result['CPU Time (s)']
            );
        }

        echo "+-----------------------------------+--------------------+---------------------+-------------------+-------------------+\n";
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

        $countResult = [];
        $messageCounts = [1, 5, 10, 15, 20, 25, 30, 50, 100];

        $i = 1;
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

                if (in_array($i, $messageCounts)) {
                    $countResult[] = [
                        'operation' => $operation,
                        'messages' => $i,
                        'Execution Time (s)' => $aggregatedResults[$operation]['Execution Time (s)'],
                        'RAM (KB)' => $aggregatedResults[$operation]['RAM (KB)'],
                        'CPU Time (s)' => $aggregatedResults[$operation]['CPU Time (s)'],
                    ];
                }
            }

            $i++;
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
        // $this->printPerformanceTable("Individual Results", $individualResults, [
        //     "Execution Time (s)",
        //     "RAM Usage (KB)",
        //     "CPU Time (s)"
        // ]);

        // Print average results
        $this->printPerformanceTable("Average Results", $averageResults, [
            "Execution Time (s)",
            "RAM Usage (KB)",
            "CPU Time (s)"
        ]);

        foreach (['DECRYPT PRIVATE KEY (AES-256-CBC)', 'DECRYPT AES KEY (RSA-2048)', 'DECRYPT IV (AES-256-CBC)', 'DECRYPT DATA (AES-128)'] as $operationFilter) {
            $this->printNumberMessage(array_filter($countResult, function($item) use ($operationFilter) {
                return $item['operation'] === $operationFilter;
            }));
        }
    }
}
