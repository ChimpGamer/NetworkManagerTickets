<?php

namespace App\Livewire;

use App\Helpers\TimeUtils;
use App\Models\Tickets\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;
use PowerComponents\LivewirePowerGrid\Column;
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
        return Ticket::query()->where('creator', Auth::user()->uuid);
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('id_formatted', function (Ticket $model) {
                return sprintf(
                    '<a class="text-blue-600 visited:text-purple-600" href="ticket/view/%s">%s</a>',
                    urlencode(e($model->id)),
                    e($model->id)
                );
            })
            ->add('title')
            ->add('created_at')
            ->add('created_at_formatted', fn (Ticket $model) => TimeUtils::formatTimestamp($model->creation))
            ->add('last_update')
            ->add('last_update_formatted', fn (Ticket $model) => TimeUtils::formatTimestamp($model->last_update))
            ->add('active')
            ->add('active_label', function ($item) {
                if ($item->active) {
                    return '<span class="bg-green-100 text-black text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">'.__('ticket-system.status.active').'</span>';
                } else {
                    return '<span class="bg-red-100 text-black text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">'.__('ticket-system.status.closed').'</span>';
                }
            });
    }

    public function columns(): array
    {
        return [
            Column::make(__('ticket-system.table.my-tickets.columns.ticket'), 'id_formatted', 'id')
                ->searchable()
                ->sortable(),

            Column::make(__('ticket-system.table.my-tickets.columns.subject'), 'title')
                ->searchable()
                ->sortable(),

            Column::make(__('ticket-system.table.my-tickets.columns.created_at'), 'created_at')
                ->hidden(),

            Column::make(__('ticket-system.table.my-tickets.columns.created_at'), 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::make(__('ticket-system.table.my-tickets.columns.updated_at'), 'last_update')
                ->hidden(),

            Column::make(__('ticket-system.table.my-tickets.columns.updated_at'), 'last_update_formatted', 'last_update')
                ->searchable(),

            Column::make(__('ticket-system.table.my-tickets.columns.status'), 'active_label', 'active')
                ->sortable(),
        ];
    }

    /*public function filters(): array
    {
        return [
            Filter::datepicker('created_at_formatted', 'created_at'),
            Filter::datepicker('last_update_formatted', 'last_update'),
        ];
    }*/
}
