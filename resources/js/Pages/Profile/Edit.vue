<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>
<script>
export default{
    data(){
        return{
            user: usePage().props.value.auth.user,
        }
    },
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
            <h2 class="font-semibold text-xl text-myGray leading-relaxed">Profile</h2>
        </template>

        
            <div class="py-12 mx-auto max-w-[1180px] space-y-6">
                
                <div class="p-4 sm:p-8 bg-myDark-400 rounded-xl /grid /grid-cols-2 /gap-x-6">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class=""
                    />
                    
                </div>
                <div class="grid grid-cols-[1fr,.7fr] gap-6">

                    <div class="p-4 sm:p-8 bg-myDark-400 rounded-xl">
                        <UpdatePasswordForm class="/max-w-xl" />
                    </div>
                    
                    <div class="p-4 sm:p-8 bg-myDark-400 rounded-xl">
                        <DeleteUserForm class="/max-w-xl" />
                    </div>
                </div>
            </div>
        <Footer />
    </AuthenticatedLayout>
</template>
