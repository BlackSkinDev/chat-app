<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request,Throwable $e)
    {
        if($e instanceof  ModelNotFoundException || $e instanceof NotFoundHttpException){
            return $this->error('Request not found',null,Response::HTTP_NOT_FOUND);
        }

        if($e instanceof  AuthenticationException ){
            return $this->error('Your session has expired. Login to continue',null,Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof UnauthorizedHttpException) {
            return $this->error('Oops! Invalid Auth Credentials',null,Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof ValidationException) {
            return $this->error($e->validator->errors()->first(), $e->validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

       return $this->error('Error handling request, try again later',null,Response::HTTP_INTERNAL_SERVER_ERROR);
       //return $this->error($e->getMessage(),null,Response::HTTP_INTERNAL_SERVER_ERROR);


    }
}
