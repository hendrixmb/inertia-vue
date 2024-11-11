<script setup>
import Layout from  '../Layouts/Layout.vue';

defineOptions({layout: Layout})
</script>
<template>
    <Head :title="` | ${$page.component}` "/>

    <h1>Home page</h1>

</template>
