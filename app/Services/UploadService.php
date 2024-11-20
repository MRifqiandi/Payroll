<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserUpload;
use App\Utils;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class UploadService.
 */
class UploadService
{
    public static function store($user, $file, $slips, $name)
    {
        $rows = array_slice(Excel::toArray([], $file)[0], 1);

        $data = Utils::ENCRYPT_SLIP(json_encode($rows), $user->public_key);

        $upload = UserUpload::create([
            'user_id' => $user->id,
            'name' => $name,
            'file' => $data['file'],
            'key' => $data['key'],
            'iv' => $data['iv'],
        ]);

        $upload->files()->createMany($slips);

        return $upload;
    }

    /**
     * Extracts data from an uploaded file and formats it into an associative array.
     *
     * @param \Illuminate\Http\UploadedFile $file The uploaded CSV, XLSX, or XLS file.
     * @return array An associative array of user data keyed by number, with each entry containing 'data'.
     */
    public static function parseFileData($file)
    {
        $rows = array_slice(Excel::toArray([], $file)[0], 1);

        $data = collect($rows)->mapWithKeys(function ($row) {
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

        return $data;
    }

    /**
     * Retrieves user keys (id and public key) based on a list of numbers.
     *
     * @param array $numbers An array of number addresses to search for in the database.
     * @return array An associative array with:
     *               - 'data': an array of user data keyed by number, each containing 'id' and 'public_key'.
     *               - 'invalid': an array of numbers that were not found in the database.
     */
    public static function fetchUserKeysByNumber($numbers)
    {
        $users = User::select([
            'id',
            'number',
            'public_key',
        ])->whereIn('number', $numbers)->get();

        $data = $users->mapWithKeys(function ($user) {
            return [$user->number => [
                'id' => $user->id,
                'public_key' => $user->public_key,
            ]];
        });

        $invalid = array_diff($numbers, $data->keys()->toArray());

        return [
            'data' => $data,
            'invalid' => $invalid,
        ];
    }

    /**
     * Generates an array of encrypted "slips" for users, each containing user ID and encrypted data.
     *
     * @param array $keys An associative array of user keys, where each entry is keyed by number and contains 'id' and 'public_key'.
     * @param array $data An associative array of user data keyed by number, with each entry containing data to be encrypted.
     * @return array An array of "slips", where each slip contains:
     *               - 'user_id': the user's ID.
     *               - 'data': the encrypted data using the user's public key.
     */
    public static function createEncryptedSlips($keys, $data, $name)
    {
        $slip = [];

        foreach ($keys as $number => $user) {
            $slip[] = [
                'user_id' => $user['id'],
                'name' => $name,
                ...Utils::ENCRYPT_SLIP(json_encode($data[$number]), $user['public_key']),
            ];
        }

        return $slip;
    }
}
