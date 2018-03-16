<?php

namespace Standard\Service;

use Standard\Exception\PaginationException;
use Standard\Interfaces\PaginationInterface;
use Standard\Enum\PaginationEnum;
use Zend\View\Helper\Url;

class PaginationService {

    /**
     * @var PaginationInterface
     */
    protected $service;

    /**
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $totalResults;

    /**
     * @var int
     */
    protected $totalPages;

    /**
     * @var int
     */
    protected $first;

    /**
     * @var array|object[]
     */
    protected $result;

    /**
     * @var String
     */
    private $routeName;

    /**
     * @var Url
     */
    private $url;

    /**
     * PaginationService constructor.
     *
     * @param PaginationInterface $service
     * @param String $routeName
     * @param Url $url
     */
    public function __construct(
        PaginationInterface $service,
        String $routeName,
        Url $url
    ) {
        $this->service      = $service;
        $this->routeName    = $routeName;
        $this->url          = $url;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPage() : int
    {
        return $this->page;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getLimit() : int
    {
        return $this->limit;
    }

    public function paginate()
    {
        $this->calculateFirstResult();
        $this->setTotalResults();
        $this->setTotalPages();
        $this->ifPageDoesNotExistRewriteToFirstPage();
        $this->validateLimit();
        $this->setResults();
    }

    private function calculateFirstResult()
    {
        $firstResult = $this->getLimit()*($this->getPage()-1);
        $this->setFirstResult(
            $firstResult < 0 ? 0 : $firstResult
        );
    }

    /**
     * @param int $first
     */
    private function setFirstResult(int $first)
    {
        $this->first = $first;
    }

    /**
     * @return int
     */
    private function getFirstResult() : int
    {
        return $this->first;
    }

    private function setTotalResults() : void
    {
        $this->totalResults = $this->service->getResultsAmount();
    }

    /**
     * @return int
     */
    public function getTotalResults() : int
    {
        return $this->totalResults;
    }

    private function setTotalPages() : void
    {
        $this->totalPages = ceil($this->getTotalResults()/$this->getLimit());
    }

    /**
     * @return int
     */
    public function getTotalPages() : int
    {
        return $this->totalPages;
    }

    public function ifPageDoesNotExistRewriteToFirstPage() : void
    {
        if($this->getPage() > $this->getTotalPages() OR $this->getPage() < 1) {
            $this->setPage(1);
        }
    }

    public function validateLimit() : void
    {
        if($this->getLimit() < 1)
            $this->setLimit(PaginationEnum::DEFAULT_LIMIT);
    }

    private function setResults() : void
    {
        $this->result = $this->service->getPaginationResults(
            $this->getFirstResult(),
            $this->getLimit()
        );
    }

    /**
     * @return array
     */
    public function getResult() : array
    {
        return $this->result;
    }

    /**
     * @return bool
     */
    public function isNextPage() : bool
    {
        return ($this->getPage() < $this->getTotalPages());
    }

    /**
     * @return int
     * @throws PaginationException
     */
    public function getPreviousPage() : int
    {
        if($this->isPreviousPage())
            return ($this->getPage()-1);
        else
            throw new PaginationException('You should check whether there is a previous page first');
    }

    /**
     * @return bool
     */
    public function isPreviousPage() : bool
    {
        return ($this->getPage()>1);
    }

    /**
     * @param int $limit
     *
     * @return array
     *
     * @throws PaginationException
     */
    public function getPreviousPages(int $limit = 10) : array
    {
        if($this->isPreviousPage()) {
            $pagesArray = [];
            for ($i = ($this->getPage() - 1), $limitCounter = 0; ($i > 0 AND $limitCounter!=$limit); $i--, $limitCounter++) {
                $pagesArray[] = $i;
            }
            return array_reverse($pagesArray);
        } else {
            throw new PaginationException('You should check whether there is a next page first');
        }
    }

    /**
     * @param int $limit
     *
     * @return array
     *
     * @throws PaginationException
     */
    public function getNextPages(int $limit = 10) : array
    {
        if($this->isNextPage()) {
            $pagesArray = [];
            for ($i = ($this->getPage() + 1), $limitCounter = 0; ($i <= $this->getTotalPages() AND $limitCounter!=$limit); $i++, $limitCounter++) {
                $pagesArray[] = $i;
            }
            return $pagesArray;
        } else {
            throw new PaginationException('You should firstly check if there is previous page');
        }
    }

    /**
     * @return int|null
     */
    public function getNextPage() : ?int
    {
        if($this->isNextPage()) {
            return ($this->getPage()+1);
        }

        return null;
    }

    /**
     * @return bool
     */
    public function itIsTheOnlyPage() : bool
    {
        if($this->getTotalPages()!=1)
            return false;
        return true;
    }

    /**
     * @return null|String
     */
    private function getRouteName() : ?String
    {
        return $this->routeName;
    }

    /**
     * @param int $page
     *
     * @return String
     */
    public function getPageUrl($page) : String
    {
        $url = $this->url;

        return $url(
            $this->getRouteName(),
            [
                'page' => $page, 'limit' => $this->getLimit()
            ]
        );
    }

}
