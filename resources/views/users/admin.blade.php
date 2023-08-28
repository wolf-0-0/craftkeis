<script>
    // ...
    // extend: {
    //   keyframes: {
    //     fadeIn: {
    //       "0%": { opacity: 0 },
    //       "100%": { opacity: 100 },
    //     },
    //   },
    //   animation: {
    //     fadeIn: "fadeIn 0.2s ease-in-out forwards",
    //   },
    // },
    // ...
</script>
<style>
    p {
        max-width: 100%;
        overflow-wrap: break-word;
        text-align: left;
    }
</style>
<x-layout>
    <x-card>
        <x-card-sec class="flex flex-col items-center mb-4">
            <hr class="border-accent w-5/6 mx-auto my-6">
            <h2 class="text-4xl font-bold uppercase mb-1 mx-auto text-center customLogo">
                ADMIN DASHBOARD
            </h2>
            <p class="text-lg font-bold uppercase mb-1 mx-auto text-center customLogo">
                List of all Users
            </p>
            <hr class="border-accent w-5/6 mx-auto my-6">
        </x-card-sec>
        <div class="divide-y divide-neutral-200 mx-auto space-y-4">
            @foreach ($users as $user)
                <x-card-sec class="py-5">
                    <details class="group">
                        <summary class="flex items-center font-medium cursor-pointer list-none">
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                            <div class="w-5/6 mx-auto">
                                <h2 class="text-3xl font-bold uppercase mb-1 mx-auto text-center customLogo">{{ $user->name }} (ID: {{$user->id}})</h2>
                                <hr class="border-accent w-5/6 mx-auto my-6">
                                <div><strong>Email : </strong> {{ $user->email }}</div>
                                <div><strong>Bio : </strong></div>
                                <div>{{ $user->bio }}</div>
                                <hr class="border-accent w-5/6 mx-auto my-6">
                            </div>
                        </summary>
                        <x-dashboard-bank :user=$user />

                        <x-dashboard-service :user=$user />

                        <x-dashboard-orderClient :user=$user />

                        <x-dashboard-orderCreator :user=$user />
                    </details>
                </x-card-sec>
            @endforeach

        </div>

        <h2>Contacts</h2>
        @foreach ($contacts as $contact)
            <div>
                <strong>
                    <a href="/users/account/chat/conversation/{{ $contact->id }}">{{ $contact->name }}</a>
                </strong>
            </div>
        @endforeach
    </x-card>
    <div class="flex justify-center mb-3">
        <a href="/">
            <button class="text-center text-lg p-2 text-white rounded-lg bg-bgsec hover:bg-onhover">
                <i class="fa-solid fa-arrow-left"></i> Back
            </button>
        </a>
    </div>
</x-layout>