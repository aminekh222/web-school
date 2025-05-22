@extends('layouts.app')

@section('title', 'Historique des contacts')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Historique des contacts</h2>
            <a href="{{ route('student.contact') }}" class="text-indigo-600 hover:text-indigo-900">
                Nouveau message
            </a>
        </div>

        @if($contacts->isEmpty())
            <p class="text-gray-500">Vous n'avez pas encore envoyé de messages.</p>
        @else
            <div class="space-y-6">
                @foreach($contacts as $contact)
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $contact->subject }}</h3>
                                <p class="text-sm text-gray-500">Envoyé le {{ $contact->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $contact->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($contact->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                                   'bg-green-100 text-green-800') }}">
                                {{ $contact->status }}
                            </span>
                        </div>

                        <div class="prose max-w-none">
                            <p class="text-gray-700">{{ $contact->message }}</p>
                        </div>

                        @if($contact->response)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Réponse de l'administration</h4>
                                <p class="text-sm text-gray-700">{{ $contact->response }}</p>
                                <p class="text-xs text-gray-500 mt-2">Répondu le {{ $contact->response_date->format('d/m/Y à H:i') }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 