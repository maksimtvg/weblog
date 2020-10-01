<?php

namespace App\Http\Controllers;

use App\Services\Log\WeblogSortInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LogController extends Controller
{
    const LOGS_PATH = 'public';
    const LOG_FILE_EXTENSION = 'log';

    /**
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * @param string $fileName
     * @param WeblogSortInterface $weblogSortService
     * @return View
     * @throws Exception
     */
    public function parseLog(string $fileName, WeblogSortInterface $weblogSortService): View
    {
        if (substr($fileName, -3) !== self::LOG_FILE_EXTENSION) {
            throw new Exception('Wrong file extension. Please use [.log] file extension');
        }

        if (!Storage::exists(self::LOGS_PATH . '/' . $fileName . '')) {
            throw new Exception('File doesn\'t exist');
        }
        $fileContents = Storage::get(self::LOGS_PATH . '/' . $fileName . '');

        [$mostVisitedPages, $uniquePagesViews] = $weblogSortService->sort($fileContents);

        return view('log')
            ->with('uniquePagesViews', $uniquePagesViews)
            ->with('mostVisitedPages', $mostVisitedPages);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
