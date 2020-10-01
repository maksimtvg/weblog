<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LogControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        UploadedFile::fake()->create('webserver.log', 100);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testFileExtension()
    {
        $response = $this->get('/parse-log/weblog.txt');
        $response->isServerError();
        $response->assertStatus(500);
    }

    public function testFileNotExist()
    {
        $response = $this->get('/parse-log/weblog.log');
        $response->assertStatus(500);
    }

    public function testFileExists()
    {
        $response = $this->get('/parse-log/webserver.log');
        $response->assertStatus(200);
    }
}
