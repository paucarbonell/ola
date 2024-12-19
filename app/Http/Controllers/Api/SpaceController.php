<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Space;
use App\Http\Resources\SpaceResource;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCommentRequest;

class SpaceController extends Controller
{
    /**
     * Index de spaces.
     */
    public function index()
    {
        $spaces = Space::with(['spaceType', 'address.municipality.island', 'address.zone', 'services', 'modalities', 'comments'])->get(); 
        return SpaceResource::collection($spaces);
    }

    /**
     * Index de spaces por id o nombre de isla.
     */
    public function indexIsla($islandIdentifier)
    {
        $spaces = Space::whereHas('address.municipality.island', function ($query) use ($islandIdentifier) {
            if (is_numeric($islandIdentifier)) {
                $query->where('id', $islandIdentifier);
            } else {
                $query->where('name', $islandIdentifier);
            }
        })->with(['spaceType', 'address.municipality.island', 'address.zone', 'services', 'modalities', 'comments'])->get();

        return SpaceResource::collection($spaces);
    }

    /**
     * Store a newly created comment for a space identified by regNumber.
     */
    public function storeByRegNumber(Request $request, $regNumber)
    {
        $space = Space::where('regNumber', $regNumber)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string',
            'status' => 'required|string',
            'score' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'images' => 'nullable|array',
            'images.*.url' => 'required_with:images|url'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment = $space->comments()->create($request->only(['comment', 'status', 'score', 'user_id']));

        if ($request->has('images')) {
            foreach ($request->images as $imageData) {
                $comment->images()->create($imageData);
            }
        }

        return response()->json(new SpaceResource($space), 201);
    }

    /**
     * Show específico a partir de un id o regNumber.
     */
    public function show($identifier)
    {
        $space = is_numeric($identifier) 
            ? Space::with(['spaceType', 'address.municipality.island', 'address.zone', 'services', 'modalities', 'comments'])->findOrFail($identifier)
            : Space::with(['spaceType', 'address.municipality.island', 'address.zone', 'services', 'modalities', 'comments'])->where('regNumber', $identifier)->firstOrFail();
        return response()->json(new SpaceResource($space));
    }

}
