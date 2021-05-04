<?php

namespace App\Http\Controllers\Gateway;

use Illuminate\Http\Request;
use App\Services\ClassService;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class ClassController extends Controller
{

    use ApiResponser;

    public $classService;

    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    public function index()
    {
        return $this->successResponse($this->classService->index());
    }

    public function studentPerClass()
    {

    }

    public function show($class)
    {

    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $class1)
    {
 
    }


    public function destroy($class)
    {

    }
}
