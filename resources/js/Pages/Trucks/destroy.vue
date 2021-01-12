<template>
    <app-layout>
        <template #header>
            <nav aria-label="Breadcrumb" class="text-black font-bold">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a :href="route('dashboard')" class="text-indigo-800">
                            Dashboard
                        </a>
                        <svg class="fill-current w-3 h-3 mx-3" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a :href="route('trucks.index')" class="text-indigo-800">
                            Camiones
                        </a>
                        <svg class="fill-current w-3 h-3 mx-3" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                        </svg>
                    </li>
                    <li>
                        <a aria-current="page" class="text-gray-500">Eliminar</a>
                    </li>
                </ol>
            </nav>
        </template>

        <div class="p-6">
            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Confirmación de la información</h3>
                            <p class="mt-1 text-sm leading-5 text-gray-600">
                                En esta sección puedes visualizar la información relevante del vehículo antes de
                                eliminarlo.
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div
                                    v-if="$page.flash.message"
                                    class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                                    role="alert">
                                    <div class="flex">
                                        <div>
                                            <p class="text-sm">{{ $page.flash.message }}</p>
                                        </div>
                                    </div>
                                </div>

                                <figure class="md:flex bg-white-100  rounded-xl p-8 md:p-0">
                                    <img
                                        :src="`/storage/${data.photo_path}`"
                                        alt=""
                                        class="object-contain h-full  w-32  md:w-48 md:h-auto md:rounded-none rounded-full mx-auto md:mx-0"/>
                                    <div class="pt-6  md:p-8 md:pt-0  text-left space-y-2">
                                        <div class=" md:text-left mt-12 md:mt-2">
                                            <h3 class="text-4xl font-bold uppercase  mb-2 text-gray-800 mb-2">
                                                Placa: <span class="text-gray-500 font-light">{{ data.placa }}</span>
                                            </h3>

                                            <div class="text-sm leading-normal mt-0 text-gray-800 font-bold uppercase">
                                                <div class="flex items-start space-x-2">
                                                    <svg class="w-6 h-6 flex-none mt-0.5 text-gray-500"
                                                         style="width:24px;height:24px" viewBox="0 0 24 24">
                                                        <path d="M3 11H15V13H3M3 18V16H21V18M3 6H9V8H3Z"
                                                              fill="currentColor"/>
                                                    </svg>

                                                    <span class="prose text-gray-800 font-bold uppercase ">
                                                        Modelo:  <span class="text-gray-500 font-light">{{
                                                            data.modelo
                                                        }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-2 text-gray-700 mt-4">
                                                <div class="flex items-start space-x-2 font-bold uppercase">

                                                    <svg class="w-6 h-6 flex-none mt-0.5 text-gray-500" fill="none"
                                                         style="width:24px;height:24px" viewBox="0 0 24 24">
                                                        <path
                                                            d="M3,2H6C6.28,2 6.53,2.11 6.71,2.29L8.79,4.38L9.59,3.59C10,3.2 10.5,3 11,3H17C17.5,3 18,3.2 18.41,3.59L19.41,4.59C19.8,5 20,5.5 20,6V19A2,2 0 0,1 18,21H8A2,2 0 0,1 6,19V13L6,12V8C6,7.5 6.2,7 6.59,6.59L7.38,5.79L5.59,4H3V2M11,5V7H17V5H11M11.41,11L9.41,9H8V10.41L10,12.41V15.59L8,17.59V19H9.41L11.41,17H14.59L16.59,19H18V17.59L16,15.59V12.41L18,10.41V9H16.59L14.59,11H11.41M12,13H14V15H12V13Z"
                                                            fill="currentColor"/>
                                                    </svg>

                                                    <span class="prose">
                                                        Tipo de combustible: <span
                                                        class="text-gray-500 font-light">{{
                                                            data.tipo_combustible
                                                        }}</span>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="mb-2 text-gray-700">
                                                <div class="flex items-start space-x-2 font-bold uppercase">
                                                    <svg class="w-6 h-6 flex-none mt-0.5 text-gray-500" fill="none"
                                                         style="width:24px;height:24px" viewBox="0 0 24 24">
                                                        <path
                                                            d="M16,6L18.29,8.29L13.41,13.17L9.41,9.17L2,16.59L3.41,18L9.41,12L13.41,16L19.71,9.71L22,12V6H16Z"
                                                            fill="currentColor"/>
                                                    </svg>
                                                    <span class="prose">
                                                        Rendimiento estipulado:  <span class="text-gray-500 font-light">{{
                                                            data.rendimiento_estipulado
                                                        }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </figure>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button
                                    class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out"
                                    type="button"
                                    @click.prevent="deleteElement(data)">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetActionSection from '@/Jetstream/ActionSection'
import JetButton from '@/Jetstream/Button'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetModal from '@/Jetstream/Modal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    components: {
        JetActionSection,
        JetButton,
        JetConfirmationModal,
        JetModal,
        JetDangerButton,
        JetSecondaryButton,
        AppLayout,

    },
    props: ['data', 'errors'],
    data() {
        return {
            form: this.$inertia.form({
                //
            }),
            vehiculo: {
                id: "",
                placa: "",
                color: "",
                modelo: "",
                tipoCombustible: "",
                rendimientoEstipulado: "",
                photo: null
            },
            photoPreview: null,
            confirmingUserDeletion: false
        }
    },
    methods: {
        alert(str1) {
            alert(str1)
        },
        deleteElement: function (data) {
            this.$swal({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    data._method = 'DELETE';
                    axios.post('/trucks/' + data.id, data)
                        .then((response) => {
                            // handle success
                            console.log('response', response)
                            this.$swal({
                                title: '!Buen trabajo¡',
                                text: "Registro eliminado con exito",
                                icon: 'success',
                            }).then(() => {
                                window.location.href = `${this.route('trucks.index')}`;
                            });
                        })
                        .catch((error) => {
                            // handle error
                            this.$swal({
                                title: 'Error referencial',
                                text: "No es posible eliminar este vehiculo, hay registros que dependen de el",
                                icon: 'error',
                            });
                            console.log(error);
                        });

                }
            })


        }
    }
}
</script>

<style scoped>

</style>
