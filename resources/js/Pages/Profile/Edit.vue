<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>
<script>
export default{
    components:{
        Navigation,
        Footer
    }
}
</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <Navigation />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-[1180px] sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-black border-white border sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-black border-white border sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-black border-white border sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
        <Footer />
    </AuthenticatedLayout>
</template>
