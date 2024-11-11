<script setup>
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
import TextInput from '../components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
    remember: null
});

const submit = () => {
    form.post('/login', {
        onError: () => form.reset("password"),
    });
}
</script>
<template>
    <Head title="Login"/>

    <h1 class="title">Log into your account</h1>

    <div class="2-2/4 mx mx-auto">

        <form @submit.prevent="submit">



            <TextInput
             name="email"
             type="email"
             v-model="form.email"
             :message="form.errors.email" />

            <TextInput
             name="password"
            v-model="form.password"
            type="password"
            :message="form.errors.password" />

        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-2">
                <input type="checkbox" v-model="form.remember" id="remember">
            <label for="remember">Remember me</label>

            </div>
             <p class="text-slate-600">Need an Account? <a :href="route('register')">Register</a>
                </p>
        </div>

            <div>

                <button class="primary-btn" :disabled="form.
                processing">Login</button>
            </div>
        </form>

    </div>
</template>
