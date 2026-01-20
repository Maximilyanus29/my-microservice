<?php

namespace app\Controller;

use Http\Core\Controller;
use Http\Core\JsonResponse;
use Http\Core\Request;

class EventController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $id = $request->getParams('id');

        return new JsonResponse($id);
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function post()
    {

    }
}