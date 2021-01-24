<?php

namespace App\Exceptions;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\RecordsNotFoundException;
use Throwable;

class EntityNotFoundException extends RecordsNotFoundException implements Responsable
{
    /**
     * EntityNotFoundException constructor.
     *
     * @param  string $message
     * @param  int $code
     * @param  Throwable|null $previous
     * @return void
     */
    public function __construct($message = 'Record not found.', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * {@inheritdoc}
     */
    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'data'    => null,
                'message' => $this->getMessage()
            ], $this->getCode() ?: 404);
        }

        return view('errors::401');
    }
}
