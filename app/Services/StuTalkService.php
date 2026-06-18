<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class StuTalkService
{
    protected string $baseUrl;
    protected int $timeout;

    public function __construct()
    {
        $this->baseUrl = config('services.stutalk.url', 'http://internal-sits/stutalk/api');
        $this->timeout = (int) config('services.stutalk.timeout', 10);
    }

    public function getStudentProfile(string $studentNumber): array
    {
        $response = Http::timeout($this->timeout)->post(
            "{$this->baseUrl}/GetStudentProfile",
            ['student_number' => $studentNumber]
        );

        if ($response->failed()) {
            Log::error('StuTalk API failed', [
                'status'        => $response->status(),
                'body'          => $response->body(),
                'student_number' => $studentNumber,
            ]);

            throw new RuntimeException('Failed to fetch student data from SITS', $response->status());
        }

        return $response->json() ?? [];
    }
}
