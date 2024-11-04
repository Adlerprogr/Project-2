<?php

namespace App\Jobs;

use App\Services\BitrixService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateLeadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $leadData;
    private BitrixService $bitrixService;

    public function __construct(array $leadData, BitrixService $bitrixService)
    {
        $this->leadData = $leadData;
        $this->bitrixService = $bitrixService;
    }

    public function handle(): void
    {
        $response = $this->bitrixService->createLead($this->leadData);

        if (isset($response['error'])) {
            Log::error('Ошибка при создании лида в Bitrix: ' . $response['error_description']);
        } else {
            Log::info('Лид успешно создан в Bitrix: ' . json_encode($response));
        }
    }
}
