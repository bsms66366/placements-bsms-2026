<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Privacy Notice</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <svg viewBox="0 0 651 192" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-18 w-auto text-gray-700 sm:h-20">
                            <g clip-path="url(#clip0)" fill="#00627F">
                            <path class="st0" d="M121.7,34.5h3.3v15.6h0.2c1.6-3.7,5.4-6.2,9.4-5.9c8.2,0,12.2,6.7,12.2,14.4s-4,14.4-12.2,14.4
                                    c-4.1,0.2-8-2.2-9.7-5.9h-0.2v5.2h-3.1V34.5z M134.5,46.8c-7.1,0-9.5,5.9-9.5,11.6s2.5,11.6,9.5,11.6c6.3,0,8.9-5.9,8.9-11.6
                                    S140.9,46.8,134.5,46.8L134.5,46.8z"/>
                                <path class="st0" d="M152,44.8h3.1v6.4h0.2c1.6-4.4,5.8-7.1,10.3-6.7v3.2c-5.2-0.4-9.7,3.5-10.1,8.6c0,0.4,0,0.8,0,1.2V72h-3.3
                                    L152,44.8z"/>
                                <path class="st0" d="M168.7,34.5h3.3v5.3h-3.3V34.5z M168.7,44.8h3.3V72h-3.3V44.8z"/>
                                <path class="st0" d="M201.3,69.9c0,8.1-3.2,13.2-12.1,13.2c-5.4,0-10.9-2.5-11.3-8.2h3.3c0.8,4,4.3,5.4,8,5.4
                                    c6.2,0,8.8-3.6,8.8-10.3v-3.7h-0.2c-1.6,3.3-4.9,5.5-8.6,5.5c-8.8,0-12.2-6.2-12.2-14c0-7.5,4.4-13.6,12.2-13.6
                                    c3.7,0,7.1,2.2,8.6,5.5h0.2V45h3.3V69.9z M198.1,58.2c0-5.3-2.5-11.3-8.8-11.3c-6.3,0-9,5.7-9,11.3s2.9,10.9,9,10.9
                                    C195,68.9,198.1,63.7,198.1,58.2z"/>
                                <path class="st0" d="M207.6,34.5h3.3v15.2h0.2c1.6-3.5,4.9-5.5,8.8-5.5c7.6,0,9.9,4,9.9,10.5v17.4h-3.3v-17c0-4.7-1.6-8.2-7-8.2
                                    s-8.4,4-8.5,9.3v16h-3.3L207.6,34.5L207.6,34.5z"/>
                                <path class="st0" d="M241.3,44.8h5.5v2.7h-5.5v18.3c0,2.2,0.2,3.5,2.7,3.6c0.9,0,1.9,0,2.9-0.2v2.9c-1,0-1.9,0.2-2.9,0.2
                                    c-4.4,0-5.9-1.6-5.9-6.2V47.5h-4.8v-2.9h4.8v-8.1h3.3V44.8z"/>
                                <path class="st0" d="M276.1,58.4c0,7.8-4.5,14.4-12.9,14.4c-8.4,0-12.9-6.6-12.9-14.4S254.8,44,263.2,44
                                    C271.6,44,276.1,50.6,276.1,58.4z M253.6,58.4c0,5.8,3.2,11.6,9.5,11.6c6.3,0,9.5-5.8,9.5-11.6s-3.2-11.6-9.5-11.6
                                    S253.6,52.6,253.6,58.4z"/>
                                <path class="st0" d="M281,44.8h3.3v4.7l0,0c1.6-3.5,4.9-5.5,8.8-5.5c7.6,0,9.9,4,9.9,10.5V72h-3.2v-17c0-4.7-1.6-8.2-7-8.2
                                    c-5.4,0-8.4,4-8.5,9.3v16H281V44.8z"/>
                                <path class="st0" d="M323.6,53.1c0.2-6.4,4.8-9.1,10.9-9.1c4.8,0,10.1,1.6,10.1,8.8v14.4c-0.2,0.9,0.6,1.8,1.6,2.1
                                    c0.2,0,0.2,0,0.6,0c0.4,0,0.8-0.2,1-0.2v2.9c-0.8,0.2-1.4,0.2-2.2,0.2c-3.3,0-3.9-1.9-3.9-4.8h-0.2c-2.3,3.5-4.7,5.5-9.9,5.5
                                    c-5,0-9.1-2.5-9.1-8c0-7.6,7.5-7.8,14.6-8.8c2.7-0.2,4.3-0.6,4.3-3.7c0-4.5-3.2-5.5-7.1-5.5c-4.1,0-7.2,1.9-7.4,6.3L323.6,53.1z
                                     M341.4,57.1L341.4,57.1c-0.6,0.8-1.9,1-2.9,1.2c-5.7,1-12.6,0.9-12.6,6.3c0,3.3,2.9,5.4,6,5.4c5,0,9.5-3.2,9.5-8.5L341.4,57.1
                                    L341.4,57.1L341.4,57.1z"/>
                                <path class="st0" d="M351.4,44.8h3.3v4.7h0.2c1.6-3.5,4.9-5.5,8.8-5.5c7.6,0,9.9,4,9.9,10.5V72h-3.3v-17c0-4.7-1.6-8.2-7-8.2
                                    c-5.4,0-8.4,4-8.5,9.3v16h-3.3L351.4,44.8L351.4,44.8z"/>
                                <path class="st0" d="M403.7,72h-3.1v-5.2h-0.2c-1.4,3.5-5.8,5.9-9.7,5.9c-8.2,0-12.2-6.7-12.2-14.4s4-14.4,12.2-14.4
                                    c4.1-0.2,7.8,2.2,9.4,5.9h0.2V34.5h3.3V72z M390.8,70c7.1,0,9.5-5.9,9.5-11.6s-2.5-11.6-9.5-11.6c-6.3,0-8.9,5.9-8.9,11.6
                                    S384.5,70,390.8,70L390.8,70z"/>
                                <path class="st0" d="M441,52.8c-0.2-4.1-3.3-5.9-7.1-5.9c-2.9,0-6.4,1.2-6.4,4.7c0,2.9,3.3,4,5.7,4.7l4.4,1
                                    c3.9,0.6,7.8,2.9,7.8,7.5c0,5.9-5.8,8.1-10.9,8.1c-6.3,0-10.7-2.9-11.2-9.7h3.3c0.2,4.5,3.6,6.8,8,6.8c3.1,0,7.5-1.4,7.5-5.2
                                    c0-3.2-2.9-4.3-5.9-4.9l-4.3-0.9c-4.4-1.2-7.6-2.6-7.6-7.4c0-5.5,5.4-7.6,10.1-7.6c5.4,0,9.8,2.9,9.9,8.8
                                    C444.1,52.8,441,52.8,441,52.8z"/>
                                <path class="st0" d="M472.1,72H469v-4.9h-0.2c-1.8,3.6-5.4,5.8-9.4,5.7c-6.8,0-9.5-4-9.5-10.3V44.8h3.3v17.8
                                    c0.2,4.9,1.9,7.5,7.4,7.5c5.7,0,8.1-5.4,8.1-10.9V44.8h3.3L472.1,72z"/>
                                <path class="st0" d="M494.7,52.8c-0.2-4.1-3.3-5.9-7.1-5.9c-2.9,0-6.4,1.2-6.4,4.7c0,2.9,3.3,4,5.7,4.7l4.3,1
                                    c3.9,0.6,7.8,2.9,7.8,7.5c0,5.9-5.8,8.1-10.9,8.1c-6.3,0-10.7-2.9-11.2-9.7h3.3c0.2,4.5,3.6,6.8,8,6.8c3.1,0,7.5-1.4,7.5-5.2
                                    c0-3.2-2.9-4.3-5.9-4.9l-4.3-0.9c-4.4-1.2-7.6-2.6-7.6-7.4c0-5.5,5.4-7.6,10.1-7.6c5.4,0,9.8,2.9,9.9,8.8
                                    C497.9,52.8,494.7,52.8,494.7,52.8z"/>
                                <path class="st0" d="M520.1,52.8c-0.2-4.1-3.3-5.9-7.1-5.9c-2.9,0-6.4,1.2-6.4,4.7c0,2.9,3.3,4,5.7,4.7l4.3,1
                                    c3.9,0.6,7.8,2.9,7.8,7.5c0,5.9-5.8,8.1-10.9,8.1c-6.3,0-10.7-2.9-11.2-9.7h3.3c0.2,4.5,3.6,6.8,8,6.8c3.1,0,7.5-1.4,7.5-5.2
                                    c0-3.2-2.9-4.3-5.9-4.9l-4.3-0.9c-4.4-1.2-7.6-2.6-7.6-7.4c0-5.5,5.4-7.6,10.1-7.6c5.4,0,9.8,2.9,9.9,8.8
                                    C523.3,52.8,520.1,52.8,520.1,52.8z"/>
                                <path class="st0" d="M531.1,59.4c0,4.9,2.6,10.7,9,10.7c4.9,0,7.5-2.9,8.5-7h3.3c-1.4,6.2-5,9.8-11.9,9.8
                                    c-8.6,0-12.2-6.7-12.2-14.4c0-7.2,3.6-14.4,12.2-14.4c8.6,0,12.2,7.6,12,15.4L531.1,59.4z M548.7,56.6c-0.2-5-3.2-9.7-8.6-9.7
                                    c-5.4,0-8.4,4.8-9,9.7H548.7z"/>
                                <path class="st0" d="M563.9,57.9l-9.8-13.2h4.1l7.8,10.3l7.6-10.3h4.1L568,57.9l10.5,14.2h-4.3l-8.5-11.5l-8.4,11.5h-4.1
                                    L563.9,57.9z"/>
                                <path class="st0" d="M121.7,103.5h3.1v4.7h0.2c1.7-3.3,5.2-5.5,8.9-5.4c3.6,0,6.8,1.7,7.8,5.3c1.6-3.3,4.9-5.4,8.6-5.3
                                    c5.9,0,9,3.1,9,9.5v18.5h-3.4v-18.2c0-4.5-1.7-7-6.4-7c-5.8,0-7.4,4.8-7.4,9.8v15.5h-3.3v-18.5c0-3.7-1.6-6.7-5.7-6.7
                                    c-5.8,0-8.1,4.4-8.1,10.1v15.2h-3.3V103.5z"/>
                                <path class="st0" d="M167.6,118.1c0,4.9,2.6,10.7,9,10.7c4.9,0,7.5-2.9,8.5-7h3.3c-1.4,6.2-5,9.8-11.9,9.8
                                    c-8.6,0-12.2-6.7-12.2-14.4c0-7.2,3.6-14.4,12.2-14.4c8.6,0,12.2,7.6,12,15.4L167.6,118.1z M185.2,115.2c-0.2-5-3.2-9.7-8.6-9.7
                                    s-8.4,4.8-9,9.7H185.2z"/>
                                <path class="st0" d="M217,130.8h-3.1v-5.2h-0.2c-1.4,3.5-5.8,5.9-9.7,5.9c-8.2,0-12.2-6.7-12.2-14.4s4-14.4,12.2-14.4
                                    c4.1-0.2,7.8,2.2,9.4,5.9h0.2V93.1h3.3L217,130.8z M204.1,128.8c7.1,0,9.5-5.9,9.5-11.6c0-5.6-2.5-11.6-9.5-11.6
                                    c-6.3,0-8.9,5.9-8.9,11.6C195.2,122.8,197.8,128.8,204.1,128.8L204.1,128.8z"/>
                                <path class="st0" d="M223.4,93h3.3v5.3h-3.3V93z M223.4,103.5h3.3v27.2h-3.3V103.5z"/>
                                <path class="st0" d="M252.2,112.1c-0.9-4.1-3.3-6.6-7.8-6.6c-6.4,0-9.5,5.8-9.5,11.6s3.2,11.6,9.5,11.6c4.3-0.2,7.8-3.5,7.8-7.8
                                    h3.3c-0.9,6.6-5.2,10.5-11.2,10.5c-8.4,0-12.9-6.6-12.9-14.4s4.5-14.4,12.9-14.4c5.8,0,10.3,3.1,11.1,9.3h-3.3V112.1z"/>
                                <path class="st0" d="M260.1,111.9c0.2-6.4,4.8-9.1,11.1-9.1c4.8,0,10.1,1.6,10.1,8.8V126c-0.2,0.9,0.6,1.8,1.6,1.9
                                    c0.2,0,0.2,0,0.4,0c0.4,0,0.8-0.2,1-0.2v2.9c-0.8,0.2-1.4,0.2-2.2,0.2c-3.3,0-3.9-1.9-3.9-4.8H278c-2.3,3.5-4.7,5.5-9.9,5.5
                                    c-5,0-9.1-2.5-9.1-8c0-7.6,7.5-7.8,14.6-8.8c2.7-0.2,4.3-0.6,4.3-3.7c0-4.5-3.2-5.5-7.1-5.5c-4.1,0-7.2,1.9-7.4,6.3L260.1,111.9z
                                     M277.9,115.9L277.9,115.9c-0.6,0.8-1.9,1-2.9,1.2c-5.7,1-12.6,0.9-12.6,6.3c0,3.3,2.9,5.4,6,5.4c5,0,9.5-3.2,9.5-8.5L277.9,115.9
                                    L277.9,115.9z"/>
                                <path class="st0" d="M287.9,93h3.3v37.7h-3.3V93z"/>
                                <path class="st0" d="M328.6,111.5c-0.2-4.1-3.3-5.9-7.1-5.9c-2.9,0-6.4,1.2-6.4,4.7c0,2.9,3.3,4,5.7,4.7l4.4,1
                                    c3.9,0.6,7.8,2.9,7.8,7.6c0,5.9-5.8,8.1-10.9,8.1c-6.3,0-10.7-2.9-11.2-9.7h3.3c0.2,4.5,3.6,6.8,8,6.8c3.1,0,7.5-1.4,7.5-5.2
                                    c0-3.2-2.9-4.3-5.9-4.9l-4.3-0.9c-4.4-1.2-7.6-2.6-7.6-7.4c0-5.5,5.4-7.6,10.1-7.6c5.4,0,9.8,2.9,9.9,8.8L328.6,111.5z"/>
                                <path class="st0" d="M356.9,112.1c-0.9-4.1-3.3-6.6-7.8-6.6c-6.4,0-9.5,5.8-9.5,11.6s3.2,11.6,9.5,11.6c4.3-0.2,7.8-3.5,7.8-7.8
                                    h3.3c-0.9,6.6-5.2,10.5-11.2,10.5c-8.4,0-12.9-6.6-12.9-14.4s4.5-14.4,12.9-14.4c5.8,0,10.3,3.1,11.1,9.3h-3.3V112.1z"/>
                                <path class="st0" d="M365,93h3.3v15.2h0.2c1.6-3.5,4.9-5.5,8.8-5.5c7.6,0,9.9,4,9.9,10.5v17.5h-3.5v-17c0-4.7-1.6-8.2-7-8.2
                                    c-5.4,0-8.4,4-8.5,9.3v15.9h-3.3L365,93L365,93L365,93z"/>
                                <path class="st0" d="M417.7,117.2c0,7.8-4.5,14.4-12.9,14.4s-12.9-6.6-12.9-14.4s4.5-14.4,12.9-14.4S417.7,109.3,417.7,117.2z
                                     M395.3,117.2c0,5.8,3.2,11.6,9.5,11.6c6.3,0,9.5-5.8,9.5-11.6c0-5.8-3.2-11.7-9.5-11.7C398.5,105.6,395.3,111.3,395.3,117.2
                                    L395.3,117.2z"/>
                                <path class="st0" d="M447.1,117.2c0,7.8-4.5,14.4-12.9,14.4c-8.4,0-12.9-6.6-12.9-14.4s4.5-14.4,12.9-14.4
                                    C442.6,102.8,447.1,109.3,447.1,117.2z M424.7,117.2c0,5.8,3.2,11.6,9.5,11.6s9.5-5.8,9.5-11.6c0-5.8-3.2-11.6-9.5-11.6
                                    S424.7,111.3,424.7,117.2z"/>
                                <path class="st0" d="M452.1,93h3.3v37.7h-3.3V93z"/>
                                <path class="st1" d="M95.6,74.8c-0.9-1.4-1.9-2.6-3.2-3.7c-6.3-5.7-17.5-7.5-28.6-9v11.9c13.4,1.8,26.7,3.6,30.9,10.5
                                    c0.9-1.4,1.3-3.1,1.3-4.8C96.1,77.9,96,76.3,95.6,74.8L95.6,74.8z"/>
                                <g>
                                    <path class="st0" d="M62.2,140.5c-0.2,0-0.2,0-0.2-0.2c-0.2-0.2-0.2-0.2-0.2-0.4v-11.9c0-0.2,0.2-0.4,0.4-0.6
                                        c15.7-2.2,31.9-4.4,31.9-15c0.2-1.6-0.2-3.1-0.6-4.7l0,0c0-0.2,0-0.2,0-0.2c0-0.2,0.2-0.6,0.4-0.6c0,0,0,0,0.2,0
                                        c0.2,0,0.4,0.2,0.6,0.4l0,0c0.4,0.8,7.1,14.4-3.3,23.7C84.5,137.2,73.3,139.1,62.2,140.5L62.2,140.5z"/>
                                    <path class="st0" d="M93.9,107.8C93.9,107.8,93.9,107.9,93.9,107.8C93.9,107.9,93.9,107.9,93.9,107.8L93.9,107.8 M93.9,107.9
                                        c1.6,2.9,6,14.8-3.2,23.2c-6.3,5.7-17.5,7.6-28.6,9v-11.9c16.2-2.2,32.3-4.5,32.3-15.5C94.6,111.1,94.4,109.4,93.9,107.9
                                         M93.9,106.7h-0.2c-0.6,0.2-0.8,0.6-0.8,0.9l0,0c0,0.2,0,0.2,0.2,0.4c0.4,1.4,0.6,2.9,0.6,4.4c0,10.1-16,12.4-31.5,14.6
                                        c-0.6,0.2-0.9,0.6-0.9,0.9v11.9c0,0.2,0.2,0.6,0.4,0.8c0.2,0.2,0.4,0.2,0.6,0.2h0.2c11.1-1.4,22.4-3.3,29.2-9.3
                                        c8.8-7.8,6.2-19.2,3.5-24.3l0,0C94.7,107.1,94.3,106.7,93.9,106.7L93.9,106.7z"/>
                                </g>
                                <path class="st2" d="M32.7,51.3c-0.9,1.4-1.3,3.1-1.3,4.8c-0.2,1.7,0.2,3.3,0.6,4.9c0.9,1.6,2.1,2.9,3.3,4c6.3,5.7,17.5,7.5,28.6,9
                                    V62.1C50.3,60.3,36.5,58.4,32.7,51.3L32.7,51.3z"/>
                                <path class="st3" d="M31.9,60.9L31.9,60.9L31.9,60.9L31.9,60.9L31.9,60.9z"/>
                                <path class="st3" d="M32,61L32,61L32,61L32,61L32,61z"/>
                                <path class="st4" d="M96.9,43c0.6,1.6,0.6,3.2,0.6,4.9c0,10.9-16.1,13.3-32.3,15.5l0,0c-11.1,1.4-22.2,3.3-28.6,9
                                    c-9.3,8.4-4.8,20.4-3.2,23.2c-0.6-1.6-0.6-3.2-0.6-4.9c0-10.9,16.1-13.3,32.3-15.5l0,0c11.1-1.4,22.2-3.3,28.6-9
                                    C103,57.9,98.4,45.9,96.9,43z"/>
                                <path class="st5" d="M36.1,98.3c1.3,1.2,2.7,2.1,4.3,2.9c6-3.2,14.4-4.5,22.7-5.5c-12.6-1.7-25.1-3.5-29.2-9.8
                                    c-0.8,1.4-1.2,2.9-1.2,4.5C31.9,93.4,33.4,96.5,36.1,98.3L36.1,98.3z"/>
                                <path class="st6" d="M63,106.7"/>
                                <path class="st5" d="M91.1,103.7c-1.3-1.2-2.7-2.1-4.3-2.9c-6,3.2-14.3,4.5-22.6,5.5l0,0c12.9,1.7,25.7,3.5,29.4,10.1
                                    c0.8-1.4,1.2-2.9,1.2-4.5s-0.2-3.1-0.6-4.7C93.3,106.1,92.3,104.8,91.1,103.7z"/>
                                <path class="st1" d="M95.4,74.5c0.6,1.6,0.6,3.2,0.6,4.9c0,10.9-16.1,13.3-32.3,15.5l0,0c-11.1,1.4-22.2,3.3-28.6,9
                                    c-9.3,8.4-4.8,20.4-3.2,23.2c-0.6-1.6-0.6-3.2-0.6-4.9c0-10.9,16.1-13.3,32.3-15.5l0,0c11.1-1.4,22.2-3.3,28.6-9
                                    C101.6,89.5,97,77.5,95.4,74.5z"/>
                                <path class="st2" d="M32,59.7c-0.6-1.6-0.6-3.2-0.6-4.9c0-10.9,16.1-13.3,32.3-15.5V27.4c-11.1,1.4-22.2,3.3-28.6,9
                                    C25.8,44.8,30.5,56.8,32,59.7L32,59.7z"/>
                    </svg>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">BSMS Digital Placement Record App Privacy Notice</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            During the course of your involvement with BSMS, you will be a member and, in some cases, a data subject of both the University of Brighton and University of Sussex; you will be able to access all facilities and support offered by both Universities. To facilitate this access, your personal data will be processed and shared between both institutions.
                            Information is collected in several different ways dependent on your interaction with the Universities.
                            As part of BSMS Attendance requirements the BSMS Digital Placement Record App and the University of Brighton collects and processes personal data relating to individual student attendance. The University is committed to being transparent about how it collects and uses that data and to meeting its data protection obligations.
                                </div>
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">Data Subjects have a number of rights – including access, rectification and erasure.  Information on how to exercise these rights can be found at Privacy notices and Record of Processing Activities (brighton.ac.uk), or by contacting dataprotection@brighton.ac.uk, Tel: 01273 642010.
                </div>
                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <div class="ml-4 text-lg leading-7 font-semibold">Data Protection Officer and Data Protection Controller</a></div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                The Data Controller is University of Brighton, Mithras House, Lewes Road.  If you would like information about how the University uses your personal data please contact dataprotection@brighton.ac.uk, 01273 642010
                        </div>
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                The Data Protection Officer is responsible for advising the University on compliance with Data Protection legislation and monitoring its performance against it. If you have any concerns regarding the way in which the University is processing your personal data, please contact the: <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">Data Protection Officer: Rachel Page, Head of Data Compliance and Records Management, 01273 642010, dataprotection@brighton.ac.uk</div>
                                </div>
                                    
                    </div>
                </div>
                            </div>
                        </div>
                

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">What information does the App Collect?</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                The App  automatically collects certain information when you visit, use or navigate the App. This information does not reveal your specific identity (like your name or contact information) but may include device and usage information, such as your IP address, browser and device characteristics, operating system, language preferences, referring URLs, device name, country, location, information about who and when you use our App and other technical information. This information is primarily needed to maintain the security and operation of our App, and for our internal analytics and reporting purposes.
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    The range of information this app also collects about you includes: your BSMS username, your placement postcode, your location; when using the app (postcode only) As this app is recording attendance at a specific location based in the UK this app will be distributed in the UK only.
                    </div>
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    Attendance at placements and workshops is a mandatory requirement for completion of the course, we take these details to record your attendance at placements you visit and workshop sessions you attend. As part of our placement and attendance monitoring, staff at BSMS will contact you if you do not attend mandatory sessions.
                    The App will in addition collect data to facilitate log in, monitor performance of the app and to request feedback on the app so that we can fix faults an improve the experience of the app.  We may also use your information as part of our efforts to keep our App safe and secure (for example, for fraud monitoring and prevention).
                    The Lawful basis for collecting this data is Contract – as it is a condition of your course to attend sessions and placements.
                        </div>
                        <div>The data is held on your mobile device and on University of Brighton servers.  University servers are held in the UK
                        The university takes the security of your data seriously. We have a framework of policies, procedures and training in place covering data protection, confidentiality and security and regularly review the appropriateness of the measures we have in place to keep the data we hold secure.
                        </div>
                        <div>Your personal data is held within our university systems and accessed by staff at BSMS for the performance of their duties to  within the Learning Technology team and Clinical Skills department who manage the apps functionally and have for monitoring mandatory placement and workshop attendance.</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">The right to complain to the ICO</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            We do our utmost to protect your privacy. Please be aware that other privacy notices exist within the university in respect of data held, including but not limited, to activities in relation to your enquiries, application, current students, alumni and use of our website:
                                </div>
                                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                If you are unsatisfied with the way Brighton and Sussex Medical School has processed your personal data, or have any questions or concerns about your data please contact: dataprotection@brighton.ac.uk/dpo@sussex.ac.uk
                                </div>
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                if we are not able to resolve the issue to your satisfaction, you have the right to apply to the Information Commissioner’s Office (ICO). They can be contacted at: https://ico.org.uk/. If you have any further questions or comments, you may also contact us here: information@sussex.ac.uk
                                        </div>
                                            
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Other privacy notices</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                   Read other privacy notices here: <a href="https://www.bsms.ac.uk/_pdf/about/bsms-privacy-notice.pdf" class="underline">BSMS </a>,and <a href="https://www.brighton.ac.uk/about-us/statistics-and-legal/privacy/index.aspx" class="underline">University of Brighton Privacy Notices</a>,
                                </div>
                                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">Changes to this notice: We keep our privacy notices under regular review.</div>
                                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">This privacy notice was last updated in June 2022..</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://www.bsms.ac.uk/index.aspx" class="ml-1 underline">
                                Brighton and Sussex Medical School
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://www.brighton.ac.uk/index.aspx" class="ml-1 underline">
                                Brighton University
                            </a>
                                    
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>

                                    <a href="https://www.sussex.ac.uk/" class="ml-1 underline">
                                        Sussex University
                                    </a>
                                    
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
