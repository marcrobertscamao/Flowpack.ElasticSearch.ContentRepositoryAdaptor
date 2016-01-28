<?php
namespace Flowpack\ElasticSearch\ContentRepositoryAdaptor\Domain\Model;

/*                                                                                                  *
 * This script belongs to the TYPO3 Flow package "Flowpack.ElasticSearch.ContentRepositoryAdaptor". *
 *                                                                                                  *
 * It is free software; you can redistribute it and/or modify it under                              *
 * the terms of the GNU Lesser General Public License, either version 3                             *
 *  of the License, or (at your option) any later version.                                          *
 *                                                                                                  *
 * The TYPO3 project - inspiring people to share!                                                   *
 *                                                                                                  */

use Flowpack\ElasticSearch\ContentRepositoryAdaptor\Exception;
use TYPO3\TYPO3CR\Search\Search\QueryBuilderInterface;

/**
 * Query Interface
 */
interface QueryInterface
{
    /**
     * Get the current request
     *
     * @return array
     */
    public function toArray();

    /**
     * Get the current request as JSON string
     *
     * @return string
     */
    public function getRequestAsJSON();

    /**
     * Get the current count request as JSON string
     *
     * This method must adapt the current query to be compatible with the count API
     *
     * @return string
     */
    public function getCountRequestAsJSON();

    /**
     * Add a sort filter to the request
     *
     * @param array $configuration
     * @return QueryBuilderInterface
     * @api
     */
    public function addSortFilter($configuration);

    /**
     * Set the size (limit) of the request
     *
     * @param integer $size
     * @return QueryBuilderInterface
     * @api
     */
    public function size($size);

    /**
     * Set the from (offset) of the request
     *
     * @param integer $size
     * @return QueryBuilderInterface
     * @api
     */
    public function from($size);

    /**
     * Match the searchword against the fulltext index
     *
     * @param string $searchWord
     * @return QueryBuilderInterface
     * @api
     */
    public function fulltext($searchWord);

    /**
     * Configure Result Highlighting. Only makes sense in combination with fulltext(). By default, highlighting is enabled.
     * It can be disabled by calling "highlight(FALSE)".
     *
     * @param integer|boolean $fragmentSize The result fragment size for highlight snippets. If this parameter is FALSE, highlighting will be disabled.
     * @param integer $fragmentCount The number of highlight fragments to show.
     * @return QueryBuilderInterface
     * @api
     */
    public function highlight($fragmentSize, $fragmentCount = null);

    /**
     * This method is used to create any kind of aggregation.
     *
     * @param string $name
     * @param array $aggregationDefinition
     * @param null $parentPath
     * @return QueryBuilderInterface
     * @api
     * @throws Exception\QueryBuildingException
     */
    public function aggregation($name, array $aggregationDefinition, $parentPath = null);

    /**
     * This method is used to create any kind of suggestion.
     *
     * @param string $name
     * @param array $suggestionDefinition
     * @return QueryBuilderInterface
     * @api
     */
    public function suggestions($name, array $suggestionDefinition);

    /**
     * Add a query filter
     *
     * @param string $filterType
     * @param mixed $filterOptions
     * @param string $clauseType one of must, should, must_not
     * @throws Exception\QueryBuildingException
     * @return QueryBuilderInterface
     * @api
     */
    public function queryFilter($filterType, $filterOptions, $clauseType = 'must');

    /**
     * @param string $path
     * @param string $value
     * @return QueryBuilderInterface
     */
    public function setValueByPath($path, $value);

    /**
     * Append $data to the given array at $path inside $this->request.
     *
     * Low-level method to manipulate the ElasticSearch Query
     *
     * @param string $path
     * @param array $data
     * @throws Exception\QueryBuildingException
     * @return QueryBuilderInterface
     */
    public function appendAtPath($path, array $data);
}
