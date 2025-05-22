@extends('layouts.app')

@section('title', 'Boîte de réception')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Boîte de réception</h2>

        @if($contacts->isEmpty())
            <p class="text-gray-500">Aucun message reçu.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($contacts as $contact)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $contact->student->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $contact->subject }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $contact->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $contact->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($contact->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                                           'bg-green-100 text-green-800') }}">
                                        {{ $contact->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="text-indigo-600 hover:text-indigo-900">Répondre</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 