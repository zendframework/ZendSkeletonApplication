<?php

namespace Standard\Interfaces;

interface PaginationInterface {

    public function getResultsAmount(): int;

    /**
     * @param int $first
     * @param int $limit
     *
     * @return array
     */
    public function getPaginationResults(
        int $first,
        int $limit
    ): array;

}
