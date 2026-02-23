<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends BaseController
{
    /**
     * Update the user's profile information.
     */
    /**
     * Update the user's profile information.
     * 
     * @authenticated
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return $this->sendResponse($request->user(), 'Profile updated successfully');
    }

    /**
     * Update the user's password.
     */
    /**
     * Update the user's password.
     * 
     * @authenticated
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return $this->sendResponse([], 'Password updated successfully');
    }

    /**
     * Get the user's purchased products (library) along with their given rating.
     * 
     * @authenticated
     */
    public function library(Request $request)
    {
        $user = $request->user();

        $purchasedProducts = \App\Models\Product::whereHas('orderItems.order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with([
                    'comments' => function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    },
                    'tags',
                    'orderItems' => function ($query) use ($user) {
                        $query->whereHas('order', function ($q) use ($user) {
                            $q->where('user_id', $user->id);
                        })->with('platform');
                    }
                ])->get();

        // Attach purchased_platform to each product mapping from the orderItem
        $purchasedProducts->each(function ($product) {
            $product->purchased_platform = $product->orderItems->first()?->platform;
        });

        $ratedProducts = \App\Models\Product::whereHas('comments', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with([
                    'comments' => function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    },
                    'tags'
                ])->get();

        return $this->sendResponse(
            [
                'purchased' => \App\Http\Resources\ProductResource::collection($purchasedProducts),
                'rated' => \App\Http\Resources\ProductResource::collection($ratedProducts),
            ],
            'User library fetched successfully'
        );
    }

    /**
     * Delete the user's account.
     */
    /**
     * Delete the user's account.
     * 
     * @authenticated
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        // For API we don't need to invalidate session/token here as the client will handle logout
        // But for Sanctum we might want to revoke tokens.
        $user->tokens()->delete();

        return $this->sendResponse([], 'Account deleted successfully');
    }
}
