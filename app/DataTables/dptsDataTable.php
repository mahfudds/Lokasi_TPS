<?php

namespace App\DataTables;

use App\App\dpt;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
class dptsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('validasi', function($query) {
                $status = 'danger';
                switch ($query->validasi) {
                    case 0:
                        $status = 'danger';
                        $label="Belum validasi";
                        break;
                    case 1:
                        $status = 'success';
                        $label="Sudah validasi";
                        break;
                }
                return '<a href="dpts/'.$query->id.'/edit" class="btn btn-sm btn-'.$status.'">'.$label.'</a>';
            })
            ->rawColumns(['validasi']);
            ;
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\dpt $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(\App\dpt $model)
    {
        $user = Auth::user();
        $Kode_Kelurahan = $user->Kode_Kelurahan;
        $query = $model->newQuery();

        if ($Kode_Kelurahan!=='') {
            $query->where('Kode_Kelurahan', $Kode_Kelurahan);
        }

        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('dpt-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy([1, 'asc']) // Order by the second column, which is 'Kecamatan', in ascending order
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            )
            ->parameters([
                'buttons' => [
                    'dom' => [
                        'button' => [
                            'className' => 'btn'
                        ]
                    ],
                    'buttons' => [
                        ['extend' => 'excel', 'text' => 'Export to Excel', 'className' => 'btn-primary']
                    ]
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('Kecamatan'),
            Column::make('Kelurahan'),
            Column::make('No_TPS'),
            Column::make('Latitude'),
            Column::make('Longitude'),
            Column::make('Jumlah_Pemilih'),
            Column::make('validasi'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'dpt_' . date('YmdHis');
    }
}
