<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Question;

class QuestionTable extends DataTableComponent
{
    protected $model = Question::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    public function builder(): Builder
    {
        return Question::latest();
    }
    public function columns(): array
    {
        return [
            Column::make("Title", 'title')
                ->format(
                    fn ($value, $row, Column $column) => $row->title
                )
                ->html()
                ->sortable(),
            Column::make("Aksi", "id")->format(
                fn ($value, $row, Column $column) => view('admin.datatable.column.col-question-action', compact('row'))->withValue($value)
            ),
        ];
    }
}
