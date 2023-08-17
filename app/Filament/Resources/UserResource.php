<?php

namespace App\Filament\Resources;

use App\Enums\GenderEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\LandlordRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\TenantRelationManager;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->placeholder('Enter name')
                    ->columnSpan([
                        'default' => 6,
                        'md' => 6,
                        'lg' => 6,
                    ]),

                TextInput::make('email')
                    ->required()
                    ->placeholder('Enter email')
                    ->columnSpan([
                        'default' => 6,
                        'md' => 6,
                        'lg' => 6,
                    ]),

                // do masking for phone number input later
                TextInput::make('phone_no')
                    ->label('Phone number')
                    ->rules(['max:11', 'string'])
                    ->maxLength(11)
                    ->required()
                    ->placeholder('Enter phone number')
                    ->columnSpan([
                        'default' => 6,
                        'md' => 6,
                        'lg' => 6,
                    ]),

                Select::make('gender')
                    ->options([
                        1 => 'Male',
                        2 => 'Female',
                    ])
                    ->required()
                    ->placeholder('Select gender')
                    ->columnSpan([
                        'default' => 6,
                        'md' => 6,
                        'lg' => 6,
                    ]),

                DatePicker::make('dob')
                    ->label('Date of birth')
                    ->required()
                    ->placeholder('Select date of birth')
                    ->columnSpan([
                        'default' => 6,
                        'md' => 6,
                        'lg' => 6,
                    ]),

                TextInput::make('nric')
                    ->rules(['max:14', 'string'])
                    ->maxLength(14)
                    ->required()
                    ->mask('999999-99-9999')
                    ->placeholder('Enter nric')
                    ->columnSpan([
                        'default' => 6,
                        'md' => 6,
                        'lg' => 6,
                    ]),

                Textarea::make('address')
                    ->rows(3)
                    ->rules(['max:255', 'string'])
                    ->maxLength(255)
                    ->required()
                    ->placeholder('Enter address')
                    ->columnSpan([
                        'default' => 6,
                        'md' => 6,
                        'lg' => 6,
                    ]),

                Select::make('type')
                    ->required()
                    ->placeholder('Select user type')
                    ->options([
                        1 => 'Tenant',
                        2 => 'Landlord'
                    ])
                    ->columnSpan([
                        'default' => 6,
                        'md' => 6,
                        'lg' => 6,
                    ]),

                Hidden::make('password')
                    ->dehydrateStateUsing(fn ($state) => \Hash::make($state))
                    ->default('password'),

            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),

                TextColumn::make('email'),

                TextColumn::make('phone_no'),

                TextColumn::make('gender')
                    ->formatStateUsing(function ($state) {
                        if ($state == GenderEnum::Male()) {
                            return 'Male';
                        }

                        return 'Female';
                    }),

                // TextColumn::make('dob')
                //     ->label('Date of birth')
                //     ->formatStateUsing(fn ($record) => Carbon::parse($record->dob)->format('d F Y')),

                TextColumn::make('type')
                    ->getStateUsing(function ($record) {
                        $user = User::where('id', $record->id)->first();

                        if ($user->hasRole('super_admin')) {
                            return 'Super Admin';
                        } else if ($user->hasRole('landlord')) {
                            return 'Landlord';
                        }

                        return 'Tenant';
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('User')
                    ->schema([
                        TextEntry::make('name')
                            ->columnSpan(1),

                        TextEntry::make('email')
                            ->columnSpan(1),

                        TextEntry::make('phone_no')
                            ->columnSpan(1),

                        TextEntry::make('gender')
                            ->formatStateUsing(function ($state) {
                                if ($state == GenderEnum::Male()) {
                                    return 'Male';
                                }

                                return 'Female';
                            })
                            ->columnSpan(1),

                        TextEntry::make('dob')
                            ->label('Date of birth')
                            ->formatStateUsing(fn ($record) => Carbon::parse($record->dob)->format('d F Y'))
                            ->columnSpan(1),

                        TextEntry::make('nric')
                            ->label('NRIC')
                            ->formatStateUsing(fn ($record) => preg_replace('/(\d{3})(\d{1})(\d{7})/', '$1-$2$3', $record->phone_no))
                            ->columnSpan(1),

                        TextEntry::make('address')
                            ->columnSpan(3),
                    ])->columns(3)

            ]);
    }

    public static function getRelations(): array
    {
        return [
            TenantRelationManager::class,
            LandlordRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
