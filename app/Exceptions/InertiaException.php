<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;
use Inertia\Inertia;

/**
 *
 */
class InertiaException extends Exception
{

    /**
     * @param Request $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response|void
     *
     * TODO reinstate '! app()->en' condition
     */
    public function render(Request $request, Throwable $e)
    {

//! app()->environment(['local', 'testing']) &&
        if ( in_array($e->getCode(), [500, 503, 404, 403])) {
            return Inertia::render('Error',
                ['status' => $e->getCode(), 'message' => $e->getMessage()]
            )
                ->toResponse($request)
                ->setStatusCode($e->getCode());
        } elseif ($e->getCode() === 419) {
            return back()->with([
                'message' => 'The page expired, please try again.',]);
        }
    }

}
