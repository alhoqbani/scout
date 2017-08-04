<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <router-link :to="{name:'Home'}">Home</router-link>
                <router-link :to="{name:'Users'}">Users</router-link>
                <router-link :to="{name:'Posts'}">Posts</router-link>
                <router-link :to="{name:'Articles'}">Articles</router-link>

                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {}
</script>
