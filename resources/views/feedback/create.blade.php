@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Submit Your Feedback</h2>
                
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <p class="font-bold">Please fix the following errors:</p>
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Feedback Type</label>
                        <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="complaint" {{ old('type') == 'complaint' ? 'selected' : '' }}>Complaint</option>
                            <option value="suggestion" {{ old('type') == 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                            <option value="inquiry" {{ old('type') == 'inquiry' ? 'selected' : '' }}>Inquiry</option>
                            <option value="praise" {{ old('type') == 'praise' ? 'selected' : '' }}>Praise</option>
                            <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                        <textarea id="message" name="message" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" placeholder="Please share your feedback, suggestions, or concerns...">{{ old('message') }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">
                            Your feedback will be analyzed by our AI system to help us better understand citizen sentiments.
                        </p>
                    </div>
                    
                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:border-amber-700 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Submit Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 