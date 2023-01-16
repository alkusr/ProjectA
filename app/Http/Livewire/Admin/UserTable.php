<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;
    protected $no = 1;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

    }
    public function builder(): Builder
    {
        // user where has participant
        return User::whereHas('participant')->with('participant', 'participant.participantTest')->orderBy('id', 'asc');
    }
    public function columns(): array
    {
        return [
            Column::make("No", 'id')
                ->format(
                    fn ($value, $row, Column $column) => $this->no++
                ),
            Column::make("Name", "participant.name")
                ->sortable()->searchable(),
            Column::make("Asal Sekolah", "participant.school_origin")
                ->sortable()->searchable(),
            Column::make("Kelas", "participant.class")
                ->sortable(),
            Column::make("Status", "participant.name")
                ->format(
                    function ($value, $row, Column $column) {
                        if ($row->participant->participantTest) {
                            return '<span class="badge bg-success">Sudah mengerjakan</span>';
                        }
                        return '<span class="badge bg-danger">Belum mengerjakan</span>';
                    }
                )
                ->html(),
            Column::make("Aksi", "id")
                ->format(
                    fn ($value, $row, Column $column) => view('admin.datatable.column.col-user-action', compact('row'))->withValue($value)
                )
                ->html(),
        ];
    }
}
