<?php
//Add namespace from composer.json file
namespace Silverstripe\OpenAiSearchPoc;

//Include the SearchQuery class
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery;
//Include the PageController class
use SilverStripe\CMS\Controllers\ContentController;
//Generate a new PHP class controller that extends the Silverstripe CMS PageController class

class SearchController
{
    //Create a function that returns a list of all the pages on the site
    public function openAIRequest(string $request)
    {
        //Get the search query from the URL
        $searchQuery = $this->getRequest()->getVar('query');
        //If the search query is not empty
        if ($searchQuery) {
            //Create a new search context
            $searchContext = singleton('SiteTree')->getCustomSearchContext();
            //Create a new search query
            $searchQuery = new SearchQuery();
            //Create a new search result
            $searchResults = $searchContext->getResults($searchQuery->search($searchQuery));
            //Return the search results
            return $searchResults;
        }
    }
}