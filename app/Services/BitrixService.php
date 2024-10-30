<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

    protected function request(string $method, array $params = [])
    {
        $response = Http::post("{$this->url}{$this->userId}/{$this->webhookKey}/{$method}", $params);

        // Логируем запрос и ответ
        Log::info("Запрос к Bitrix: {$method}", ['params' => $params]);
        Log::info("Ответ от Bitrix: {$method}", ['response' => $response->json()]);

        return $response->json();
    }

    public function createLead(array $leadData)
    {
        return $this->request('crm.lead.add', [
            'fields' => $leadData,
            'params' => ['REGISTER_SONET_EVENT' => 'Y'],
        ]);
    }

    public function updateLead($leadId, array $leadData)
    {
        return $this->request('crm.lead.update', [
            'id' => $leadId,
            'fields' => $leadData,
        ]);
    }

    public function getLead($leadId)
    {
        return $this->request('crm.lead.get', [
            'id' => $leadId,
        ]);
    }

    // Другие методы по мере необходимости
}
