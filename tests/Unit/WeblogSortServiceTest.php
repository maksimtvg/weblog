<?php

namespace Tests\Unit;

use App\Services\Log\WeblogSortService;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WeblogSortServiceTest extends TestCase
{
    private $weblogSortService;

    public function setUp(): void
    {
        parent::setUp();
        $this->weblogSortService = resolve(WeblogSortService::class);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSuccessSort()
    {
        $response = $this->weblogSortService->sort(Storage::get('public\webserver.log'));

        $this->assertIsArray($response);
        $this->assertArrayHasKey(0, $response);
        $this->assertArrayHasKey(1, $response);
        $this->assertIsArray($response[0]);
        $this->assertIsArray($response[1]);
    }

    public function testEmptyResponse()
    {
        $response = $this->weblogSortService->sort('');
        $this->assertEmpty($response[0]);
        $this->assertEmpty($response[1]);
    }

    public function testMostVisitedPages()
    {
        $log = <<<EOT
                /help_page 126.318.035.038
                /contact 184.123.665.067
                /help_page 126.318.035.038
                /help_page 126.318.035.038
                /help_page 126.318.035.038
                /index 444.701.448.104
                EOT;

        $response = $this->weblogSortService->sort($log);
        $this->assertEquals(4, $response[0]['/help_page']);
        $this->assertEquals(1, $response[0]['/contact']);
    }

    public function testUniquePagesViews()
    {
        $log = <<<EOT
                /help_page 126.318.035.038
                /contact 184.123.665.067
                /help_page 126.318.035.038
                /help_page 126.318.035.038
                /help_page 543.910.244.929
                /index 444.701.448.104
                /index 222.333.448.104
                EOT;

        $response = $this->weblogSortService->sort($log);
        $this->assertEquals(2, $response[1]['/help_page']);
        $this->assertEquals(1, $response[1]['/contact']);
        $this->assertEquals(2, $response[1]['/index']);
    }
}
