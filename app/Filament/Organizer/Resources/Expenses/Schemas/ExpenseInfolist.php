<?php

namespace App\Filament\Organizer\Resources\Expenses\Schemas;

use Filament\Schemas\Schema;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\FontWeight;

class ExpenseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Expense Overview')
                    ->schema([
                        Grid::make(3)
                            ->schema([

                                TextEntry::make('title')
                                    ->weight(FontWeight::Bold)
                                    ->columnSpan(2),

                                TextEntry::make('payment_status')
                                    ->badge(),
                            ]),
                    ]),

                Section::make('Financial Details')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('amount')
                                    ->money('NPR')
                                    ->weight(FontWeight::Bold),

                                TextEntry::make('payment_date')
                                    ->date(),

                                TextEntry::make('payee_name')
                                    ->label('Paid To'),
                            ]),
                    ]),

                Section::make('Related Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('event.title')
                                    ->label('Event'),

                                TextEntry::make('category.name')
                                    ->label('Expense Category'),
                            ]),
                    ]),

                Section::make('Notes')
                    ->schema([
                        TextEntry::make('notes')
                            ->columnSpanFull(),
                    ]),

                Section::make('System Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')->dateTime(),
                                TextEntry::make('updated_at')->dateTime(),
                            ]),
                    ]),
            ]);
    }
}
