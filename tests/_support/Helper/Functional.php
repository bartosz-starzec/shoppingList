<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Functional extends \Codeception\Module
{
    const DEFAULT_TIMEOUT = 30;
    const PAGE_LOAD_TIMEOUT = 10;
    const MIN_TIMEOUT = 1;
}
