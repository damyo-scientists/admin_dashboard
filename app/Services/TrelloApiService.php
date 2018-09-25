<?php
/**
 * Created by PhpStorm.
 * User: Velmont
 * Date: 2018-09-02
 * Time: 오후 9:17
 */

namespace App\Services;

use Trello\Client;


class TrelloApiService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $contents;

    /**
     * @param string $apiKey
     * @param string $token
     * @return TrelloApiService
     */
    public function init(string $apiKey, string $token): TrelloApiService
    {
        $this->client = new Client();
        $this->client->authenticate($apiKey, $token, Client::AUTH_URL_CLIENT_ID);
        $this->contents = [];
        return $this;
    }

    public function boardMember(string $boardId, string $memberName)
    {
        $nameFilter = array('username' => $memberName);
        $this->contents = $this->client->boards()->members()->all($boardId);
        //$this->filter($nameFilter);
        return $this;
    }

    public function boardMembers(string $boardId, array $memberNamesFilter)
    {
        $this->contents = $this->client->boards()->members()->all($boardId);
        $this->filter($memberNamesFilter);
        return $this;
    }

    public function boardCards(string $boardId, string $visibilityFilter = ''): TrelloApiService
    {
        $allowShowCustomField = array(
            'customFieldItems' => 'true'
        );
        if (empty($visibilityFilter))
            $boardCards = $this->client->boards()->cards()->all($boardId, $allowShowCustomField);
        else
            $boardCards = $this->client->boards()->cards()->filter($boardId, $visibilityFilter);
        $this->contents = $boardCards;
        return $this;
    }

    /**
     * @param string $boardId
     * @return TrelloApiService
     */
    public function boardCustomFields(string $boardId): TrelloApiService
    {
        $boardFields = $this->client->board()->customFields()->all($boardId);
        $this->contents = $boardFields;

        return $this;
    }

    public function filter(array $filters = [], bool $divideByFilterValue = false): TrelloApiService
    {
        $filteredContents = [];
        $contents = $this->contents;
        foreach ($filters as $filterKey => $filterValue) {
            foreach ($contents as $content) {
                if (is_array($content[$filterKey])) {
                    foreach ($content[$filterKey] as $contentValue) {
                        if (!is_array($filterValue)) {
                            if ($contentValue === $filterValue) {
                                if ($divideByFilterValue) {
                                    $filteredContents[$filterValue][] = $content;
                                } else {
                                    $filteredContents[] = $content;
                                }
                            }
                        } else {
                            foreach ($filterValue as $childValue) {
                                if ($contentValue === $childValue) {
                                    if ($divideByFilterValue) {
                                        $filteredContents[$childValue][] = $content;
                                    } else {
                                        $filteredContents[] = $content;
                                    };
                                }
                            }
                        }
                    }
                } else {
                    if (!is_array($filterValue)) {
                        if ($content[$filterKey] === $filterValue) {
                            if ($divideByFilterValue) {
                                $filteredContents[$filterValue][] = $content;
                            } else {
                                $filteredContents[] = $content;
                            }
                        }
                    } else {
                        foreach ($filterValue as $childValue) {
                            if ($content[$filterKey] === $childValue) {
                                if ($divideByFilterValue) {
                                    $filteredContents[$childValue][] = $content;
                                } else {
                                    $filteredContents[] = $content;
                                };
                            }
                        }
                    }
                }
            }
        }
        $this->contents = $filteredContents;
        return $this;
    }

    public function notEmptyFilter(array $filters = []): TrelloApiService
    {
        $filteredContents = [];
        $contents = $this->contents;
        foreach ($filters as $filterValue) {
            foreach ($contents as $content) {
                if (!empty($content[$filterValue])) {
                    $filteredContents[] = $content;
                }
            }
        }
        $this->contents = $filteredContents;
        return $this;
    }

    public function customFields(array $customFieldsFilter = []): TrelloApiService
    {
        $filteredContents = [];
        $contents = $this->contents;
        foreach ($customFieldsFilter as $customFieldFilter) {
            foreach ($contents as $content) {
                foreach ($content['customFieldItems'] as $customFieldItem) {
                    foreach ($customFieldFilter['ids'] as $id) {
                        if ($customFieldItem['idCustomField'] === $id) {
                            $content[$customFieldFilter['name']] = $customFieldItem['value'][$customFieldFilter['type']];
                        }
                    }
                }
                $filteredContents[] = $content;
            }
        }
        $this->contents = $filteredContents;
        return $this;
    }

    public function get(): array
    {
        return $this->contents;
    }

    public function getFirst(): array
    {
        return $this->contents[0];
    }
}