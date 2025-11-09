<?php

namespace App\Filament\Resources\KYCS\Schemas;

use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\View\Components\BadgeComponent;
use Illuminate\Support\Facades\Storage;

class KYCInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Details')->schema([
                    TextEntry::make('details.first_name'),
                    TextEntry::make('details.middle_name'),
                    TextEntry::make('details.last_name'),
                    TextEntry::make('details.gender'),
                    TextEntry::make('dob')->label(function ($record) {
                        return 'DOB ' . '(' . $record->details['dob_date_type'] . ')';
                    })->default(function ($record) {
                        $year = $record->details['dob']['year'];
                        $month = $record->details['dob']['month'];
                        $day = $record->details['dob']['day'];
                        return "$year-$month-$day";
                    }),
                ])->columnSpanFull()->columns(5),
                Section::make('Family Information')->schema([
                    TextEntry::make('details.father_or_husband_name')->label("Father's / Husband's Name"),
                    TextEntry::make('details.grandfather_or_father_in_law_name')->label("Grandfather's / Father in Law's Name"),
                    TextEntry::make('details.marital_status'),
                ])->columnSpanFull()->columns(3),
                Section::make('Permanent Address')->schema([
                    TextEntry::make('details.permanent_address.address')->label("Permanent Address"),
                    TextEntry::make('details.permanent_address.district')->label("District"),
                    TextEntry::make('details.permanent_address.municipality')->label("Municipality \ Rural Municipality"),
                    TextEntry::make('details.permanent_address.ward_no')->label('Ward No'),
                ])->columnSpanFull()->columns(4),
                Section::make('Temporary Address')->schema([
                    TextEntry::make('details.temporary_address.address')->label("Temporary Address"),
                    TextEntry::make('details.temporary_address.district')->label("District"),
                    TextEntry::make('details.temporary_address.municipality')->label("Municipality \ Rural Municipality"),
                    TextEntry::make('details.temporary_address.ward_no')->label('Ward No'),
                ])->columnSpanFull()->columns(4),
                Section::make('Documents')->schema([
                    TextEntry::make('document_type')->label("Document Type")->default('Citizenship'),
                    TextEntry::make('details.citizenship_number')->label("Citizenship Number"),
                    TextEntry::make('details.issued_district')->label("Issued District"),
                    TextEntry::make('Issued At')->label('Issued At')->default(function ($record) {
                        $year = $record->details['date_of_issued']['year'];
                        $month = $record->details['date_of_issued']['month'];
                        $day = $record->details['date_of_issued']['day'];
                        return "$year-$month-$day";
                    }),
                    ImageEntry::make('details.document_front')->belowContent(Action::make('Download')->button()->icon('heroicon-m-arrow-down')->action(function ($record) {
                        return Storage::download($record->details['document_front']);
                    })),
                    ImageEntry::make('details.document_back')->belowContent(Action::make('Download')->button()->icon('heroicon-m-arrow-down')->action(function ($record) {
                        return Storage::download($record->details['document_back']);
                    }))
                ])->columnSpanFull()->columns(4)
            ]);
    }
}
