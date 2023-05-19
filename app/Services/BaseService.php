<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;

class BaseService
{
  private $repository;
  public function __construct(BaseRepository $_repository)
  {
    $this->repository = $_repository;
  }

  public function list(Request $request)
  {
    $res = $this->repository->list();
    return response()->json(['success' => true, 'data' => $res], 200);
  }
  public function get($id, Request $request)
  {
    $res = $this->repository->get($id);
    if ($res) {
      return response()->json(['success' => true, 'data' => $res], 200);
    }
    return response()->json(['message' => 'Data not found'], 404);
  }
  public function store(Request $request)
  {
    if ($request->isJson()) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|min:2|max:255',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
      }

      $res = $this->repository->store($request->all());
      return response()->json(['success' => true, 'data' => $res], 200);;
    }
    return response()->json(['message' => 'Please, send a valid Json Request'], 400, []);
  }
  public function update($id, Request $request)
  {
    if ($request->isJson()) {
      $validator = Validator::make($request->all(), [
        'name' => 'min:2|max:255',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
      }

      $res = $this->repository->update($id, $request->all());
      return response()->json(['success' => $res], 200);
    }
    return response()->json(['message' => 'Please, send a valid Json Request'], 400, []);
  }
  public function delete($id, Request $request)
  {
    $res = $this->repository->delete($id);
    if ($res) {
      return response()->json(['success' => $res], 200);
    }
    return response()->json(['message' => 'Data not found'], 404);
  }
}
