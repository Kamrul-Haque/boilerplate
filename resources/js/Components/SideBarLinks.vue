<script>
import NavLink from "@/Components/NavLink.vue";

export default {
    components: {NavLink},
    props: [
        'showSideBar'
    ],
}
</script>

<template>
    <NavLink :href="route('dashboard')"
             :active="route().current('dashboard')">
        <span class="mdi mdi-view-dashboard"></span>
        <span :class="[showSideBar ? 'pl-3' : 'md:hidden']">Dashboard</span>
    </NavLink>
    <NavLink :href="route('users.index')"
             :active="route().current('users.*')">
        <span class="mdi mdi-account-multiple"></span>
        <span :class="[showSideBar ? 'pl-3' : 'md:hidden']">Users</span>
    </NavLink>
    <NavLink :href="route('settings.edit', $page.props.settings.id)"
             :active="route().current('settings.*')">
        <span class="mdi mdi-cog"></span>
        <span :class="[showSideBar ? 'pl-3' : 'md:hidden']">Settings</span>
    </NavLink>
</template>
