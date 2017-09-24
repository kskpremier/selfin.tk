<?php

namespace reception\entities;

interface AggregateRoot
{
    /**
     * @return array
     */
    public function releaseEvents(): array;
}