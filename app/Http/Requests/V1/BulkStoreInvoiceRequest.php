<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "*.customerId" => ["required", "integer"],
            "*.amount" => ["required", "numeric"],
            "*.status" => ["required", Rule::in(values: ["B", "b", "P", "p", "V", "v"])],
            "*.bailedDate" => ["required", "date_format:Y-m-d H:i:s"],
            "*.paidDate" => ["nullable", "date_format:Y-m-d H:i:s"],
        ];
    }

    protected function prepareForValidation(): void
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj["customer_id"] = $obj["customerId"] ?? null;
            $obj["bailed_date"] = $obj["bailedDate"] ?? null;
            $obj["paid_date"] = $obj["paidDate"] ?? null;

            $data[] = $obj;
        }

        $this->merge(input: $data);
    }
}
