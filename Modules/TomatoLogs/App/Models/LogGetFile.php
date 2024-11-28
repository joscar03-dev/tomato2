<?php

namespace Modules\TomatoLogs\App\Models;

use Sushi\Sushi;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Jackiedo\LogReader\Facades\LogReader;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogGetFile extends Model
{
    use Sushi;

    protected ?array $rows;
    protected string $name = "laravel.log";

    public function getRows()
    {
        $logs = LogReader::filename($this->name)->get();

        $counter = 0;
        foreach ($logs as $key => $value) {
            $this->rows[] =[
                'id' => $counter+1,
                'key' => $value->id,
                'date' => $value->date,
                'environment' => $value->environment,
                'level' => $value->level,
                'file_path' => $value->file_path,
                'message' => $value->context->message
            ];
            $counter++;
        }

        return $this->rows;
    }

    protected function sushiShouldCache()
    {
        return true;
    }
}
