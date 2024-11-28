<?php

namespace App\Livewire;

use App\Models\Tickets\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class MyTicketsTable extends PowerGridComponent
{

    public string $tableName = 'my-tickets-table';

    public string $sortField = 'id';
    public string $sortDirection = 'desc';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
        ];
    }

    public function datasource(): Builder
    {
        return Ticket::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('created_at')
            ->add('created_at_formatted', fn (Ticket $model) => Carbon::createFromTimestampMs($model->creation)->format('d/m/Y H:i:s'))
            ->add('last_update')
            ->add('last_update_formatted', fn (Ticket $model) => Carbon::createFromTimestampMs($model->last_update)->format('d/m/Y H:i:s'))
            ->add('active')
            ->add('active_label', function ($item) {
                if ($item->active) {
                    return '<span class="bg-green-100 text-black text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>';
                } else {
                    return '<span class="bg-red-100 text-black text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Closed</span>';
                }
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Ticket', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Subject', 'title')
                ->searchable()
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::make('Updated at', 'last_update')
                ->hidden(),

            Column::make('Updated at', 'last_update_formatted', 'last_update')
                ->searchable(),

            Column::make('Status', 'active_label', 'active')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('created_at_formatted', 'created_at'),
            Filter::datepicker('last_update_formatted', 'last_update'),
        ];
    }
}
