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

        
            <div class="py-8 md:py-12 mx-auto px-[8%] sm:px-0 max-w-full sm:max-w-[580px] md:max-w-[730px] lg:max-w-[980px] xl:max-w-[1180px] space-y-6">
                
                <div class="p-4 sm:p-8 bg-myDark-400 rounded-xl">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class=""
                    />
                    
                </div>
                <div class="grid grid-cols-1 md:grid-cols-[1fr,.7fr] gap-6">

                    <div class="p-4 sm:p-8 bg-myDark-400 rounded-xl">
                        <UpdatePasswordForm />
                    </div>
                    
                    <div class="p-4 sm:p-8 bg-myDark-400 rounded-xl">
                        <DeleteUserForm />
                    </div>
                </div>
            </div>
        <Footer />
    </AuthenticatedLayout>
</template>
