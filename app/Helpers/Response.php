<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

final class Response
{
    /**
     * @var int
     */
    private const HTTP_OK = 200;

    /**
     * @var int
     */
    private const HTTP_CREATED = 201;

    /**
     * @var int
     */
    private const HTTP_BAD_REQUEST = 400;

    /**
     * @var int
     */
    private const HTTP_UNAUTHORIZED = 401;

    /**
     * @var int
     */
    private const HTTP_PAYMENT_REQUIRED = 402;

    /**
     * @var int
     */
    private const HTTP_FORBIDDEN = 403;

    /**
     * @var int
     */
    private const HTTP_NOT_FOUND = 404;

    /**
     * @var int
     */
    private const HTTP_METHOD_NOT_ALLOWED = 405;

    /**
     * @var int
     */
    private const HTTP_NOT_ACCEPTABLE = 406;

    /**
     * @var int
     */
    private const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;

    /**
     * @var int
     */
    private const HTTP_REQUEST_TIMEOUT = 408;

    /**
     * @var int
     */
    private const HTTP_CONFLICT = 409;

    /**
     * @var int
     */
    private const HTTP_GONE = 410;

    /**
     * @var int
     */
    private const HTTP_LENGTH_REQUIRED = 411;

    /**
     * @var int
     */
    private const HTTP_PRECONDITION_FAILED = 412;

    /**
     * @var int
     */
    private const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;

    /**
     * @var int
     */
    private const HTTP_REQUEST_URI_TOO_LONG = 414;

    /**
     * @var int
     */
    private const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;

    /**
     * @var int
     */
    private const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;

    /**
     * @var int
     */
    private const HTTP_EXPECTATION_FAILED = 417;

    /**
     * @var int
     */
    private const HTTP_I_AM_A_TEAPOT = 418;

    /**
     * @var int
     */
    private const HTTP_MISDIRECTED_REQUEST = 421;

    /**
     * @var int
     */
    private const HTTP_UNPROCESSABLE_ENTITY = 422;

    /**
     * @var int
     */
    private const HTTP_LOCKED = 423;

    /**
     * @var int
     */
    private const HTTP_FAILED_DEPENDENCY = 424;

    /**
     * @var int
     */
    private const HTTP_TOO_EARLY = 425;

    /**
     * @var int
     */
    private const HTTP_UPGRADE_REQUIRED = 426;

    /**
     * @var int
     */
    private const HTTP_PRECONDITION_REQUIRED = 428;

    /**
     * @var int
     */
    private const HTTP_TOO_MANY_REQUESTS = 429;

    /**
     * @var int
     */
    private const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;

    /**
     * @var int
     */
    private const HTTP_UNAVAILABLE_FOR_LEGAL_REASONS = 451;

    /**
     * @var int
     */
    private const HTTP_INTERNAL_SERVER_ERROR = 500;

    /**
     * @var int
     */
    private const HTTP_NOT_IMPLEMENTED = 501;

    /**
     * @var int
     */
    private const HTTP_BAD_GATEWAY = 502;

    /**
     * @var int
     */
    private const HTTP_SERVICE_UNAVAILABLE = 503;

    /**
     * @var int
     */
    private const HTTP_GATEWAY_TIMEOUT = 504;

    /**
     * @var int
     */
    private const HTTP_VERSION_NOT_SUPPORTED = 505;

    /**
     * @var int
     */
    private const HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;

    /**
     * @var int
     */
    private const HTTP_INSUFFICIENT_STORAGE = 507;

    /**
     * @var int
     */
    private const HTTP_LOOP_DETECTED = 508;

    /**
     * @var int
     */
    private const HTTP_NOT_EXTENDED = 510;

    /**
     * @var int
     */
    private const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;

    /**
     * @param mixed $result
     * @param int $status
     *
     * @return JsonResponse
     */
    private function sendSuccess(mixed $result, int $status): JsonResponse
    {
        return new JsonResponse(['success' => true, 'result' => $result], $status);
    }

    /**
     * @param mixed $result
     * @param int $status
     *
     * @return JsonResponse
     */
    private function sendNotSuccess(mixed $result, int $status): JsonResponse
    {
        return new JsonResponse(['success' => false, 'result' => $result], $status);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendOK(mixed $result): JsonResponse
    {
        return $this->sendSuccess($result, self::HTTP_OK);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendCreated(mixed $result): JsonResponse
    {
        return $this->sendSuccess($result, self::HTTP_CREATED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendBadRequest(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_BAD_REQUEST);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendUnauthorized(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_UNAUTHORIZED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendPaymentRequired(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_PAYMENT_REQUIRED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendForbidden(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_FORBIDDEN);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendNotFound(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_NOT_FOUND);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendMethodNotAllowed(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_METHOD_NOT_ALLOWED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendNotAcceptable(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendProxyAuthenticationRequired(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_PROXY_AUTHENTICATION_REQUIRED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendRequestTimeout(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_REQUEST_TIMEOUT);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendConflict(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_CONFLICT);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendGone(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_GONE);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendLengthRequired(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_LENGTH_REQUIRED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendPreconditionFailed(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_PRECONDITION_FAILED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendRequestEntityTooLarge(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_REQUEST_ENTITY_TOO_LARGE);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendRequestURITooLong(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_REQUEST_URI_TOO_LONG);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendUnsupportedMediaType(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_UNSUPPORTED_MEDIA_TYPE);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendRequestedRangeNotSatisfiable(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendExpectationFailed(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_EXPECTATION_FAILED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendIAmATeapot(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_I_AM_A_TEAPOT);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendMisdirectedRequest(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_MISDIRECTED_REQUEST);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendUnprocessableEntity(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendLocked(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_LOCKED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendFailedDependency(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_FAILED_DEPENDENCY);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendTooEarly(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_TOO_EARLY);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendUpgradeRequired(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_UPGRADE_REQUIRED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendPreconditionRequired(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_PRECONDITION_REQUIRED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendTooManyRequest(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendRequestHeaderFieldsTooLarge(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendUnavailableForLegalReasons(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendInternalServerError(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendNotImplemented(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendBadGateway(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_BAD_GATEWAY);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendServiceUnavailable(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_SERVICE_UNAVAILABLE);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendGatewayTimeout(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_GATEWAY_TIMEOUT);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendVersionNotSupported(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_VERSION_NOT_SUPPORTED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendVariantAlsoNegotiatesExperimental(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendInsufficientStorage(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_INSUFFICIENT_STORAGE);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendLoopDetected(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_LOOP_DETECTED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendNotExtended(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_NOT_EXTENDED);
    }

    /**
     * @param mixed $result
     *
     * @return JsonResponse
     */
    public function sendNetworkAuthenticationRequired(mixed $result): JsonResponse
    {
        return $this->sendNotSuccess($result, self::HTTP_NETWORK_AUTHENTICATION_REQUIRED);
    }
}
