<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <inertia-link :href="route('dashboard')">
                                <jet-application-mark class="block h-9 w-auto"/>
                            </inertia-link>
                        </div>

                        <!-- Navigation Links -->

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link :href="route('trucks.index')" :active="route().current('trucks.index')||route().current('trucks.create')||route().current('trucks.edit')||route().current('trucks.show')||route().current('trucks.preview')">
                                Camiones
                            </jet-nav-link>
                        </div>



                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.jetstream.managesProfilePhotos"
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                             :src="$page.user.profile_photo_url" :alt="$page.user.name"/>
                                    </button>

                                    <button v-else
                                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>{{ $page.user.name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <jet-dropdown-link :href="route('profile.show')">
                                        Profile
                                    </jet-dropdown-link>

                                    <jet-dropdown-link :href="route('api-tokens.index')"
                                                       v-if="$page.jetstream.hasApiFeatures">
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Management -->
                                    <template v-if="$page.jetstream.hasTeamFeatures">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-dropdown-link :href="route('teams.show', $page.user.current_team)">
                                            Team Settings
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('teams.create')"
                                                           v-if="$page.jetstream.canCreateTeams">
                                            Create New Team
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        <template v-for="team in $page.user.all_teams">
                                            <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                                <jet-dropdown-link as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id == $page.user.current_team_id"
                                                             class="mr-2 h-5 w-5 text-green-400" fill="none"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>

                                        <div class="border-t border-gray-100"></div>
                                    </template>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Logout
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"/>
                                <path
                                    :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">

                    <jet-responsive-nav-link :href="route('trucks.index')" :active="route().current('trucks.index')||route().current('trucks.create')||route().current('trucks.edit')||route().current('trucks.show')||route().current('trucks.preview')">
                        Camiones
                    </jet-responsive-nav-link>

                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="$page.user.profile_photo_url"
                                 :alt="$page.user.name"/>
                        </div>

                        <div class="ml-3">
                            <div class="font-medium text-base text-gray-800">{{ $page.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link :href="route('profile.show')"
                                                 :active="route().current('profile.show')">
                            Profile
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link :href="route('api-tokens.index')"
                                                 :active="route().current('api-tokens.index')"
                                                 v-if="$page.jetstream.hasApiFeatures">
                            API Tokens
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Logout
                            </jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        <template v-if="$page.jetstream.hasTeamFeatures">
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Team
                            </div>

                            <!-- Team Settings -->
                            <jet-responsive-nav-link :href="route('teams.show', $page.user.current_team)"
                                                     :active="route().current('teams.show')">
                                Team Settings
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('teams.create')"
                                                     :active="route().current('teams.create')">
                                Create New Team
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Switch Teams
                            </div>

                            <template v-for="team in $page.user.all_teams">
                                <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                    <jet-responsive-nav-link as="button">
                                        <div class="flex items-center">
                                            <svg v-if="team.id == $page.user.current_team_id"
                                                 class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round"
                                                 stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </jet-responsive-nav-link>
                                </form>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main class="bg-gray-200">
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>

        <!--footer-->
        <footer class="bg-gray-100 shadow-4xl">
            <div class="container mx-auto px-6 pt-10 pb-6">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/4  p-4">
                        <div class="flex-shrink-0 flex items-center mb-4">
                            <inertia-link :href="route('dashboard')">
                                <jet-application-mark class="block h-9 w-auto"/>
                            </inertia-link>
                        </div>
                        <p class="text-gray-600">
                            marking the world a better place trough construction elegant hierarchies.
                        </p>
                        <div class="flex justify-start">
                            <a class="text-gray-700 hover:text-gray-800 mr-2 my-2" href="">
                                <svg class="rounded-full bg-blue-500 border mb-2 w-6 h-6"
                                     version="1.1" id="LinkedIn_w_x2F__circle" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                                     xml:space="preserve">
                                    <path fill="#FFFFFF" d="M10,0.4c-5.302,0-9.6,4.298-9.6,9.6s4.298,9.6,9.6,9.6s9.6-4.298,9.6-9.6S15.302,0.4,10,0.4z M7.65,13.979
                                        H5.706V7.723H7.65V13.979z M6.666,6.955c-0.614,0-1.011-0.435-1.011-0.973c0-0.549,0.409-0.971,1.036-0.971s1.011,0.422,1.023,0.971
                                        C7.714,6.52,7.318,6.955,6.666,6.955z M14.75,13.979h-1.944v-3.467c0-0.807-0.282-1.355-0.985-1.355
                                        c-0.537,0-0.856,0.371-0.997,0.728c-0.052,0.127-0.065,0.307-0.065,0.486v3.607H8.814v-4.26c0-0.781-0.025-1.434-0.051-1.996h1.689
                                        l0.089,0.869h0.039c0.256-0.408,0.883-1.01,1.932-1.01c1.279,0,2.238,0.857,2.238,2.699V13.979z"/>
                                </svg>
                            </a>
                            <a class="text-gray-700 hover:text-gray-800 m-2" href="">
                                <svg class="rounded-full bg-blue-700 border mb-2 border mb-2 w-6 h-6"
                                     version="1.1"
                                     id="Facebook_w_x2F__circle" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                                     xml:space="preserve">
                                    <path fill="#FFFFFF" d="M10,0.4c-5.302,0-9.6,4.298-9.6,9.6s4.298,9.6,9.6,9.6s9.6-4.298,9.6-9.6S15.302,0.4,10,0.4z M12.274,7.034
                                        h-1.443c-0.171,0-0.361,0.225-0.361,0.524V8.6h1.805l-0.273,1.486H10.47v4.461H8.767v-4.461H7.222V8.6h1.545V7.726
                                        c0-1.254,0.87-2.273,2.064-2.273h1.443V7.034z"/>
                                </svg>
                            </a>
                            <a class="text-gray-700 hover:text-gray-800 m-2" href="">
                                <svg class="rounded-full bg-blue-500 border mb-2 border mb-2 w-6 h-6"
                                     version="1.1" id="Twitter_w_x2F__circle" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                                     xml:space="preserve">
                                    <path fill="#FFFFFF" d="M10,0.4c-5.302,0-9.6,4.298-9.6,9.6s4.298,9.6,9.6,9.6s9.6-4.298,9.6-9.6S15.302,0.4,10,0.4z M13.905,8.264
                                        c0.004,0.082,0.005,0.164,0.005,0.244c0,2.5-1.901,5.381-5.379,5.381c-1.068,0-2.062-0.312-2.898-0.85
                                        c0.147,0.018,0.298,0.025,0.451,0.025c0.886,0,1.701-0.301,2.348-0.809c-0.827-0.016-1.525-0.562-1.766-1.312
                                        c0.115,0.021,0.233,0.033,0.355,0.033c0.172,0,0.34-0.023,0.498-0.066c-0.865-0.174-1.517-0.938-1.517-1.854V9.033
                                        C6.257,9.174,6.549,9.26,6.859,9.27C6.351,8.93,6.018,8.352,6.018,7.695c0-0.346,0.093-0.672,0.256-0.951
                                        c0.933,1.144,2.325,1.896,3.897,1.977c-0.033-0.139-0.049-0.283-0.049-0.432c0-1.043,0.846-1.891,1.891-1.891
                                        c0.543,0,1.035,0.23,1.38,0.598c0.431-0.086,0.835-0.242,1.2-0.459c-0.141,0.441-0.44,0.812-0.831,1.047
                                        c0.383-0.047,0.747-0.148,1.086-0.299C14.595,7.664,14.274,7.998,13.905,8.264z"/>
                                </svg>
                            </a>
                            <a class="text-gray-700 hover:text-gray-800 m-2" href="#">
                                <svg class="rounded-full bg-pink-400 border mb-2 border mb-2 w-6 h-6"
                                     id="Instagram_w_circle"
                                     data-name="Instagram w/circle" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 19.19995 19.19995" x="0px" y="0px" enable-background="new 0 0 20 20"
                                     xml:space="preserve">
                                    <path fill="#FFFFFF" class="cls-1"
                                          d="M13.89777,7.05115a1.65591,1.65591,0,0,0-.94891-0.94891,2.76589,2.76589,0,0,0-.92841-0.17218C11.49316,5.906,11.33508,5.90094,10,5.90094S8.50684,5.906,7.97955,5.93005a2.76589,2.76589,0,0,0-.92841.17218,1.65591,1.65591,0,0,0-.94891.94891,2.76589,2.76589,0,0,0-.17218.92841C5.906,8.50684,5.90094,8.665,5.90094,10s0.00507,1.49316.02911,2.02045a2.76553,2.76553,0,0,0,.17218.92841,1.65591,1.65591,0,0,0,.94891.94891,2.76589,2.76589,0,0,0,.92841.17218c0.52716,0.024.6853,0.02911,2.02045,0.02911s1.49329-.00507,2.02045-0.02911a2.76589,2.76589,0,0,0,.92841-0.17218,1.65591,1.65591,0,0,0,.94891-0.94891,2.76553,2.76553,0,0,0,.17218-0.92841c0.024-.52728.02911-0.68536,0.02911-2.02045S14.094,8.50684,14.06995,7.97955A2.76589,2.76589,0,0,0,13.89777,7.05115ZM10,12.56757A2.56757,2.56757,0,1,1,12.56757,10,2.56756,2.56756,0,0,1,10,12.56757ZM12.669,7.931a0.6,0.6,0,1,1,.6-0.6A0.6,0.6,0,0,1,12.669,7.931ZM11.66669,10A1.66669,1.66669,0,1,1,10,8.33331,1.66671,1.66671,0,0,1,11.66669,10ZM10,0.4A9.6,9.6,0,1,0,19.6,10,9.59995,9.59995,0,0,0,10,.4Zm4.96991,11.6615a3.67039,3.67039,0,0,1-.23242,1.21368,2.55612,2.55612,0,0,1-1.46228,1.46228,3.67039,3.67039,0,0,1-1.21368.23242C11.5282,14.99426,11.35791,15,10,15s-1.5282-.00574-2.06152-0.03009a3.67039,3.67039,0,0,1-1.21368-.23242,2.55612,2.55612,0,0,1-1.46228-1.46228,3.67039,3.67039,0,0,1-.23242-1.21368C5.00574,11.5282,5,11.35791,5,10s0.00574-1.5282.03009-2.06152a3.67039,3.67039,0,0,1,.23242-1.21368A2.55612,2.55612,0,0,1,6.72479,5.26251a3.67039,3.67039,0,0,1,1.21368-.23242C8.4718,5.00574,8.64209,5,10,5s1.5282,0.00574,2.06152.03009a3.67039,3.67039,0,0,1,1.21368.23242,2.55612,2.55612,0,0,1,1.46228,1.46228,3.67039,3.67039,0,0,1,.23242,1.21368C14.99426,8.4718,15,8.64209,15,10S14.99426,11.5282,14.96991,12.06152Z"
                                          transform="translate(-0.40002 -0.40002)"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="w-full md:w-3/4  p-4 ">
                        <div class="flex justify-end ">
                            <div class="w-full md:w-1/3 text-center md:text-left">
                                <h5 class="uppercase mb-6 font-bold">Links</h5>
                                <ul class="mb-4">
                                    <li class="mt-2">
                                        <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">FAQ</a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Help</a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="#"
                                           class="hover:underline text-gray-600 hover:text-orange-500">Support</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="w-full md:w-1/3 text-center md:text-left">
                                <h5 class="uppercase mb-6 font-bold">Legal</h5>
                                <ul class="mb-4">
                                    <li class="mt-2">
                                        <a href="#"
                                           class="hover:underline text-gray-600 hover:text-orange-500">Terms</a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="#"
                                           class="hover:underline text-gray-600 hover:text-orange-500">Privacy</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="w-full md:w-1/3 text-center md:text-left">
                                <h5 class="uppercase mb-6 font-bold">Company</h5>
                                <ul class="mb-4">
                                    <li class="mt-2">
                                        <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Official
                                            Blog</a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">About
                                            Us</a>
                                    </li>
                                    <li class="mt-2">
                                        <a href="#"
                                           class="hover:underline text-gray-600 hover:text-orange-500">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="flex justify-center border-t-2 p-6 mx-3">
                <p class="text-gray-600">
                    ©2019 - {{ new Date().getFullYear() }} Todos los derechos reservados.
                </p>
            </div>
        </footer>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

export default {
    props: ["hasHeader"],
    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
    }
}
</script>
