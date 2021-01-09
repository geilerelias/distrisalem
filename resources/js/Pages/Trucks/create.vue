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
                    <li class="flex items-center">
                        <a :href="route('trucks.index')" class="text-indigo-800">
                            Camiones
                        </a>
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                        </svg>
                    </li>
                    <li>
                        <a class="text-gray-500" aria-current="page">Crear</a>
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
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Información relevante</h3>
                            <p class="mt-1 text-sm leading-5 text-gray-600">
                                Agregue la información relevante del vehículo a registrar incluyendo una imagen del
                                mismo, tenga en cuenta que todos los campos son obligatorios.
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">

                        <form action="#" method="POST">

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
                                    <div class="my-3">
                                        <input type="file" class="hidden"
                                               ref="photo"
                                               @change="updatePhotoPreview">
                                        <jet-label for="photo" value="Foto"/>
                                        <!-- Current Profile Photo -->
                                        <div class="mt-2" v-show="! photoPreview">
                                            <img :src="require('@/../images/truck-icon.jpg')"
                                                 alt="Current Profile Photo"
                                                 class="rounded-full h-20 w-20 object-cover">
                                        </div>
                                        <!-- New Profile Photo Preview -->
                                        <div class="mt-2" v-show="photoPreview">
                                            <span class="block rounded-full w-20 h-20"
                                                  :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                            </span>
                                        </div>
                                        <jet-secondary-button class="mt-2 mr-2" type="button"
                                                              @click.native.prevent="selectNewPhoto">
                                            Seleccionar foto
                                        </jet-secondary-button>
                                        <jet-secondary-button type="button" class="mt-2"
                                                              @click.native.prevent="deletePhoto">
                                            Remover foto
                                        </jet-secondary-button>
                                        <div v-if="$page.errors.photo" class="text-red-500">{{
                                            $page.errors.photo[0]
                                            }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="placa_vehiculo"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Placa del vehículo
                                            </label>
                                            <input id="placa_vehiculo" v-model="vehiculo.placa"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">

                                            <div v-if="$page.errors.placa" class="text-red-500">{{
                                                $page.errors.placa[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="color"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Color del vehículo
                                            </label>
                                            <select id="color"
                                                    v-model="vehiculo.color"
                                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                <option selected="true" disabled="disabled">Selecciona</option>
                                                <option value="Blanco">Blanco</option>
                                                <option value="Negro">Negro</option>
                                                <option value="Plata">Plata</option>
                                                <option value="Gris">Gris</option>
                                                <option value="Azul">Azul</option>
                                                <option value="Rojo">Rojo</option>
                                                <option value="Beige">Beige</option>
                                                <option value="Amarillo">Amarillo</option>
                                                <option value="Verde">Verde</option>
                                                <option value="Otros">Otros</option>
                                            </select>

                                            <div v-if="$page.errors.color" class="text-red-500">{{
                                                $page.errors.color[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="modelo"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Modelo del vehículo
                                            </label>
                                            <input id="modelo" v-model="vehiculo.modelo"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <div v-if="$page.errors.modelo" class="text-red-500">{{
                                                $page.errors.modelo[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="rendimiento_estipulado"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Rendimiento estipulado del vehículo
                                            </label>
                                            <input id="rendimiento_estipulado" v-model="vehiculo.rendimientoEstipulado"
                                                   class="mt-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                            <div v-if="$page.errors.rendimientoEstipulado" class="text-red-500">{{
                                                $page.errors.rendimientoEstipulado[0]
                                                }}
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="tipo_combustible"
                                                   class="block text-sm font-medium leading-5 text-gray-700">
                                                Tipo de combustible
                                            </label>
                                            <select id="tipo_combustible" v-model="vehiculo.tipoCombustible"
                                                    class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                <option selected disabled>Selecciona</option>
                                                <option>Gasolina</option>
                                                <option>ACPM</option>
                                                <option>Gas</option>

                                            </select>
                                            <div v-if="$page.errors.tipoCombustible" class="text-red-500">{{
                                                $page.errors.tipoCombustible[0]
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button
                                        @click.prevent="save(vehiculo)" type="button"
                                        class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                        Guardar
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
    props: ['errors'],
    data() {
        return {
            imageData: "", // we will store base64 format of image in this string
            file: null,
            photoPreview: null,
            vehiculo: {
                placa: "",
                color: "",
                modelo: "",
                tipoCombustible: "",
                rendimientoEstipulado: "",
                photo: null
            },


        }
    },
    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }

            this.form.post(route('user-profile-information.update'), {
                preserveScroll: true
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deletePhoto() {
            this.$inertia.delete(route('current-user-photo.destroy'), {
                preserveScroll: true,
            }).then(() => {
                this.photoPreview = null
            });
        },
        save(data) {
            let formData = new FormData();
            formData.append("placa", data.placa);
            formData.append("color", data.color);
            formData.append("modelo", data.modelo);
            formData.append("tipoCombustible", data.tipoCombustible);
            formData.append("rendimientoEstipulado", data.rendimientoEstipulado);
            formData.append("photo", this.$refs.photo.files[0]);

            console.log(data)

            this.$inertia.post('/trucks', formData)
                .then((response) => {
                    // handle success
                    console.log(response);
                    if (this.$page.flash.message) {
                        this.$swal(
                            'Buen trabajo!',
                            this.$page.flash.message,
                            'success'
                        )
                        this.reset();
                    }

                })
                .catch((error) => {
                    // handle error
                    console.log(error);
                })
                .then(() => {
                    // always executed
                });

            // this.$swal({
            //     title: 'Are you sure?',
            //     text: "You won't be able to revert this!",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Yes, delete it!'
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //
            //     }
            // })


        },
        reset() {
            this.vehiculo = {
                placa: "",
                color: "",
                modelo: "",
                tipoCombustible: "",
                rendimientoEstipulado: "",
                photo: null
            };
            this.deletePhoto();
            console.log('reset');
        }
    }
}
</script>

<style scoped>

</style>

