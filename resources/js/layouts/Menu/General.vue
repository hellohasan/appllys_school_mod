<template>
    <Fragment>
        <li class="nav-header">General Section</li>
        <li class="nav-item">
            <router-link to="/profile" class="nav-link">
                <i class="nav-icon fas fa-user green"></i>
                <p>{{$t('profile')}}</p>
            </router-link>
        </li>
    </Fragment>
</template>

<script>
import role from '../../directive/role/index'
import {Fragment} from "vue-fragment";
export default {
    name: "General",
    components:{Fragment},
    directives:{role}
}
</script>

<style scoped>

</style>
