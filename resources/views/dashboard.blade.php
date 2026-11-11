@extends('layouts.app', ['breadcrumbs' => [
    ['href'=> route('dashboard'), 'text'=> 'Dashboard', 'active'],
]])

@section('title', __('Dashboard'))

@section('page_heading', 'Dashboard')

@section('content')

<section id="school-overview" class="relative isolate mb-8 overflow-hidden rounded-2xl border border-primary/15 bg-gradient-to-br from-primary/10 via-card to-card p-5 shadow-sm sm:p-7" aria-labelledby="school-overview-heading">
    <div class="absolute -right-10 -top-14 size-48 rounded-full bg-primary/5 blur-3xl" aria-hidden="true"></div>
    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div class="max-w-2xl">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-primary">School overview</p>
            <h2 id="school-overview-heading" class="mt-2 text-2xl font-semibold tracking-tight sm:text-3xl">Your school day, at a glance</h2>
            <p class="mt-2 text-sm leading-6 text-muted-foreground sm:text-base">Keep attendance, enrolment and upcoming school activity in view.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <span class="inline-flex max-w-full items-center gap-2 rounded-full border bg-background/80 px-3 py-2 text-sm font-medium shadow-sm">
                <span class="size-2 shrink-0 rounded-full bg-emerald-500" aria-hidden="true"></span>
                <span class="truncate">{{ current_school()?->name ?? config('app.name', 'Skuul') }}</span>
            </span>
            @if (current_academic_year() !== null)
                <span class="inline-flex items-center rounded-full bg-primary/10 px-3 py-2 text-sm font-medium text-foreground">
                    {{ current_academic_year()->name }}
                </span>
            @endif
        </div>
    </div>
</section>

@livewire('dashboard-data-cards')


@if (auth()->user()->hasRole(\App\Enums\Role::Student))
    <div class="flex flex-wrap items-center justify-between gap-3 border-y py-3">
        <p class="font-medium">Your profile</p>
        <april:button-link href="{{ route('students.print-profile', auth()->user()->id) }}" variant="outline">
            <x-lucide-download class="mr-2 size-4" />
            Download profile
        </april:button-link>
    </div>
@endif

@endsection
