<?php

namespace Modules\TomatoLogs\App\Tables;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Modules\TomatoLogs\App\Models\LogFile;

class LogsTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct(public mixed $query = null)
    {
        if(!$this->query){
            $this->query = LogFile::query();
        }
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return $this->query;
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(label: trans('tomato-admin::global.search'),columns: ['id','path'])
            ->bulkAction(
                label: trans('tomato-admin::global.crud.delete'),
                each: function (LogFile $model) {
                    $model->delete();
                },
                after: fn () => Toast::danger(trans('tomato-backup::global.delete_backup'))->autoDismiss(2),
                confirm: true
            )
            ->export()
            ->defaultSort('id')
            ->column(key: "id",label: trans('tomato-logs::global.id'), sortable: true, hidden: true)
            ->column(key: "name",label: trans('tomato-logs::global.name'), sortable: true)
            ->column(key: 'actions',label: trans('tomato-roles::global.roles.actions'))
            ->paginate(15);
    }
}
