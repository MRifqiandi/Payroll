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
    public static function store($user, $file, $slips, $name, $type)
    {
        $rows = array_slice(Excel::toArray([], $file)[0], 1);

        $data = Utils::ENCRYPT_SLIP(json_encode($rows), $user->public_key);

        $upload = UserUpload::create([
            'user_id' => $user->id,
            'name' => $name,
            'file' => $data['file'],
            'key' => $data['key'],
            'iv' => $data['iv'],
            'type' => $type,
        ]);

        $upload->files()->createMany($slips);

        return $upload;
    }

    /**
     * Extracts data from an uploaded file and formats it into an associative array.
     *
     * @param \Illuminate\Http\UploadedFile $file The uploaded CSV, XLSX, or XLS file.
     * @param \App\Constants::SLIP_TYPE $type The type of slip to parse.
     * @return array An associative array of user data keyed by number, with each entry containing 'data'.
     */
    public static function parseFileData($file, $type)
    {
        $rows = array_slice(Excel::toArray([], $file)[0], 1);

        $data = ParseSlip::execute($rows, $type);

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
    public static function createEncryptedSlips($keys, $data, $name, $type)
    {
        $slip = [];

        foreach ($keys as $number => $user) {
            $slip[] = [
                'user_id' => $user['id'],
                'name' => $name,
                'type' => $type,
                ...Utils::ENCRYPT_SLIP(json_encode($data[$number]), $user['public_key']),
            ];
        }

        return $slip;
    }
}
