<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListRequest;
use Auth;
use App\Lists;
use Validator;

class ListsController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api');
    }

    public function showAll(Request $request)
    {
      $user = Auth::guard('api')->user();
      return response()->json($user->lists);
    }

    public function create(ListRequest $request)
    {
        $user = Auth::guard('api')->user();
        $list = $user->lists()->create($request->all());
        return response()->json($list, 201);
    }

    public function showItems(Request $request, Lists $list)
    {
        return response()->json($list->items);
    }

    public function edit(ListRequest $request, Lists $list)
    {
      $list->update($request->all());
      return response()->json($list, 200);
    }

    public function delete(Request $request, Lists $list)
    {
      $list->delete();
      return response()->json(null, 204);
    }
}
