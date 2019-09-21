@extends('_layouts.master')

@section('body')
<section class="container max-w-6xl mx-auto px-6 py-10 md:py-12">
    <div class="flex flex-col-reverse mb-10 lg:flex-row lg:mb-24">
        <div class="mt-8">
            <h1 class="text-red-500">{{ $page->siteName }}</h1>

            <h2 class="font-light mt-4">{{ $page->siteDescription }}</h2>

            <p class="text-lg">Manage translations easily in Laravel.</p>

            <div class="flex my-10">
                <a href="/docs/getting-started" title="{{ $page->siteName }} getting started" class="bg-red-500 hover:bg-red-600 font-normal text-white hover:text-white rounded mr-4 py-2 px-6">Get Started</a>

                <a href="#" title="Laravel i18n by Kodilab" class="bg-gray-400 hover:bg-gray-600 text-blue-900 font-normal hover:text-white rounded py-2 px-6">About Kodilab</a>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 117.48 137.16" class="w-64 ml-56 text-red-500 fill-current">
            <path d="M74.22,52.49l-5.41-3.34,0-.16,20.83,1.75.1.2L77.46,61.79c-.09-1.55-.18-2.91-.26-4.26-.06-1-.06-1-1-.78L31.63,68.8,7.45,75.36c-1.18.32-1.18.32-.55,1.41Q22.48,103.55,38,130.34a1.07,1.07,0,0,0,1.56.58q12.3-4.46,24.63-8.85l21.47-7.66c3.38-1.21,6.76-2.45,10.15-3.63.88-.31.51-.67.2-1.12L79.1,84.7Q71.87,74.06,64.64,63.43c-.39-.57-.47-.84.34-1a21.1,21.1,0,0,0,2.85-.79c.64-.23.92,0,1.26.51Q77.19,74,85.32,85.8l16.15,23.5a6.35,6.35,0,0,1,1,1.88,2.89,2.89,0,0,1-1.83,3.66c-3.57,1.32-7.16,2.61-10.74,3.92l-20.08,7.37-29,10.66a5.91,5.91,0,0,1-7.18-2.62L.58,76.47c-1.26-2.2-.44-4.19,2.09-4.88,5.38-1.46,10.78-2.86,16.17-4.28l54.5-14.41A1.41,1.41,0,0,0,74.22,52.49Z"/><path class="cls-1" d="M81.06,0A5.63,5.63,0,0,1,85.4,2.2L116.53,42l.34.46c1.14,1.63.66,3-1.26,3.56-4.53,1.24-9.07,2.45-13.6,3.68-1.72.47-3.45.92-5.17,1.41a.74.74,0,0,1-1-.34C95.29,50,94.68,49.11,94,48.3c-.42-.52-.46-.74.29-.93,5.58-1.45,11.15-2.94,16.73-4.41l.32-.08c1-.26,1-.27.36-1.11Q97.07,22.84,82.43,3.9a1.05,1.05,0,0,0-1.19-.45Q69.83,5.73,58.42,8q-11.1,2.19-22.2,4.34c-1.21.24-1.22.23-.54,1.21L62.27,52.25c.59.86.59.86-.45,1.12-.85.22-1.72.39-2.55.67a1,1,0,0,1-1.34-.49q-8.46-12.53-17-25L30.62,13.31,30.44,13c-1.3-2-.72-3.32,1.61-3.76L50.3,5.8C59,4.13,67.79,2.42,76.54.78A32.38,32.38,0,0,1,81.06,0Z"/><path class="cls-1" d="M41.56,74.56A5.65,5.65,0,0,1,45.27,76L64.59,91l12.62,9.81a8.52,8.52,0,0,1,1.67,1.58,2,2,0,0,1-.95,3.26,3.24,3.24,0,0,1-3.33-.53q-4-3.14-8-6.31a1.34,1.34,0,0,0-1.42-.28q-8.33,2.75-16.69,5.44c-.69.22-.89.49-.76,1.22.47,2.73.86,5.48,1.28,8.22a2.09,2.09,0,0,1-1.64,2.69,3.67,3.67,0,0,1-4.92-3.16c-.63-4.71-1.23-9.42-1.85-14.13Q39.2,88.37,37.83,78a2.51,2.51,0,0,1,1.82-3A4.88,4.88,0,0,1,41.56,74.56Zm3,6.88c-.37.1-.25.36-.22.55.79,5.38,1.6,10.75,2.39,16.13.08.58.35.57.79.43l12.7-4c.56-.18.52-.36.1-.68-1-.73-1.9-1.49-2.85-2.24L45.25,82C45,81.77,44.77,81.6,44.55,81.44Z"/><path class="cls-1" d="M72,16.33c.19,1.75-.87,3-1.73,4.34-.64,1-1.32,2-2,2.94a3,3,0,0,0-.24.43c-.23.52-.67,1.1-.28,1.61s1.11.24,1.7.24c2,0,3.65-1.23,5.52-1.72a5.09,5.09,0,0,1,3.76.27,3.45,3.45,0,0,1,.75.5A1.15,1.15,0,0,1,79,27.05a31.38,31.38,0,0,0-3.52,1.15,10.53,10.53,0,0,0-4.07,2.72,4.6,4.6,0,0,0-.57.8,1.45,1.45,0,0,0-.06,1.56c.3.45.81.27,1.22.21a39.28,39.28,0,0,0,5.45-1.55,16.83,16.83,0,0,1,7-.9,6.72,6.72,0,0,1,4.18,1.9,4.17,4.17,0,0,1-.07,6.22c-2.21,2.31-5,3.34-8.06,4a17,17,0,0,1-4.88.64,3.6,3.6,0,0,1-2.9-1.47c-.68-1-.42-1.74.74-2a26.57,26.57,0,0,1,3.76-.38,15.65,15.65,0,0,0,5.33-1.25,6.39,6.39,0,0,0,2.15-1.76,1.68,1.68,0,0,0,.38-1.83,1.64,1.64,0,0,0-1.59-1,15.14,15.14,0,0,0-5.32,1,35.57,35.57,0,0,1-5.52,1.6A5.51,5.51,0,0,1,66.83,34,3.87,3.87,0,0,1,67,29.84c.43-.67.24-.87-.44-1a6.86,6.86,0,0,1-2.6-1,3.08,3.08,0,0,1-1.2-4.4,22.34,22.34,0,0,1,2.29-3.11c.34-.46.67-.94,1-1.4a4.19,4.19,0,0,0,.5-4.35c-.54-1.37-.05-2.14,1.42-2.35A3.63,3.63,0,0,1,72,15.34C72,15.67,72,16,72,16.33Z"/></svg>
    </div>

    <hr class="block my-8 border lg:hidden">

    <div class="md:flex -mx-2 -mx-4">
        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-terminal.svg" class="h-12 w-12" alt="terminal icon">

            <h3 id="intro-markdown" class="text-2xl text-blue-900 mb-0">Keep your project translations <br>updated</h3>

            <p>Laravel i18n package helps you to keep your translation files updated. It detects new texts on your projects
                and removes the deprecated translations.</p>
        </div>

        <div class="mb-8 mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-window.svg" class="h-12 w-12" alt="window icon">

            <h3 id="intro-laravel" class="text-2xl text-blue-900 mb-0">Optional editor <br>to manage project translations</h3>

            <p>Laravel i18n provides an optional editor allowing you to edit your translation through your project website.</p>
        </div>

        <div class="mx-3 px-2 md:w-1/3">
            <img src="/assets/img/icon-stack.svg" class="h-12 w-12" alt="stack icon">

            <h3 id="intro-mix" class="text-2xl text-blue-900 mb-0">Add translatable attributes <br>to your models</h3>

            <p>Laravel i18n provides support to translatable attributes to your Eloquent models in a simple one step solution.</p>
        </div>
    </div>
</section>
@endsection
