@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Your Feedback</h2>
                    <a href="{{ route('feedback.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:border-amber-700 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Submit New Feedback
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(count($feedback) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sentiment</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($feedback as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($item->type == 'complaint') bg-red-100 text-red-800
                                                @elseif($item->type == 'suggestion') bg-yellow-100 text-yellow-800
                                                @elseif($item->type == 'inquiry') bg-blue-100 text-blue-800
                                                @elseif($item->type == 'praise') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($item->type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ \Illuminate\Support\Str::limit($item->message, 100) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($item->status == 'pending') bg-gray-100 text-gray-800
                                                @elseif($item->status == 'in_progress') bg-yellow-100 text-yellow-800
                                                @elseif($item->status == 'resolved') bg-green-100 text-green-800
                                                @elseif($item->status == 'rejected') bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($item->sentiment_label)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($item->sentiment_label == 'POSITIVE') bg-green-100 text-green-800
                                                    @elseif($item->sentiment_label == 'NEGATIVE') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst(strtolower($item->sentiment_label)) }}
                                                    @if($item->sentiment_score)
                                                        ({{ number_format($item->sentiment_score, 2) }})
                                                    @endif
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-500">Processing...</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $feedback->links() }}
                    </div>
                @else
                    <div class="bg-gray-50 p-6 text-center">
                        <p class="text-gray-500">You haven't submitted any feedback yet.</p>
                        <a href="{{ route('feedback.create') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:border-amber-700 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Submit Your First Feedback
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 