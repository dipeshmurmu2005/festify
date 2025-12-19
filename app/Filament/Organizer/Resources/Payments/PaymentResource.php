<?php

namespace App\Filament\Organizer\Resources\Payments;

use App\Filament\Organizer\Resources\Payments\Pages\CreatePayment;
use App\Filament\Organizer\Resources\Payments\Pages\EditPayment;
use App\Filament\Organizer\Resources\Payments\Pages\ListPayments;
use App\Filament\Organizer\Resources\Payments\Pages\ViewPayment;
use App\Filament\Organizer\Resources\Payments\Schemas\PaymentForm;
use App\Filament\Organizer\Resources\Payments\Schemas\PaymentInfolist;
use App\Filament\Organizer\Resources\Payments\Tables\PaymentsTable;
use App\Models\Payment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Payments';

    public static function form(Schema $schema): Schema
    {
        return PaymentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PaymentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPayments::route('/'),
            'view' => ViewPayment::route('/{record}'),
        ];
    }
}
