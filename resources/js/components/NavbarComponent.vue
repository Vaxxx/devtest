<template>
    <div>
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading"><h1>Dev Test</h1></div>
            <div class="list-group list-group-flush mt-5">
                <router-link to="/first" class="list-group-item list-group-item-action bg-light"><i class="fas fa-tachometer-alt"></i> &nbsp;Dashboard</router-link>
                <router-link to="/gig" class="list-group-item list-group-item-action bg-light"> <i class="fas fa-robot"></i>&nbsp;Gigs</router-link>
                <router-link to="/company" class="list-group-item list-group-item-action bg-light"><i class="far fa-building"></i> &nbsp;Company</router-link>
                <router-link to="/account" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user"></i> &nbsp;Account</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
