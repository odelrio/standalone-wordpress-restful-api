<?php

namespace HyperWP\Domain\Model;

use DatePeriod;
use DateTime;

interface PostRepository
{
    public function all(string $status);
    public function find(int $id);
    public function byDate(DateTime $dateTime);
    public function byDateRange(DatePeriod $datePeriod);
}