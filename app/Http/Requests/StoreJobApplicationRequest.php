<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'applicant_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'contact_no' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:500'],
            'transportation_mode' => ['required', 'string', 'max:255'],
            'professional_summary' => ['required', 'string', 'max:4000'],
            'educational_background' => ['required', 'string', 'max:4000'],
            'recent_company' => ['nullable', 'string', 'max:255'],
            'recent_position' => ['nullable', 'string', 'max:255'],
            'opportunity_reason' => ['required', 'string', 'max:4000'],
            'best_time_to_contact' => ['required', 'string', 'max:255'],
            'resume' => ['required', 'file', 'mimes:pdf', 'max:10240'],
        ];
    }
}
