<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sku' => ['required', 'string', 'max:50', Rule::unique('products', 'sku')->ignore($this->route('product'))],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image_url' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (is_string($value))
                        return; // Allow existing URL string
                    if (!request()->hasFile($attribute))
                        return; // Allow if not present (nullable)
                    // Validate file if it is a file
                    $validator = \Illuminate\Support\Facades\Validator::make([$attribute => $value], [
                        $attribute => 'file|image|max:10240'
                    ]);
                    if ($validator->fails()) {
                        $fail($validator->errors()->first($attribute));
                    }
                }
            ],
            'video_url' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (is_string($value))
                        return;
                    if (!request()->hasFile($attribute))
                        return;

                    $validator = \Illuminate\Support\Facades\Validator::make([$attribute => $value], [
                        $attribute => 'file|mimetypes:video/mp4,video/webm,video/x-matroska|max:51200'
                    ]);
                    if ($validator->fails()) {
                        $fail($validator->errors()->first($attribute));
                    }
                }
            ],
            'is_new' => ['boolean'],
            'is_offer' => ['boolean'],
            'offer_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'offer_start_date' => ['nullable', 'date'],
            'offer_end_date' => ['nullable', 'date', 'after_or_equal:offer_start_date'],
            'release_date' => ['nullable', 'date'],
            'active' => ['boolean'],
            'featured' => ['boolean'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['integer', 'exists:tags,id'],
            'platform_ids' => ['nullable', 'array'],
            'platform_ids.*' => ['integer', 'exists:platforms,id'],
        ];
    }
}
