<?php

namespace App\DTO;

use App\Http\Requests\OrderRequest;

class OrderDTO
{
    public function __construct(
        public int $userId,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $address,
        public string $entrance,
        public string $floor,
        public string $flat,
        public string $intercom,
        public string $comment,
        public string $city,
    ) {}

    public static function fromRequest(OrderRequest $request, int $userId): self
    {
        return new self(
            userId: $userId,
            lastName: $request->input('last_name', 'Имя не указано'),
            email: $request->input('email'),
            phone: $request->input('phone', 'Не указан'),
            address: $request->input('address'),
            entrance: $request->input('entrance'),
            floor: $request->input('floor'),
            flat: $request->input('flat'),
            intercom: $request->input('intercom'),
            comment: $request->input('comment'),
            city: $request->input('city'),
        );
    }
}
