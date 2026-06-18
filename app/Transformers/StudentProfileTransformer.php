<?php

namespace App\Transformers;

class StudentProfileTransformer
{
    public static function transform(array $raw): array
    {
        return [
            'student_number' => $raw['StudentCode']        ?? $raw['student_number'] ?? null,
            'bsms_id'        => $raw['BsmsId']             ?? $raw['bsms_id']        ?? null,
            'first_name'     => $raw['Forename']           ?? $raw['first_name']     ?? null,
            'last_name'      => $raw['Surname']            ?? $raw['last_name']      ?? null,
            'known_as'       => $raw['KnownAs']            ?? $raw['known_as']       ?? null,
            'email'          => $raw['EmailAddress']       ?? $raw['email']          ?? null,
            'dob'            => $raw['DateOfBirth']        ?? $raw['dob']            ?? null,
            'year_of_study'  => $raw['YearOfStudy']        ?? $raw['year']           ?? null,
            'programme'      => $raw['ProgrammeCode']      ?? $raw['programme']      ?? null,
            'status'         => $raw['StudentStatus']      ?? $raw['status']         ?? null,
        ];
    }
}
