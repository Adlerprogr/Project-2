<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class BitrixService
{
    protected string $url;
    protected string $userId;
    protected string $webhookKey;

    public function __construct()
    {
        $this->url = config('bitrix.url');
        $this->userId = config('bitrix.user_id');
        $this->webhookKey = config('bitrix.webhook_key');
    }

    protected function request(string $method, array $params = []): ?array
    {
        try {
            $response = Http::post("{$this->url}{$this->userId}/{$this->webhookKey}/{$method}", $params);

            return $response->json() ?: null; // Возвращаем null, если ответ пуст
        } catch (RequestException $e) {
            Log::error("Ошибка при запросе к Bitrix: {$method}", [
                'error' => $e->getMessage(),
                'params' => $params,
            ]);
            return null; // Возвращаем null при ошибке
        }
    }

    public function createLead(array $leadData): ?array
    {
        return $this->request('crm.lead.add', [
            'fields' => $leadData,
            'params' => ['REGISTER_SONET_EVENT' => 'Y'],
        ]);
    }

    public function updateLead(int $leadId, array $leadData): ?array
    {
        return $this->request('crm.lead.update', [
            'id' => $leadId,
            'fields' => $leadData,
        ]);
    }

    public function getLead(int $leadId): ?array
    {
        return $this->request('crm.lead.get', [
            'id' => $leadId,
        ]);
    }

    // Другие методы по мере необходимости
}
