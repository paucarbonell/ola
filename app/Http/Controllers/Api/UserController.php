<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Show específico a partir de un mail.
     */
    public function show($email): JsonResponse
    {
        $user = User::where('email', $email)->with(['spaces', 'comments', 'comments.images'])->firstOrFail();

        return response()->json(new UserResource($user));
    }

    /**
     * Elimina usuario y sus relacionados a partir de un mail.
     */
    public function destroy($email): JsonResponse
    {
        $user = User::where('email', $email)->firstOrFail();

        // Delete en cascada
        foreach ($user->spaces as $space) {
            $space->services()->detach();
            $space->modalities()->detach();
            $space->delete(); 
        }
        $user->comments()->delete();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
    
    /**
     * Update por Id o por mail.
     */
    public function update(Request $request, $identifier)
    {
        $user = is_numeric($identifier) ? User::findOrFail($identifier) : User::where('email', $identifier)->firstOrFail();
        $user->update($request->all());

        return new UserResource($user);
    }
}
