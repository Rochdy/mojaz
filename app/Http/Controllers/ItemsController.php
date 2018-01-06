<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Lists;
use App\Item;
use Validator;


class ItemsController extends Controller
{
  public function create(Request $request, Lists $list)
  {
    $item = $list->items()->create($request->all());
    return response()->json($item, 201);
  }

  public function edit(Request $request, Lists $list, Item $item)
  {
    $item->update($request->all());
    return response()->json($item, 200);
  }

  public function delete(Request $request, Lists $list, Item $item)
  {
    $item->delete();
    return response()->json(null, 204);
  }
}
