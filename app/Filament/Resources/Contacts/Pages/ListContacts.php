<?php

namespace App\Filament\Resources\Contacts\Pages;

use App\Filament\Resources\Contacts\ContactResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    public function mount(): void
    {
        parent::mount();

        $contact = \App\Models\Contact::first();
        
        if ($contact) {
            $this->redirect(ContactResource::getUrl('edit', ['record' => $contact->id]));
        } else {
            $this->redirect(ContactResource::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
