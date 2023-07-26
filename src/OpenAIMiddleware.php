<?php
namespace SilverStripe\OpenAiSearchPoc;


use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Control\Middleware\HTTPMiddleware;


class OpenAIMiddleware implements HTTPMiddleware
{
    public function process(HTTPRequest $request, callable $delegate): HTTPResponse
    {
        $response = $delegate($request);
        $response->addHeader('X-OpenAI-Response', 'true');
        return $response;
    }
}