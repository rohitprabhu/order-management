<?php

namespace App\Http\Requests;

use App\Enums\OrderStatus;
use App\Rules\AvailableQtyRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class OrderPostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customerEmail'     => 'required|email',
            'items'             => 'required|array|min:1',
            'items.*.productId' => 'required|string|exists:products,id',
            'items.*.quantity'  => ['required', 'integer', new AvailableQtyRule()],
            'status'            => ['required', new Enum(OrderStatus::class)]
        ];
    }
}
