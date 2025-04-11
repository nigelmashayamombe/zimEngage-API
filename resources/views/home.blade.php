@extends('layouts.app')

@section('content')
<div class="relative isolate overflow-hidden bg-white">
    <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-32 lg:flex lg:px-8 lg:py-40">
        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl lg:flex-shrink-0 lg:pt-8">
            <div class="mt-24 sm:mt-32 lg:mt-16">
                <a href="{{ route('feedback.create') }}" class="inline-flex space-x-6">
                    <span class="rounded-full bg-amber-600/10 px-3 py-1 text-sm font-semibold leading-6 text-amber-600 ring-1 ring-inset ring-amber-600/10">Have your say</span>
                    <span class="inline-flex items-center space-x-2 text-sm font-medium leading-6 text-gray-600">
                        <span>Submit feedback</span>
                    </span>
                </a>
            </div>
            <h1 class="mt-10 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Citizen Voice Platform</h1>
            <p class="mt-6 text-lg leading-8 text-gray-600">
                Your voice matters. Share your feedback, suggestions, and concerns with government agencies and help shape the future of public services.
            </p>
            <div class="mt-10 flex items-center gap-x-6">
                <a href="{{ route('feedback.create') }}" class="rounded-md bg-amber-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-amber-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600">
                    Submit Feedback
                </a>
                <a href="{{ route('feedback.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
                    View Your Feedback <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
        <div class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mr-0 lg:mt-0 lg:max-w-none lg:flex-none xl:ml-32">
            <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
                <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" alt="App screenshot" class="w-[76rem] rounded-md bg-white/5 shadow-2xl ring-1 ring-white/10">
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-amber-50 py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-none">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Citizen Feedback Analytics
                </h2>
                <p class="mt-4 text-lg leading-8 text-gray-600">
                    Our AI-powered sentiment analysis helps us understand citizen feedback better.
                </p>
            </div>
            <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex flex-col bg-white p-8">
                    <dt class="text-sm font-semibold leading-6 text-gray-600">Total Feedback</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-amber-600">{{ $stats['total_feedback'] ?? 0 }}</dd>
                </div>
                <div class="flex flex-col bg-white p-8">
                    <dt class="text-sm font-semibold leading-6 text-gray-600">Positive Sentiment</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-green-600">{{ $stats['positive_sentiment'] ?? 0 }}</dd>
                </div>
                <div class="flex flex-col bg-white p-8">
                    <dt class="text-sm font-semibold leading-6 text-gray-600">Negative Sentiment</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-red-600">{{ $stats['negative_sentiment'] ?? 0 }}</dd>
                </div>
                <div class="flex flex-col bg-white p-8">
                    <dt class="text-sm font-semibold leading-6 text-gray-600">Resolved Issues</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-blue-600">{{ $stats['resolved_issues'] ?? 0 }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>

<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
            <h2 class="text-base font-semibold leading-7 text-amber-600">Citizen Engagement</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">How it works</p>
            <p class="mt-6 text-lg leading-8 text-gray-600">
                Our platform uses advanced sentiment analysis to help government agencies understand citizen feedback better and respond more effectively.
            </p>
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                <div class="flex flex-col">
                    <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                        <svg class="h-5 w-5 flex-none text-amber-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                        </svg>
                        Submit Feedback
                    </dt>
                    <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                        <p class="flex-auto">
                            Share your thoughts, suggestions, or concerns about government services and policies.
                        </p>
                    </dd>
                </div>
                <div class="flex flex-col">
                    <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                        <svg class="h-5 w-5 flex-none text-amber-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 01-9.201 2.466l-.312-.311h2.433a.75.75 0 000-1.5H3.989a.75.75 0 00-.75.75v4.242a.75.75 0 001.5 0v-2.43l.31.31a7 7 0 0011.712-3.138.75.75 0 00-1.449-.39zm1.23-3.723a.75.75 0 00.219-.53V2.929a.75.75 0 00-1.5 0V5.36l-.31-.31A7 7 0 003.239 8.188a.75.75 0 101.448.389A5.5 5.5 0 0113.89 6.11l.311.31h-2.432a.75.75 0 000 1.5h4.243a.75.75 0 00.53-.219z" clip-rule="evenodd" />
                        </svg>
                        AI Analysis
                    </dt>
                    <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                        <p class="flex-auto">
                            Our AI-powered sentiment analysis processes your feedback to identify key themes and sentiments.
                        </p>
                    </dd>
                </div>
                <div class="flex flex-col">
                    <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                        <svg class="h-5 w-5 flex-none text-amber-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z" clip-rule="evenodd" />
                        </svg>
                        Government Response
                    </dt>
                    <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                        <p class="flex-auto">
                            Government agencies review the analyzed feedback and respond to address your concerns.
                        </p>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection 