<?php

namespace App\Http\Controllers;

use App\Services\TelegramBotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class TelegramBotController extends Controller
{
    public function __construct(
        private readonly TelegramBotService $telegramBotService
    ) {
    }

    public function webhook(Request $request): JsonResponse
    {
        try {

            $this->telegramBotService->handle(
                $request->all()
            );

            return response()->json([
                'ok' => true,
            ]);

        } catch (Throwable $exception) {

            report($exception);

            return response()->json([
                'ok' => false,
                'message' => $exception->getMessage(),
            ], 500);

        }
    }
}