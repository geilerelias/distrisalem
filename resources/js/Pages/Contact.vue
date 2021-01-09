<template>
    <app-layout>
        <template #header>
            <nav class="text-black font-bold" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a :href="route('dashboard')" class="text-indigo-800">
                            Dashboard
                        </a>
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                        </svg>
                    </li>

                    <li>
                        <a class="text-gray-500" aria-current="page">Contacto</a>
                    </li>
                </ol>
            </nav>

        </template>


        <!--
          Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
          Read the documentation to get started: https://tailwindui.com/documentation
        -->
        <div class="p-6">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-4 md:gap-6">
                    <div class="md:col-span-2">
                        <div class="px-4 sm:px-0">
                            <div class="pt-6  md:p-8 md:pt-0  text-left space-y-2">
                                <div class=" md:text-left mt-12 md:mt-2">
                                    <h3 class="text-xl font-bold uppercase  mb-2 text-gray-800 mb-2">
                                        MANTENTE EN CONTACTO CON NOSOTROS
                                    </h3>

                                    <div class="text-sm leading-normal mt-0 text-gray-800 font-bold text-justify ">
                                        <div class="flex items-start space-x-2">
                                            Si quieres saber mas de lo que hacemos y como podemos ayudarte, no dudes en
                                            escribirnos a nuestros correos electrónicos o llamar a cualquiera de los
                                            números telefónicos que tenemos disponibles para ti. Para nosotros es un
                                            placer poder servirte.
                                        </div>
                                    </div>


                                    <div class="mb-2 text-gray-700 mt-4">
                                        <div class="divide-y divide-gray-300">
                                            <div class="py-3 flex items-start align-middle space-x-2 font-bold ">
                                                <svg class="w-8 h-8 flex-none mt-2 mr-5 text-gray-500" fill="none"
                                                     style="width:32px;height:32px" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                          d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/>
                                                </svg>
                                                <div>
                                                    <div class="font-light">
                                                        8553 N. Beach St. Ste. 227
                                                        <br>
                                                        Fort Worth, Texas 76137
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="py-3 flex items-start align-middle space-x-2 font-bold ">
                                                <svg class="w-8 h-8 flex-none mt-2 mr-5  text-gray-500" fill="none"
                                                     style="width:32px;height:32px" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                          d="M17,19H7V5H17M17,1H7C5.89,1 5,1.89 5,3V21A2,2 0 0,0 7,23H17A2,2 0 0,0 19,21V3C19,1.89 18.1,1 17,1Z"/>
                                                </svg>
                                                <div>
                                                    <div class="font-light">
                                                        01 (800) 433 744
                                                        <br>
                                                        01 (800) 433 633
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="py-3 flex items-start align-middle space-x-2 font-bold ">
                                                <svg class="w-8 h-8 flex-none mt-2 mr-5 text-gray-500" fill="none"
                                                     style="width:32px;height:32px" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                          d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
                                                </svg>
                                                <div>
                                                    <div class="font-light">
                                                        john@tailwindcss.com
                                                        <br>
                                                        heather@tailwindcss.com
                                                    </div>
                                                </div>
                                            </div>
                                            <div></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">

                        <form method="POST">

                            <div class="shadow overflow-hidden sm:rounded-md">

                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div
                                        class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                                        role="alert" v-if="$page.flash.message">
                                        <div class="flex">
                                            <div>
                                                <p class="text-sm">{{ $page.flash.message }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="name_contact"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Nombres
                                            </label>
                                            <input id="name_contact" v-model="contact.name"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">

                                            <div v-if="$page.errors.name" class="text-red-500">{{
                                                    $page.errors.name[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="last_name_contact"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Apellidos
                                            </label>
                                            <input id="last_name_contact" v-model="contact.lastName"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">

                                            <div v-if="$page.errors.lastName" class="text-red-500">
                                                {{ $page.errors.lastName[0] }}
                                            </div>
                                        </div>
                                        <div class="col-span-6">
                                            <label for="email_contact" class="block text-sm font-medium text-gray-700">
                                                Dirección de correo
                                            </label>
                                            <input type="email" id="email_contact" v-model="contact.email"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <div v-if="$page.errors.email" class="text-red-500">
                                                {{ $page.errors.email[0] }}
                                            </div>
                                        </div>
                                        <div class="col-span-6">
                                            <label for="phone_contact" class="block text-sm font-medium text-gray-700">
                                                Celular
                                            </label>
                                            <input type="tel" id="phone_contact" v-model="contact.phone"
                                                   pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <div v-if="$page.errors.phone" class="text-red-500">
                                                {{ $page.errors.phone[0] }}
                                            </div>
                                        </div>

                                        <div class="col-span-6">
                                            <label for="message_contact"
                                                   class="block text-sm font-medium text-gray-700">
                                                Mensaje
                                            </label>
                                            <div class="mt-1">
                                                <textarea id="message_contact" rows="3" v-model="contact.message"
                                                          class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                                          placeholder="you@example.com"></textarea>
                                            </div>
                                            <div v-if="$page.errors.message" class="text-red-500">
                                                {{ $page.errors.message[0] }}
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button
                                        @click.prevent="send(contact)" type="button"
                                        class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import JetButton from '@/Jetstream/Button'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetModal from '@/Jetstream/Modal'

export default {
    components: {
        AppLayout,
        Welcome,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetConfirmationModal,
        JetDangerButton,
        JetModal
    },
    props: ['data', 'errors'],

    data() {
        return {
            contact: {
                name: '',
                lastName: '',
                email: '',
                phone: '',
                message: ''
            }
        }
    },
    methods: {
        send(contact) {
            this.$inertia.post('/contacts', contact)
                .then(function (response) {
                    // handle success
                    console.log(response);
                    this.reset();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });

        },
        reset() {
            this.contact = {
                name: '',
                lastName: '',
                email: '',
                phone: '',
                message: ''
            }
        }
    }
}
</script>

<style scoped>

</style>
