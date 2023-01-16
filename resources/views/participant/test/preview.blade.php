<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">

        @livewireStyles
        <style>
            input[type="radio"] {
                display: none;
            }

            input[type="radio"],
            input[type="radio"]+div label.badge {
                cursor: pointer;
                transition: .2s;
            }


            input[type="radio"]:checked+div label.badge {
                background-color: rgb(106, 171, 201);
                color: white;
            }

            .active {
                background-color: rgb(106, 171, 201);
                color: white;
            }

        </style>
    </x-slot>
    @livewire('participant.test.test-preview', ['participant_test' => $participant_test])
    <x-slot name="js">
        @livewireScripts
        {{-- sweatalert2 --}}
        <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/easytimerjs/easytimer.min.js') }}"></script>

    </x-slot>
</x-app-layout>
