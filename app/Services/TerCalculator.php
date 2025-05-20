<?php

namespace App\Services;

use InvalidArgumentException;

class TERCalculator
{
    protected array $tarif;

    public function __construct(array $tarif)
    {
        $this->tarif = $tarif;
    }

    /**
     * Hitung TER berdasarkan kategori dan gaji
     *
     * @param string $kategori 'A', 'B', atau 'C'
     * @param float $gaji nilai gaji/penghasilan
     * @return float hasil TER
     * @throws InvalidArgumentException jika kategori tidak ditemukan
     */
    public function hitungTER(string $kategori, float $gaji): float
    {
        if (!isset($this->tarif[$kategori])) {
            throw new InvalidArgumentException("Kategori $kategori tidak valid.");
        }

        $brackets = $this->tarif[$kategori];
        $ter = 0;
        $prevMax = 0;

        foreach ($brackets as $bracket) {
            $max = $bracket['max'];
            $rate = $bracket['rate'];

            if ($gaji <= $max) {
                $ter += ($gaji - $prevMax) * $rate;
                break;
            } else {
                $ter += ($max - $prevMax) * $rate;
                $prevMax = $max;
            }
        }

        return round($ter, 2); // pembulatan 2 desimal, bisa diubah sesuai kebutuhan
    }
}
