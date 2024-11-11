<script setup>
import { Link, Head } from '@inertiajs/vue3';
import { route } from '../../../vendor/tightenco/ziggy/src/js';
</script>
<template>
    <div>
        <h1 class="title">Welcome back {{ $page.props.auth.user.name }}

        </h1>
    </div>
</template>
