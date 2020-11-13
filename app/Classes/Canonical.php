<?php

namespace Main\Classes;

use Illuminate\Http\Request;

class Canonical
{
    /**
     * Determine whether the current request needs a canonical link.
     *
     * @return bool
     */
    public static function needsLink(): bool
    {
        $request = Request::capture();

        $destination = self::getCanonicalDestination();

        return self::getBaseUrl($request) !== $destination;
    }

    /**
     * Get the base request of the current request.
     *
     * @param Request $request
     *
     * @return string
     */
    private static function getBaseUrl(Request $request): string
    {
        return str_replace($request->getRequestUri(), '', $request->url());
    }

    /**
     * Get the destination of the canonical link.
     *
     * @return string
     */
    public static function getCanonicalDestination(): string
    {
        return request()->getSchemeAndHttpHost();
    }

    /**
     * Generate a canonical link for the current request.
     *
     * @return string
     */
    public static function getLink(): string
    {
        $request = Request::capture();

        $destination = self::getCanonicalDestination();

        return "{$destination}{$request->getPathInfo()}";
    }
}
