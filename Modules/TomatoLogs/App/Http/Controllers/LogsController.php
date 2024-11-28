<?php

namespace Modules\TomatoLogs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jackiedo\LogReader\Facades\LogReader;
use ProtoneMedia\Splade\Facades\Toast;
use Modules\TomatoLogs\App\Models\LogFile;
use Modules\TomatoLogs\App\Models\LogGetFile;
use Modules\TomatoLogs\App\Tables\FilesTable;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class LogsController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if(is_developer()){
            return Tomato::index(
                request: $request,
                model: LogFile::class,
                view: 'tomato-logs::logs.index',
                table: \Modules\TomatoLogs\App\Tables\LogsTable::class,
            );
        }
        else {
            return developer_redirect();
        }
    }

    public function show(Request $request, LogFile $record)
    {
        return view('tomato-logs::logs.view', [
            'table' => new FilesTable($record->name, $record->id),
            'record' => $record
        ]);
    }

    /**
     * @param Request $request
     * @param LogGetFile $record
     * @param $record
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function file(Request $request, LogGetFile $record)
    {
        $file = LogReader::find($record->key);
        return view('tomato-logs::logs.file', [
            'record' => $file,
            'id' => $record->parent
        ]);
    }

    public function destroy(Request $request, LogFile $record)
    {
        $log = LogReader::filename($record->name);
        $log->delete();
        LogReader::removeLogFile();
        LogFile::boot();

        Toast::title("Log Deleted Success")->success()->autoDismiss(2);
        return redirect()->back();

    }



}
