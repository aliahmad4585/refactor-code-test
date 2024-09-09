use PHPUnit\Framework\TestCase;
use DTApi\Helpers\TeHelper;
use Carbon\Carbon;

<?php

class TeHelperTest extends TestCase
{
    public function testWillExpireAtWithin90Minutes()
    {
        $due_time = Carbon::now()->addMinutes(60)->format('Y-m-d H:i:s');
        $created_at = Carbon::now()->format('Y-m-d H:i:s');

        $result = TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($due_time, $result);
    }

    public function testWillExpireAtWithin24Hours()
    {
        $due_time = Carbon::now()->addHours(23)->format('Y-m-d H:i:s');
        $created_at = Carbon::now()->format('Y-m-d H:i:s');

        $expected = Carbon::now()->addMinutes(90)->format('Y-m-d H:i:s');
        $result = TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($expected, $result);
    }

    public function testWillExpireAtBetween24And72Hours()
    {
        $due_time = Carbon::now()->addHours(48)->format('Y-m-d H:i:s');
        $created_at = Carbon::now()->format('Y-m-d H:i:s');

        $expected = Carbon::now()->addHours(16)->format('Y-m-d H:i:s');
        $result = TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($expected, $result);
    }

    public function testWillExpireAtMoreThan72Hours()
    {
        $due_time = Carbon::now()->addHours(100)->format('Y-m-d H:i:s');
        $created_at = Carbon::now()->format('Y-m-d H:i:s');

        $expected = Carbon::now()->addHours(52)->format('Y-m-d H:i:s');
        $result = TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($expected, $result);
    }
}