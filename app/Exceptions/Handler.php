<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param Exception $exception
     * @return bool
     */
    private function isBadRequestException(Exception $exception): bool
    {
        $badRequestExceptions = [
            NotUniqueException::class,
        ];

        return in_array(get_class($exception), $badRequestExceptions);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return Response
     *
     * @throws Exception
     */
    public function render($request, Exception $exception): Response
    {
        if ($this->isBadRequestException($exception)) {
            return new JsonResponse('Product with that name already exists!', 400, $this->defaultHeaders());
        }
        if ($this->isValidationException($exception)) {
            return new JsonResponse($exception->validator->getMessageBag()->first(), 400, $this->defaultHeaders());
        }

        return new JsonResponse('Bad request', 400, $this->defaultHeaders());
    }

    /**
     * @return array
     */
    protected function defaultHeaders(): array
    {
        return [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS, PATCH, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'DNT,X-Mx-ReqToken,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Authorization',
            'Access-Control-Expose-Headers' => 'Authorization',
        ];
    }

    /**
     * @param Exception $exception
     * @return bool
     */
    private function isValidationException(Exception $exception): bool
    {
        return $exception instanceof ValidationException;
    }
}
