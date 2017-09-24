<?php

namespace reception\dispatchers;

interface EventDispatcher
{
    public function dispatchAll(array $events): void;
    public function dispatch($event): void;
}