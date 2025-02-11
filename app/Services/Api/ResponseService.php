<?php
/**
 * @author Eguana Team
 * @copyright Copyright (c) 2024 Eguana {http://eguanacommerce.com}
 * Created by PhpStorm
 * User: Talish Nazir
 * Date: 2025-01-31
 * Time: 9:16 AM
 */
declare(strict_types=1);

namespace App\Services\Api;

use Illuminate\Http\JsonResponse;

/**
 * Class for ResponseService
 */
class ResponseService
{
    /**
     * Success response method.
     *
     * @param mixed $result
     * @param string|mixed $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result
        ];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, 200);
    }

    /**
     * Error response method.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
