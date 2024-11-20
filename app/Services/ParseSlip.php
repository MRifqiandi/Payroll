<?php

namespace App\Services;

use App\Constants;

/**
 * Class ParseSlip.
 */
class ParseSlip
{
    public static function execute($rows, $type)
    {
        switch ($type) {
            case Constants::SLIP_TYPE['GAJI BULANAN']:
                return self::parseMonthlySalary($rows);
            case Constants::SLIP_TYPE['UANG MAKAN']:
                return self::parseMealAllowance($rows);
            default:
                return [];
        }
    }

    public static function parseMonthlySalary($rows)
    {
        return collect($rows)->mapWithKeys(function ($row) {
            return [
                $row[7] => [
                    'gjpokok' => $row[21],
                    'tjistri' => $row[22],
                    'tjanak' => $row[23],
                    'tjupns' => $row[24],
                    'tjstruk' => $row[25],
                    'tjfungs' => $row[26],
                    'tjdaerah' => $row[27],
                    'tjpencil' => $row[28],
                    'tjlain' => $row[29],
                    'tjkompen' => $row[30],
                    'pembul' => $row[31],
                    'tjberas' => $row[32],
                    'tjpph' => $row[33],
                    'potpfkbul' => $row[34],
                    'potpfk2' => $row[35],
                    'potpfk10' => $row[36],
                    'potpph' => $row[37],
                    'potswrum' => $row[38],
                    'potkelbtj' => $row[39],
                    'potlain' => $row[40],
                    'pottabrum' => $row[41],
                    'bersih' => $row[42],
                    // 'kdkawin' => $row[44],
                    // 'kdjab' => $row[45],
                    // 'thngj' => $row[46],
                    // 'kdgapok' => $row[47],
                    'bpjs' => $row[48],
                    'bpjs2' => $row[49],
                ],
            ];
        })->toArray();
    }

    public static function parseMealAllowance($rows)
    {
        return collect($rows)->mapWithKeys(function ($row) {
            return [
                $row[5] => [
                    'jmlhari' => $row[14],
                    'tarif' => $row[15],
                    'pph' => $row[16],
                    'kotor' => $row[17],
                    'potongan' => $row[18],
                    'bersih' => $row[19],
                ],
            ];
        })->toArray();
    }
}
