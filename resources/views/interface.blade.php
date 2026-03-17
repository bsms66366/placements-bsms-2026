<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Interface</title>

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
                <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div> -->
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
                             <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 195 179"><defs><style>.cls-1{fill:none;stroke:#bcba40;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.2px;}</style></defs><path class="cls-1" d="m119.21,67.25c.37-.61.74-1.22,1.26-2.09h2.79c1.59,4.03,5.33,2.93,8.58,3.04,4.48.15,8.95.37,13.29-1.26,6.53-2.45,10.12-8.24,10.61-15.46.82-12.13-2.41-23.22-9.63-33.13-4.42-6.07-10.23-9.43-17.81-8.55-2.89.34-5.98,1.53-8.36,3.2-4.73,3.33-8.31,7.85-11.45,12.73-2.79,4.32-2.69,8.6-.99,13.23.89,2.42.59,2.61-2.35,4.45.06-1.16.1-2.01.14-2.86"/><path class="cls-1" d="m84.88,43.13c.78.94,1.57,1.87,2.4,2.86-2.01,4.14-4.26,8.09-5.88,12.29-1.38,3.6-1.88,7.52-3.03,11.21-1.93,6.15-3.84,12.32-6.21,18.3-1.29,3.25-1.37,6.18-.28,9.38.32.95.05,2.09.05,3.89.6.68,2.68,1.63,1.3,3.82"/><path class="cls-1" d="m105.61,96.83c-5.51,11.15-10.93,22.34-16.56,33.42-2.36,4.65-4.73,9.46-10.33,11.27"/><path class="cls-1" d="m61.89,125.45c-1.09.29-2.18.59-3.55.96-.37-.73-.81-1.58-1.24-2.44-.04.16-.09.32-.13.48-2.46-1.38-4.85-2.91-7.4-4.11-2.64-1.25-5.42-2.18-8.26-3.3-2.62,5.68-3.05,10.71-.28,16.23,1.62.24,3.49.52,5.66.84.33,1.55.67,3.12,1.01,4.7l-.73.17c.65.54,1.29,1.07,1.33,1.1,3.61-.42,6.64-.77,10.63-1.22,3.51-5.83,7.45-12.36,11.38-18.89"/><path class="cls-1" d="m112.09,117.09c-.54,3.75-1.08,7.5-1.62,11.26-.87,6.11-1.72,12.22-2.6,18.33-.15,1-.46,1.98-.72,3.09-1.99-.78-3.71-1.45-5.42-2.12"/><path class="cls-1" d="m81,140.89c.43.64,1.04,1.9,1.27,1.84,2.72-.78,3.8,1.59,5.65,2.97,2.02-2.45,4.64-4.33,3.5-8.04-.16-.53.33-1.29.6-1.91,3.77-8.58,7.03-17.43,11.51-25.63,2.97-5.43,2.98-10.84,3.03-16.5,0-.75-.4-1.5-.62-2.25-.31-1.04-.62-2.09-1.08-3.65-.51-.44-1.5-1.28-2.57-2.19-8.53,11.24-17.33,22.85-26.14,34.46"/><path class="cls-1" d="m113.06,49.56c-2.77,5.16-1.11,10.22.8,15.05.46,1.16,2.9,1.5,4.37,2.33,2.1,1.19,5.15,1.41,5.19,4.83,2.56,1.37,6.73,1.34,5.62,6.16,4.27,2.72,3.79,6.45-.11,10.22-1.77,1.71-2.86,3.68-3.69,6.07-.96,2.76-3,5.13-4.38,7.77-2.56,4.89-4.99,9.85-7.47,14.78"/><path class="cls-1" d="m115.98,86.87c2.27,1.6,3.06,4.48,1.92,7.71-1.21,3.46-3.15,6.78-3.72,10.32-.7,4.31-2.93,8.61-1.15,13.17.04.11-.4.42-.61.63"/><path class="cls-1" d="m74.84,38.31c-2.7.54-5.39,1.5-8.1,1.53-7.08.08-8.83,5.05-9.96,10.39-.76,3.56-.81,7.26-1.2,11.16,4.15,1.79,2.11,5.75,3.05,8.77.25.81.23,1.71.36,2.56.02.12.2.22.31.32.11-.11.22-.21.32-.32"/><path class="cls-1" d="m130.55,14.19c-3.09.85-5.51,1.99-7.7,4.96-2.47,3.36-6.7,5.62-10.49,7.81-3.38,1.96-4.72,5.34-2.54,8.45"/><path class="cls-1" d="m154.52,38.95c-7.11,9.08-17.89,11.87-27.81,16.15-1.02-1.68-1.94-3.32-2.97-4.89-1.38-2.09-2.65-3.79-5.79-4.11-2.18-.22-4.13-2.76-6.18-4.26"/><path class="cls-1" d="m104.32,54.71c1.26,2.2,2.91,4.28,2.96,7.36-2.75-.73-3.6-4.29-6.71-2.43-2.56,4.81-4.92,9.85-5.02,15.64,0,.32-.4.64-.62.97"/><path class="cls-1" d="m57.03,88.47c.76,1.39,1.29,2.98,2.31,4.15,3.8,4.34,6.41,9.07,7.91,14.78,1.54,5.89,3.39,11.68,4.41,17.72.93,5.51,2.52,10.91,3.42,16.42.41,2.5-.15,5.15-.29,8.17,1.77.53,4.03.86,6.05-1.59-4.1-5.05-3.14-11.34-4.02-17.21-.77-5.13-1.4-10.28-1.9-15.44-.11-1.14.27-2.59.96-3.49,5.31-6.93,10.83-13.7,16.09-20.65,1.61-2.12,2.64-4.68,3.94-7.04"/><path class="cls-1" d="m91.04,77.22c-1.1-1.93-2.19-3.87-3.29-5.8-.33.1-.67.19-1,.29-.08.76-.5,1.72-.19,2.26,3.56,6.29,3.37,12.9,1.92,19.65-.08.39.19.85.3,1.28"/><path class="cls-1" d="m105.61,87.51c2.06.12,4.11.24,6.17.36.05.29.11.59.16.88,1.33-.79,2.67-1.59,3.61-2.15-.75-2.49-1.64-4.31-1.76-6.18-.14-2.25-1.18-3.63-3.02-4.46-2.2-1-4.47-1.95-6.8-2.55-2.07-.53-3.76.3-4.53,2.51-.94,2.69-1.94,5.36-2.91,8.04"/><path class="cls-1" d="m104.96,108.09c-.32,3.54-.59,7.08-1,10.61-.18,1.62-.64,3.22-.95,4.83-1.22,6.46-5.48,11.17-9.41,16.05.99,1.64,1.96,3.24,2.93,4.85"/><path class="cls-1" d="m68.69,150.22c-3.02,2.25-5.81,4.96-9.12,6.64-4.72,2.41-7.39.36-7.39-5.04"/><path class="cls-1" d="m74.84,66.61c-3.5-3.6-5.63-7.86-6.03-12.89-4.12,2.03-6.24,5.23-5.58,9.67.83,5.67,2.54,11.1,6.1,15.76"/><path class="cls-1" d="m53.15,88.47c-1.08.75-2.16,1.5-3.32,2.31,2.82,3.23,5.04,5.77,7.31,8.36-.86,1.19-1.39,2.07-2.06,2.83-1.54,1.76-2.07,3.55-1.02,5.83.47,1.02.81,2.71.29,3.44-1.87,2.6-.65,4.36,1.07,6.18"/><path class="cls-1" d="m95.25,157.93c-.68,1.51-.27,2.59,1.63,3.24-1.58,1.92-3.05,3.69-4.54,5.5.45,3.41,1.8,4.66,5.42,3,4.59-2.11,8.51-.38,12.71.47,5.09,1.03,10.2,2.1,15.21-.32.83-.4,1.6-.93,3.13-1.83-3.17-1.51-5.79-2.64-8.3-3.97-2.41-1.28-5.42-2.02-5.84-5.44"/><path class="cls-1" d="m104.96,127.71c-1.12,5.78-2.24,11.56-3.47,17.87,2.85-2.82,3.29-6.11,3.69-9.2.43-3.27,0-6.64.14-9.95.05-1.3.74-2.56.9-3.86.5-4.17.89-8.36,1.32-12.54"/><path class="cls-1" d="m66.1,55.99c-.2,6.35,2.14,11.96,5.18,17.36"/><path class="cls-1" d="m71.28,127.71c-2.57,6.12-5.14,12.24-7.66,18.24.55,1.1,1.09,2.17,1.55,3.08-.91,4.69-4.55,5.32-8.14,6.02-1.92-3.44-1.19-5.07,2.25-5.86,1.29-.3,2.39-1.43,3.58-2.18"/><path class="cls-1" d="m57.03,72.39c2.05,5.25,4.1,10.5,6.15,15.76"/><path class="cls-1" d="m64.16,60.5c.43,4.4,2.29,8.36,4.33,12.16.51.96,2.47,1.15,3.93,1.77,2.74-7.02,4.79-14.19,5.6-21.65.16-1.45-.8-2.99-.84-4.5-.04-1.71.37-3.43.59-5.14"/><path class="cls-1" d="m59.3,73.36c1.26,5.49,3.61,10.49,6.8,15.11"/><path class="cls-1" d="m84.88,80.76c-1.72-2.23-3.44-4.47-5.37-6.97-1.69,3.08,1.32,3.9,1.88,5.67.54,1.71,1.71,3.21,2.51,4.85.82,1.68,1.53,3.42,2.28,5.14"/><path class="cls-1" d="m105.61,34.77c-2.53-.3-4.64.74-6.46,2.28-2.84,2.41-5.74,4.12-9.76,3.29-1.16-.24-2.57.76-3.87,1.18"/><path class="cls-1" d="m53.47,67.25c-.54,2.68-1.08,5.36-1.62,8.04-.22,1.07-.6,2.14-.6,3.22,0,1.07.04,2.75.67,3.1,1.59.89,1.14,2.13,1.23,3.33"/><path class="cls-1" d="m55.09,124.17c.61.92,1.22,1.84,1.86,2.8-1.67,2.77-2.06,5.31-.35,8.19.81,1.36.53,3.37.83,5.69-2.06,1.02-4.3,2.14-6.55,3.25"/><path class="cls-1" d="m83.91,42.17c-.12-3.29-3.58-7.58-6.81-7.94-1.11-.12-2.36.92-3.54,1.44.02.45.03.9.05,1.35,1.49.54,2.97,1.12,4.48,1.6,1.47.47,2.79,1,2.59,2.91"/><path class="cls-1" d="m101.73,128.67c.46,5.62.15,11.02-4.53,15.11"/><path class="cls-1" d="m112.41,159.22c-3.13-.11-6.27-.37-9.39-.26-1.58.05-3.13.77-5.2,1.32,1.42,1.7,2.3,2.76,2.86,3.44h3.96"/><path class="cls-1" d="m121.16,168.22c-1.94-.54-3.88-1.12-5.83-1.59-1.56-.38-3.15-.64-5.33-1.07,1.85,2.85,3.02,3.3,5.98,3.68,1.98.26,3.89,1.02,5.84,1.55"/><path class="cls-1" d="m71.28,52.14c.92,2.71-.57,5.87,1.6,8.37.95,1.1,1.74,2.35,2.61,3.52"/><path class="cls-1" d="m92.01,48.28c-.25.3-.5.59-.81.96-.4-.29-.9-.67-1.4-1.03-.29.16-.61.22-.69.4-.94,2.02-.93,2.02.1,3.44,2.23.31,3.83.54,5.72.8v5.37c1.12-.41,1.85-.67,2.59-.94"/><path class="cls-1" d="m97.19,157.61c-5.34-2.37-10.58.11-15.87.32"/><path class="cls-1" d="m53.79,77.22c.97,3.11,2,6.2,2.86,9.34.15.54-.38,1.27-.6,1.92"/><path class="cls-1" d="m86.18,72.39c-2.03-1.07-3.25-.08-4.17,1.63,4.06,4.35,5.23,9.63,4.82,15.41"/><path class="cls-1" d="m67.07,165.01c-1.52.16-3.04.33-4.56.49,1.65,2.04,3.27,1.32,4.89.15"/><path class="cls-1" d="m118.89,67.89c-4.53,1.33-5.86,4.82-6.15,9"/><path class="cls-1" d="m97.19,151.18c3.43.4,6.39,2.81,10.04,2.25"/><path class="cls-1" d="m96.54,57.92c-.76,1.82-1.44,3.68-2.3,5.45-.47.98-1.23,1.82-2.14,3.14,1.17.12,1.82.18,3.24.33-1.11,3.34-2.22,6.7-3.34,10.05-.32.97-1.08,2.02-.9,2.88.74,3.54,1.46,6.97-.66,10.34-.23.37.37,1.25.59,1.89"/><path class="cls-1" d="m99.46,154.4c.72,2.85,3.48,1.78,5.23,2.44,1.48.55,3.4-.08,5.13-.19"/><path class="cls-1" d="m63.19,59.21c-3.04,1.64-2.61,4.57-2.15,7.05.43,2.35,1.86,4.51,2.75,6.79.12.3-.39.84-.6,1.27"/><path class="cls-1" d="m93.31,47.96c2.79,1.2,5.51,2.71,8.74,1.93"/><path class="cls-1" d="m65.45,144.11h4.36c-1.91,4.25-.4,7.46,3.6,10.14.66-1.06,1.39-2.21,2.17-3.46.6.2,1.24.41,1.67.55-.18,1.97-.35,3.79-.51,5.61.3.14.6.28.9.42,1.02-1.31,2.03-2.62,3.05-3.93"/><path class="cls-1" d="m80.35,149.25c.32,1.72.94,3.44.89,5.14-.05,1.62-.53,3.35-1.27,4.8-1.06,2.05-2.26,4.17-3.9,5.74-1.6,1.53-3.83,2.4-6.08,3.74-.27-.5-.6-1.13-.86-1.6.96-.63,2.31-1.52,3.63-2.38-.38-.75-.6-1.18-.82-1.61"/><path class="cls-1" d="m107.56,42.49c1.15,1.7-.49,2.34-1.31,3.2-1.36,1.43-2.85,2.76-4.09,4.3.02,1.81,2.86,2.47,1.52,4.4"/><path class="cls-1" d="m94.6,77.54c-.54,1.29-1.19,2.54-1.59,3.87-.37,1.24-.46,2.56-.68,3.85"/><path class="cls-1" d="m107.56,149.89c2.61,1.04,5.21,2.07,8.55,3.39-1.8.35-2.9.56-4.02.78-.22.75-.43,1.5-.65,2.26"/><path class="cls-1" d="m103.02,43.13c-1.2.6-2.41,1.2-3.61,1.8-.17.23-.35.46-.52.7-.65-.96-1.31-1.92-1.96-2.88-.25.1-.51.2-.76.3.29.83.59,1.66,1.02,2.88-.32.17-1.23,1.1-1.92.95-1.37-.3-2.99-.89-3.8-1.91-.81-1.01-.75-2.7-1.08-4.1"/><path class="cls-1" d="m58.65,93.94c1.09,3.05,2.85,5.47,6.15,6.43"/><path class="cls-1" d="m66.75,108.09c-1.74,1.26-3.49,2.53-4.53,3.29v11.96c-.65.15-1.65.37-2.74.61.36.54.58.86.79,1.19"/><path class="cls-1" d="m70.96,105.2c3.33-.14,3.81.28,3.9,3.22.04,1.29.2,2.57.31,3.86"/><path class="cls-1" d="m86.5,90.08c-.11,2.25-.22,4.5-.32,6.75"/><path class="cls-1" d="m70.96,107.45c-.75-2.85-1.51-5.69-2.62-9.91.48-2.52.29-2.92-2.56-3.28"/><path class="cls-1" d="m93.63,41.85c-.32,2.04-.65,4.07-1.06,6.66-.88-.87-1.62-1.45-2.16-2.17-1-1.32-1.9-2.69-3.91-2.24"/><path class="cls-1" d="m55.09,64.36l.97,5.79"/><path class="cls-1" d="m99.46,153.75c-1.1-.6-2.2-1.21-3.33-1.83.3-.54.53-.96,1.02-1.82-1.32-.09-2.4-.16-4.16-.27v6.18"/><path class="cls-1" d="m72.25,74.65c-.52,1.72-1.04,3.44-1.61,5.35-1.69-1.68-3.94,1.56-5.51-.85"/><path class="cls-1" d="m76.79,48.92c-2.27,1.18-4.53,2.36-6.8,3.54"/><path class="cls-1" d="m99.78,141.53c.18,1.73.36,3.46.61,5.85.74-1.1,1.04-1.54,1.34-1.99"/><path class="cls-1" d="m85.53,52.46c1.01,1.45,2.01,2.9,3.39,4.87,1.92-1.17,3.64-2.22,5.36-3.27"/><path class="cls-1" d="m70.31,80.43c-1.84,3.97-3.67,7.93-5.51,11.9"/><path class="cls-1" d="m74.84,143.46l-4.86,1.93"/><path class="cls-1" d="m106.91,58.57l4.86,1.93"/><path class="cls-1" d="m62.86,158.58c.16-.45.31-.9.52-1.48,1.8,1.19,3.42,2.26,5.25,3.47,1.39-2,2.83-4.09,4.27-6.17"/><path class="cls-1" d="m55.41,118.06c-2.56.9-.16,3.2-1.3,4.5"/><path class="cls-1" d="m61.89,92.33q3.06,1.13,4.53,4.18c-.18.16-.35.32-.53.48-.9-1.23-1.85-2.44-2.69-3.71-.61-.92-1.09-1.92-1.63-2.88"/><path class="cls-1" d="m56.06,77.22c-.42,3.44,1.59,6,3.24,8.68"/><path class="cls-1" d="m115,157.29h2.63c.02.3.03.6.05.9l-2.67.71"/><path class="cls-1" d="m100.11,163.72c-1.4.86-2.81,1.72-4.21,2.57"/><path class="cls-1" d="m76.46,157.29c-2.35,3.12-4.44,6.55-8.74,7.4"/><path class="cls-1" d="m101.08,162.44c1.48-1.01,2.73-3.16,4.86-.98-1.73,3.61-.18,5.61,4.21,5.48"/><path class="cls-1" d="m66.1,78.5c.49,2,.18,4.37,2.59,5.47"/><path class="cls-1" d="m55.74,62.43c-2.14,2.81-2.42,5.81-.97,9"/><path class="cls-1" d="m55.74,73.04c.13,1.17.26,2.34.4,3.62-1.02.1-1.65.16-2.75.27.14-1.03.28-1.98.41-2.93"/><path class="cls-1" d="m92.66,76.9c.34-.19.67-.39,1.66-.96.22,1.51.44,2.84.6,4.18.24,1.93.44,3.86.65,5.79"/><path class="cls-1" d="m54.44,72.72c.11,1.18.22,2.36.32,3.54"/><path class="cls-1" d="m51.85,78.5c0,1.18.08,2.36-.02,3.54-.1,1.16-1.03,2.44.67,3.22"/><path class="cls-1" d="m55.74,150.86c-1.08.11-2.31.59-3.2.23-1.32-.52-3.12-1.44-3.42-2.53-.39-1.45-1.21-3.95,1.77-4.45"/><path class="cls-1" d="m95.25,166.94c-.42-.13-.85-.26-1.3-.41-.23.72-.43,1.37-.64,2.01"/><path class="cls-1" d="m68.69,167.58c-.56.28-1.12.56-1.68.84.03.27.06.54.09.8.86-.12,1.71-.24,2.57-.35"/><path class="cls-1" d="m124.07,167.58c.97.32,1.94.64,2.91.96"/><path class="cls-1" d="m106.26,124.17v2.89"/><path class="cls-1" d="m64.48,161.15c.3.25.59.49,1.13.94v-1.75c-1.38.46-2.86.96-4.36,1.47q1.79,2.27,8.25-.89c.06,1.07.11,1.94.16,2.81"/><path class="cls-1" d="m72.58,158.9c.37-.4.74-.81,1.12-1.21-.21-.17-.41-.34-.62-.51-1.03,1.54-2.06,3.07-3.09,4.61"/><path class="cls-1" d="m109.17,154.72c-.54-.32-1.4-.53-1.56-.98-.62-1.73-1.73-1.44-2.97-.94"/><path class="cls-1" d="m57.68,92.98c-.69-.27-1.38-.55-2.06-.82-.18.29-.35.58-.53.86.76.63,1.51,1.26,2.27,1.89"/><path class="cls-1" d="m112.09,155.04c1.4.54,2.81,1.07,4.21,1.61"/><path class="cls-1" d="m58.65,117.74h-2.59"/><path class="cls-1" d="m77.44,39.27c-.54.86-1.08,1.72-1.62,2.57"/><path class="cls-1" d="m84.56,42.49c-1.94,0-3.89.03-5.83-.01-.87-.02-1.73-.2-2.59-.31"/><path class="cls-1" d="m77.76,159.22c-1.54,1.8-3.08,3.6-4.6,5.4l1.04,1.03"/><path class="cls-1" d="m106.58,165.65c1.4.11,2.81.21,4.21.32"/><path class="cls-1" d="m54.12,85.9l2.91,3.86"/><path class="cls-1" d="m71.93,101.34c-.76.11-1.51.21-2.27.32"/><path class="cls-1" d="m98.81,52.46c.81.57,1.62,1.14,2.54,1.79.46-.06,1.2-.15,1.95-.24-.1.24-.2.48-.3.72.65.63,1.31,1.27,1.96,1.9"/><path class="cls-1" d="m58.97,70.47l.97,1.93"/><path class="cls-1" d="m110.47,156.33c1.08.32,2.16.64,3.24.96"/><path class="cls-1" d="m62.86,72.72c.43,1.5.86,3,1.3,4.5.04.13.21.22.31.32.11-.11.22-.21.32-.32"/><path class="cls-1" d="m63.51,160.83l-1.87-1.04c.32-.38.64-.75.96-1.13l2.2,1.53"/><path class="cls-1" d="m56.38,70.47c.12.62.25,1.24.5,2.46-1.2-.35-1.8-.52-2.4-.7-.2-.24-.41-.48-.61-.72.62-.35,1.25-.69,1.87-1.04"/><path class="cls-1" d="m123.1,168.54h-1.95c1.7-1.67,1.61-1.63,2.3-.34.34.64,1.05,1.09,1.58,1.63"/><path class="cls-1" d="m109.82,157.29l2.59,1.29"/><path class="cls-1" d="m69.01,101.34c-.86.11-1.73.21-2.59.32"/><path class="cls-1" d="m57.03,80.11v1.29"/></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold">BSMS Anatomy Interface webpage</a></div>
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

                                                                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Admin</a>
                                                                    
                                                                </a>
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
