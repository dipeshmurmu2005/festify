<?php

namespace App\Filament\Organizer\Resources\Events\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExpensesRelationManager extends RelationManager
{
    protected static string $relationship = 'expenses';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('expenses')
                    ->required()
                    ->maxLength(255),
            ]);
    }


    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([
                    TextEntry::make('title'),
                    TextEntry::make('payee_name')
                        ->label('Payee / Vendor Name'),
                    TextEntry::make('amount')
                        ->prefix('Rs. '),
                    TextEntry::make('payment_status')
                        ->label('Payment Status')
                        ->badge(),
                    TextEntry::make('payment_date')
                        ->default('No Date Provided')
                        ->label('Payment Date'),
                    TextEntry::make('created_at')
                ])->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name'),
                TextColumn::make('title'),
                TextColumn::make('amount')->prefix('Rs. '),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
