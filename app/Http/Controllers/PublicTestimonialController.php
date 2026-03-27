<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;

class PublicTestimonialController extends Controller
{
    public function store(StorePublicTestimonialRequest $request): RedirectResponse
    {
        Testimonial::create([
            ...$request->validated(),
            'is_featured' => false,
            'sort_order' => 0,
        ]);

        return redirect()
            ->route('home')
            ->withFragment('testimonial-form')
            ->with('success', 'Thank you for sharing your experience. Your testimonial has been submitted for admin review before publishing.');
    }
}
