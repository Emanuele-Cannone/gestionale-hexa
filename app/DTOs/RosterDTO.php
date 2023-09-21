<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class RosterDTO extends ValidatedDTO
{
    public int $user_id;

    public int $proof_id;

    public string $date;

    public string $from;

    public string $to;

    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'user_id' => 'exists:users,id|required',
            'proof_id' => 'exists:proofs,id|required',
            'date' => 'date|date_format:Y-m-d|required',
            'from' => ['string', 'required', 'regex:/^[0-2][0-9]:[0-5][0-9]:[0-5][0-9]/'],
            'to' => ['string', 'required', 'regex:/^[0-2][0-9]:[0-5][0-9]:[0-5][0-9]/'],
        ];
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [];
    }

    /**
     * Defines the type casting for the properties of the DTO.
     */
    protected function casts(): array
    {
        return [];
    }

    /**
     * Maps the DTO properties before the DTO instantiation.
     */
    protected function mapBeforeValidation(): array
    {
        return [];
    }

    /**
     * Maps the DTO properties before the DTO export.
     */
    protected function mapBeforeExport(): array
    {
        return [
            'user_id' => $this->user_id,
            'proof_id' => $this->proof_id,
            'data' => $this->date,
            'from' => $this->from,
            'to' => $this->to,
        ];
    }

    /**
     * Defines the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Defines the custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [];
    }
}
