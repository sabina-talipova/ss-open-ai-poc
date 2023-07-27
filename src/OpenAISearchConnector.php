<?php
namespace SilverStripe\OpenAiSearchPoc;

use GptTestProject\GPTApplication\GPTConnector;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\Connect\Query;

class OpenAISearchConnector
{
    public static function openAISearch(Query $preresult, string $instruction = "Please, provide a summary of those paragraphs"): ArrayList
    {
        $response = [];
        $gptHandler = new GPTConnector();
        $results = ArrayList::create(); 

        foreach ($preresult as $row) {
            $text = self::stringSanitaizer($row['Content']);

            if (empty($text)) continue;

            $response = $gptHandler->sendRequest($instruction . $text);

            $row['Content'] = $text;
            $row['OpenAIContent'] = trim(str_replace("\r\n","", json_decode($response)->choices[0]->text));
            $results->push($row);
        }

        return $results;
    }

    private static function stringSanitaizer(string $text): string
    {
        return trim(str_replace("\r\n","", $text));
    }
}